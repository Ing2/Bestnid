<?php 


function conectaDb(){

/* Conectar a una base de datos de ODBC invocando al controlador */
$dsn = 'mysql:dbname=grupo10;host=localhost';
$user = 'root';
$pass = '';

try {
   $gbd = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
  echo 'Falló la conexión: ' . $e->getMessage();
  
}

return $gbd;
}
?>
