function validacionFechas()
{
	
ini = document.getElementById("fechainicio").value;
fin = document.getElementById("fechafin").value;

if (ini > fin) {
	if ( fin.length != 0 ) {
	alert("La fecha de inicio es mayor que la fecha de fin,por favor vuelva a ingresar las fechas");
	return false;
	}
}
}