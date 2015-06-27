<?php

$usuario=$_SESSION['UserLogged']
if(($usuario->getTipo() != 2)){

	
	session_destroy();
   header("Location: ../sesion/InicioSesion.php");
	
	exit;
	}
	?>