<?php
require_once '../Conexion.php';
require_once '../twig.php';
require_once '../categoria/categoria.php';
require_once '../subasta/subasta.php';
require_once '../sesion/sesion.php';
require_once '../seguridad.php';
require_once 'oferta.php';

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
	$contacto=null;
	$iniciarsesion=null;
	$registrarse=null;
	$sobrebestnid=null;
}
$monto = $_POST['numero'];
$razon = $_POST['razon'];
$idsubasta =  $_POST['idsubasta'];
$idusuario = $_POST['idusuario'];


$oferta = new oferta(null,$razon,$monto,0,1,$idusuario,$idsubasta);
$dardealta=Oferta::altaOferta($oferta);


$categorias=Categoria::recuperarCategoriasActivas();
$subastas=Subasta::recuperarSubasta($idsubasta);
$fotos=Subasta::recuperarFotos($idsubasta);
$aceptada='Su Subasta fue enviada con exito';




Twig_Autoloader::register();
$template = $twig->loadTemplate("verdetalle.html.twig");
$template->display(array('Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','IniciarSesion' =>$iniciarsesion,'MiCuenta' => 'Mi Cuenta',
'Registrarse' =>$registrarse,'Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad','Ayuda' => 'Ayuda','subastas'=>$subastas,
'Categoria'=>'Categorias','categorias'=>$categorias,
'nombre'=>$nombre,'apellido'=>$apellido,'CerrarSesion'=>$cerrarsesion,'MiCuenta'=>$micuenta,
'sobrebestnid'=>$sobrebestnid,'contacto'=>$contacto,
'ordenar'=>'Si lo desea puede ordenar nuestras subastas por alguno de los siguientes criterios:','tipo'=>$tipo,
'fotos' => $fotos,'subastas'=>$subastas,
'aceptada'=>$aceptada,


));
?>