<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="/seveclon/css/login.css">
  
  <title>Eliminar Registro</title>
</head>
<body>

	<!-- Consulta a la base de datos  -->
<?php 

include "../conexion.php";

$id= trim($_GET["id"]);

$conex -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sentencia= $conex->prepare("DELETE FROM servicios WHERE id_servicio=:u");
    $sentencia->bindParam(":u",$id);

    $resultado=$sentencia->execute();

if($resultado)
{
	echo "<script>
alert ('Registro Eliminado con éxito'); 
window.location='buscar_servicio.php'; 
</script>"; 
	
}else
{
	echo "<script>
alert ('Registro no Eliminado, Verifique el id ingresado'); 
window.history.go(-1); 
</script>"; 
	
}