function alerta()
{
var mensaje;
// Ponemos el mensaje principal
var opcion = prompt("Introduzca numero de hijos:", "");
// En caso de que sea incorrecto
 
if (opcion == null || opcion == "") {
        mensaje ="Has cancelado o introducido el numero incorrecto ";
        
        } else {
            // Muestra el total
            mensaje = "Tienes  " + opcion + " 1hijos";
            }
            alert( mensaje);
}

