<?php
//conexion a la base de datos
mysql_connect("localhost", "root", "") or die(mysql_error()) ;
mysql_select_db("grupo10") or die(mysql_error()) ;

//si la variable imagen no ha sido definida nos dara un advertencia.
$id = $_GET['imagen'];

//vamos a crear nuestra consulta SQL
$consulta = "SELECT foto FROM foto_subasta WHERE idfoto = $id";
//con mysql_query la ejecutamos en nuestra base de datos indicada anteriormente
//de lo contrario mostraremos el error que ocaciono la consulta y detendremos la ejecucion.
$resultado= @mysql_query($consulta) or die(mysql_error());

//si el resultado fue exitoso
//obtendremos el dato que ha devuelto la base de datos
$datos = mysql_fetch_assoc($resultado);
//ruta va a obtener un valor parecido a "imagenes/nombre_imagen.jpg" por ejemplo
$ruta =$datos['foto'];

//ahora solamente debemos mostrar la imagen
echo "<img src='$ruta' />";

?>