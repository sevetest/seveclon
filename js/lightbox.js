window.onload = function (){


/* Constantes para las imagenes de la galeria */
const imagenes=document.querySelectorAll('.img-galeria')
/*Selección de la galeria*/
const imagensel=document.querySelector('.agregar-imagen')
/*Contenedor para mostrar la imagen seleccionada */
const contenedorLight=document.querySelector('.imagen-light')
/*Icono para cerrar exposición */
const cerrar=document.querySelector('.close')
/*Icono del menu */
const menu_iconoOcultar=document.querySelector('.menu-icono');
/*Acceder a la clase de la etiqueta <p> en index.html */
const info=document.querySelector('.info');
/*Acceder a la clase de la etiqueta <p> en index.html */
const licencia=document.querySelector('.licencia');
/*Variable global para identificar imagen seleccionada */
var tinfo="";



/*Recorrer el arreglo de las imagenes de la galeria*/
imagenes.forEach(imagen=>{
    /* Evento para obtener la ruta de la imagen seleccionada y pasarle el atributo a la función mostrarImagen */
    imagen.addEventListener('click', ()=>{

        
       tinfo =imagen.getAttribute('id');
       console.log(tinfo);
       mostrarImagen(imagen.getAttribute('src'));

       
        
    })
})


/*Ocultar exposición de imagen y fondo */
contenedorLight.addEventListener('click', (e)=>{

    if(e.target==cerrar){
        contenedorLight.classList.toggle('exponer-fondo');
        imagensel.classList.toggle('exponer-imagen');
        menu_iconoOcultar.style.opacity='1';
    }
})


/*Sustitución de ruta en el contenedor de las imagenes a mostrar */
const mostrarImagen=(imagen)=>{
    imagensel.src=imagen;
    contenedorLight.classList.toggle('exponer-fondo');
    imagensel.classList.toggle('exponer-imagen');
    menu_iconoOcultar.style.opacity='0';

    /*Agregar texto a etiquetas de texto de acuerdo a id de imagen seleccionada */
    if(tinfo=="sb"){
        info.innerHTML="Cuidado y protección de bienes muebles e inmuebles";
        licencia.innerHTML="★Lic. Part. Col. 19443★";
        
    }else if(tinfo=="sp"){
        info.innerHTML="Protección, custodia, salvaguarda, defensa de vida y de la integridad corporal del prestatario";
        licencia.innerHTML="★Lic. Part. Col. 19445★";
    }else if(tinfo=="st"){
        info.innerHTML="Consiste en la prestación de servicios de custodia, vigilancia, cuidado y protección de bienes muebles o valores, incluyendo su traslado";
        licencia.innerHTML="★Lic. Part. Col. 19447★";

    }else if(tinfo=="ar"){
        info.innerHTML="Este servicio está enfocado en realizar un análisis estratégico e integral de riesgos y vulnerabilidades de inmuebles y personas.";
    }
    
}


}