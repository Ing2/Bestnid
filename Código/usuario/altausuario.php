<?php
require_once '../Conexion.php';
require_once '../twig.php';
//require_once '../seguridad.php';
require_once '../usuario/usuario.php';

$clave = $_POST['con1'];


$nom = $_POST['nombre'];

$ape =  $_POST['apellido'];

$mail = $_POST['email'];

$tipo=2;
$fechaalta=date("Y-m-j");
$usuario = new usuario(1,$nom,$ape,$mail,$fechaalta,$tipo,$clave);

$dardealta=Usuario::altaUsuario($usuario);
$informar='Por favor diríjase a la sección de registro si desea darse de alta en bestnid';

if($dardealta==null)
{ $informar='Lo Sentimos pero ya existe un usuario con ese mail por favor vuelva a intentar registrarse! ';}
else
  { $informar='Bienvenido a Bestnid , por favor empiece a disfrutar de nuestro sitio';}


Twig_Autoloader::register();
$template = $twig->loadTemplate("altausuario.html.twig");

$template->display(array('Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','IniciarSesion' => 'Iniciar Sesion','MiCuenta' => 'Mi Cuenta',
'Registrarse' => 'Registrarse','Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad','Informar' => $informar,

'Ingresenombre' => 'Ingrese su nombre de usuario','Ingresecontraseña' => 'Ingrese su contraseña',
'NombreUsuario' => 'Nombre de usuario','Contraseña' => 'Contraseña','Acciones' => 'Acciones',
'Admin' => 'Admin','ModificarDatos' => 'Modificar Datos Propios','ManejoUsuario' => 'Gestion De Usuarios',
'ManejoCategoria' => 'Gestion de Categorias','VerComentarios' => 'Listado de Comentarios',
'VerOfertas' => 'Listado de Ofertas','VerSubastas' => 'Ver Subastas',
'AgregarAdmin' => 'Gestion de Administradores',

));




	
	?>