function validacion() 
{
nomu = document.getElementById("nombreus").value; 
con = document.getElementById("clave").value;
nom = document.getElementById("nombre").value;
ape = document.getElementById("apellido").value;
meil = document.getElementById("mail").value;


if(nomu.length==0)
   {
   alert("Por cavor complete el campo Nombre de usuario.");
   document.getElementById("nombreus").focus();
   return false;
   }
var RegExPattern = new RegExp("^[ 0-9a-zA-Z]*$");   
    var errorMessage = 'Usuario Incorrecto ingrese solo letras y numeros en el nombre de usuario.';
    if (!((con.match(RegExPattern)) && (con.value!='')))
	{	
        alert(errorMessage);
        document.getElementById("nombreus").focus();
		return false;
    }    

// validar password

if(con.length==0)
   {
   alert("Por cavor complete el campo clave.");
   document.getElementById("clave").focus();
   return false;
   }
var RegExPattern = new RegExp("^[ 0-9a-zA-Z]*$");   
    var errorMessage = 'Clave Incorrecta ingrese solo letras y numeros en la clave.';
    if (!((con.match(RegExPattern)) && (con.value!='')))
	{	
        alert(errorMessage);
        document.getElementById("clave").focus();
		return false;
    } 
	
//validar nombre

var checkOK = new RegExp("^[a-z A-ZnNaeiouAEIOUuU]*$");

if (nom.length==0)
   {
   alert("Por favor complete el campo nombre.");
   document.getElementById("nombre").focus();
   return false;
   }
if (!((nom.match(checkOK)) && (nom.value!='')))
	{
	alert("Escriba sólo letras en el campo nombre.");
	document.getElementById("nombre").focus();
    return false;	
	}

//validar apellido

var checkOK = new RegExp("^[a-zA-Zñáéíóú]*$");

if (ape.length==0)
   {
   alert("Por favor complete el campo apellido.");
   document.getElementById("apellido").focus();
   return false;
   }
if (!((ape.match(checkOK)) && (ape.value!='')))
	{
	alert("Escriba solo letras en el campo apellido.");
	document.getElementById("apellido").focus();
    return false;	
	}


//validar mail	
if(meil.length==0)
   {
   alert("Por favor complete el campo mail.");
   document.getElementById("mail").focus();
   return false;
   }
   
var x=meil;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");

if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  alert("Email Invalido");
  document.getElementById("mail").focus();
  return false;
  }	



return true;
}
