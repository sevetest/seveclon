/* Seleccionar el item y hacerlo constante*/
const cerrar=document.querySelector('.cerrarses');

/* Evento para el item */
cerrar.addEventListener('click',()=>{


if (reply=confirm("¿Seguro que desea salir del sistema?")) 
{
//Se asigna la ruta al item Cerrar Sesión en su atributo href
cerrar.setAttribute('href','/seveclon/login/cerrarsesion.php');
}
else 
{
//En respuesta negativa no se hace nada

}

})


