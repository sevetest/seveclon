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

if(isset($_SESSION['INICIO'])){
    session_unset();
	session_destroy();
  header("location:/seveclon/index.html");
  
}else if(isset($_SESSION['TIEMPO'])){ 
  session_unset();
	session_destroy();
  header("location:/seveclon/index.html");

    }else{
      echo "<script> alert('No se encuentra una sesión activa');
      window.history.back();
      </script>";
        
    }
?>  
</body>
</html>