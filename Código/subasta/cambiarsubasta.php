<?php



require_once '../Conexion.php';
require_once '../twig.php';
require_once '../categoria/categoria.php';
require_once '../subasta/subasta.php';
require_once '../sesion/sesion.php';
require_once '../subasta/fotosubasta.php';

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
$id=$_SESSION['Id'];


$idsubasta = $_POST['idsubasta'];
$titulo= $_POST['titulo'];
	$descripcion= $_POST['descripcion'];
	$categoria= $_POST['categoria'];
	
if(isset($_FILES['imagen5']['name']))
{$imagen5 = $_FILES['imagen5']['name'];
}
else{$imagen5=null;}

if(isset($_FILES['imagen6']['name']))
{
$imagen6 = $_FILES['imagen6']['name'];
}
else{$imagen6=null;}


if(isset($_FILES['imagen7']['name']))
{
$imagen7 = $_FILES['imagen7']['name'];
}
else{$imagen7=null;}

if(isset($_FILES['imagen8']['name']))
{
$imagen8 = $_FILES['imagen8']['name'];
}
else{$imagen8=null;}



	
$subasta=Subasta::recuperarSubasta($idsubasta);


if( ((strlen($titulo))>0) and ((strlen($descripcion))==0) and ($categoria==0))
{
	
	$titulo= $_POST['titulo'];
	Subasta::modificarSubastaTitulo($idsubasta,$titulo);
	
	//solo el titulo
}
if( ((strlen($titulo))==0) and ((strlen($descripcion))>0) and ($categoria==0))
{
	
	$descripcion= $_POST['descripcion'];
	Subasta::modificarSubastaDescripcion($idsubasta,$descripcion);
	//solo la descripcion
}
if( ((strlen($titulo))==0) and ((strlen($descripcion))==0) and ($categoria!=0))
{

$categoria= $_POST['categoria'];
	//solo la categoria
	Subasta::modificarSubastaCategoria($idsubasta,$categoria);
}

if( ((strlen($titulo))>0) and ((strlen($descripcion))>0) and ($categoria==0))
{
	
		$titulo= $_POST['titulo'];
		$descripcion= $_POST['descripcion'];
		Subasta::modificarSubastaDescripcionyTitulo($idsubasta,$descripcion,$titulo);
	// titulo + descripcion
}

if( ((strlen($titulo))>0) and ((strlen($descripcion))==0) and ($categoria!=0))
{
	
	$titulo= $_POST['titulo'];
	$categoria= $_POST['categoria'];
	Subasta::modificarSubastaTituloyCategoria($idsubasta,$titulo,$categoria);
	// titulo + categoria
}

if( ((strlen($titulo))==0) and ((strlen($descripcion))>0) and ($categoria!=0))
{
	
	$descripcion= $_POST['descripcion'];
	$categoria= $_POST['categoria'];
	Subasta::modificarSubastaDescripcionyCategoria($idsubasta,$descripcion,$categoria);
	//categoria + descripcion
}

if( ((strlen($titulo))>0) and ((strlen($descripcion)) >0) and ($categoria!=0))
{ 

	$titulo= $_POST['titulo'];
	$descripcion= $_POST['descripcion'];
	$categoria= $_POST['categoria'];
	//categoria + descripcion + titulo
	Subasta::modificarSubasta($idsubasta,$descripcion,$titulo,$categoria);
}


$numid=FotoSubasta::idMaximo();


//if (($ofertas= Subasta::tieneOferta($idsubasta)) == 0){
//	$dardebaja=Subasta::modificarSubasta($idsubasta,$descripcion,$titulo,$categoria);
//	$mensaje="la subasta fue borrada exitosamente";
//}
//else{
//	$mensaje="la subasta no puede modificarse porque tiene ofertas en curso";
//}








