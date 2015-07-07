<?php
require_once '../Conexion.php';
require_once '../twig.php';
require_once '../categoria/categoria.php';
require_once 'subasta.php';
require_once '../sesion/sesion.php';
require_once 'fotosubasta.php';
require_once '../seguridad.php';

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
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$dias =  $_POST['dias'];
$idcategoriasub= $_POST['categoria'];
$fechainicio=date("Y-m-j");
$fechafin= date("Y-m-d", strtotime("$fechainicio + $dias days"));  
//$fechafin= date('Y-m-d', strtotime('+15 day')) ; 
$idestadosub=1;
$idusuariosub=$_SESSION['Id'];


$subasta = new subasta(null,$descripcion,$fechainicio,$fechafin,$idestadosub,$idusuariosub,$idcategoriasub,$titulo);
$dardealta=Subasta::altaSubasta($subasta);
//echo ($dardealta);
$numid=FotoSubasta::idMaximo();




for ($i = 0; $i <5; $i++) {
$numid=$numid+1;

if (isset($_FILES['imagen'.$i]))
{
	//if ($_FILES['imagen'.$i]["error"] > 0){
	//echo "ha ocurrido un error";
//} else {

	//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
	//y que el tamano del archivo no exceda los 100kb
	$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
	$limite_kb = 10000000000;

	if (in_array($_FILES['imagen'.$i]['type'], $permitidos) && $_FILES['imagen'.$i]['size'] <= $limite_kb * 1024){
		//esta es la ruta donde copiaremos la imagen
		//recuerden que deben crear un directorio con este mismo nombre
		//en el mismo lugar donde se encuentra el archivo subir.php
		$ruta = "../imagenes/" .$numid. $_FILES['imagen'.$i]['name'];
		//print_r ($ruta);
		//comprobamos si este archivo existe para no volverlo a copiar.
		//pero si quieren pueden obviar esto si no es necesario.
		//o pueden darle otro nombre para que no sobreescriba el actual.
		if (!file_exists($ruta)){
			//aqui movemos el archivo desde la ruta temporal a nuestra ruta
			//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
			//almacenara true o false
			$resultado = move_uploaded_file($_FILES['imagen'.$i]["tmp_name"], $ruta);
			if ($resultado){
			
				$nombre1 ="imagenes/".$numid.$_FILES['imagen'.$i]['name'];
				$fotosubasta = new fotosubasta(null,$dardealta,$nombre1);
				$altafoto=FotoSubasta::altaFotoSubasta($fotosubasta);	
				//echo "el archivo ha sido movido exitosamente";
			} else {
				//echo "ocurrio un error al mover el archivo.";
			}
		} else {
			//echo $_FILES['imagen'.$i]['name'] . ", este archivo existe";
		}
	} else {
		//echo "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
	}
}
}
//}



























$categorias=Categoria::recuperarCategoriasActivas();
$subastas=Subasta::recuperarSubastasActivas();
Twig_Autoloader::register();
$template = $twig->loadTemplate("altasubasta.html.twig");
$template->display(array('Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','IniciarSesion' =>$iniciarsesion,'MiCuenta' => 'Mi Cuenta',
'Registrarse' =>$registrarse,'Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad','Ayuda' => 'Ayuda','subastas'=>$subastas,
'Categoria'=>'Categorias','categorias'=>$categorias,
'nombre'=>$nombre,'apellido'=>$apellido,'CerrarSesion'=>$cerrarsesion,'MiCuenta'=>$micuenta,
'sobrebestnid'=>$sobrebestnid,'contacto'=>$contacto,'informar'=>'El Siguiente listado contiene todas las subastas activas en Bestnid',
'ordenar'=>'Si lo desea puede ordenar nuestras subastas por alguno de los siguientes criterios:','tipo'=>$tipo,'agrego'=>$dardealta,
));
?>










