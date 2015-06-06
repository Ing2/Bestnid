<?php
require_once '../Conexion.php';
require_once '../twig.php';
require_once '../categoria/categoria.php';
require_once '../subasta/subasta.php';

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
}

if (($intnombre == 0) and ($cat!='i') and ($intfi==0) and ($intff==0)) {
 // echo "solo por categoria";
  $subastas=Subasta::filtrarPorCategoria($cat);
  $tipo=2;
}
if (($intnombre == 0) and ($cat=='i') and ($intfi>0) and ($intff>0)) {
  //echo "solo por fecha";
  $subastas=Subasta::filtrarPorFechas($fechai,$fechaf);
  $tipo=3;
}
if (($intnombre > 0) and ($cat!='i') and ($intfi==0) and ($intff==0)) {
  //echo "por nombre mas categoria";
  $subastas=Subasta::filtrarPorTituloyCategoria($nombre,$cat);
  $tipo=4;
}
if (($intnombre > 0) and ($cat=='i') and ($intfi>0) and ($intff>0)) {
  //echo "por nombre mas fechas";
  $subastas=Subasta::filtrarPorTituloyFechas($nombre,$fechai,$fechaf);
  $tipo=5;
}
if (($intnombre > 0) and ($cat!='i') and ($intfi>0) and ($intff>0)) {
  //echo "por nombre mas fechas mas categoria";
  $subastas=Subasta::filtrarPorTituloCategoriayFechas($nombre,$cat,$fechai,$fechaf);
  $tipo=6;
}
if (($intnombre == 0) and ($cat!='i') and ($intfi>0) and ($intff>0)) {
  //echo "por categoria mas fecha";
  $subastas=Subasta::filtrarPorCategoriayFechas($cat,$fechai,$fechaf);
  $tipo=7;
}





$categorias=Categoria::recuperarCategoriasActivas();


Twig_Autoloader::register();
$template = $twig->loadTemplate("subastas.html.twig");
$template->display(array('Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','IniciarSesion' => 'Iniciar Sesion','MiCuenta' => 'Mi Cuenta',
'Registrarse' => 'Registrarse','Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad','subastas'=>$subastas, 'Ayuda' => 'Ayuda',
'Categoria'=>'Categorias','categorias'=>$categorias,
'Ingresenombre' => 'Ingrese su nombre de usuario','Ingresecontraseña' => 'Ingrese su contraseña',
'NombreUsuario' => 'Nombre de usuario','Contraseña' => 'Contraseña',
'tipo'=>$tipo,'nombre'=>$nombre,'categoria'=>$cat,'fechainicio'=>$fechai,'fechafin'=>$fechaf

));
?>