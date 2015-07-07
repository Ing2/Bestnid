<!--
// editcheck.js - Form validation
//
// Written by Dan Bailey - Data Design Group, Inc.  2004
// www.ddginc-usa.com
// See www.ddginc-usa.com/editcheckdoc.htm for documentation.
//
// frm - optional, edit check specific frm, or all forms
// itm - optional, edit check the specific item, or all items.

function valforms(frm,itm)
{
 //var sel = document.getElementById("categoria");
//var cat=(sel.selectedIndex);

//var x = parseInt(cat);
var i
var j
for (j=0;j < document.forms.length; j++ ) { // for each form
  if (frm && document.forms[j]!=frm) continue; // if frm specified, only look at it
  for (i=0;i < document.forms[j].length; i++ ) {  // for each field
     if (itm && document.forms[j].elements[i] != itm) continue; // if itm specified, only look at it
     var editstr = document.forms[j].elements[i].getAttribute('editcheck');
     if ((editstr) && (editstr.length>0)) {

         // break up edit string into command
         var cmds = editstr.split(";");
         var fld = document.forms[j].elements[i];

         for (var k=0;k< cmds.length; k++ ) {
             var cmdarr = cmds[k].split("=");
             cmdarr[0] = cmdarr[0];
             var msg=""
             if (cmdarr.length>2) 
                msg=cmdarr[2];

             switch (cmdarr[0]) {
                case "req" : 
                  if ((cmdarr.length==1)||(cmdarr.length>1 && cmdarr[1].charAt(0)=="Y")) {
                     if (fld.value.replace(/\s/g,"")==""){
                        if (!msg || !msg.length)
                               msg=fld.name.replace(/_/g," ") + " is required!";
                        window.alert(msg);
                        fld.focus();
                        return false;
                     }
                   }
                   break;

               case "type" : 
                   switch (cmdarr[1]) {

                     


                       case "alphabetic": 
                       case "alpha":  
                         if(fld.value.length>0 && fld.value.search("[^A-Z a-z]") >= 0) { 
                              if (!msg || !msg.length)
                                 msg = "Por favor ingrese solo letras de la A la Z , en minuscula o mayuscula en el Campo Tituloo!";
                              window.alert(msg);
                              fld.focus();
                              fld.select();
                              return false;
						
							  
                         }//if                             
						   if(fld.value.length==1 ) { 
                           
                              if (!msg || !msg.length)
                                 msg = "Por favor ingrese mas de 2 letras en el Campo Titulo!";
                              window.alert(msg);
                              fld.focus();
                              fld.select();
                              return false;
						
							 
                         }//if   	



					  
                        break; //alpha 
						 case "alpha2":  
                         if(fld.value.length>0 && fld.value.search("[^A-Z a-z�������0-9.]") >= 0) { 
                              if (!msg || !msg.length)
                                 msg = "Por favor ingrese solo letras de la A la Z , en minuscula o mayuscula y/o caracteres numericos en el Campo Descripcioon!";
                              window.alert(msg);
                              fld.focus();
                              fld.select();
                              return false;
                         }//if                             
						 if(fld.value.length==1 ) { 
                              if (!msg || !msg.length)
                                 msg = "Por favor ingrese mas de 2 letras y/o caracteres numericos en el Campo Descripcion!";
                              window.alert(msg);
                              fld.focus();
                              fld.select();
                              return false;
						
							  
                         }//if 
						
                        break; //alpha 

                       case "alphanumeric": 
                       case "alphanum":  { 
                         if(fld.value.length>0 && fld.value.search("[^A-Z a-z0-9]") >= 0) { 
                              if (!msg || !msg.length)
                                 msg = "Por favor ingrese solo letras!";
                              window.alert(msg);
                              fld.focus();
                              fld.select();
                              return false;
                         }//if                             

                        break; 
                       }//alphabetic
					    case "categoria":  { 
                        if(x==0)
							    {
							 msg = "Por Favor Seleccione una categoria";
                              window.alert(msg);
	
                              return false;  
						  }
                       break; 
                       }//pass
					       case "opc":  { 
							var cantidad = document.getElementById("cantidad").value;

 var cant= parseInt(cantidad);

 var aEliminar=0;
 
  if(cantidad==1)
 {
  if (document.form1.opciones[1].checked)
  {
	  aEliminar=aEliminar+1;
  }

 }
 
 
 
 if(cantidad==2)
 {
  if (document.form1.opciones[1].checked)
  {
	  aEliminar=aEliminar+1;
  }
  
   if (document.form1.opciones1[1].checked)
  {
	  aEliminar=aEliminar+1;
  } 
 }
 

  if(cantidad==3)
 {
  if (document.form1.opciones[1].checked)
  {
	  aEliminar=aEliminar+1;
  }
   if (document.form1.opciones1[1].checked)
  {
	  aEliminar=aEliminar+1;
  } 
  if (document.form1.opciones2[1].checked)
  {
	  aEliminar=aEliminar+1;
  } 
 }
 
 
   if(cantidad==4)
 {
  if (document.form1.opciones[1].checked)
  {
	  aEliminar=aEliminar+1;
  }
   if (document.form1.opciones1[1].checked)
  {
	  aEliminar=aEliminar+1;
  } 
  if (document.form1.opciones2[1].checked)
  {
	  aEliminar=aEliminar+1;
  } 
   if (document.form1.opciones3[1].checked)
  {
	  aEliminar=aEliminar+1;
  } 
 }
 
   if(cantidad==5)
 {
  if (document.form1.opciones[1].checked)
  {
	  aEliminar=aEliminar+1;
  }
   if (document.form1.opciones1[1].checked)
  {
	  aEliminar=aEliminar+1;
  } 
  if (document.form1.opciones2[1].checked)
  {
	  aEliminar=aEliminar+1;
  } 
   if (document.form1.opciones3[1].checked)
  {
	  aEliminar=aEliminar+1;
  } 
    if (document.form1.opciones4[1].checked)
  {
	  aEliminar=aEliminar+1;
  } 
 }
 
 if(cantidad==aEliminar)
 {
	 window.alert("No puede eliminar todas las fotos de su subasta, debe quedar al menos una.");
	 return false;
 }
						  
                       break; 
                       }//opc
					   
					     
					   
					   


						   
						   
						   
						   
                       default:  // regular expression
                         var re = new RegExp(cmdarr[1],'gi');
                         if (fld.value.length>0 && re.test(fld.value) == false) {
                              if (!msg || !msg.length)
                                 msg = fld.name.replace(/_/g," ") + " &iexcl;no cumple con los criterios de validaci&oacute;n!";
                              window.alert(msg);
                              fld.focus();
                              fld.select();
                              return false;
                         }
                         break; // default case, custom type via regular expression

                   } // switch
                   break; // case "type"

               case "maxlength" : 
               case "maxlen" : 
                   if(fld.value.length && fld.value.length>0 && (fld.value.length > eval(cmdarr[1]))) {
                         if (!msg || !msg.length)
                             msg = "La extension maxima de " + fld.name.replace(/_/g," ") + " es " + cmdarr[1] + " caracteres!";
                         window.alert(msg);
                         fld.focus();
                         fld.select();
                         return false;
                   }
                   break;

               case "minlenth" :                
               case "minlen" : 
                   if(fld.value.length && fld.value.length>0 && (fld.value.length < eval(cmdarr[1]))) {
                         if (!msg || !msg.length)
                             msg = "La extension minima de " + fld.name.replace(/_/g," ") + " es " + cmdarr[1] + " carecteres!";
                         window.alert(msg);
                         fld.focus();
                         fld.select();
                         return false;
                   }
                   break;

               case "eval" : 
                   if(!(eval(cmdarr[1]))) {
                         if (!msg || !msg.length)
                             msg = fld.name.replace(/_/g," ") + " &iexcl;no cumple con los criterios de validaci&oacute;n!";
                         window.alert(msg);
                         fld.focus();
                         fld.select();
                         return false;
                   }
                   break; // minval

               case "minvalue" :           
               case "minval" : 
                   if(fld.value.length && fld.value.length>0 && (eval(fld.value) < eval(cmdarr[1]))) {
                         if (!msg || !msg.length)
                             msg = "&iexcl;El valor m&iacute;nimo de " + fld.name.replace(/_/g," ") + " es " + cmdarr[1] + "!";
                         window.alert(msg);
                         fld.focus();
                         fld.select();
                         return false;
                   }
                   break; // minval

               case "maxvalue" : 
               case "maxval" : 
                   if(fld.value.length && fld.value.length>0 && (eval(fld.value) > eval(cmdarr[1]))) {
                         if (!msg || !msg.length)
                             msg = "&iexcl;El valor m&aacute;ximo de " + fld.name.replace(/_/g," ") + " es " + cmdarr[1] + "!";
                         window.alert(msg);
                         fld.focus();
                         fld.select();
                         return false;
                   }
                   break; // maxval


               case "cvt" : 
                   var cmd
                   if (fld.value.length && fld.value.length>0) {
                       for (var n=0;n<cmdarr[1].length;n++) {
                          cmd=cmdarr[1].charAt(n);  // one-letter command codes
                          switch (cmd) {
                              
                              case "T" :  // trim spaces leading and trailing
                                 if (fld.value != fld.value.replace(/^\s+/g,'').replace(/\s+$/g,''))
                                    fld.value = fld.value.replace(/^\s+/g,'').replace(/\s+$/g,'');
                                 break;
                              case "]" :  // trim trailing spaces
                                 if (fld.value != fld.value.replace(/\s+$/g,''))
                                    fld.value = fld.value.replace(/\s+$/g,'') ;
                                 break;
                              case "[" : // trim leading spaces 
                                 if (fld.value != fld.value.replace(/^\s+/g,'')) 
                                    fld.value = fld.value.replace(/^\s+/g,'') ;
                                 break;
                              case "C" : // crunch multiple spaces into one space
                                 if (fld.value != fld.value.replace(/\s+/g,' '))
                                    fld.value = fld.value.replace(/\s+/g,' ') ;
                                 break;
                              case "~" : // remove punctuation
                                 if (fld.value != fld.value.replace(/[\W_]/g,''))
                                    fld.value = fld.value.replace(/[\W_]/g,'') ;
                                 break;

                          } // switch command character
                      } // for n each command character
                   } // if
                   break;  // case cvt

             } // switch
         } // for k
     } // if editcheck
  } // for i each field
}// for j each form
return true;
}

//-->
