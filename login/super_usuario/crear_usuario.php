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
    <link rel="stylesheet" href="/seveclon/css/crear_usuario.css">
    <link rel="stylesheet" href="/seveclon/css/barra_navegacion.css"></link>
    <title>Document</title>
</head>
<body>

<header>
   <nav class="nav-menu">
      <div class="container-logo">
            <a href="/seveclon/index.html" class="n-logo"><img src="/seveclon/img/seve_logo.jpg" class="logo" alt="logo"></a>
</div>
            
             <img src="/seveclon/img/menu_icono.svg" alt="Sin imagen" class="nav-icono">
             

            <ul class="nav-lista">
              <li class="nav-item"><a class="n-link" href="/seveclon/index.html">Inicio</a></li>
              <li class="nav-item"><a class="n-link" href="crear_usuario.php">Usuarios</a></li>
              <li class="nav-item"><a class="n-link" href="#empleados">Empleados</a></li>
              <li class="nav-item"><a class="n-link" href="#servicios">Servicios</a></li>
              <li class="nav-item"><a class="n-link cerrarses" href="">Cierre de Sesión</a></li>

            </ul>
   </nav>
</header>

<?php 
 /*Archivo con las funciones de cifrado */
 include('cifrar.php');

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

$sentencia= $conex->prepare("SELECT * from usuarios WHERE usuario=:u");

$sentencia->bindParam(":u",$id);


$sentencia->execute();

$resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);

/*Llave */
$llave="PgrS#p3o_Sr08c";

foreach($resultado as $row){

}

/*Descifrar contraseña para su comparación*/
$condes=descrifrar($row['contrasena'],$llave);
        
}





/*Si se envía el formulario se validan los campos  */
if (isset($_POST['registrar'])) {

$nom=$_POST['nombre'];
$usu=$_POST['usuario'];
$con=$_POST['contrasena'];
$cov=$_POST['ccontrasena'];
$tusu=$_POST['tusuario'];
$use="";

  include ("validar_usuario.php");

  if(valreg($nom,$usu,$use,$con,$cov,$tusu)){
    include("procesar_nuevo.php");
  }

}else if(isset($_POST['actualizar'])){

$nom=$_POST['nombre'];
$usu=$_POST['usuario'];
$con=$_POST['contrasena'];
$cov=$_POST['ccontrasena'];
$tusu=$_POST['tusuario'];


  include ("validar_usuario.php");
  if(valreg($nom,$usu,$id,$con,$cov,$tusu)){
    include("modificar_usuario.php");

}

}


	?>
    
 <div class="container-form">
    <form class="fcrear" action="" method="post">
          <h1 class="titulo">Registro de Usuarios</h1>
              <div class="grupo">
                  <input type="text" name="nombre" id="" value="<?php if($_GET){echo $row['nombre'];} else if($_POST){echo $_POST['nombre'];}?>"><span class="barra"></span>
                  <label>Nombre</label>
                </div>

                <div class="grupo">
                  <input type="text" name="usuario" id="" value="<?php if($_GET){echo $row['usuario'];} else if($_POST){echo $_POST['usuario'];}?>"><span class="barra"></span>
                  <label>Usuario</label>
                </div>

                <div class="grupo">
                  <input type="text" name="contrasena" id="" value="<?php if($_GET){echo $condes;} else if($_POST){echo $_POST['contrasena'];}?>"><span class="barra"></span>
                  <label>Contraseña</label>
                </div>

                <div class="grupo">
                  <input type="password" name="ccontrasena" id="" value="<?php if($_GET){echo $condes;} else if($_POST){echo $_POST['ccontrasena'];}?>"><span class="barra"></span>
                  <label>Confirmar Contraseña</label>
                </div>

                <div class="grupo">
                  <input type="text" name="tusuario" id="" value="<?php if($_GET){echo $row['T_usuario'];} else if($_POST){echo $_POST['tusuario'];}?>"><span class="barra"></span>
                  <label>Tipo de Usuario</label>
                </div>

                <div class="container-botones">
                <button class="button-limpiar" type="reset" name="limpiar" id="limpiar">Limpiar formulario</button>

                <br>
                <hr width="100%">
    
                <div class="g-recaptcha" data-sitekey="6LfWxIAaAAAAACpbbVAjvdT_Ujf6sLxlFD3LIR9J"></div>
    
                <br>

                <button class="button-guardar" name="registrar" id="guardar" type="submit">Guardar</button>
                <a href="/seveclon/login/super_usuario/buscar_usuario.php"><button class="button-buscar"type="button">Buscar</button></a>
                </div>
    </form>
    </div>

  <!-- Scripts -->
    <script src="../../js/botones_usuario.js"></script>
    <script src="../../js/menu_nav.js"></script>
    <script src="../../js/cerrarses.js"></script>
    


</body>
</html>

<?php
}
?>