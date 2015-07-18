<?php
require_once '../Conexion.php';
require_once '../twig.php';
require_once '../categoria/categoria.php';
require_once '../subasta/subasta.php';
require_once '../sesion/sesion.php';
require_once '../oferta/oferta.php';
require_once '../mail/mail.php';
require_once '../usuario/usuario.php';

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

$id=$_SESSION['Id'];
   $subastas=Subasta::recuperarSubastasFinalizadasParaUnUsuario($id);

$ofertaganadora=$_POST['ganador'];
$idsubasta=$_POST['idsubasta'];
$monto=$_POST['monto'];
$usuariooferta=$_POST['idusuariooferta'];
$usuarioduenio=$_POST['idusuarioduenio'];


$exitosa=Subasta::pasarAExito($idsubasta);
$ofertassinexito=Oferta::pasarOfertaASinExito($idsubasta);
$ofertaganadora=Oferta::pasarOfertaAGanadora($ofertaganadora);
$usuarioof=Usuario::recuperarUsuario($usuariooferta);
$usuariodue=Usuario::recuperarUsuario($usuarioduenio);
$destofer=$usuarioof->getEmail();
$destsub=$usuariodue->getEmail();
$fecha=date("Y-m-j");
$subastamail=Subasta::recuperarSubasta($idsubasta);
$asuntosub=$subastamail->getTitulo();
$montooferta=$monto*(0.7);
$mailoferta = new mail(1,"Bestnid",$destofer,$fecha,$asuntosub,"Usted es el ganador de la subasta,el mail a contactarse es :".$destsub);
$mailduenio = new mail(1,"Bestnid",$destsub,$fecha,$asuntosub,"El monto de la oferta seleccionada es :".$montooferta."El mail a contactarse es:".$destofer);
$mailenviooferta=Mail::altaMail($mailoferta);
$mailenviosubasta=Mail::altaMail($mailduenio);
$informar="Mail enviado a las partes";

 $subastas=Subasta::recuperarSubastasFinalizadasParaUnUsuario($id);

Twig_Autoloader::register();
$template = $twig->loadTemplate("FrontEnd.html.twig");
$template->display(array('Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','IniciarSesion' =>$iniciarsesion,'MiCuenta' => 'Mi Cuenta',
'Registrarse' =>$registrarse,'Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad','Ayuda' => 'Ayuda',
'Categoria'=>'Categorias',
'nombre'=>$nombre,'apellido'=>$apellido,'CerrarSesion'=>$cerrarsesion,'MiCuenta'=>$micuenta,
'sobrebestnid'=>$sobrebestnid,'contacto'=>$contacto,'informar'=>'El Siguiente listado contiene todas las subastas activas en Bestnid',
'ordenar'=>'Si lo desea puede ordenar nuestras subastas por alguno de los siguientes criterios:','tipo'=>$tipo
,'Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','IniciarSesion' => 'Iniciar Sesion','MiCuenta' => 'Mi Cuenta',
'Registrarse' => 'Registrarse','Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad','subastas'=>$subastas,

'Ingresenombre' => 'Ingrese su nombre de usuario','Ingresecontraseña' => 'Ingrese su contraseña',
'NombreUsuario' => 'Nombre de usuario','Contraseña' => 'Contraseña','Acciones' => 'Acciones',
'Admin' => 'Admin','ModificarDatos' => 'Modificar Datos Propios','ManejoUsuario' => 'Gestion De Usuarios',
'ManejoCategoria' => 'Gestion de Categorias','VerComentarios' => 'Listado de Comentarios',
'VerOfertas' => 'Listado de Ofertas','VerSubastas' => 'Ver Subastas',
'AgregarAdmin' => 'Gestion de Administradores', 'informar' => $informar, 'Contacto'=>$contacto,

));

?>










