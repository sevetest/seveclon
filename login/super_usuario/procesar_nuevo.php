<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/seveclon/css/login.css">
  <title>Datos Procesados</title>
</head>
<body >

<?php 

/*Solicitar archivo de conexión */
require('../conexion.php');


$nom=$_POST['nombre'];
$usu=$_POST['usuario'];
$con=$_POST['contrasena'];
$cov=$_POST['ccontrasena'];
$tusu=$_POST['tusuario'];

/*Llave */
$llave="PgrS#p3o_Sr08c";

/*Cifrar contraseña*/
$concifrada=cifrar($con,$llave);

$conex -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sentencia= $conex->prepare("INSERT INTO usuarios (nombre,usuario,contrasena,T_usuario) VALUES (:n,:u,:c,:t)");

$sentencia->bindParam(":n",$nom);
$sentencia->bindParam(":u",$usu);
$sentencia->bindParam(":c",$concifrada);
$sentencia->bindParam(":t",$tusu);


$resultado=$sentencia->execute();



if($resultado)
{
echo "<script>
alert ('Registro Guardado con ÉXITO'); 
window.location='crear_usuario.php'; 
</script>"; 


}else{
echo "<script>
alert ('Registro no Guardado, intente de nuevo'); 
window.history.go(-1); 
</script>"; 
}


?>
</body>
</html>