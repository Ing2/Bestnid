<?php
require_once '../Conexion.php';
require_once '../twig.php';
require_once '../sesion/sesion.php';
require_once '../categoria/categoria.php';

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






$contenido = $_POST['tit'];
$idcategoria=$_POST['idcategoria'];
//$idcategoria = $_POST['idcategoria'];
$categoria=Categoria::existeCategoria($contenido);
if($categoria==null){
	
	$modcategoria=Categoria::modificarCategoria($contenido,$idcategoria);
	$mens="Se modifico correctamente la categoria!";
	$mensa=null;
}
else{
	$mensa="Lo Sentimos pero ya existe una categoria con ese nombre por favor vuelva a intentarlo! ";
	$mens=null;
}


$categorias=Categoria::recuperarCategoriasActivas();



Twig_Autoloader::register();
$template = $twig->loadTemplate("categoria.html.twig");
$template->display(array('Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio',
'Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad', 'Ayuda' => 'Ayuda',

'Ingresenombre' => 'Ingrese su nombre de usuario','Ingresecontraseña' => 'Ingrese su contraseña',
'NombreUsuario' => 'Nombre de usuario','Contraseña' => 'Contraseña','sobrebestnid'=>$sobrebestnid,'contacto'=>$contacto, 'Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad', 'Ayuda' => 'Ayuda', 'CerrarSesion' => 'Cerrar Sesion',

'Ingresenombre' => 'Ingrese su nombre de usuario','Ingresecontraseña' => 'Ingrese su contraseña',
'NombreUsuario' => 'Nombre de usuario','Contraseña' => 'Contraseña','Acciones' => 'Acciones',
'Admin' => 'Admin','ModificarDatos' => 'Modificar Datos Propios','ManejoUsuario' => 'Gestion De Usuarios',
'ManejoCategoria' => 'Gestion de Categorias','VerComentarios' => 'Listado de Comentarios',
'VerOfertas' => 'Listado de Ofertas','VerSubastas' => 'Ver Subastas',
'AgregarAdmin' => 'Gestion de Administradores','mensa'=>$mensa,
'nombre'=>$nombre,'apellido'=>$apellido,'bienvenido'=>$bienvenido,'MiCuenta' => 'Mi Cuenta','categorias'=>$categorias, 'mens'=>$mens, 'AltaAdmin'=>'Agregar administrador', 'Contacto'=>$contacto,
));
?>