<?php
require_once '../Conexion.php';
require_once '../twig.php';
require_once '../categoria/categoria.php';
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

$nombre=null;
$cat=null;
$fechai=null;
$fechaf=null;

if(isset($_GET['titulo']))
{$nombre = $_GET['titulo'];}

if(isset($_GET['categoria']))
{$cat = $_GET['categoria'];}

if(isset($_GET['fechainicio']))
{$fechai = $_GET['fechainicio'];}

if(isset($_GET['fechafin']))
{$fechaf = $_GET['fechafin'];}

$intnombre=strlen($nombre);
$intcat=strlen($cat);
$intfi=strlen($fechai);
$intff=strlen($fechaf);
$tipo=0;



$subastas=Subasta::recuperarSubastasActivas();

if (($intnombre > 0) and ($cat=='i') and ($intfi==0) and ($intff==0)) {
  //echo "por nombre";
  $subastas=Subasta::filtrarPorTitulo($nombre);
  $tipo=1;
  $informar='El siguiente listado contiene todas las subastas activas de Bestnid con el nombre " '.$nombre.' "';
  $informar2='Lo sentimos pero no se pudo encontrar ninguna subastas activa con el nombre ":'.$nombre.' "';
}

if (($intnombre == 0) and ($cat!='i') and ($intfi==0) and ($intff==0)) {
 // echo "solo por categoria";
  $subastas=Subasta::filtrarPorCategoria($cat);
  $tipo=2;
  $quecategoria=Subasta::recuperarCategoriaSubasta($cat);
  $informar='El siguiente listado contiene todas las subastas activas de Bestnid pertenecientes a la categoria '.$quecategoria;
$informar2='Lo sentimos pero no se pudo encontrar ninguna subastas activa con la categoria '.$quecategoria;
  }
if (($intnombre == 0) and ($cat=='i') and ($intfi>0) and ($intff>0)) {
  //echo "solo por fecha";
  $subastas=Subasta::filtrarPorFechas($fechai,$fechaf);
  $tipo=3;
  $informar='El siguiente listado contiene todas las subastas activas de Bestnid que se encuentran entre el día '.$fechai.' y el día '.$fechaf; 
$informar2='Lo sentimos pero no se pudo encontrar ninguna subastas activa entre la fecha '.$fechai.' y '.$fechaf;
  }
if (($intnombre > 0) and ($cat!='i') and ($intfi==0) and ($intff==0)) {
  //echo "por nombre mas categoria";
  $subastas=Subasta::filtrarPorTituloyCategoria($nombre,$cat);
  $tipo=4;
  $quecategoria=Subasta::recuperarCategoriaSubasta($cat);
  $informar='El siguiente listado contiene todas las subastas activas de Bestnid con el nombre " '.$nombre.' " y pertenecientes a la categoria '.$quecategoria;
$informar2='Lo sentimos pero no se pudo encontrar ninguna subastas activa con el nombre " '.$nombre.' " y la categoria '.$quecategoria;
  }
if (($intnombre > 0) and ($cat=='i') and ($intfi>0) and ($intff>0)) {
  //echo "por nombre mas fechas";
  $subastas=Subasta::filtrarPorTituloyFechas($nombre,$fechai,$fechaf);
  $tipo=5;
  $informar='El siguiente listado contiene todas las subastas activas de Bestnid con el nombre " '.$nombre.' " que se encuentran entre el día '.$fechai.' y el día '.$fechaf;
$informar2='Lo sentimos pero no se pudo encontrar ninguna subastas activa con el nombre " '.$nombre.' " entre la fecha '.$fechai.' y '.$fechaf;
  }
if (($intnombre > 0) and ($cat!='i') and ($intfi>0) and ($intff>0)) {
  //echo "por nombre mas fechas mas categoria";
  $subastas=Subasta::filtrarPorTituloCategoriayFechas($nombre,$cat,$fechai,$fechaf);
  $tipo=6;
  $quecategoria=Subasta::recuperarCategoriaSubasta($cat);
  $informar='El siguiente listado contiene todas las subastas activas de Bestnid con el nombre " '.$nombre.' " pertenecientes a la categoria " '.$quecategoria.' " que se encuentran entre el día '.$fechai.' y el día '.$fechaf;
$informar2='Lo sentimos pero no se pudo encontrar ninguna subastas activa con el nombre " '.$nombre.' ", la categoria " '.$quecategoria.' " entre las fechas '.$fechai.' y '.$fechaf;
  }
