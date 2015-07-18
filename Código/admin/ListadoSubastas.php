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


$subastas=Subasta::recuperarSubastasTodas();
   $intfi=0;
$intff=0;


if(isset($_GET['fechainicio']))
  {
$fechai = $_GET['fechainicio'];
$intfi=strlen($fechai);
}

  if(isset($_GET['fechafin']))
  {
$fechaf = $_GET['fechafin'];
$intff=strlen($fechaf);
}



$informar='';
$informar2='';
$tipo=0;
   if (($intfi>0) and ($intff>0)) {
 
  $subastas=Subasta::filtrarPorFechas($fechai,$fechaf);

  $tipo=3;
  $informar='El siguiente listado contiene todas las subastas de Bestnid que se encuentran entre el día '.$fechai.' y el día '.$fechaf; 
  $informar2='Lo sentimos pero no se pudo encontrar ninguna subastas entre la fecha '.$fechai.' y '.$fechaf;
  }
  if ($intfi ==0 and ($intff>0)){
	  $subastas=Subasta::filtrarPorFechasFin($fechaf);
	  $tipo=3;
  $informar='El siguiente listado contiene todas las subastas activas de Bestnid hasta el día '.$fechaf;
  $informar2='Lo sentimos pero no se pudo encontrar ninguna subastas activa hasta el dia '.$fechaf;
  }
  if ($intfi >0 and ($intff==0)){
	  $subastas=Subasta::filtrarPorFechasInicio($fechai);
	  $tipo=3;
  $informar='El siguiente listado contiene todas las subastas activas de Bestnid desde el día '.$fechai; 
  $informar2='Lo sentimos pero no se pudo encontrar ninguna subastas activa desde fecha '.$fechai.' en adelante';
  }

//if (isset($_SESSION['UserLogged'])){
 //  $user=$_SESSION['UserLogged'];
   // include '../permisosAdmin.php'; 
   
	Twig_Autoloader::register();
$template = $twig->loadTemplate("ListadoSubastas.html.twig");

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
'AgregarAdmin' => 'Gestion de Administradores', 'CerrarSesion'=>$cerrarsesion, 'Ayuda'=>'Ayuda','informar'=>$informar, 'informar2'=>$informar2, 'nombre'=>$nombre,'apellido'=>$apellido, 'tipo'=>$tipo,
'Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','IniciarSesion' =>$iniciarsesion,'MiCuenta' => 'Mi Cuenta',
'Registrarse' =>$registrarse,'Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad','Ayuda' => 'Ayuda','subastas'=>$subastas,
'Categoria'=>'Categorias',
'nombre'=>$nombre,'apellido'=>$apellido,'CerrarSesion'=>$cerrarsesion,'MiCuenta'=>$micuenta,
'sobrebestnid'=>$sobrebestnid,
'ordenar'=>'Si lo desea puede ordenar nuestras subastas por alguno de los siguientes criterios:','tipo'=>$tipo, 'AltaAdmin'=>'Agregar administrador', 'Contacto'=>$contacto,
));




	//}
	?>