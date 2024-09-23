function alerta()
{
var mensaje;
// Ponemos el mensaje principal
var opcion = prompt("Introduzca un numero :");
var opcion2 = prompt("Introduzca otro numero :");
var suma = Number(opcion) + Number(opcion2) ;
// En caso de que sea incorrecto
 
if (opcion == null || opcion == "" || opcion2 == null || opcion2 == "") {
        mensaje ="Has cancelado o introducido el numero incorrecto ";
        
        } else {
            // Muestra el total
            mensaje = "La suma es  " + suma ;
            }
            alert( mensaje);
}

