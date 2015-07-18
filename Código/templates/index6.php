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

$tipo= $_GET['tipo'];
$nombre = $_GET['nombre'];
$cat = $_GET['categoria'];
$fechai = $_GET['fechainicio'];
$fechaf = $_GET['fechafin'];

if ($tipo==1) {
  $subastas=Subasta::filtrarPorNombreyOrdenarAlfabeticamente($nombre);
  
  $informar='El siguiente listado contiene todas las subastas activas filtradas por el nombre " '.$nombre.' " y ordenadas alfabeticamente';
  
}
if ($tipo==2) {
  $subastas=Subasta::filtrarPorCategoriayOrdenarAlfabeticamente($cat);
  $quecategoria=Subasta::recuperarCategoriaSubasta($cat);
   $informar='El siguiente listado contiene todas las subastas activas filtradas por la categoria " '.$quecategoria.' " y ordenadas alfabeticamente';
}
if ($tipo==3) {
  $subastas=Subasta::filtrarPorFechayOrdenarAlfabeticamente($fechai,$fechaf);
   $informar='El siguiente listado contiene todas las subastas activas filtradas entre las fechas " '.$fechai.' " y " '.$fechaf.' " y ordenadas alfabeticamente';
}
if ($tipo==4) {
  $subastas=Subasta::filtrarPorNombremasCategoriayOrdenarAlfabeticamente($nombre,$cat);
  $quecategoria=Subasta::recuperarCategoriaSubasta($cat);
   $informar='El siguiente listado contiene todas las subastas activas filtradas por el nombre " '.$nombre.' " y la categoria " '.$quecategoria.' " , ordenadas alfabeticamente';
}
if ($tipo==5) {
  $subastas=Subasta::filtrarPorNombremasFechasyOrdenarAlfabeticamente($nombre,$fechai,$fechaf);
   $informar='El siguiente listado contiene todas las subastas activas filtradas por el nombre " '.$nombre.' " entre las fechas " '.$fechai.' " y " '.$fechaf.' " y ordenadas alfabeticamente';
}
if ($tipo==6) {
  $subastas=Subasta::filtrarPorNombremasFechasmasCategoriayOrdenarAlfabeticamente($nombre,$cat,$fechai,$fechaf);
  $quecategoria=Subasta::recuperarCategoriaSubasta($cat);
   $informar='El siguiente listado contiene todas las subastas activas filtradas por el nombre " '.$nombre.' ", la categoria " '.$quecategoria.' " entre las fechas " '.$fechaf.' " y " '.$fechaf.' " y ordenadas alfabeticamente';
}
if ($tipo==7) {
  $subastas=Subasta::filtrarPorCategoriamasFechasyOrdenarAlfabeticamente($cat,$fechai,$fechaf);
  $quecategoria=Subasta::recuperarCategoriaSubasta($cat);
   $informar='El siguiente listado contiene todas las subastas activas filtradas por la categoria " '.$quecategoria.' " entre las fechas " '.$fechai.' " y " '.$fechaf.' " y ordenadas alfabeticamente';
}




if ($tipo==8) {
  $subastas=Subasta::filtrarPorFechaInicioOrdenarAlfabeticamente($fechai);
   $informar='El siguiente listado contiene todas las subastas activas filtradas por la fecha de inicio " '.$fechai.' " y ordenadas alfabeticamente';
}
if ($tipo==9) {
  $subastas=Subasta::filtrarPorFechaInicioMasCategoriaOrdenarAlfabeticamente($cat,$fechai);
  $quecategoria=Subasta::recuperarCategoriaSubasta($cat);
   $informar='El siguiente listado contiene todas las subastas activas filtradas por la categoria " '.$quecategoria.' " y la fecha de inicio " '.$fechai.' " , ordenadas alfabeticamente';
}
if ($tipo==10) {
  $subastas=Subasta::filtrarPorFechaInicioMasTituloOrdenarAlfabeticamente($nombre,$fechai);
   $informar='El siguiente listado contiene todas las subastas activas filtradas por nombre " '.$nombre.' " y la fecha de inicio " '.$fechai.' " , ordenadas alfabeticamente';
}
if ($tipo==11) {
  $subastas=Subasta::filtrarPorFechaInicioTituloyCategoriaOrdenarAlfabeticamente($nombre,$cat,$fechai);
  $quecategoria=Subasta::recuperarCategoriaSubasta($cat);
   $informar='El siguiente listado contiene todas las subastas activas filtradas por nombre " '.$nombre.' " , la categoria " '.$quecategoria.' " y fecha de inicio " '.$fechai.' " , ordenadas alfabeticamente';
}


if ($tipo==12) {
  $subastas=Subasta::filtrarPorFechaFinOrdenarAlfabeticamente($fechaf);
   $informar='El siguiente listado contiene todas las subastas activas filtradas por la fecha fin " '.$fechaf.' " y ordenadas alfabeticamente';
}
if ($tipo==13) {
  $subastas=Subasta::filtrarPorFechaFinMasCategoriaOrdenarAlfabeticamente($cat,$fechaf);
  $quecategoria=Subasta::recuperarCategoriaSubasta($cat);
   $informar='El siguiente listado contiene todas las subastas activas filtradas por la categoria " '.$quecategoria.' " y la fecha fin " '.$fechaf.' " , ordenadas alfabeticamente';
}
if ($tipo==14) {
  $subastas=Subasta::filtrarPorFechaFinMasTituloOrdenarAlfabeticamente($nombre,$fechaf);
   $informar='El siguiente listado contiene todas las subastas activas filtradas por nombre " '.$nombre.' " y la fecha fin " '.$fechaf.' " , ordenadas alfabeticamente';

}
if ($tipo==15) {
  $subastas=Subasta::filtrarPorFechaFinTituloyCategoriaOrdenarAlfabeticamente($nombre,$cat,$fechaf);
  $quecategoria=Subasta::recuperarCategoriaSubasta($cat);
   $informar='El siguiente listado contiene todas las subastas activas filtradas por nombre " '.$nombre.' ", la categoria " '.$quecategoria.' " y la fecha fin " '.$fechaf.' " , ordenadas alfabeticamente';
}
if ($tipo==16) {
  $subastas=Subasta::ordenarPorTitulo();
  $informar='El siguiente listado contiene todas las subastas activas ordenadas Alfabeticamente';
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
'ordenar'=>'Si lo desea puede ordenar nuestras subastas por alguno de los siguientes criterios:','tipo'=>$tipo, 'informar'=>$informar, 
));
?>