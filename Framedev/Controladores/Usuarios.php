<?php
class Usuarios extends Controlador
{
    public function index()
    {
		$this->se_requiere_logueo(true,'Usuarios|index');
        require URL_VISTA.'usuarios/usuarios.php';
    }
	public function logueados()
    {
		$this->se_requiere_logueo(true,'Usuarios|logueados');
        require URL_VISTA.'usuarios/logueados.php';
    }
	public function logueados_get()
    {
		$this->se_requiere_logueo(true,'Usuarios|logueados');
        $modelo = $this->loadModel('Usuarios');
		print $modelo->logueados_get($_POST);
    }
	public function tyc($stat){
		$model = $this->loadModel('Usuarios');
		print json_encode($model->acceptTyc($stat));
	}
    public function obtener_usuarios()
    {
		$this->se_requiere_logueo(true,'Usuarios|obtener_usuarios');
		$obtener_modelo = $this->loadModel('Usuarios');
		print $obtener_modelo->obtener_usuarios($_POST);
    }
    public function perfil()
    {
		$this->se_requiere_logueo(true,'Usuarios|perfil');
		$usuario_data = $this->loadModel('Usuarios');
		$usuario = $usuario_data->datos_usuario($_SESSION['id_usuario']);
		$perfil  = $usuario_data->perfil_usuario($_SESSION['id_usuario']);
		if($perfil['avatar']){$avatar = self::duplicatePublic($perfil['avatar']);}
		

			$model = $this->loadModel('Login');
			$credenciales_top = $model->credenciales();
			
			$usuario_menu_top = $usuario_data->datos_usuario($_SESSION['id_usuario']);

			$usuario_name = $usuario_menu_top['nombres'];		
		
		
		require URL_VISTA.'usuarios/perfil.php';
    }
	public function upload_avatar(){
		$this->se_requiere_logueo(true,'Usuarios|upload_avatar');
		$upload_dir = '../uploads/perfiles/';
		$allowed_ext = array('jpg','jpeg','png','gif');
		
		if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
			self::exit_status('Error! Error en el metodo HTTP!'.$_SERVER['REQUEST_METHOD']);
		} 
		if(array_key_exists('pic',$_FILES) && $_FILES['pic']['error'] == 0 ){
			$pic = $_FILES['pic'];
			if(!in_array(self::get_extension($pic['name']),$allowed_ext)){
				self::exit_status('Solo las extensiones '.implode(',',$allowed_ext).' son permitidas!');
			}
			$extension_or = pathinfo($pic['name']);
			$destino_final = $upload_dir.$this->token(6).'.'.$extension_or['extension'];
			if (file_exists($destino_final)){
				$destino_final = self::smart_rename($destino_final);
			}
			if(move_uploaded_file($pic['tmp_name'], $destino_final)){
				$elemento = pathinfo($destino_final);
				$extension = $elemento['extension'];
				$nombre = $elemento['filename'];
				$set_image = $this->loadModel('Usuarios');
				$inserta_imagen = $set_image->set_avatar($nombre.'.'.$extension);
				$avatar = self::duplicatePublic($nombre.'.'.$extension);
				self::exit_status($avatar);
			}

		}else{
			self::exit_status('Algunos errores ocurrieron al actualizar el avatar: '.$_FILES['pic']['error']);
		}
	}
	private function exit_status($str){
		$this->se_requiere_logueo(true,'Usuarios|upload_avatar');
		if($str){
			echo json_encode(array('status'=>$str)); 
			exit;	
		}
	}
	private function get_extension($file_name){
		$this->se_requiere_logueo(true,'Usuarios|upload_avatar');
		if($file_name){
			$ext = explode('.', $file_name);
			$ext = array_pop($ext);
			return strtolower($ext);	
		}
	}
	private function smart_rename($ruta){
		$this->se_requiere_logueo(true,'Usuarios|upload_avatar');
		if($ruta){
			$elemento = pathinfo($ruta);
			$hash = $this->token(3);
			$new_file = $elemento['dirname'].'/'.$elemento['filename'].'_'.$hash.'.'.$elemento['extension'];
			if (file_exists($new_file)){
				$new_file = self::smart_rename($new_file);
			}else{
				return $new_file;
			}
		}
	}	

    public function datos_usuario($user_id)
    {
		$this->se_requiere_logueo(true,'Usuarios|datos_usuario');
		
		$usuario_data = $this->loadModel('Usuarios');
		$usuario = $usuario_data->datos_usuario($user_id);
		
		$ubicacion_data = $this->loadModel('Ubicacion');
		$ubicacion = $ubicacion_data->select_ubicaciones($usuario['id_ubicacion']);
		
		$usuarios = $this->loadModel('Roles');
		$roles = $usuarios->selectRolesByTipo("'27','25'",$_SESSION['id_rol'],$usuario['id_rol']);
		
		if(($usuario['cat_status'])==3){$chk_cat_status = "checked";$cat_status = 3;}else{$chk_cat_status = "";$cat_status = $usuario['cat_status'];}
		if(($usuario['cat_pass_chge'])==132){$chk_change_pass = "checked";$change_pass = 132;}else{$chk_change_pass = "";$change_pass = $usuario['cat_pass_chge'];}
		
		require URL_VISTA.'modales/usuarios/editar_usuario.php';	
    }
	public function modal_add_usr(){
		$this->se_requiere_logueo(true,'Usuarios|modal_add_usr');
		
		$ubicacion_data = $this->loadModel('Ubicacion');
		$ubicacion = $ubicacion_data->select_ubicaciones('');
		
		$usuarios = $this->loadModel('Roles');
		$roles = $usuarios->selectRolesByTipo("'27','25'",$_SESSION['id_rol']);
		
		require URL_VISTA.'modales/usuarios/nuevo_usuario.php';
	}
	public function agregar_usuario(){
		$this->se_requiere_logueo(true,'Usuarios|agregar_usuario');
		$usuario_model = $this->loadModel('Usuarios');
		$inserta_usuario = $usuario_model->agregar_usuario($_POST);
		print json_encode($inserta_usuario);
	}
	public function resetpassword($token){
		if(!$token){Header("Location: ".URL_APP."login"); exit();}
		$this->se_requiere_logueo(false);
		$modelo = $this->loadModel('Usuarios');
		$token_valid = $modelo->verifica_token($token);
		if($token_valid['valid']){
			require URL_VISTA.'login/restore.php';
		}else{
			Header("Location: ".URL_APP."login");
		}
	}
	public function setpassword_lost(){
		$this->se_requiere_logueo(false);
		
		$modelo = $this->loadModel('Usuarios');
		$token_valid = $modelo->verifica_token($_POST['token']);
		
		if(($token_valid['valid'])&&($_POST['password2'] == $_POST['password'])){
		
			$reset_pass = $modelo->cambiar_password($_POST['password'],$token_valid['id_usuario']);
			if($reset_pass){
				$clear = $modelo->eliminar_token($_POST['token']);
				
				if($clear){
					$respuesta = array('resp' => true , 'mensaje' => 'Se cambió satisfactoriamente su contraseña' );
				}else{
					$respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al insertar registro.' );
				}				
				echo json_encode($respuesta);				
			}
		}else{
			Header("Location: ".URL_APP."login");
		}
	}
	public function editar_usuario(){
		$this->se_requiere_logueo(true,'Usuarios|editar_usuario');
		$usuario_model = $this->loadModel('Usuarios');
		$edita_usuario = $usuario_model->editar_usuario($_POST);
		print json_encode($edita_usuario);
	}
	
	public function cambiar_password(){
		$_SESSION['pass_chge'] = 133;
		$this->se_requiere_logueo(true,'Usuarios|editar_perfil');
		$usuario_model = $this->loadModel('Usuarios');
		
		if(($_POST['password1'] == $_POST['password2'])&&($_POST['password1'])){
			$chge_pass = $cambiar_password = $usuario_model->cambiar_password($_POST['password1'],$_SESSION['id_usuario']);
		}
		if($chge_pass){
			$set_pass_chge = $usuario_model->pass_chge_stat(133,$_SESSION['id_usuario']);
			if($set_pass_chge){
				$respuesta = array('resp' => true , 'dispositivo' => $_SESSION['dispositivo'] );
			}else{
				$_SESSION['pass_chge'] = 132;
				$respuesta = array('resp' => false , 'dispositivo' => $_SESSION['dispositivo'] );
			}				
		}else{
			$_SESSION['pass_chge'] = 132;
			$respuesta = array('resp' => false , 'dispositivo' => $_SESSION['dispositivo'] );
		}
		print json_encode($respuesta);
	}
	
	public function editar_perfil(){
		$this->se_requiere_logueo(true,'Usuarios|editar_perfil');
		$usuario_model = $this->loadModel('Usuarios');
		$edita_perfil = $usuario_model->editar_perfil($_POST);
		print json_encode($edita_perfil);
	}
	public function baja_usuario($id){
		$this->se_requiere_logueo(true,'Usuarios|baja_usuario');
		$baja_usr = $this->loadModel('Usuarios');
		$baja_user = $baja_usr->baja_usuario($id);
		print json_encode($baja_user);
	}
}
?>
