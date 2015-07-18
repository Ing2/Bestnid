<?php
require_once '../Conexion.php';
require_once '../twig.php';
//require_once '../seguridad.php';
require_once '../usuario/usuario.php';
require_once '../sesion/sesion.php';
require_once '../subasta/subasta.php';
//if (isset($_SESSION['UserLogged'])){
  // $user=$_SESSION['UserLogged'];
    //$tipo=$user->getTipo();
    //include '../permisosAdmin.php';

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
	$cerrarsesion='Cerrar Sesion';
	$micuenta='Mi Cuenta';
	$bienvenido='Bienvenido:';
	$contacto='Contacto';
	$iniciarsesion=null;
	$registrarse=null;
	$sobrebestnid=null;
}
$id=$_SESSION['Id'];
   $subastas=Subasta::recuperarSubastasFinalizadasParaUnUsuario($id);



	Twig_Autoloader::register();
$template = $twig->loadTemplate("FrontEnd.html.twig");

$template->display(array('Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','IniciarSesion' => 'Iniciar Sesion',
'Registrarse' => 'Registrarse','Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad', 'Ayuda' => 'Ayuda', 'CerrarSesion' => 'Cerrar Sesion',

'Ingresenombre' => 'Ingrese su nombre de usuario','Ingresecontraseña' => 'Ingrese su contraseña',
'NombreUsuario' => 'Nombre de usuario','Contraseña' => 'Contraseña','Acciones' => 'Acciones',
'Admin' => 'Admin','ModificarDatos' => 'Modificar Datos Propios','ManejoUsuario' => 'Gestion De Usuarios',
'ManejoCategoria' => 'Gestion de Categorias','VerComentarios' => 'Listado de Comentarios',
'VerOfertas' => 'Listado de Ofertas','VerSubastas' => 'Ver Subastas',
'AgregarAdmin' => 'Gestion de Administradores',
'nombre'=>$_SESSION['Nombre'],'apellido'=>$_SESSION['Apellido'], 'bienvenido'=>$bienvenido,'subastas'=>$subastas, 'Contacto'=>$contacto,

));




	//}
	?>