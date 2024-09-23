function alerta()
{
var mensaje;
// Ponemos el mensaje principal
var km = prompt("Introduzca una velocidad en km/h :");
const metros =0.27777 ;
var paso = Number(km) * (metros);
// En caso de que sea incorrecto
 
if (km == null || km == "" ) {
        mensaje ="Has cancelado o introducido el numero incorrecto ";
        
        } else {
            // Muestra el total
            mensaje = "La velocidad en m/s es  " + paso ;
            }
            alert( mensaje);
}
