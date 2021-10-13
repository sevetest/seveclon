<?php
session_start();
if(isset($_SESSION['INICIO']) && ($_SESSION['INICIO']=='E')){
  header('location:empleado/indexemp.php');
}else if(isset($_SESSION['INICIO']) && ($_SESSION['INICIO']=='A')){
    
    header('location:administrador/indexadm.php');
}else if(isset($_SESSION['INICIO'])&&($_SESSION['INICIO']=='S')){
      header('location:super_usuario/indexsus.php');
}else{

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/login.css">
  <title>Login</title>
</head>
<body>


 <div class="container-form">
   <form method="POST" action="loginv.php">
     <h1 class="titulo">Login</h5>
 
     <div class="grupo">
       <input type="text" name="usuario" id="usuario"><span class="barra"></span>
       <label>Usuario</label>
     </div>
     <div class="grupo">
       <input type="password" name="contrasena" id="contrasena"><span class="barra"></span>
       <label>Contraseña</label>
     </div>

     <br>
     <hr width="100%">
  
     <div class="g-recaptcha" data-sitekey="6LfWxIAaAAAAACpbbVAjvdT_Ujf6sLxlFD3LIR9J"></div>
  
    <input class="buttons" type="submit" name="ingresar" on click="recaptcha" value="Ingresar">
      
    </form>
  </div>


</body>
</html>

<?php
}
?>