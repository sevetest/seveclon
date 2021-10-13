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
function valreg($nom,$usu,$use,$con,$cov,$tusu){
	

$conf='/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
$letras='/^[a-zA-ZÀ-ÿ\s]{1,40}$/';
$letnum='/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';

if(empty($nom) || empty($usu) || empty($con) || empty($cov) || empty($tusu)){

echo "<script>
alert ('Rellene todos los campos para continuar');

</script>"; 
return false;


}else if(!preg_match($letras,$nom)){
	echo "<script>
alert ('Ingrese solo letras en campo Nombre');
   
</script>"; 
return false;


}else if(!preg_match($letnum,$usu)){
	echo "<script>
alert ('El usuario debe tener una longitud de por lo menos: 8 caracteres, una letra mayúscula, una letra minúscula y un número');

</script>"; 
return false;


}else if(!valusuario($usu) && $use==""){
	echo "<script>
alert ('El usuario ya existe, Ingrese otro Usuario');

</script>"; 
return false;


}else if(!valusuario($usu) && $usu!==$use){
	echo "<script>
alert ('El usuario ya existe, Ingrese otro Usuario');

</script>"; 
return false;


}else if(!preg_match($conf, $con)){

echo "<script>
alert ('La contraseña debe tener una longitud de por lo menos: 8 caracteres, un caracter especial (@,$,!,%,*,?,&), una letra mayúscula, una letra minúscula y un número');  

</script>";
return false;


}else if($con!==$cov){

echo "<script>
alert ('La contraseña no coincide, Ingresa nuevamente la contraseña en campo *Confirmar Contraseña*');
 
</script>";
return false;


}else if(!preg_match($letras,$tusu)){
	echo "<script>
alert ('Ingrese solo S/A/R en campo Tipo de Usuario');

</script>"; 
return false;
}else{
return true;
}

}

/*Validar usuario existente */
function valusuario($usu){
	
require('../conexion.php');


$conex -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sentencia= $conex->prepare("SELECT * from usuarios WHERE usuario=:u");

$sentencia->bindParam(":u",$usu);


$sentencia->execute();

$resultado=$sentencia->fetchAll(PDO::FETCH_OBJ);


if($resultado){
	
return false;
}else{
	
return true;
}

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