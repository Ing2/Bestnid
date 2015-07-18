function pordios1()
{
	titulo = document.getElementById("tit").value;


var checkOK = new RegExp("^[a-zA-Zραινσϊ]*$");


 if (titulo.length==1)
   {
   alert("Por favor ingrese 2 o mas caracteres en el campo de Modificar categoria.");
   document.getElementById("tit").focus();
   return false;
   }
   
if (!((titulo.match(checkOK)) && (titulo.value!='')))
	{
	alert("Escriba solo letras en el campo Modificar Categoria.");
	document.getElementById("tit").focus();
    return false;	
	}
	
	
}