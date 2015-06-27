<?php
require_once '../Conexion.php';
require_once '../twig.php';
require_once '../sesion/sesion.php';
require_once '../categoria/categoria.php';
if (!(isset($_SESSION['UserLogged'])))
   {
	$iniciarsesion='Iniciar Sesión';
	$registrarse='Registrarse';
	$sobrebestnid='Sobre Bestnid';
	$contacto='Contacto';
   }

$contenido = $_POST['titulo'];
$idestado = 1;

$categoria = new categoria(null,$contenido,$idestado);
$sobrebestnid='Sobre Bestnid';
$contacto='Contacto';
$dardealta=Categoria::altaCategoria($categoria);


Twig_Autoloader::register();
$template = $twig->loadTemplate("agregarcat.html.twig");
$template->display(array('Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','IniciarSesion' => 'Iniciar Sesion',
'Registrarse' => 'Registrarse','Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad', 'Ayuda' => 'Ayuda',

'Ingresenombre' => 'Ingrese su nombre de usuario','Ingresecontraseña' => 'Ingrese su contraseña',
'NombreUsuario' => 'Nombre de usuario','Contraseña' => 'Contraseña','sobrebestnid'=>$sobrebestnid,'contacto'=>$contacto,
));
?>