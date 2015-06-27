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

$categorias=Categoria::recuperarCategoriasTodas();
print_r($categorias);


Twig_Autoloader::register();
$template = $twig->loadTemplate("modificarcat.html.twig");
$template->display(array('Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','IniciarSesion' => 'Iniciar Sesion',
'Registrarse' => 'Registrarse','Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad', 'Ayuda' => 'Ayuda',

'Ingresenombre' => 'Ingrese su nombre de usuario','Ingresecontraseña' => 'Ingrese su contraseña',
'NombreUsuario' => 'Nombre de usuario','Contraseña' => 'Contraseña','sobrebestnid'=>$sobrebestnid,'contacto'=>$contacto,
));
?>