if (($intnombre == 0) and ($cat!='i') and ($intfi>0) and ($intff>0)) {
  //echo "por categoria mas fecha";
  $subastas=Subasta::filtrarPorCategoriayFechas($cat,$fechai,$fechaf);
  $tipo=7;
  $quecategoria=Subasta::recuperarCategoriaSubasta($cat);
  $informar='El siguiente listado contiene todas las subastas activas de Bestnid pertenecientes a la categoria " '.$quecategoria.' " que se encuentran entre el día '.$fechai.' y el día '.$fechaf;
$informar2='Lo sentimos pero no se pudo encontrar ninguna subastas activa con la categoria " '.$quecategoria.' " entre la fecha '.$fechai.' y '.$fechaf;
  }



if (($intnombre == 0) and ($cat=='i') and ($intfi>0) and ($intff==0)) {
  //echo "por  fecha inicio";
  $subastas=Subasta::filtrarPorFechaInicio($fechai);
  $tipo=8;
   $informar='El siguiente listado contiene todas las subastas activas de Bestnid que se encuentran en el día '.$fechai;
$informar2='Lo sentimos pero no se pudo encontrar ninguna subastas activa con la fecha '.$fechai;
   }
if (($intnombre == 0) and ($cat!='i') and ($intfi>0) and ($intff==0)) {
  //echo "por fecha inicio + cat";
  $subastas=Subasta::filtrarPorFechaInicioMasCategoria($cat,$fechai);
  $tipo=9;
  $quecategoria=Subasta::recuperarCategoriaSubasta($cat);
  $informar='El siguiente listado contiene todas las subastas activas de Bestnid pertenecientes a la categoria " '.$quecategoria.' " que se encuentran en el día '.$fechai;
$informar2='Lo sentimos pero no se pudo encontrar ninguna subastas activa con la categoria  " '.$quecategoria.' " y la fecha '.$fechai;
  }
if (($intnombre > 0) and ($cat=='i') and ($intfi>0) and ($intff==0)) {
  //echo "por  fecha inicio + titulo";
  $subastas=Subasta::filtrarPorFechaInicioMasTitulo($nombre,$fechai);
  $tipo=10;
  $informar='El siguiente listado contiene todas las subastas activas de Bestnid con el nombre " '.$nombre.' " que se encuentran en el día '.$fechai;
$informar2='Lo sentimos pero no se pudo encontrar ninguna subastas activa con el nombre " '.$nombre.' "y la fecha '.$fechai;
  }
if (($intnombre > 0) and ($cat!='i') and ($intfi>0) and ($intff==0)) {
  //echo "por fechainicio titulo categoria";
  $subastas=Subasta::filtrarPorFechaInicioTituloyCategoria($nombre,$cat,$fechai);
  $tipo=11;
  $quecategoria=Subasta::recuperarCategoriaSubasta($cat);
  $informar='El siguiente listado contiene todas las subastas activas de Bestnid con el nombre " '.$nombre.' " pertenecientes a la categoria " '.$quecategoria.' " que se encuentran en el día '.$fechai;
$informar2='Lo sentimos pero no se pudo encontrar ninguna subastas activa con el nombre " '.$nombre.' ", la categoria " '.$quecategoria.' " y la fecha '.$fechai;
  }


if (($intnombre == 0) and ($cat=='i') and ($intfi==0) and ($intff>0)) {
  //echo "por  fecha fin";
  $subastas=Subasta::filtrarPorFechaFin($fechaf);
  $tipo=12;
  $informar='El siguiente listado contiene todas las subastas activas de Bestnid en el día fin '.$fechaf;
$informar2='Lo sentimos pero no se pudo encontrar ninguna subastas activa con la fecha fin '.$fechaf;
  }
