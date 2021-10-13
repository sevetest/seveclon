<?php
//Cerrar sesión en caso de refrescar o cerrar la página
/* session_unset(); */
//Comprobar si hay inicio de sesión y el tipo de usuario
session_start();
if(!isset($_SESSION['INICIO'])){
header('location:/seveclon/login/login.php');
}else if(!isset($_SESSION['TIEMPO'])){
  header('location:/seveclon/login/login.php');
  }else if($_SESSION['INICIO']!='A' && $_SESSION['INICIO']!='S' && $_SESSION['INICIO']!='R'){
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
    <title>Búsqueda</title>
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
              <li class="nav-item"><a class="n-link" href="crear_empleado.php">Empleados</a></li>
              <li class="nav-item"><a class="n-link cerrarses" href="">Cierre de Sesión</a></li>

            </ul>
   </nav>
</header>


<!-- Controles para búsqueda -->
<div class="container-busqueda">
 <form  name="fbuscar" method="POST" onsubmit="return validar();">
 
   <input class="idbuscar" type="text" name="idemp" id="idemp" value="<?php if($_POST){echo $_POST['idemp'];}?>" placeholder="Ingrese la CURP del Empleado:">
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
          <th>Foto</th>
          <th>Nombre</th>
          <th>Apellido Paterno</th>
          <th>Apellido Materno</th>
          <th>Sexo</th>
          <th>Fecha de Nacimiento</th>
          <th>Lugar de Nacimiento</th>
          <th>Edad</th>
          <th>C.P.</th>
          <th>Calle</th>
          <th>Número Exterior</th>
          <th>Número Interior</th>
          <th>Colonia</th>
          <th>Municipio</th>
          <th>Estado</th>
          <th>Entre Calles</th>
          <th>Referencias</th>
          <th>Tel. de Casa</th>
          <th>Tel. Móvil</th>
          <th>RFC</th>
          <th>CURP</th>
          <th>NSS</th>
          <th>Tipo de Sangre</th>
          <th>Enfermedades</th>
          <th>Escolaridad</th>
          <th>Nombre de Familiar</th>
          <th>Teléfono de Familiar</th>
          <th>Puesto</th>
          <th>Estado Civil</th>
          <th>Status</th>

        </tr>
    </thead>
	
<?php 

/* Consulta a la base de datos para mostrar en la tabla los datos de coincidencia  */
include "../conexion.php";

if($_POST){
$idemp= trim($_POST["idemp"]);

$conex -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sentencia= $conex->prepare("SELECT * from empleados WHERE curp=:u");

$sentencia->bindParam(":u",$idemp);


$sentencia->execute();

$resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);


if(!$resultado){
?>
<h3 class="subtitulo">CURP No Existe</h3>
<?php
}else{
  ?>
      <h3 class="subtitulo">CURP Encontrada</h3>
      <!--Indicador que hubo Post para mostrar los botones de edición-->
      <input type="text" class="post" id="post" value="post" style="display:none">
<?php
      foreach($resultado as $row){     

?>

    <tbody>

        <tr>
          <td><?php echo $row['id_empleado']; ?></td>
          <td>
            /*conversión de dato binario a base64 */
            <img src="data:<?php echo $row['foto']['tipo']?>;base64,<?php echo base64_encode($row['foto'];) ?>">
            
          </td>
          <td><?php echo $row['N_empleado']; ?></td>
          <td><?php echo $row['A_paterno']; ?></td>
          <td><?php echo $row['A_materno']; ?></td>
          <td><?php echo $row['sexo']; ?></td>
          <td><?php echo $row['F_nacimiento']; ?></td>
          <td><?php echo $row['L_nacimiento']; ?></td>
          <td><?php echo $row['edad']; ?></td>
          <td><?php echo $row['C_postal']; ?></td>
          <td><?php echo $row['calle']; ?></td>
          <td><?php echo $row['N_exterior']; ?></td>
          <td><?php echo $row['N_interior']; ?></td>
          <td><?php echo $row['colonia']; ?></td>
          <td><?php echo $row['municipio']; ?></td>
          <td><?php echo $row['estado']; ?></td>
          <td><?php echo $row['E_calles']; ?></td>
          <td><?php echo $row['referencias']; ?></td>
          <td><?php echo $row['T_casa']; ?></td>
          <td><?php echo $row['T_movil']; ?></td>
          <td><?php echo $row['rfc']; ?></td>
          <td><?php echo $row['curp']; ?></td>
          <td><?php echo $row['nss']; ?></td>
          <td><?php echo $row['T_sangre']; ?></td>
          <td><?php echo $row['enfermedades']; ?></td>
          <td><?php echo $row['escolaridad']; ?></td>
          <td><?php echo $row['N_familiar']; ?></td>
          <td><?php echo $row['T_familiar']; ?></td>
          <td><?php echo $row['puesto']; ?></td>
          <td><?php echo $row['E_civil']; ?></td>
          <td><?php echo $row['status']; ?></td>
  
        </tr>
    </tbody>

<?php
      }
?>


	
 </table>
</div>

<div class="container-botones">
<a href="crear_empleado.php?id=<?php echo $idemp?>"><button class="boton-modificar" type="button" name="bModificar" id="bModificar" onclick="return validar()">Modificar</button></a>

<a href="eliminar_empleado.php?id=<?php echo $idemp?>"><button class="boton-eliminar" type="button" name="bEliminar" id="bEliminar" onclick="return confirmar()">Eliminar</button></a>

<a href="PDF/reporte.php"><p><button class="boton-generar" type="submit" name="bgenerar" id="bgenerar">Generar Reporte de Usuario</button></p></a>
</div>

	
<?php 
      
    }
    
    
}
	?>

<!-- SCRIPTS -->
<script src="/seveclon/js/botones_empleado.js"></script>
<script src="/seveclon/js/menu_nav.js"></script>
<script src="/seveclon/js/cerrarses.js"></script>
</body>
</html>
<?php

}

?>