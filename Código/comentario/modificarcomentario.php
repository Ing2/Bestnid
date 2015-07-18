
	
<?php
require_once '../Conexion.php';
require_once '../twig.php';
require_once '../categoria/categoria.php';
require_once '../subasta/subasta.php';
require_once '../sesion/sesion.php';
require_once '../seguridad.php';
require_once 'comentario.php';

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
	$idusuario=null;
	}
else
	{
	$tipo=$_SESSION['Tipo'];
	$nombre=$_SESSION['Nombre'];
	$apellido=$_SESSION['Apellido'];
	$idusuario=$_SESSION['Id'];
	$cerrarsesion='Cerrar Sesion';
	$micuenta='Mi Cuenta';
	$bienvenido='Bienvenido:';
	$contacto='Contacto';
	$iniciarsesion=null;
	$registrarse=null;
	$sobrebestnid=null;
}

$comentario = $_POST['comentario'];
$idcomentario =  $_POST['idcomentario'];
$fechacom=date("Y-m-j");
$idsubasta =  $_POST['idsubasta'];





$modificar=Comentario::modificarComentario($idcomentario,$comentario,$fechacom);


$categorias=Categoria::recuperarCategoriasActivas();
$subastas=Subasta::recuperarSubasta($idsubasta);
$fotos=Subasta::recuperarFotos($idsubasta);
$comentarios=Comentario::recuperarComentariosParaSubasta($idsubasta);
$comentarioagregado=null;
$comentariomodificado='se modifico su comentario';
$subastasRandom=Subasta::recuperarSubastasActivasRandom($idsubasta);
$aceptada=null;

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
'aceptada'=>$aceptada,'comentarioagregado'=>$comentarioagregado,'idusuario'=>$idusuario,
'comentarios'=>$comentarios,'tipo'=>$tipo,'comentariomodificado'=>$comentariomodificado,'subastasrandom'=>$subastasRandom, 'Contacto'=>$contacto,


));
?>