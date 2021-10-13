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
function valreg($nom,$soc,$rfc,$fco,$fte,$tco,$loc,$nel,$tse,$sta){

/*Modificar formato de fecha para su validación */
$fcontratacion = date("m/d/Y", strtotime($fco));

/*Modificar formato de fecha para su validación */
$ftermino = date("m/d/Y", strtotime($fte));

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
if(empty($nom) || empty($soc) || empty($rfc) || empty($fco) || empty($loc) || empty($tco) || empty($fte) || empty($nel) || empty($tse) || empty($sta)){


echo "<script>
alert ('Rellene todos los campos para continuar');

</script>"; 
return false;


}else if(!preg_match($letras,$nom)){
	echo "<script>
alert ('Ingrese solo letras en campo Nombre de Empresa');
   
</script>"; 
return false;

}else if(!preg_match($letras,$soc)){
	echo "<script>
alert ('Ingrese solo letras en campo Nombre de Empresa');
   
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


}else if(!validarfecha($fcontratacion)){

echo "<script>
alert ('Ingrese una fecha válida (dd/mm/aaaa) en campo Fecha de Contratación');  

</script>";
return false;

}else if(!validarfecha($ftermino)){

	echo "<script>
	alert ('Ingrese una fecha válida (dd/mm/aaaa) en campo Fecha de Termino');  
	
	</script>";
	return false;

}else if(!preg_match($letnum, $tco)){

	echo "<script>
	alert ('Ingrese solo letras y números en campo Tiempo de Contratación');  
	
	</script>";
	return false;

}else if(!preg_match($letnum, $loc)){

	echo "<script>
	alert ('Ingrese solo letras y números en campo Locación');  
	
	</script>";
	return false;

}else if(!is_numeric($nel)){

	echo "<script>
	alert ('Ingrese solo números en campo Número de Elementos');  
	
	</script>";
	return false;

}else if(!preg_match($letras,$tse)){
	echo "<script>
alert ('Ingrese solo letras en campo Tipo de Servicio');
   
</script>"; 
return false;

}else if(!preg_match($letras,$sta)){
	echo "<script>
alert ('Ingrese solo letras en campo Tipo de Servicio');
   
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