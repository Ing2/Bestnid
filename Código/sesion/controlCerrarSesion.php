<?php

require_once'../usuario.php';
require_once '../Conexion.php';
require_once '../seguridad.php';
   require_once '../usuariorol.php';
    require_once '../rol.php';


if (isset($_SESSION['UserLogged'])){
   $user=$_SESSION['UserLogged'];

     $rol= Usuario::recuperarRol($user->getId());
    include '../permisosAdmin.php'; 
$usuarios= Usuario::recuperarUsuarios();
$roles=rol::recuperarRoles();

session_destroy();
   header("Location: indexInicioSesion.php");

}

?>
