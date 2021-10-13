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
    <link rel="stylesheet" href="/seveclon/css/crear_usuario.css">
    <link rel="stylesheet" href="/seveclon/css/barra_navegacion.css"></link>
    <title>Document</title>
</head>
<body>

<header>
 <!--  Barra de navegación con menú -->
   <nav class="nav-menu">
      <div class="container-logo">
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

<?php 

/*Si se recibe el usuario por medio de la url */ 
if($_GET){
  /*Archivo de conexión */
  include('../conexion.php');

?>
<!-- Etiqueta indicadora de que hay get  -->
<input type="text" id="get" value="get" style="display:none">
<?php
$id= trim($_GET["id"]);

$conex -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sentencia= $conex->prepare("SELECT * from servicios WHERE id_servicio=:u");

$sentencia->bindParam(":u",$id);


$sentencia->execute();

$resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);


foreach($resultado as $row){

}

        
}





/*Si se envía el formulario se validan los campos  */
if (isset($_POST['registrar'])) {

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


  include ("validar_servicio.php");

  if(valreg($nom,$soc,$rfc,$fco,$fte,$tco,$loc,$nel,$tse,$sta)){
    include("procesar_nuevo.php");
  }

}else if(isset($_POST['actualizar'])){

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


  include ("validar_servicio.php");
  if(valreg($nom,$soc,$rfc,$fco,$fte,$tco,$loc,$nel,$tse,$sta)){
    include("modificar_servicio.php");
}

}


	?>
    
 <div class="container-form">
    <form class="fcrear" action="" method="post">
          <h1 class="titulo">Registro de Servicios</h1>
              <div class="grupo">
                  <input type="text" name="N_empresa" id="" value="<?php if($_GET){echo $row['N_empresa'];} else if($_POST){echo $_POST['N_empresa'];}?>"><span class="barra"></span>
                  <label>Nombre de la Empresa</label>
                </div>

                <div class="grupo">
                  <input type="text" name="R_social" id="" value="<?php if($_GET){echo $row['R_social'];} else if($_POST){echo $_POST['R_social'];}?>"><span class="barra"></span>
                  <label>Razón Social</label>
                </div>

                <div class="grupo">
                  <input type="text" name="rfc" id="" value="<?php if($_GET){echo $row['rfc'];} else if($_POST){echo $_POST['rfc'];}?>"><span class="barra"></span>
                  <label>RFC</label>
                </div>

                <div class="grupo">
                  <input type="date" name="F_contratacion" id="" value="<?php if($_GET){echo $row['F_contratacion'];} else if($_POST){echo $_POST['F_contratacion'];}?>"><span class="barra"></span>
                  <label>Fecha de Contratación</label>
                </div>

                <div class="grupo">
                  <input type="date" name="F_termino" id="" value="<?php if($_GET){echo $row['F_termino'];} else if($_POST){echo $_POST['F_termino'];}?>"><span class="barra"></span>
                  <label>Fecha de Termino</label>
                </div>

                <div class="grupo">
                  <input type="text" name="T_contratacion" id="" value="<?php if($_GET){echo $row['T_contratacion'];} else if($_POST){echo $_POST['T_contratacion'];}?>"><span class="barra"></span>
                  <label>Tiempo de Contratación</label>
                </div>

                <div class="grupo">
                  <input type="text" name="locacion" id="" value="<?php if($_GET){echo $row['locacion'];} else if($_POST){echo $_POST['locacion'];}?>"><span class="barra"></span>
                  <label>Locación</label>
                </div>

                <div class="grupo">
                  <input type="text" name="N_elementos" id="" value="<?php if($_GET){echo $row['N_elementos'];} else if($_POST){echo $_POST['N_elementos'];}?>"><span class="barra"></span>
                  <label>Número de Elementos Asignados</label>
                </div>

                <div class="grupo">
                  <input type="text" name="T_servicio" id="" value="<?php if($_GET){echo $row['T_servicio'];} else if($_POST){echo $_POST['T_servicio'];}?>"><span class="barra"></span>
                  <label>Tipo de Servicio</label>
                </div>

                <div class="grupo">
                  <input type="text" name="status" id="" value="<?php if($_GET){echo $row['status'];} else if($_POST){echo $_POST['status'];}?>"><span class="barra"></span>
                  <label>Status</label>
                </div>

                <!-- Botones para acciones del formulario -->
                <div class="container-botones">
                <button class="button-limpiar" type="reset" name="limpiar" id="limpiar">Limpiar formulario</button>

                <br>
                <hr width="100%">
    
                <div class="g-recaptcha" data-sitekey="6LfWxIAaAAAAACpbbVAjvdT_Ujf6sLxlFD3LIR9J"></div>
    
                <br>

                <button class="button-guardar" name="registrar" id="guardar" type="submit">Guardar</button>
                <a href="/seveclon/login/administrador/buscar_servicio.php"><button class="button-buscar"type="button">Buscar</button></a>
                </div>
    </form>
    </div>

  <!-- Scripts -->
    <script src="../../js/botones_servicio.js"></script>
    <script src="../../js/menu_nav.js"></script>
    <script src="../../js/cerrarses.js"></script>
    


</body>
</html>

<?php
}
?>