if (($intnombre == 0) and ($cat!='i') and ($intfi==0) and ($intff>0)) {
  //echo "por fecha inicio + cat";
  $subastas=Subasta::filtrarPorFechaFinMasCategoria($cat,$fechaf);
  $tipo=13;
  $quecategoria=Subasta::recuperarCategoriaSubasta($cat);
  $informar='El siguiente listado contiene todas las subastas activas de Bestnid pertenecientes a la categoria " '.$quecategoria.' " que se encuentran en el día '.$fechai;
$informar2='Lo sentimos pero no se pudo encontrar ninguna subastas activa con la categoria " '.$quecategoria.' " y fecha '.$fechai;
  }
if (($intnombre > 0) and ($cat=='i') and ($intfi==0) and ($intff>0)) {
  //echo "por  fecha + titulo";
  $subastas=Subasta::filtrarPorFechaFinMasTitulo($nombre,$fechaf);
  $tipo=14;
  $informar='El siguiente listado contiene todas las subastas activas de Bestnid con el nombre " '.$nombre.' " en el día fin '.$fechaf;
  $informar2='Lo sentimos pero no se pudo encontrar ninguna subastas activa con el nombre ":'.$nombre.' " y fecha fin '.$fechaf;
}
if (($intnombre > 0) and ($cat!='i') and ($intfi==0) and ($intff>0)) {
  //echo "por categoria mas fecha";
  $subastas=Subasta::filtrarPorFechaFinTituloyCategoria($nombre,$cat,$fechaf);
  $tipo=15;
  $quecategoria=Subasta::recuperarCategoriaSubasta($cat);
  $informar='El siguiente listado contiene todas las subastas activas de Bestnid con el nombre " '.$nombre.' " pertenecientes a la categoria " '.$quecategoria.' " que se encuentran en el día fin '.$fechaf;
  $informar2='Lo sentimos pero no se pudo encontrar ninguna subastas activa con el nombre "'.$nombre.' ", categoria  " '.$quecategoria.' " y fecha fin '.$fechaf;
}

if (($intnombre == 0) and ($cat=='i') and ($intfi==0) and ($intff==0)) {
  //echo "la nada misma";
  $subastas=Subasta::recuperarSubastasActivas();
  $tipo=16;
  $informar='El siguiente listado contiene todas las subastas activas de Bestnid';
}




$categorias=Categoria::recuperarCategoriasActivas();


Twig_Autoloader::register();
$template = $twig->loadTemplate("subastas.html.twig");
$template->display(array('Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','IniciarSesion' => 'Iniciar Sesion','MiCuenta' => 'Mi Cuenta',
'Registrarse' => 'Registrarse','Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad','subastas'=>$subastas,
'Categoria'=>'Categorias','categorias'=>$categorias,
'Ingresenombre' => 'Ingrese su nombre de usuario','Ingresecontraseña' => 'Ingrese su contraseña',
'NombreUsuario' => 'Nombre de usuario','Contraseña' => 'Contraseña',
'tipo'=>$tipo,'nombre'=>$nombre,'categoria'=>$cat,'fechainicio'=>$fechai,'fechafin'=>$fechaf, 'informar'=>$informar, 'Ayuda' => 'Ayuda', 'Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','IniciarSesion' =>$iniciarsesion,'MiCuenta' => 'Mi Cuenta',
'Registrarse' =>$registrarse,'Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad','Ayuda' => 'Ayuda','subastas'=>$subastas,
'Categoria'=>'Categorias','categorias'=>$categorias,'bienvenido'=>$bienvenido,
'nombre'=>$nombre,'apellido'=>$apellido,'CerrarSesion'=>$cerrarsesion,'MiCuenta'=>$micuenta,
'sobrebestnid'=>$sobrebestnid,'contacto'=>$contacto,'informar'=>'El Siguiente listado contiene todas las subastas activas en Bestnid',
'ordenar'=>'Si lo desea puede ordenar nuestras subastas por alguno de los siguientes criterios:','tipo'=>$tipo, 'informar'=>$informar, 'losentimos'=>$informar2,

));
?>