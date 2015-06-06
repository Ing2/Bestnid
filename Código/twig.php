<?php

 require_once 'Twig/Autoloader.php';

 Twig_Autoloader::register();
 $templateDir="../templates";
// $templateDirCompi="./templates-c";
 
 $loader = new Twig_Loader_Filesystem($templateDir);
 $twig = new Twig_Environment($loader); //, array( 'cache' => $templateDirCompi,       ));
 
?>
