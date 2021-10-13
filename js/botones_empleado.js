/*Comprobar si hay get en el formulario crear_empleado*/   
if(indicador_mod=document.getElementById('get')){

    titulo=document.querySelector('.titulo').innerHTML = 'Actualizar Servicio';
    bguardar=document.querySelector(".button-guardar").innerHTML = 'Actualizar';
    bguardar.setAttribute('name','actualizar');

}


function validar()
{
	
    
    /*Acceder a elementos por medio de su id*/
	idservicio= document.getElementById("idemp").value;

	

    /*Expresion regular para no aceptar espacios en el campo de búsqueda */
    espacios=/\s+/g;

	
	
	if(idservicio==="")
	{
		alert("Campo CURP de Empleado Vacio,ingrese el usuario");
		fbuscar.idemp.focus();
		return false;
			
	}else if(espacios.test(idservicio))
	{
		alert("Campo CURP de Empleado No Debe Contener Espacios en Blanco");
		fbuscar.idemp.focus();
		return false;
		
	}else
	{

		return true();
	}
	
}

function confirmar(){
    if (confirm('¿Estas seguro de eliminar este registro?'))
	{
     
    }else{
		 return false; 
	}
}