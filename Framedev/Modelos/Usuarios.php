<?php
require_once( '../vendor/manuelaguado/mysqldatatables/MysqlDatatable.php' );
class UsuariosModel
{
    function __construct($db,$dbt) {
        try {
            $this->db = $db;
			$this->dbt = $dbt;
        } catch (PDOException $e) {
            exit('No se ha podido establecer la conexión a la base de datos.');
        }
    }	
	public function agregar_usuario($arreglo){

		if( $arreglo['password'] == $arreglo['password2'] ){
			$respuesta = self::guardar_usuario($arreglo);
		}else{
			$respuesta = array('resp' => false , 'mensaje' => 'Error en captura de datos.' , 'error' => 'Las contraseñas ingresadas no son iguales.' );
		}

		return $respuesta;
	}


	public function guardar_usuario($arreglo){

		foreach ($arreglo as $key => $value) {
			$this->$key = strip_tags($value);
		}

		$respuesta = self::valida_login_correo($this->usuario,$this->correo);

		if($respuesta['resp'] == true ){
			
			$sql = "
				INSERT INTO fw_usuarios (
					id_ubicacion,
					password,
					cat_pass_chge,
					cat_status, 
					usuario, 
					correo, 
					id_rol, 
					nombres, 
					apellido_paterno,
					apellido_materno,
					user_alta,
					fecha_alta
				) VALUES (
					:id_ubicacion,
					:password,
					:cat_pass_chge,
					:cat_status, 
					:usuario, 
					:correo, 
					:id_rol, 
					:nombres, 
					:apellido_paterno,
					:apellido_materno,
					:user_alta,
					:fecha_alta
				)";
			$query = $this->db->prepare($sql);
			$query_resp = $query->execute(
				array(
					':id_ubicacion' => $this->id_ubicacion,
					':password' => md5($this->password), 
					':cat_pass_chge' => $this->change_pass, 
					':cat_status' => $this->cat_status, 
					':usuario' => trim($this->usuario),
					':correo' => $this->correo, 
					':id_rol' => $this->id_rol, 
					':nombres' => $this->nombres, 
					':apellido_paterno' => $this->apellido_paterno,
					':apellido_materno' => $this->apellido_materno,
					':user_alta' => $_SESSION['id_usuario'],
					':fecha_alta' => date("Y-m-d H:i:s")
				)
			);
			
			$id_usuario = $this->db->lastInsertId();
			
			self::crear_perfil($id_usuario);
			self::updateIngreso($this->fecha_ingreso,$id_usuario);
			
			if($query_resp){
				$respuesta = array('resp' => true , 'mensaje' => 'Registro guardado correctamente.', 'id_rol' =>  $this->id_rol, 'id_usuario' => $id_usuario);
			}else{
				$respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al insertar registro.' );
			}
			
		}

		return $respuesta;
	}

