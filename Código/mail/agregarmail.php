<?php
require_once '../Conexion.php';
require_once '../mail/mail.php';
require_once '../twig.php';
require_once '../sesion/sesion.php';
require_once '../usuario/usuario.php';

if (!(isset($_SESSION['UserLogged'])))
   {
	$iniciarsesion='Iniciar Sesión';
	$registrarse='Registrarse';
	$sobrebestnid='Sobre Bestnid';
	$contacto='Contacto';
	$nombre=null;
	$apellido=null;
	$cerrarsesion=null;
	$micuenta=null;
	$bienvenido=null;
	}
else
	{
	$nombre=$_SESSION['Nombre'];
	$apellido=$_SESSION['Apellido'];
	$idusuario=$_SESSION['Id'];
	$cerrarsesion='Cerrar Sesion';
	$micuenta='Mi Cuenta';
	$bienvenido='Bienvenido:';
	$contacto='Contacto';
	$iniciarsesion=null;
	$registrarse=null;
	$sobrebestnid=null;
	$usuario= Usuario::recuperarUsuario($idusuario);
}
$ori = $_POST['origen'];


$dest= $_POST['destino'];

$asun=  $_POST['asunto'];

$cont = $_POST['contenido'];


$fecha=date("Y-m-j");
$mail = new mail(1,$ori,$dest,$fecha,$asun,$cont);

$dardealta=Mail::altaMail($mail);


if($dardealta==null)
{ $informar='mail no enviado ';}
else
  { $informar='Mail enviado de forma exitosa!';}


Twig_Autoloader::register();
$template = $twig->loadTemplate("altamail.html.twig");
$template->display(array('Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','MiCuenta' => 'Mi Cuenta',
'Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad','Ayuda' => 'Ayuda', 'Registrarse'=>$registrarse,
'informar'=>$informar,'bienvenido'=>$bienvenido,'CerrarSesion'=>$cerrarsesion,
'ordenar'=>'Si lo desea puede ordenar nuestras subastas por alguno de los siguientes criterios:', 'Contacto'=>$contacto,'nombre'=>$nombre, 'apellido'=>$apellido, 'IniciarSesion'=>$iniciarsesion,


));
?>