<?php
//Cerrar sesión en caso de refrescar o cerrar la página
/* session_unset(); */
//Comprobar si hay inicio de sesión y el tipo de usuario
session_start();
if(!isset($_SESSION['INICIO'])){
header('location:/seveclon/login/login.php');
}else if(!isset($_SESSION['TIEMPO'])){
  header('location:/seveclon/login/login.php');
  }else if($_SESSION['INICIO']!='A' && $_SESSION['INICIO']!='S'){
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
    <link rel="stylesheet" href="/seveclon/css/buscar_usuario.css">
    <link rel="stylesheet" href="/seveclon/css/barra_navegacion.css"></link>
    <title>Busqueda</title>
</head>
<body>

<!-- Barra de Navegación  -->

<header>
   <nav class="nav-menu">
          <div class=container-logo>
            <a href="/seveclon/index.html" class="n-logo"><img src="/seveclon/img/seve_logo.jpg" class="logo" alt="logo"></a>
          </div>
            
             <img src="/seveclon/img/menu_icono.svg" alt="Sin imagen" class="nav-icono">
             

            <ul class="nav-lista">
              <li class="nav-item"><a class="n-link" href="/seveclon/index.html">Inicio</a></li>
              <li class="nav-item"><a class="n-link" href="crear_servicio.php">Servicios</a></li>
              <li class="nav-item"><a class="n-link" href="../reclutador/crear_empleado.php">Empleados</a></li>
              <li class="nav-item"><a class="n-link cerrarses" href="">Cierre de Sesión</a></li>

            </ul>
   </nav>
</header>


<!-- Controles para búsqueda -->
<div class="container-busqueda">
 <form  name="fbuscar" method="POST" onsubmit="return validar();">
  <input class="idbuscar" type="text" name="idser" id="idser" value="<?php if($_POST){echo $_POST['idser'];}?>" placeholder="Ingrese el id del servicio:" >
  <button class="boton-buscar" type="submit" name="bbuscar" id="bbuscar">Buscar</button>
 </form>
</div>

<div class="container-tabla">
 <p><h1 class="titulo">Resultado de Búsqueda</h1></p>

<!-- Tabla para mostrar datos -->
   <table>
    <thead>
        <tr>
          <th>Id</th>
          <th>Empresa</th>
          <th>Razón Social</th>
          <th>RFC</th>
          <th>Fecha de Contratación</th>
          <th>Fecha de Termino</th>
          <th>Tiempo de Contratación</th>
          <th>Locación</th>
          <th>Número de Elementos</th>
          <th>Tipo de Servicio</th>
          <th>Status</th>
        </tr>
    </thead>
	
<?php 

/* Consulta a la base de datos para mostrar en la tabla los datos de coincidencia  */
include "../conexion.php";

if($_POST){
$idser= trim($_POST["idser"]);

$conex -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sentencia= $conex->prepare("SELECT * from servicios WHERE id_servicio=:u");

$sentencia->bindParam(":u",$idser);


$sentencia->execute();

$resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);


if(!$resultado){
?>
<h3 class="subtitulo">Id No Existe</h3>
<?php
}else{
  ?>
      <h3 class="subtitulo">Id Encontrado</h3>
      <input type="text" class="post" id="post" value="post" style="display:none">
<?php
      foreach($resultado as $row){     

?>

    <tbody>

        <tr>
          <td><?php echo $row['id_servicio']; ?></td>
          <td><?php echo $row['N_empresa']; ?></td>
          <td><?php echo $row['R_social']; ?></td>
          <td><?php echo $row['rfc']; ?></td>
          <td><?php echo $row['F_contratacion']; ?></td>
          <td><?php echo $row['F_termino']; ?></td>
          <td><?php echo $row['T_contratacion']; ?></td>
          <td><?php echo $row['locacion']; ?></td>
          <td><?php echo $row['N_elementos']; ?></td>
          <td><?php echo $row['T_servicio']; ?></td>
          <td><?php echo $row['status']; ?></td>
        </tr>
    </tbody>

<?php
      }
?>


	
 </table>
</div>

<div class="container-botones">
<a href="crear_servicio.php?id=<?php echo $idser?>"><button class="boton-modificar" type="button" name="bModificar" id="bModificar" onclick="return validar()">Modificar</button></a>

<a href="eliminar_servicio.php?id=<?php echo $idser?>"><button class="boton-eliminar" type="button" name="bEliminar" id="bEliminar" onclick="return confirmar()">Eliminar</button></a>

<a href="PDF/reporte.php"><p><button class="boton-generar" type="submit" name="bgenerar" id="bgenerar">Generar Reporte de Usuario</button></p></a>
</div>

	
<?php 
      
    }
    
    
}
	?>

<!-- SCRIPTS -->
<script src="/seveclon/js/botones_servicio.js"></script>
<script src="/seveclon/js/menu_nav.js"></script>
<script src="/seveclon/js/cerrarses.js"></script>
</body>
</html>
<?php

}

?>