	public function valida_login_correo($usuario,$correo){
		$resp = true;
		$error = "";
		$mensaje = "";
		
		$resp_login = self::consulta_login($usuario);
		$resp_correo = self::consulta_correo($correo);
		if($resp_login['resp'] == true ){
			$resp=false;
			$mensaje = 'Error por duplicidad de datos.';
			$error.= 'Nombre de usuario no disponible.<br />';
		}
		if($resp_correo['resp'] == true ){
			$resp=false;
			$mensaje = 'Error por duplicidad de datos.';
			$error.= 'Cuenta de correo electrónico no disponible.'; 
		}
		return array('resp' => $resp, 'mensaje' => $mensaje, 'error' => $error );
	}
	public function consulta_login($usuario){
		$sql_usr="SELECT usuario FROM fw_usuarios WHERE usuario = '".$usuario."' ;";
		$query = $this->db->prepare($sql_usr);
		$query->execute();
		$query_resp = $query->fetchAll();

		if($query_resp){
			$respuesta = array('resp' => true, 'datos' => $query_resp );
		}else{
			$respuesta = array('resp' => false, 'mensaje' => 'Sin resultados.'  );
		}
		return $respuesta;
	}
	public function consulta_correo($correo){
		$sql_usr="SELECT correo FROM fw_usuarios WHERE correo = '".$correo."' ;";
		$query = $this->db->prepare($sql_usr);
		$query->execute();
		$query_resp = $query->fetchAll();

		if($query_resp){
			$respuesta = array('resp' => true, 'datos' => $query_resp );
		}else{
			$respuesta = array('resp' => false, 'mensaje' => 'Sin resultados en busqueda.'  );
		}
		return $respuesta;
	}
	public function obtener_usuarios($array){
		ini_set('memory_limit', '256M');				
		$table = 'fw_usuarios';
		$primaryKey = 'id_usuario';
		$columns = array(
			array( 
				'db' => 'id_usuario',
				'dbj' => 'id_usuario',
				'real' => 'id_usuario',
				'typ' => 'int',
				'dt' => 0
			),
			array( 
				'db' => 'usuario AS usuario',
				'dbj' => 'usuario',	
				'alias' => 'usuario',
				'real' => 'usuario',
				'typ' => 'txt',
				'dt' => 1
			),
			array( 
				'db' => 'correo AS correo',
				'dbj' => 'correo',				
				'real' => 'correo',
				'alias' => 'correo',
				'typ' => 'txt',
				'dt' => 2
			),
			array( 
				'db' => 'nombres AS nombres',
				'dbj' => 'nombres',
				'real' => 'nombres',
				'alias' => 'nombres',
				'typ' => 'int',
				'dt' => 3				
			),
			array( 
				'db' => 'apellido_paterno AS apellido_paterno',
				'dbj' => 'apellido_paterno',
				'real' => 'apellido_paterno',
				'alias' => 'apellido_paterno',
				'typ' => 'txt',
				'dt' => 4				
			),
			array( 
				'db' => 'apellido_materno AS apellido_materno',
				'dbj' => 'apellido_materno',
				'real' => 'apellido_materno',
				'alias' => 'apellido_materno',
				'typ' => 'txt',
				'dt' => 5				
			),
			array( 
				'db' => 'fw_roles.descripcion AS descripcion',
				'dbj' => 'fw_roles.descripcion',
				'real' => 'fw_roles.descripcion',
				'alias' => 'descripcion',
				'typ' => 'txt',
				'dt' => 6				
			),
		);
		$render_table = new SSP;
		$inner = '
			INNER JOIN fw_roles ON fw_usuarios.id_rol = fw_roles.id_rol
		';
		$where = '';
		return json_encode(
			$render_table->complex( $array, $this->dbt, $table, $primaryKey, $columns, null, $where, $inner )
		);
	}
	public function datos_usuario($user_id){
		$user_id = intval($user_id);
		$sql_usr="
			SELECT
				fw_usuarios.id_usuario,
				fw_usuarios.id_area,
				fw_usuarios.`password`,
				fw_usuarios.usuario,
				fw_usuarios.correo,
				fw_usuarios.id_rol,
				fw_usuarios.nombres,
				fw_usuarios.apellido_paterno,
				fw_usuarios.apellido_materno,
				fw_usuarios.id_ubicacion,
				fw_usuarios.cat_status,
				fw_usuarios.cat_pass_chge,
				fw_usuarios_config.fecha_ingreso
			FROM
				fw_usuarios
			INNER JOIN fw_usuarios_config ON fw_usuarios_config.id_usuario = fw_usuarios.id_usuario
			WHERE
				fw_usuarios.id_usuario = ".$user_id."		
		";
		$query = $this->db->prepare($sql_usr);
		$query->execute();
		$usuario = $query->fetchAll();
		$array = array();
		if($query->rowCount()>=1){
			foreach ($usuario as $row) {
					$array['id_usuario'] 		= $row->id_usuario;
					$array['usuario'] 			= $row->usuario;
					$array['correo' ]			= $row->correo;
					$array['id_rol'] 			= $row->id_rol;
					$array['nombres'] 			= $row->nombres;
					$array['apellido_paterno'] 	= $row->apellido_paterno;
					$array['apellido_materno'] 	= $row->apellido_materno;
					$array['id_ubicacion'] 		= $row->id_ubicacion;
					$array['password'] 			= $row->password;
					$array['cat_pass_chge'] 	= $row->cat_pass_chge;
					$array['cat_status'] 		= $row->cat_status;
					$array['fecha_ingreso'] 	= $row->fecha_ingreso;
			}
		}
		return $array;
	}
	public function perfil_usuario($user_id){
		$user_id = intval($user_id);
		$sql_usr="SELECT * FROM fw_usuarios_config WHERE id_usuario = ".$user_id."";
		$query = $this->db->prepare($sql_usr);
		$query->execute();
		$perfil = $query->fetchAll();
		$array = array();
		if($query->rowCount()>=1){
			foreach ($perfil as $row) {
					$array['avatar'] 			= $row->avatar;
					$array['paginacion'] 		= $row->paginacion;
					$array['activar_paginado'] 	= $row->activar_paginado;
			}
		}else{
			self::crear_perfil($user_id);
			self::perfil_usuario($user_id);
		}
		return $array;
	}
	public function verifica_token($token){
		$sql="SELECT * FROM fw_lost_password WHERE token = '".$token."'";
		$query = $this->db->prepare($sql);
		$query->execute();
		$lost_pass = $query->fetchAll();
		$array = array();
		if($query->rowCount()>=1){
			foreach ($lost_pass as $row) {
				$array['token'] 		= $row->token;
				$array['id_usuario'] 	= $row->id_usuario;
				$array['correo'] 		= $row->correo;
				$array['valid'] 		= true;
			}
		}else{
			$array['valid'] 		= false;
		}
		return $array;
	}
	public function cambiar_password($pass,$id_usuario){
		if(isset($_SESSION['id_usuario'])){$mod_user = $_SESSION['id_usuario'];}else{$mod_user = $id_usuario;}
		$sql = "UPDATE fw_usuarios SET password = '".md5($pass)."', user_mod = '".$mod_user."' where id_usuario = '".$id_usuario."'";
		$query = $this->db->prepare($sql);
		$query_resp = $query->execute();
		return $query_resp;
	}
	public function eliminar_token($token){
		$clean = "DELETE FROM fw_lost_password WHERE token = :token";
        $query = $this->db->prepare($clean);
        $query_resp = $query->execute(array(':token' => $token));
		return $query_resp;
	}
	public function editar_usuario($arreglo){
		foreach ($arreglo as $key => $value) {
			$this->$key = strip_tags($value);
		}
		if(($this->password == $this->password2)&&($this->password)){
			$change_pass = "password='".md5($this->password)."',";
		}else{
			$change_pass = "";
		}
		
				$sql = "UPDATE fw_usuarios SET 
						id_ubicacion 		=	'".$this->id_ubicacion."',
						$change_pass
						cat_status 			=	'".$this->cat_status."',
						cat_pass_chge 		=	'".$this->change_pass."',
						correo 				=	'".$this->correo."',
						id_rol 				=	'".$this->id_rol."',
						nombres 			=	'".$this->nombres."',
						apellido_paterno 	=	'".$this->apellido_paterno."',
						apellido_materno 	=	'".$this->apellido_materno."',
						user_mod			=   '".$_SESSION['id_usuario']."'
					where 
						id_usuario 	= 	'".$this->id_usuario."'
				";
				$query = $this->db->prepare($sql);
				$query_resp = $query->execute();	

		if($query_resp){
			self::updateIngreso($this->fecha_ingreso,$this->id_usuario);
			$respuesta = array('resp' => true , 'mensaje' => 'Registro guardado correctamente.' );
		}else{
			$respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al insertar registro.' );
		}
		return $respuesta;		
	}
	public function editar_perfil($arreglo){
		foreach ($arreglo as $key => $value) {
			$this->$key = strip_tags($value);
		}
		if(($this->password == $this->password2)&&($this->password != 'no_seas_miron')){
			$change_pass = "password='".md5($this->password)."',";
		}else{
			$change_pass = "";
		}
		
				$sql = "UPDATE fw_usuarios SET 
						$change_pass
						correo 				=	'".$this->correo."',
						nombres 			=	'".$this->nombres."',
						apellido_paterno 	=	'".$this->apellido_paterno."',
						apellido_materno 	=	'".$this->apellido_materno."',
						user_mod			=   '".$_SESSION['id_usuario']."'
					where 
						id_usuario 	= 	'".$_SESSION['id_usuario']."'
				";
				$query = $this->db->prepare($sql);
				$query_resp = $query->execute();
				
				self::crear_perfil($_SESSION['id_usuario']);
				
				if(self::crear_perfil($_SESSION['id_usuario'])){
					$activar_paginado = (!empty ($this->activar_paginado)) ? 1 : 0;
					$paginacion = $this->paginacion ? $this->paginacion : 0;
					$sql2 = "UPDATE fw_usuarios_config SET 
							paginacion 			=	'".$paginacion."',
							activar_paginado	= 	'".$activar_paginado."',
							user_mod			=   '".$_SESSION['id_usuario']."'
						where 
							id_usuario 	= 	'".$_SESSION['id_usuario']."'
					";
					$query2 = $this->db->prepare($sql2);
					$query_resp2 = $query2->execute();
				}
				
		if(($query_resp)&&($query_resp2)){
			$respuesta = array('resp' => true , 'mensaje' => 'El perfil guardado correctamente.', 'chackbox' => $activar_paginado, 'new_name' => $this->nombres );
		}else{
			$respuesta = array('resp' => false , 'mensaje' => 'Ocurrió un error al actualizar el perfil.' );
		}
		return $respuesta;		
	}
	function updateIngreso($fecha_ingreso,$id_usuario){
		$sql = "
			UPDATE fw_usuarios_config
			SET 
				fecha_ingreso = '".$fecha_ingreso."',
				user_mod = '".$_SESSION['id_usuario']."'
			WHERE
				id_usuario = '".$id_usuario."'			
		";
		$query = $this->db->prepare($sql);
		$result = $query->execute();	
	}
	function pass_chge_stat($stat,$user){
		$sql = "
			UPDATE fw_usuarios
			SET 
				cat_pass_chge = '".$stat."',
				user_mod = '".$_SESSION['id_usuario']."'
			WHERE
				id_usuario = '".$user."'			
		";
		$query = $this->db->prepare($sql);
		$result = $query->execute();
		return $result;
	}	
	function acceptTyc($stat){
		$sql = "
			UPDATE fw_usuarios_config
			SET 
				aceptar_tyc = '".$stat."',
				user_mod = '".$_SESSION['id_usuario']."'
			WHERE
				id_usuario = '".$_SESSION['id_usuario']."'			
		";
		$query = $this->db->prepare($sql);
		$result = $query->execute();
		if($result){
			$_SESSION['tyc'] = 'SI';
			$respuesta = array('resp' => true , 'dispositivo' => $_SESSION['dispositivo'] );
		}else{
			$_SESSION['tyc'] = 'NO';
			$respuesta = array('resp' => false , 'dispositivo' => $_SESSION['dispositivo'] );
		}
		return $respuesta;		
	}
	function set_avatar($avatar){
		$perfil = self::perfil_usuario($_SESSION['id_usuario']);
		$avatar_actual = $perfil['avatar'];
		
			if($avatar_actual){
				unlink('../uploads/perfiles/'.$avatar_actual);
			}
		
			$sql = "
				UPDATE fw_usuarios_config
				SET avatar = '".$avatar."',
				 user_mod = '".$_SESSION['id_usuario']."'
				WHERE
					id_usuario = '".$_SESSION['id_usuario']."'			
			";
			
		$query = $this->db->prepare($sql);
		$query_resp = $query->execute();
	}	
	private function crear_perfil($id_usuario){
		$sql="SELECT count(*) as existe FROM fw_usuarios_config where id_usuario = '".$id_usuario."'";
		$total = $this->db->prepare($sql);
		$total->execute();
		$existe = $total->fetch(PDO::FETCH_OBJ);	
		if($existe->existe == 1){
			return true;
		}else{
			$sql = "
				INSERT INTO fw_usuarios_config (
					id_usuario,
					user_alta,
					fecha_alta
				)
				VALUES
				(
					:id_usuario,
					:user_alta,
					:fecha_alta
				);
			";
			$query = $this->db->prepare($sql);
			$query_resp = $query->execute(array(
				':id_usuario' => $id_usuario,
				':user_alta' => $_SESSION['id_usuario'],
				':fecha_alta' => date("Y-m-d H:i:s") 
			));
			if($query_resp){
				return true;
			}else{
				return false;
			}
		}
	}
	public function baja_usuario($id_usuario){
		$sql = "UPDATE fw_usuarios SET cat_status = '5', user_mod = '".$_SESSION['id_usuario']."' where id_usuario = '".$id_usuario."'";
		$query = $this->db->prepare($sql);
		$query_resp = $query->execute();
		if($query_resp){
			$respuesta = array('resp' => true , 'mensaje' => 'La baja del usuario se realizó de manera correcta.' );
		}else{
			$respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al dar de baja al usuario.' );
		}
		return $respuesta;
	}
	public function logueados_get($array){
		ini_set('memory_limit', '256M');				
		$table = 'fw_login AS fwl';
		$primaryKey = 'fwl.id_usuario';
		$columns = array(
			array( 
				'db' => 'fwl.id_usuario as id_usuario',
				'dbj' => 'fwl.id_usuario',
				'real' => 'fwl.id_usuario',
				'alias' => 'id_usuario',
				'typ' => 'int',
				'dt' => 0
			),
			array( 
				'db' => 'fwu.usuario AS usuario',
				'dbj' => 'fwu.usuario',	
				'real' => 'fwu.usuario',
				'alias' => 'usuario',
				'typ' => 'txt',
				'dt' => 1
			),
			array( 
				'db' => 'CONCAT(fwu.nombres, " " ,	fwu.apellido_paterno, " " ,	fwu.apellido_materno) AS nombre',
				'dbj' => 'CONCAT(fwu.nombres, " " ,	fwu.apellido_paterno, " " ,	fwu.apellido_materno)',
				'real' => 'CONCAT(fwu.nombres, " " ,	fwu.apellido_paterno, " " ,	fwu.apellido_materno)',
				'alias' => 'nombre',
				'typ' => 'txt',
				'dt' => 2
			),
			array( 
				'db' => 'fwl.fecha_login AS fecha_login',
				'dbj' => 'fwl.fecha_login',
				'real' => 'fwl.fecha_login',
				'alias' => 'fecha_login',
				'typ' => 'int',
				'dt' => 3				
			),
			array( 
				'db' => 'fwl.ultima_verificacion AS ultima_verificacion',
				'dbj' => 'fwl.ultima_verificacion',
				'real' => 'fwl.ultima_verificacion',
				'alias' => 'ultima_verificacion',
				'typ' => 'txt',
				'dt' => 4				
			),
			array( 
				'db' => 'fwl.ipv4 AS ipv4',
				'dbj' => 'fwl.ipv4',
				'real' => 'fwl.ipv4',
				'alias' => 'ipv4',
				'typ' => 'txt',
				'dt' => 5				
			),
			array( 
				'db' => 'fwl.session_id AS session_id',
				'dbj' => 'fwl.session_id',
				'real' => 'fwl.session_id',
				'alias' => 'session_id',
				'typ' => 'txt',
				'dt' => 6			
			),
			array( 
				'db' => 'fwl.session_id AS session_idx',
				'dbj' => 'fwl.session_id',
				'real' => 'fwl.session_id',
				'alias' => 'session_idx',
				'typ' => 'txt',
				'acciones' => true,
				'dt' => 7
			)
		);
		$render_table = new acciones_login;
		$inner = '
			INNER JOIN fw_usuarios AS fwu ON fwl.id_usuario = fwu.id_usuario
		';
		$where = '
			fwl.`open` = 1
		';
		return json_encode(
			$render_table->complex( $array, $this->dbt, $table, $primaryKey, $columns, null, $where, $inner )
		);
	}	
}
class acciones_login extends SSP{
	static function data_output ( $columns, $data, $db )
	{
		$out = array();
		for ( $i=0, $ien=count($data) ; $i<$ien ; $i++ ) {
			$row = array();

			for ( $j=0, $jen=count($columns) ; $j<$jen ; $j++ ) {
				$column = $columns[$j];
				$name_column = ( isset($column['alias']) )? $column['alias'] : $column['db'] ;
				if ( isset( $column['acciones'] ) ) {
					
					$id_usuario 		= $data[$i][ 'id_usuario' ];
					
					$salida = '<table><tr>';

					if(Controlador::tiene_permiso('Login|force_sign_out')){
						$salida .= '
							<td style="padding:0px!important;"><div class="hidden-sm hidden-xs btn-group">
								<a onclick = "modal_sign_out('.$id_usuario.');" class="btn btn-xs btn-warning tooltip-warning" data-rel="tooltip" data-original-title="Des-loguear usuario">
									<i class="ace-icon fa fa-sign-out bigger-120"></i>
								</a>
							</div></td>				
						';
					}
					$salida .= '</tr></table>';
					
					$row[ $column['dt'] ] = $salida;
				}else{
					$row[ $column['dt'] ] = $data[$i][$name_column];	
				}
			}
			$out[] = $row;
		}
		return $out;
	}
}