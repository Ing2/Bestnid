<?php
@session_start();
if (!isset($_SESSION['UserLogged'])){

	header("Location: ../sesion/InicioSesion.php");
	exit;
}
?>

