<?php
 require_once '../twig.php';
  require_once '../Conexion.php';
  require_once '../usuario/usuario.php';
  
  //Usuario logueado al sitio web
    $UserLogged=null;
	$mail=$_POST['email'];
	$contrase=$_POST['password'];
	
	
			
  if (!isset($_SESSION['UserLogged']))
	{
       
     $UserLogged = Usuario::existeUsuario($mail);
	
	
	 if($UserLogged != null && $UserLogged->getPass() == $contrase)  {
	 session_start();
		
		  //Login exitoso 	  
		  
			$_SESSION['UserLogged'] = $UserLogged; /* guardo el objeto usuario en la sesion */  
		    $tipo=$UserLogged->getTipo();  
			
		
		    if ($tipo== 1){
			 
		            include 'controlbackend.php';
					
		      }
			  else {
		      if ($tipo == 2){
			  
			        
					 include 'controlFrontEnd.php';
					
					 }		 
				
		  }
		  }
		  else{
			 include 'InicioSesion.php';
             	   echo " 
                <script language='JavaScript'> 
                alert('Usuario y/o contraseña Erroneos , vuelva a ingresar los datos por favor'); 
                </script>";	
		     
	  }
	
		
	}
	else{
		include 'InicioSesion.php';
		echo " 
                <script language=’JavaScript’> 
                alert('Usuario y/o contraseña Erroneos, vuelva a ingresar los datos por favor'); 
                </script>";
	  }
    
  ?>