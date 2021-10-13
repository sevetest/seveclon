<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="/seveclon/css/login.css">
  
  <title>Modificación de Datos</title>
</head>
<body>

	<!-- Consulta a la base de datos  -->
<?php 
/*Archivo de conexión */
include "../conexion.php";

if($_POST){
  
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
  $id=$_GET['id'];
    
        
    $conex -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sentencia= $conex->prepare("UPDATE servicios SET N_empresa=:n,R_social=:rs,rfc=:r,F_contratacion=:fc,F_termino=:ft,T_contratacion=:tc,locacion=:l,N_elementos=:ne,T_servicio=:ts,status=:s) WHERE id_servicio=:id");
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
    $sentencia->bindParam(":id",$id);


    $resultado=$sentencia->execute();
    
    if($resultado)
    {
    echo "<script>
    alert ('Registro Actualizado con éxito'); 
    window.location='crear_usuario.php'; 
    </script>"; 
    
    
    }else{
    echo "<script>
    alert ('Registro no Actualizado, intente de nuevo'); 
    window.history.go(-1); 
    </script>"; 
    }
}
?>

</body>
</html>