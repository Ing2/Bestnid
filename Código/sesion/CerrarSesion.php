<?php

require_once '../seguridad.php';

session_destroy();
   header("Location: ../templates/Index.php");

?>
