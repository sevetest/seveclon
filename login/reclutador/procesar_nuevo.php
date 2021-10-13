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
$nom=$_POST['N_empleado'];
$apa=$_POST['A_paterno'];
$ama=$_POST['A_materno'];
$sex=$_POST['sexo'];
$fna=$_POST['F_nacimiento'];
$lna=$_POST['L_nacimiento'];
$eda=$_POST['edad'];
$cpo=$_POST['C_postal'];
$cal=$_POST['calle'];
$nex=$_POST['N_exterior'];
$nin=$_POST['N_interior'];
$col=$_POST['colonia'];
$mun=$_POST['municipio'];
$est=$_POST['estado'];
$eca=$_POST['E_calles'];
$ref=$_POST['referencias'];
$tca=$_POST['T_casa'];
$tmo=$_POST['T_movil'];
$rfc=$_POST['rfc'];
$curp=$_POST['curp'];
$nss=$_POST['nss'];
$tsa=$_POST['T_sangre'];
$enf=$_POST['enfermedades'];
$esc=$_POST['escolaridad'];
$nfa=$_POST['N_familiar'];
$tfa=$_POST['T_familiar'];
$pue=$_POST['puesto'];
$eci=$_POST['E_civil'];
$sta=$_POST['status'];

/*Conversión del archivo foto a tipo binario con 16 mb máximo y de tipo imagen */
$N_archivo=$_FILES['foto']['name'];
$T_archivo=$_FILES['foto']['type'];
$Ta_archivo=$_FILES['foto']['size'];

/*abrir imagen foto mediante function de la variable $_FILES*/
$A_archivo=fopen($_FILES['foto']['tmp_name'],'r');
/*pasar a binario */
$B_archivo=fread($A_archivo,$Ta_archivo);


$conex -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sentencia= $conex->prepare("INSERT INTO empleados (foto,T_Archivo,N_empleado,A_paterno,A_materno,sexo,F_nacimiento,L_nacimiento,
edad,C_postal,calle,N_exterior,N_interior,colonia,municipio,estado,E_calles,referencias,T_casa,T_movil,rfc,curp,
nss,T_sangre,enfermedades,escolaridad,N_familiar,T_familiar,puesto,E_civil,status) VALUES (:fo,:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,
:k,:l,:m,:n,:nn,:o,:p,:q,:r,:s,:t,:u,:v,:w,:x,:y,:z,:za,:zb)");

$sentencia->bindParam(":fo",$B_archivo);
$sentencia->bindParam(":a",$nom);
$sentencia->bindParam(":b",$apa);
$sentencia->bindParam(":c",$ama);
$sentencia->bindParam(":d",$sex);
$sentencia->bindParam(":e",$fna);
$sentencia->bindParam(":f",$lna);
$sentencia->bindParam(":g",$eda);
$sentencia->bindParam(":h",$cpo);
$sentencia->bindParam(":i",$cal);
$sentencia->bindParam(":j",$nex);
$sentencia->bindParam(":k",$nin);
$sentencia->bindParam(":l",$col);
$sentencia->bindParam(":m",$mun);
$sentencia->bindParam(":n",$est);
$sentencia->bindParam(":nn",$eca);
$sentencia->bindParam(":o",$ref);
$sentencia->bindParam(":p",$tca);
$sentencia->bindParam(":q",$tmo);
$sentencia->bindParam(":r",$rfc);
$sentencia->bindParam(":s",$curp);
$sentencia->bindParam(":t",$nss);
$sentencia->bindParam(":u",$tsa);
$sentencia->bindParam(":v",$enf);
$sentencia->bindParam(":w",$esc);
$sentencia->bindParam(":x",$nfa);
$sentencia->bindParam(":y",$tfa);
$sentencia->bindParam(":z",$pue);
$sentencia->bindParam(":za",$eci);
$sentencia->bindParam(":zb",$sta);


$resultado=$sentencia->execute();



if($resultado)
{
echo "<script>
alert ('Registro Guardado con ÉXITO'); 
window.location='crear_empleado.php'; 
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