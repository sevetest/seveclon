window.onload = function (){

/* Seleccionar el icono del menú en indexedDB.html y hacerlo constante*/
const menu_icono=document.querySelector('.nav-icono');

/* Seleccionar el menú de navegación en indexedDB.html y hacerlo constante*/
const menu=document.querySelector('.nav-lista');

/* Evento para el icono del menú */
menu_icono.addEventListener('click',()=>{

    menu.classList.toggle("spread");
})

/* Evento para cierre de menú */
window.addEventListener('click',e=>{

   /*  Si el usuario ya desplegó el menú... */
    if(menu.classList.contains('spread')
    && e.target !=menu && e.target !=menu_icono){
       /*regresar la clase spread a la clase nav-menu para esconderlo */
        menu.classList.toggle("spread")
    }
})

}