if(isset($_POST['opciones']))
{
		
		$accion=$_POST['opciones'];
		if($accion=='Eliminar')
		{
		       $id=$_POST['foto0'];
		       $baja=FotoSubasta::borrarFotoSubasta($id);
		}
		if($accion=='Reemplazar')
		{
               $nombreimagen=$_FILES['imagen0']['name'];
               if((strlen($nombreimagen))>0)
               {
		       $id=$_POST['foto0'];
		       $baja=FotoSubasta::borrarFotoSubasta($id);
		       }
		}
	

		if (isset($_FILES['imagen0']))
   {
	   $numid=$numid+1;
	//if ($_FILES['imagen'.$i]["error"] > 0){
	//echo "ha ocurrido un error";
//} else {
                 
	//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
	//y que el tamano del archivo no exceda los 100kb
	$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
	$limite_kb = 10000000000;

	if (in_array($_FILES['imagen0']['type'], $permitidos) && $_FILES['imagen0']['size'] <= $limite_kb * 1024){
		//esta es la ruta donde copiaremos la imagen
		//recuerden que deben crear un directorio con este mismo nombre
		//en el mismo lugar donde se encuentra el archivo subir.php
		$ruta = "../imagenes/" .$numid. $_FILES['imagen0']['name'];
		//print_r ($ruta);
		//comprobamos si este archivo existe para no volverlo a copiar.
		//pero si quieren pueden obviar esto si no es necesario.
		//o pueden darle otro nombre para que no sobreescriba el actual.
		if (!file_exists($ruta)){
			//aqui movemos el archivo desde la ruta temporal a nuestra ruta
			//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
			//almacenara true o false
			$resultado = move_uploaded_file($_FILES['imagen0']["tmp_name"], $ruta);
			if ($resultado){
				$nombre1 ="imagenes/".$numid.$_FILES['imagen0']['name'];
				$fotosubasta = new fotosubasta(null,$idsubasta,$nombre1);
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
	
	

	
if(isset($_POST['opciones1']))
{
	
			$accion=$_POST['opciones1'];
		if($accion<>'Mantener')
		{
		
		       $id=$_POST['foto1'];
		      $baja=FotoSubasta::borrarFotoSubasta($id);
	        
		}
	
	
	

		if (isset($_FILES['imagen1']))
   {
	   $numid=$numid+1;
	//if ($_FILES['imagen'.$i]["error"] > 0){
	//echo "ha ocurrido un error";
//} else {
                 
	//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
	//y que el tamano del archivo no exceda los 100kb
	$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
	$limite_kb = 10000000000;

	if (in_array($_FILES['imagen1']['type'], $permitidos) && $_FILES['imagen1']['size'] <= $limite_kb * 1024){
		//esta es la ruta donde copiaremos la imagen
		//recuerden que deben crear un directorio con este mismo nombre
		//en el mismo lugar donde se encuentra el archivo subir.php
		$ruta = "../imagenes/" .$numid. $_FILES['imagen1']['name'];
		//print_r ($ruta);
		//comprobamos si este archivo existe para no volverlo a copiar.
		//pero si quieren pueden obviar esto si no es necesario.
		//o pueden darle otro nombre para que no sobreescriba el actual.
		if (!file_exists($ruta)){
			//aqui movemos el archivo desde la ruta temporal a nuestra ruta
			//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
			//almacenara true o false
			$resultado = move_uploaded_file($_FILES['imagen1']["tmp_name"], $ruta);
			if ($resultado){
				$nombre1 ="imagenes/".$numid.$_FILES['imagen1']['name'];
				$fotosubasta = new fotosubasta(null,$idsubasta,$nombre1);
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
	
if(isset($_POST['opciones2']))
{
	
					$accion=$_POST['opciones2'];
		if($accion<>'Mantener')
		{
	          
		         $id=$_POST['foto2'];
		         $baja=FotoSubasta::borrarFotoSubasta($id);
		         
		}
	

		if (isset($_FILES['imagen2']))
   {
	   $numid=$numid+1;
	//if ($_FILES['imagen'.$i]["error"] > 0){
	//echo "ha ocurrido un error";
//} else {
                 
	//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
	//y que el tamano del archivo no exceda los 100kb
	$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
	$limite_kb = 10000000000;

	if (in_array($_FILES['imagen2']['type'], $permitidos) && $_FILES['imagen2']['size'] <= $limite_kb * 1024){
		//esta es la ruta donde copiaremos la imagen
		//recuerden que deben crear un directorio con este mismo nombre
		//en el mismo lugar donde se encuentra el archivo subir.php
		$ruta = "../imagenes/" .$numid. $_FILES['imagen2']['name'];
		//print_r ($ruta);
		//comprobamos si este archivo existe para no volverlo a copiar.
		//pero si quieren pueden obviar esto si no es necesario.
		//o pueden darle otro nombre para que no sobreescriba el actual.
		if (!file_exists($ruta)){
			//aqui movemos el archivo desde la ruta temporal a nuestra ruta
			//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
			//almacenara true o false
			$resultado = move_uploaded_file($_FILES['imagen2']["tmp_name"], $ruta);
			if ($resultado){
				$nombre1 ="imagenes/".$numid.$_FILES['imagen2']['name'];
				$fotosubasta = new fotosubasta(null,$idsubasta,$nombre1);
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

if(isset($_POST['opciones3']))
{
	
						$accion=$_POST['opciones3'];
		if($accion<>'Mantener')
		{
		    
		         $id=$_POST['foto3'];
		         $baja=FotoSubasta::borrarFotoSubasta($id);
		         
		}
	
	
	

		if (isset($_FILES['imagen3']))
   {
	   $numid=$numid+1;
	//if ($_FILES['imagen'.$i]["error"] > 0){
	//echo "ha ocurrido un error";
//} else {
                 
	//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
	//y que el tamano del archivo no exceda los 100kb
	$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
	$limite_kb = 10000000000;

	if (in_array($_FILES['imagen3']['type'], $permitidos) && $_FILES['imagen3']['size'] <= $limite_kb * 1024){
		//esta es la ruta donde copiaremos la imagen
		//recuerden que deben crear un directorio con este mismo nombre
		//en el mismo lugar donde se encuentra el archivo subir.php
		$ruta = "../imagenes/" .$numid. $_FILES['imagen3']['name'];
		//print_r ($ruta);
		//comprobamos si este archivo existe para no volverlo a copiar.
		//pero si quieren pueden obviar esto si no es necesario.
		//o pueden darle otro nombre para que no sobreescriba el actual.
		if (!file_exists($ruta)){
			//aqui movemos el archivo desde la ruta temporal a nuestra ruta
			//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
			//almacenara true o false
			$resultado = move_uploaded_file($_FILES['imagen3']["tmp_name"], $ruta);
			if ($resultado){
				$nombre1 ="imagenes/".$numid.$_FILES['imagen3']['name'];
				$fotosubasta = new fotosubasta(null,$idsubasta,$nombre1);
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
	
	
if(isset($_POST['opciones4']))
{
		
		$accion=$_POST['opciones4'];
		if($accion<>'Mantener')
		{
			
		         $id=$_POST['foto4'];
		         $baja=FotoSubasta::borrarFotoSubasta($id);
		         
		}
	
	

		if (isset($_FILES['imagen4']))
   {
   	$numid=$numid+1;
	//if ($_FILES['imagen'.$i]["error"] > 0){
	//echo "ha ocurrido un error";
//} else {
                 
	//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
	//y que el tamano del archivo no exceda los 100kb
	$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
	$limite_kb = 10000000000;

	if (in_array($_FILES['imagen4']['type'], $permitidos) && $_FILES['imagen4']['size'] <= $limite_kb * 1024){
		//esta es la ruta donde copiaremos la imagen
		//recuerden que deben crear un directorio con este mismo nombre
		//en el mismo lugar donde se encuentra el archivo subir.php
		$ruta = "../imagenes/" .$numid. $_FILES['imagen4']['name'];
		//print_r ($ruta);
		//comprobamos si este archivo existe para no volverlo a copiar.
		//pero si quieren pueden obviar esto si no es necesario.
		//o pueden darle otro nombre para que no sobreescriba el actual.
		if (!file_exists($ruta)){
			//aqui movemos el archivo desde la ruta temporal a nuestra ruta
			//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
			//almacenara true o false
			$resultado = move_uploaded_file($_FILES['imagen4']["tmp_name"], $ruta);
			if ($resultado){
				$nombre1 ="imagenes/".$numid.$_FILES['imagen4']['name'];
				$fotosubasta = new fotosubasta(null,$idsubasta,$nombre1);
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







$fotos=Subasta::recuperarFotos($idsubasta);
//print_r($fotos[1][0]);
$cant=Subasta::cantidadDeFotos($idsubasta);
$cant=$cant-1;
$cantidad=Subasta::cantidadDeFotos($idsubasta);
$categorias=Categoria::recuperarCategoriasActivas();

$dardealta=$idsubasta;
//echo ($dardealta);

for ($i = 5; $i <9; $i++) {

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
				$fotosubasta = new fotosubasta(null,$idsubasta,$nombre1);
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

   
if( ((strlen($titulo))==0) and ((strlen($descripcion))==0) and ($categoria==0) and (!isset($_POST['opciones'])) and (!isset($_POST['opciones1'])) and (!isset($_POST['opciones2'])) and (!isset($_POST['opciones3'])) and (!isset($_POST['opciones4'])))
{

$informarmod='No se ingreso ningún dato o imagen para Modificar!!!';}

else
{
$informarmod='Su subasta fue modificada con exito!!!';
}
if((strlen($imagen5)>0) or (strlen($imagen6)>0) or (strlen($imagen7)>0) or (strlen($imagen8)>0))
{
	$informarmod='Se agregaron nueva/s fotos';
}



$cantidadFotos=Subasta::controlarFoto($idsubasta);

if($cantidadFotos==0)
{
	$agregar=Subasta::agregarFotoPorDefecto($idsubasta);
}

$categorias=Categoria::recuperarCategoriasActivas();
$subastas=Subasta::recuperarSubasta($idsubasta);
$fotos=Subasta::recuperarFotos($idsubasta);
//'aceptada'=>$aceptada,
$subastasRandom=Subasta::recuperarSubastasActivasRandom($idsubasta);

Twig_Autoloader::register();
$template = $twig->loadTemplate("verdetalle.html.twig");
$template->display(array('Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio',
'Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad','Ayuda' => 'Ayuda','subasta'=>$subasta,
'Categoria'=>'Categorias','categorias'=>$categorias,'bienvenido'=>$bienvenido,
'nombre'=>$nombre,'apellido'=>$apellido,'CerrarSesion'=>$cerrarsesion,
'sobrebestnid'=>$sobrebestnid,'contacto'=>$contacto,'informar'=>'El Siguiente listado contiene todas las subastas activas en Bestnid',
'ordenar'=>'Si lo desea puede ordenar nuestras subastas por alguno de los siguientes criterios:','tipo'=>$tipo,'Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','MiCuenta' => 'Mi Cuenta',
'Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad',

'Ingresenombre' => 'Ingrese su nombre de usuario','Ingresecontraseña' => 'Ingrese su contraseña',
'NombreUsuario' => 'Nombre de usuario','Contraseña' => 'Contraseña','Acciones' => 'Acciones',
'Admin' => 'Admin','ModificarDatos' => 'Modificar Datos Propios','ManejoUsuario' => 'Gestion De Usuarios',
'ManejoCategoria' => 'Gestion de Categorias','VerComentarios' => 'Listado de Comentarios',
'VerOfertas' => 'Listado de Ofertas','VerSubastas' => 'Ver Subastas',
'AgregarAdmin' => 'Gestion de Administradores','fotos' => $fotos,'cant'=>$cant,'cantidad'=>$cantidad,'subastas'=>$subastas,
'informarmod'=>$informarmod,'subastasrandom'=>$subastasRandom,'idusuario'=>$idusuario, 'Contacto'=>$contacto,

));

?>










