
function validar()
{
    
    /*Acceder a elementos por medio de su id o clase */
	idusuario= document.getElementById("idusu").value;

	

    /*Expresion regular para no aceptar espacios en el campo de búsqueda */
    espacios=/\s+/g;

	
	
	if(idusuario==="")
	{
		alert("Campo Usuario Vacio,ingrese el usuario");
		fbuscar.idusu.focus();
		return false;
			
	}else if(espacios.test(idusuario))
	{
		alert("Campo Usuario No Debe Contener Espacios en Blanco");
		fbuscar.idusu.focus();
		return false;
		
	}else
	{

		return true();
	}
	
}


 /*Comprobar si hay get en el formulario crear_usuario*/   
if(indicador_mod=document.getElementById('get')){
    
titulo=document.querySelector('.titulo').innerHTML = 'Actualizar Usuario';


bguardar=document.querySelector(".button-guardar").innerHTML = 'Actualizar';
bguardar.setAttribute('name','actualizar');

}

    

function confirmar(){
    if (confirm('¿Estas seguro de eliminar este registro?'))
	{
     
    }else{
		 return false; 
	}
}

