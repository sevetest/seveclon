<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/login.css">
  <title>Datos Procesados</title>
</head>
<body>

<?php 

session_start();
require('conexion.php');
include('super_usuario/cifrar.php');

$usu=$_POST['usuario'];
$con=$_POST['contrasena'];


$conex -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sentencia= $conex->prepare("SELECT * from usuarios WHERE usuario=:u");

$sentencia->bindParam(":u",$usu);


$sentencia->execute();

$resultado=$sentencia->fetch(PDO::FETCH_ASSOC);

/*Llave */
$llave="PgrS#p3o_Sr08c";

/*Descifrar contraseña para su comparación*/
$condes=descrifrar($resultado['contrasena'],$llave);

/*Comprobar si hay resultado y comparar la contraseña*/
if($resultado && $con==$condes){

	$_SESSION['INICIO']=$resultado["T_usuario"];
        $_SESSION['TIEMPO']=time();

	$usu=$resultado['nombre'];
        $tie="Reclutador";
        $tia="Administrador";
        $tiu="Super-Usuario";



if(isset($_SESSION['INICIO'])){
    
    switch($_SESSION['INICIO']){
        
        case 'R':
        
        echo "<script> alert('*****¡Bienvenido $usu !  Has ingresado como $tie*****');
window.location='reclutador/indexrec.php';   
</script>";
        
        break;
        
        
        case 'A':
       
       echo "<script> alert('*****¡Bienvenido $usu !  Has ingresado como $tia*****');
window.location='administrador/indexadm.php';   
</script>";
        
        break;

        case 'S':
       
            echo "<script> alert('*****¡Bienvenido $usu !  Has ingresado como $tiu*****');
     window.location='super_usuario/indexsus.php';   
     </script>";
             
             break;
    }
    
    
}


}else{

echo "<script> alert('Usuario o Contraseña Incorrecta');
window.history.go(-1);   
</script>";


}

?>
</body>
</html>