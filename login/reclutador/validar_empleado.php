<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="/seveclon/css/login.css">
  
  <title>Modificación de Datos</title>
</head>
<body>


<?php 


/*Validar campos mediante la función valreg */
function valreg($N_archivo,$T_archivo,$Ta_archivo,$nom,$apa,$ama,$sex,$fna,$lna,$eda,$cpo,$cal,$nex,$nin,$col,$mun,$est,$eca,$ref,$tca,$tmo,$rfc,$curp,$nss,$tsa,$enf,$esc,$nfa,$tfa,
$pue,$eci,$sta){

/*Modificar formato de fecha para su validación */
$fnacimiento = date("m/d/Y", strtotime($fna));


/*Regex */
/*Validar que sean letras */
$letras='/[a-zA-ZÀ-ÿ\s]{1,40}/';
/*Validar que sea alfa-númerico */
$letnum='/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]/';
/*Validar fecha */

// patron del RFC, persona moral
/* $rfcpm = "/^(([A-ZÑ&]{3})([0-9]{2})([0][13578]|[1][02])(([0][1-9]|[12][\\d])|[3][01])([A-Z0-9]{3}))|" +
                  "(([A-ZÑ&]{3})([0-9]{2})([0][13456789]|[1][012])(([0][1-9]|[12][\\d])|[3][0])([A-Z0-9]{3}))|" +
                  "(([A-ZÑ&]{3})([02468][048]|[13579][26])[0][2]([0][1-9]|[12][\\d])([A-Z0-9]{3}))|" +
                  "(([A-ZÑ&]{3})([0-9]{2})[0][2]([0][1-9]|[1][0-9]|[2][0-8])([A-Z0-9]{3}))$/";
 // patron del RFC, persona fisica
 $rfcpf = "/^(([A-ZÑ&]{4})([0-9]{2})([0][13578]|[1][02])(([0][1-9]|[12][\\d])|[3][01])([A-Z0-9]{3}))|" +
                       "(([A-ZÑ&]{4})([0-9]{2})([0][13456789]|[1][012])(([0][1-9]|[12][\\d])|[3][0])([A-Z0-9]{3}))|" +
                       "(([A-ZÑ&]{4})([02468][048]|[13579][26])[0][2]([0][1-9]|[12][\\d])([A-Z0-9]{3}))|" +
                       "(([A-ZÑ&]{4})([0-9]{2})[0][2]([0][1-9]|[1][0-9]|[2][0-8])([A-Z0-9]{3}))$/"; */

/*IF-ELSE anidados para validación de campos */
if(empty($N_archivo) || empty($nom) || empty($apa) || empty($ama) || empty($sex) || empty($fna) || empty($lna) || empty($eda) || empty($cpo)
|| empty($cal) || empty($nex) || empty($col) || empty($mun) || empty($est) || empty($eca) || empty($ref) || empty($tca)
|| empty($tmo) || empty($rfc) || empty($curp) || empty($nss) || empty($tsa) || empty($enf) || empty($esc) || empty($nfa)
|| empty($tfa) || empty($pue) || empty($eci) || empty($sta))
{


echo "<script>
alert ('Rellene todos los campos para continuar');

</script>"; 
return false;


}else if(!preg_match($letras,$nom)){
	echo "<script>
alert ('Ingrese solo letras en campo Nombre de Empleado');
   
</script>"; 
return false;

}else if(!preg_match($letras,$apa)){
	echo "<script>
alert ('Ingrese solo letras en campo Apellido Paterno');
   
</script>"; 
return false;

}else if(!preg_match($letras,$sex)){
	echo "<script>
alert ('Ingrese solo letras en campo Sexo');
   
</script>"; 
return false;


/* }else if(!preg_match($rfcpm,$rfc)){
	echo "<script>
alert ('El Rfc de persona moral debe tener una longitud de por lo menos: 12 caracteres, letras mayúsculas y números');

</script>"; 
return false; */


/* }else if(!preg_match($rfcpf,$rfc)){
	echo "<script>
alert ('El Rfc de persona física debe tener una longitud de por lo menos: 12 caracteres, letras mayúsculas y números');

</script>"; 
return false; */


}else if(!validarfecha($fnacimiento)){

echo "<script>
alert ('Ingrese una fecha válida (dd/mm/aaaa) en campo Fecha de Nacimiento');  

</script>";
return false;

}else if(!preg_match($letras, $lna)){

	echo "<script>
	alert ('Ingrese solo letras en campo Lugar de Nacimiento');  
	
	</script>";
	return false;

/*Debe o no aceptar letras y numeros o solo números */
}else if(!is_numeric($eda)){

	echo "<script>
	alert ('Ingrese solo letras y números en campo Edad');  
	
	</script>";
	return false;

}else if(!is_numeric($cpo)){

	echo "<script>
	alert ('Ingrese solo números en campo Código Postal');  
	
	</script>";
	return false;


/*Debe o no aceptar letras y numeros */
}else if(!preg_match($letras, $cal)){

	echo "<script>
	alert ('Ingrese solo letras y números en campo Calle');  
	
	</script>";
	return false;

	/*Debe o no aceptar letras y numeros */
}else if(!is_numeric($nex)){

	echo "<script>
	alert ('Ingrese solo letras y/o números en campo Número Exterior');  
	
	</script>";
	return false;

/* }else if(!is_numeric($nin)){

	echo "<script>
	alert ('Ingrese solo números en campo Número Interior');  
	
	</script>";
	return false; */

}else if(!preg_match($letras,$col)){
	echo "<script>
alert ('Ingrese solo letras en campo Colonia');
   
</script>"; 
return false;

}else if(!preg_match($letras,$mun)){
	echo "<script>
alert ('Ingrese solo letras en campo Municipio');
   
</script>"; 
return false;

}else if(!preg_match($letras,$est)){
	echo "<script>
alert ('Ingrese solo letras en campo Estado');
   
</script>"; 
return false;

}else if(!preg_match($letras,$eca)){
	echo "<script>
alert ('Ingrese solo letras en campo Entre Calles');
   
</script>"; 
return false;

}else if(!preg_match($letras,$ref)){
	echo "<script>
alert ('Ingrese solo letras en campo Referencias');
   
</script>"; 
return false;

}else if(!is_numeric($tca)){
	echo "<script>
alert ('Ingrese solo letras en campo Teléfono de Casa');
   
</script>"; 
return false;

}else if(!is_numeric($tmo)){
	echo "<script>
alert ('Ingrese solo letras en campo Teléfono Móvil');
   
</script>"; 
return false;
/*No distingue entre letras y números  */
}else if(!preg_match($letras,$rfc)){
	echo "<script>
alert ('Ingrese solo letras y números en campo RFC');
   
</script>"; 
return false;
/*No distingue entre letras y números  */
}else if(!preg_match($letras,$curp)){
	echo "<script>
alert ('Ingrese solo letras y números en campo CURP');
   
</script>"; 
return false;

}else if(!is_numeric($nss)){
	echo "<script>
alert ('Ingrese solo letras en campo Número de Seguridad Social');
   
</script>"; 
return false;
/*No distingue entre letras y números  */
}else if(!preg_match($letras,$tsa)){
	echo "<script>
alert ('Ingrese solo letras y números en campo Tipo de Sangre');
   
</script>"; 
return false;

}else if(!preg_match($letras,$enf)){
	echo "<script>
alert ('Ingrese solo letras en campo Enfermedades');
   
</script>"; 
return false;

}else if(!preg_match($letras,$esc)){
	echo "<script>
alert ('Ingrese solo letras en campo Escolaridad');
   
</script>"; 
return false;

}else if(!preg_match($letras,$nfa)){
	echo "<script>
alert ('Ingrese solo letras en campo Nombre de Familiar');
   
</script>"; 
return false;

}else if(!is_numeric($tfa)){
	echo "<script>
alert ('Ingrese solo números en campo Teléfono de Familiar');
   
</script>"; 
return false;

}else if(!preg_match($letras,$pue)){
	echo "<script>
alert ('Ingrese solo letras en campo Puesto');
   
</script>"; 
return false;

}else if(!preg_match($letras,$eci)){
	echo "<script>
alert ('Ingrese solo letras en campo Estado Civil');
   
</script>"; 
return false;

}else if(!preg_match($letras,$sta)){
	echo "<script>
alert ('Ingrese solo letras en campo Status');
   
</script>"; 
return false;


}else{
	return true;
	}

}


/*Función para validar fecha */
function validarfecha($fecha){
	$valores = explode('/', $fecha);
	if(count($valores) == 3 && checkdate($valores[0], $valores[1], $valores[2])){
		return true;
    }
	return false;
}


/*Validar Recaptcha */
function respCaptcha($cap){
    
$secret='6LfWxIAaAAAAAJsANy_ulJvTACPq8973-MWgCzV2';
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$cap");
$responseKey=json_decode($response,true);
    
if(!$cap){
	echo "<script>
alert ('Favor de verificar el Captcha para continuar');
   
</script>"; 
return false;

}else if($responseKey['success']){
    
return true;

}else{
     
    echo "<script>
alert ('Hubo un error en la validación del Captcha, intente de nuevo');
   
</script>"; 
return false;

}

}

?>


</body>
</html>