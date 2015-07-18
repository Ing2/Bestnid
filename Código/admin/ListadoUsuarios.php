<?php
require_once '../Conexion.php';
require_once '../twig.php';
require_once '../seguridad.php';
require_once '../usuario/usuario.php';
require_once '../subasta/subasta.php';

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

//if (isset($_SESSION['UserLogged'])){
 //  $user=$_SESSION['UserLogged'];
   // include '../permisosAdmin.php'; 
   $intfi=0;
$intff=0;
   $subastas=Usuario::recuperarUsuariosTodos();
  
  if(isset($_GET['fechainicio']))
  {$fechai = $_GET['fechainicio'];
   $intfi=strlen($fechai);
}


  if(isset($_GET['fechafin']))
  {$fechaf = $_GET['fechafin'];
	$intff=strlen($fechaf);}
$informar='';
$informar2='';
$tipo=0;
   if (($intfi>0) and ($intff>0)) {
 
  $subastas=Usuario::filtrarPorFechas($fechai,$fechaf);

  $tipo=3;
  $informar='El siguiente listado contiene todas los usuarios de Bestnid que se encuentran entre el día '.$fechai.' y el día '.$fechaf; 
  $informar2='Lo sentimos pero no se pudo encontrar ningun usuario que se haya dado de alta entre la fecha '.$fechai.' y '.$fechaf;
  }
  if ($intfi ==0 and ($intff>0)){
	  $subastas=Usuario::filtrarPorFechasFin($fechaf);
	  $tipo=3;
  $informar='El siguiente listado contiene todas los usuarios de Bestnid que se dieron de alta antes del dia: '.$fechaf;
  $informar2='Lo sentimos pero no se pudo encontrar ningun usuario que se haya dado alta antes del dia: '.$fechaf;
  }
  if ($intfi >0 and ($intff==0)){
	  $subastas=Usuario::filtrarPorFechasInicio($fechai);
	  $tipo=3;
  $informar='El siguiente listado contiene todas los usuarios de Bestnid que se dieron de alta desde el dia: '.$fechai.' hasta el dia de hoy'; 
  $informar2='Lo sentimos pero no se pudo encontrar ningun usuario que se haya dado alta desde el dia: '.$fechai.' hasta el dia de hoy';
  }
  
  
  
	Twig_Autoloader::register();
$template = $twig->loadTemplate("ListadoUsuarios.html.twig");

$template->display(array('Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','IniciarSesion' => 'Iniciar Sesion','MiCuenta' => 'Mi Cuenta',
'Registrarse' => 'Registrarse','Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad','subastas'=>$subastas,'tipo'=>$tipo,'nombre'=>$nombre,
 'Ayuda' => 'Ayuda',
 'Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home', 'apellido'=>$apellido,

'Ingresenombre' => 'Ingrese su nombre de usuario','Ingresecontraseña' => 'Ingrese su contraseña',
'NombreUsuario' => 'Nombre de usuario','Contraseña' => 'Contraseña','Acciones' => 'Acciones',
'Admin' => 'Admin','ModificarDatos' => 'Modificar Datos Propios','ManejoUsuario' => 'Gestion De Usuarios',
'ManejoCategoria' => 'Gestion de Categorias','VerComentarios' => 'Listado de Comentarios',
'VerOfertas' => 'Listado de Ofertas','VerSubastas' => 'Ver Subastas',
'AgregarAdmin' => 'Gestion de Administradores', 'CerrarSesion'=>$cerrarsesion, 'Ayuda'=>'Ayuda', 'informar'=>$informar, 'informar2'=>$informar2, 'AltaAdmin'=>'Agregar administrador', 'Contacto'=>$contacto,

));




	//}
	?>