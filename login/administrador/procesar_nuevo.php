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

/*Variables recibidas mediante POST*/
$nom=$_POST['N_empresa'];
$soc=$_POST['R_social'];
$rfc=$_POST['rfc'];
$fco=$_POST['F_contratacion'];
$fte=$_POST['F_termino'];
$tco=$_POST['T_contratacion'];
$loc=$_POST['locacion'];
$nel=$_POST['N_elementos'];
$tse=$_POST['T_servicio'];
$sta=$_POST['status'];


$conex -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sentencia= $conex->prepare("INSERT INTO servicios (N_empresa,R_social,rfc,F_contratacion,F_termino,T_contratacion,locacion,N_elementos,T_servicio,status) VALUES (:n,:rs,:r,:fc,:ft,:tc,:l,:ne,:ts,:s)");

$sentencia->bindParam(":n",$nom);
$sentencia->bindParam(":rs",$soc);
$sentencia->bindParam(":r",$rfc);
$sentencia->bindParam(":fc",$fco);
$sentencia->bindParam(":ft",$fte);
$sentencia->bindParam(":tc",$tco);
$sentencia->bindParam(":l",$loc);
$sentencia->bindParam(":ne",$nel);
$sentencia->bindParam(":ts",$tse);
$sentencia->bindParam(":s",$sta);


$resultado=$sentencia->execute();



if($resultado)
{
echo "<script>
alert ('Registro Guardado con ÉXITO'); 
window.location='crear_servicio.php'; 
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