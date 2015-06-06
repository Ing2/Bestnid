<?php
require_once '../Conexion.php';
require_once '../twig.php';
require_once '../categoria/categoria.php';
require_once '../subasta/subasta.php';

$tipo= $_GET['tipo'];
$nombre = $_GET['nombre'];
$cat = $_GET['categoria'];
$fechai = $_GET['fechainicio'];
$fechaf = $_GET['fechafin'];

if ($tipo==1) {
  $subastas=Subasta::filtrarPorNombreyOrdenarPorFechaVencimiento($nombre);
}
if ($tipo==2) {
  $subastas=Subasta::filtrarPorCategoriayOrdenarPorFechaVencimiento($cat);
}
if ($tipo==3) {
  $subastas=Subasta::filtrarPorFechayOrdenarPorFechaVencimiento($fechai,$fechaf);
}
if ($tipo==4) {
  $subastas=Subasta::filtrarPorNombremasCategoriayOrdenarPorFechaVencimiento($nombre,$cat);
}
if ($tipo==5) {
  $subastas=Subasta::filtrarPorNombremasFechasyOrdenarPorFechaVencimiento($nombre,$fechai,$fechaf);
}
if ($tipo==6) {
  $subastas=Subasta::filtrarPorNombremasFechasmasCategoriayOrdenarPorFechaVencimiento($nombre,$cat,$fechai,$fechaf);
}
if ($tipo==7) {
  $subastas=Subasta::filtrarPorCategoriamasFechasyOrdenarPorFechaVencimiento($cat,$fechai,$fechaf);
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
'tipo'=>$tipo,'nombre'=>$nombre,'categoria'=>$cat,'fechainicio'=>$fechai,'fechafin'=>$fechaf
));
?>