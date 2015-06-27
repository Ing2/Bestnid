<?php

$usuario=$_SESSION['UserLogged'];
if(($usuario->getTipo() != 1)){

	
include '../sesion/cerrarsesion.php';
   header("Location: ../sesion/InicioSesion.php");
	
	exit;
	}
	?>