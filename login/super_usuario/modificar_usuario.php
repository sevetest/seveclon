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

    $nom=$_POST['nombre'];
    $usu=$_POST['usuario'];
    $con=$_POST['contrasena'];
    $use=$_GET['id'];
    $tusu=$_POST['tusuario'];
    
    /*Llave */
$llave="PgrS#p3o_Sr08c";

/*Cifrar contraseña*/
$concifrada=cifrar($con,$llave);
        
    $conex -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sentencia= $conex->prepare("UPDATE usuarios SET nombre=:n,usuario=:u,contrasena=:c,T_usuario=:t WHERE usuario=:e");
    $sentencia->bindParam(":n",$nom);
    $sentencia->bindParam(":u",$usu);
    $sentencia->bindParam(":c",$concifrada);
    $sentencia->bindParam(":t",$tusu);
    $sentencia->bindParam(":e",$use);


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