function pordios()
{
	titulo = document.getElementById("titulo").value;


var checkOK = new RegExp("^[a-zA-Zραινσϊ]*$");

if (titulo.length==0)
   {
   alert("Por favor complete el campo para el nombre categoria.");
   document.getElementById("titulo").focus();
   return false;
   }
 if (titulo.length==1)
   {
   alert("Por favor ingrese 2 o mas caracteres en el nombre de la categoria.");
   document.getElementById("titulo").focus();
   return false;
   }
   
if (!((titulo.match(checkOK)) && (titulo.value!='')))
	{
	alert("Escriba solo letras para el nombre de la categoria.");
	document.getElementById("titulo").focus();
    return false;	
	}
	
	
}
