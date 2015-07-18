<?php
require_once '../Conexion.php';
require_once '../twig.php';
require_once '../seguridad.php';
require_once '../usuario/usuario.php';
require_once '../subasta/subasta.php';
require_once '../sesion/sesion.php';

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
	$tipo=null;
	}
else
	{
	$tipo=$_SESSION['Tipo'];
	$nombre=$_SESSION['Nombre'];
	$apellido=$_SESSION['Apellido'];
	$cerrarsesion='Cerrar Sesion';
	$micuenta='Mi Cuenta';
	$bienvenido='Bienvenido:';
	$contacto='Contacto';
	$iniciarsesion=null;
	$registrarse=null;
	$sobrebestnid=null;
}

//if (isset($_SESSION['UserLogged'])){
 //  $user=$_SESSION['UserLogged'];
   // include '../permisosAdmin.php'; 
   $id=$_SESSION['Id'];
   $subastas=Subasta::recuperarSubastasActivasParaUnUsuario($id);

if($subastas==null)
{
	$notienesubastas="Usted no posee ninguna subastas activa!!!";
}
else
{
	$notienesubastas=null;
}
$elimino=null;

$informar=null;
Twig_Autoloader::register();
$template = $twig->loadTemplate("ListadoSubastasActivas.html.twig");

$template->display(array('Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','IniciarSesion' => 'Iniciar Sesion','MiCuenta' => 'Mi Cuenta',
'Registrarse' => 'Registrarse','Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad','subastas'=>$subastas,

'Ingresenombre' => 'Ingrese su nombre de usuario','Ingresecontraseña' => 'Ingrese su contraseña',
'NombreUsuario' => 'Nombre de usuario','Contraseña' => 'Contraseña','Acciones' => 'Acciones',
'Admin' => 'Admin','ModificarDatos' => 'Modificar Datos Propios','ManejoUsuario' => 'Gestion De Usuarios',
'ManejoCategoria' => 'Gestion de Categorias','VerComentarios' => 'Listado de Comentarios',
'VerOfertas' => 'Listado de Ofertas','VerSubastas' => 'Ver Subastas', 
'AgregarAdmin' => 'Gestion de Administradores', 'Ayuda' => 'Ayuda', 'CerrarSesion'=>$cerrarsesion,'MiCuenta'=>$micuenta, 'nombre'=>$nombre,'apellido'=>$apellido,
'informar'=>$informar,'notienesubastas'=>$notienesubastas,
'elimino'=>$elimino,'Contacto'=>$contacto,
));




	//}
	?>