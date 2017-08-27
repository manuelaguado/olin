<?php
class Site extends Controlador
{
       public function index()
       {
              $load='site/page/index/index';
              require SITE.'plantilla/index.php';
       }

       public function page($folder,$file,$process=null){
              $newfldr = str_replace('|', '/', $folder);

              if (file_exists(DIR_FILES.'/vistas/site/'.$newfldr.'/'.$file.'.php')){

                     if(@$process != 'undefined'){include(URL_MAIN.'resources/process_site.php');}
                     require SITE.$newfldr.'/'.$file.'.php';
                     require_once(SITE.'plantilla/init.php');

              }else{

                     $load='site/page/extra/404';
                     require SITE.'plantilla/index.php';

              }


       }

       function mail(){
              $datamail = array();
              $datamail['destinatarios'] = array(
                     'manuelaguado@gmail.com'
              );
              $datamail['plantilla'] 	= 'basica';
              $datamail['subject'] 	= 'Informe';
              $datamail['body'] 		= array(
                     'fecha'			=>	'México D.F. a 16 de Noviembre de 2015',
                     'asunto'		=>	'Se le informa la finalización del plan',
                     'firma'			=>	'Ing Pocoyó',
                     'hospital'		=>	'Belisario Domíguez'
              );
              $this->sendMail($datamail);
       }
}
?>
