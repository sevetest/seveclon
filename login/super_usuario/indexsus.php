<?php
//Cerrar sesión en caso de refrescar o cerrar la página
/* session_unset(); */
//Comprobar si hay inicio de sesión y el tipo de usuario
session_start();
if(!isset($_SESSION['INICIO'])){
header('location:/seveclon/login/login.php');
}else if(!isset($_SESSION['TIEMPO'])){
  header('location:/seveclon/login/login.php');
  }else if($_SESSION['INICIO']!='S'){
header('location:/seveclon/index.html');
  }else{
  //Tiempo en segundos para dar vida a la sesión.
  $inactivo = 1200;//20min en este caso.

  //Calculamos tiempo de vida inactivo.
  $vida_session = time() - $_SESSION['TIEMPO'];

      //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
      if($vida_session > $inactivo)
      {
          //Removemos sesión.
          session_unset();
          //Destruimos sesión.
          session_destroy();              
          //Redirigimos a inicio.
          header("Location:/seveclon/index.html");

          exit();
      }

$_SESSION['TIEMPO'] = time();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/indexsus.css">
    <link rel="stylesheet" href="/seveclon/css/barra_navegacion.css"></link>
    <title>Inicio Super-usuario</title>
</head>
<body>

<header>
   <nav class="nav-menu">
     <div class="container-logo">
            <a href="../../index.html" class="n-logo"><img src="../../img/seve_logo.jpg" class="logo" alt="logo"></a>
</div>
            
             <img src="../../img/menu_icono.svg" alt="Sin imagen" class="nav-icono">
             

            <ul class="nav-lista">
              <li class="nav-item"><a class="n-link" href="/seveclon/index.html">Inicio</a></li>
              <li class="nav-item"><a class="n-link" href="crear_usuario.php">Usuarios</a></li>
              <li class="nav-item"><a class="n-link" href="../reclutador/indexrec.php">Empleados</a></li>
              <li class="nav-item"><a class="n-link" href="../administrador/indexadm.php">Servicios</a></li>
              <li class="nav-item"><a class="n-link cerrarses" href="">Cierre de Sesión</a></li>

            </ul>
            
            
           
            
           

   </nav>
</header>

    <!-- Scripts -->
    <script src="../../js/menu_nav.js"></script>
    <script src="../../js/cerrarses.js"></script>
</body>
</html>

<?php

}

?>