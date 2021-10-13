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
    <link rel="stylesheet" href="/seveclon/css/crear_usuario.css">
    <link rel="stylesheet" href="/seveclon/css/barra_navegacion.css"></link>
    <title>Crear Registro</title>
</head>
<body>

<header>
 <!--  Barra de navegación con menú -->
   <nav class="nav-menu">
      <div class="container-logo">
            <!-- <a href="/seveclon/index.html" class="n-logo"><img src="/seveclon/img/seve_logo.jpg" class="logo" alt="logo"></a> -->
</div>
            
             <img src="/seveclon/img/menu_icono.svg" alt="Sin imagen" class="nav-icono">
             

            <ul class="nav-lista">
              <li class="nav-item"><a class="n-link" href="/seveclon/index.html">Inicio</a></li>
              <li class="nav-item"><a class="n-link" href="crear_empleado.php">Empleados</a></li>
              <li class="nav-item"><a class="n-link cerrarses" href="">Cierre de Sesión</a></li>

            </ul>
   </nav>
</header>

<?php 

/*Si se reciben datos por medio de GET por medio de la url */ 
if($_GET){
  /*Archivo de conexión */
  include('../conexion.php');

?>
<!-- Etiqueta indicadora de que hay get  -->
<input type="text" id="get" value="get" style="display:none">
<?php
$id= trim($_GET["id"]);

$conex -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sentencia= $conex->prepare("SELECT * from empleados WHERE curp=:u");

$sentencia->bindParam(":u",$id);


$sentencia->execute();

$resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);


foreach($resultado as $row){

}

        
}





/*Si se envía el formulario se validan los campos  */
if (isset($_POST['registrar'])) {

/*variables que guardan los valores enviados */
$nom=$_POST['N_empleado'];
$apa=$_POST['A_paterno'];
$ama=$_POST['A_materno'];
$sex=$_POST['sexo'];
$fna=$_POST['F_nacimiento'];
$lna=$_POST['L_nacimiento'];
$eda=$_POST['edad'];
$cpo=$_POST['C_postal'];
$cal=$_POST['calle'];
$nex=$_POST['N_exterior'];
$nin=$_POST['N_interior'];
$col=$_POST['colonia'];
$mun=$_POST['municipio'];
$est=$_POST['estado'];
$eca=$_POST['E_calles'];
$ref=$_POST['referencias'];
$tca=$_POST['T_casa'];
$tmo=$_POST['T_movil'];
$rfc=$_POST['rfc'];
$curp=$_POST['curp'];
$nss=$_POST['nss'];
$tsa=$_POST['T_sangre'];
$enf=$_POST['enfermedades'];
$esc=$_POST['escolaridad'];
$nfa=$_POST['N_familiar'];
$tfa=$_POST['T_familiar'];
$pue=$_POST['puesto'];
$eci=$_POST['E_civil'];
$sta=$_POST['status'];

/*variables de los datos enviados de la foto */
$N_archivo=$_FILES['foto']['name'];
$T_archivo=$_FILES['foto']['type'];
$Ta_archivo=$_FILES['foto']['size'];


  include ("validar_empleado.php");

  if(valreg($N_archivo,$T_archivo,$Ta_archivo,$nom,$apa,$ama,$sex,$fna,$lna,$eda,$cpo,$cal,$nex,$nin,$col,$mun,$est,$eca,$ref,$tca,$tmo,$rfc,$curp,$nss,$tsa,$enf,$esc,$nfa,$tfa,
  $pue,$eci,$sta)){
    include("procesar_nuevo.php");
  }

}else if(isset($_POST['actualizar'])){

  $fot=$_POST['foto'];
  $nom=$_POST['N_empleado'];
  $apa=$_POST['A_paterno'];
  $ama=$_POST['A_materno'];
  $sex=$_POST['sexo'];
  $fna=$_POST['F_nacimiento'];
  $lna=$_POST['L_nacimiento'];
  $eda=$_POST['edad'];
  $cpo=$_POST['C_postal'];
  $cal=$_POST['calle'];
  $nex=$_POST['N_exterior'];
  $nin=$_POST['N_interior'];
  $col=$_POST['colonia'];
  $mun=$_POST['municipio'];
  $est=$_POST['estado'];
  $eca=$_POST['E_calles'];
  $ref=$_POST['referencias'];
  $tca=$_POST['T_casa'];
  $tmo=$_POST['T_movil'];
  $rfc=$_POST['rfc'];
  $curp=$_POST['curp'];
  $nss=$_POST['nss'];
  $tsa=$_POST['T_sangre'];
  $enf=$_POST['enfermedades'];
  $esc=$_POST['escolaridad'];
  $nfa=$_POST['N_familiar'];
  $tfa=$_POST['T_familiar'];
  $pue=$_POST['puesto'];
  $eci=$_POST['E_civil'];
  $sta=$_POST['status'];


  include ("validar_empleado.php");
  if(valreg($fot,$nom,$apa,$ama,$sex,$fna,$lna,$eda,$cpo,$cal,$nex,$nin,$col,$mun,$est,$eca,$ref,$tca,$tmo,$rfc,$curp,$nss,$tsa,$enf,$esc,$nfa,$tfa,
  $pue,$eci,$sta)){
    include("modificar_empleado.php");
}

}


	?>
    
 <div class="container-form">
    <form class="fcrear" action="" method="post" enctype="multipart/form-data">
          <h1 class="titulo">Registro de Empleados</h1>

                <div class="grupo">
                  <input type="file" name="foto" id="" value="<?php if($_GET){echo $row['foto'];} else if($_POST){echo $_POST['foto'];}?>"><span class="barra"></span>
                  <label>Foto del Empleado</label>
                </div>

                <div class="grupo">
                  <input type="text" name="N_empleado" id="" value="<?php if($_GET){echo $row['N_empleado'];} else if($_POST){echo $_POST['N_empleado'];}?>"><span class="barra"></span>
                  <label>Nombre del Empleado</label>
                </div>

                <div class="grupo">
                  <input type="text" name="A_paterno" id="" value="<?php if($_GET){echo $row['A_paterno'];} else if($_POST){echo $_POST['A_paterno'];}?>"><span class="barra"></span>
                  <label>Apellido Paterno</label>
                </div>

                <div class="grupo">
                  <input type="text" name="A_materno" id="" value="<?php if($_GET){echo $row['A_materno'];} else if($_POST){echo $_POST['A_materno'];}?>"><span class="barra"></span>
                  <label>Apellido Materno</label>
                </div>

                <div class="grupo">
                  <input type="text" name="sexo" id="" value="<?php if($_GET){echo $row['sexo'];} else if($_POST){echo $_POST['sexo'];}?>"><span class="barra"></span>
                  <label>Sexo</label>
                </div>

                <div class="grupo">
                  <input type="date" name="F_nacimiento" id="" value="<?php if($_GET){echo $row['F_termino'];} else if($_POST){echo $_POST['F_termino'];}?>"><span class="barra"></span>
                  <label>Fecha de Nacimiento</label>
                </div>

                <div class="grupo">
                  <input type="text" name="L_nacimiento" id="" value="<?php if($_GET){echo $row['L_nacimiento'];} else if($_POST){echo $_POST['L_nacimiento'];}?>"><span class="barra"></span>
                  <label>Lugar de Nacimiento</label>
                </div>

                <div class="grupo">
                  <input type="text" name="edad" id="" value="<?php if($_GET){echo $row['edad'];} else if($_POST){echo $_POST['edad'];}?>"><span class="barra"></span>
                  <label>Edad</label>
                </div>

                <div class="grupo">
                  <input type="text" name="C_postal" id="" value="<?php if($_GET){echo $row['C_postal'];} else if($_POST){echo $_POST['C_postal'];}?>"><span class="barra"></span>
                  <label>Código Postal</label>
                </div>

                <div class="grupo">
                  <input type="text" name="calle" id="" value="<?php if($_GET){echo $row['calle'];} else if($_POST){echo $_POST['calle'];}?>"><span class="barra"></span>
                  <label>Calle</label>
                </div>

                <div class="grupo">
                  <input type="text" name="N_exterior" id="" value="<?php if($_GET){echo $row['N_exterior'];} else if($_POST){echo $_POST['N_exterior'];}?>"><span class="barra"></span>
                  <label>Número Exterior</label>
                </div>

                <div class="grupo">
                  <input type="text" name="N_interior" id="" value="<?php if($_GET){echo $row['N_interior'];} else if($_POST){echo $_POST['N_interior'];}?>"><span class="barra"></span>
                  <label>Número Interior</label>
                </div>

                <div class="grupo">
                  <input type="text" name="colonia" id="" value="<?php if($_GET){echo $row['colonia'];} else if($_POST){echo $_POST['colonia'];}?>"><span class="barra"></span>
                  <label>Colonia</label>
                </div>

                <div class="grupo">
                  <input type="text" name="municipio" id="" value="<?php if($_GET){echo $row['municipio'];} else if($_POST){echo $_POST['municipio'];}?>"><span class="barra"></span>
                  <label>Municipio</label>
                </div>

                <div class="grupo">
                  <input type="text" name="estado" id="" value="<?php if($_GET){echo $row['estado'];} else if($_POST){echo $_POST['estado'];}?>"><span class="barra"></span>
                  <label>Estado</label>
                </div>

                <div class="grupo">
                  <input type="text" name="E_calles" id="" value="<?php if($_GET){echo $row['E_calles'];} else if($_POST){echo $_POST['E_calles'];}?>"><span class="barra"></span>
                  <label>Entre calles</label>
                </div>

                <div class="grupo">
                  <input type="text" name="referencias" id="" value="<?php if($_GET){echo $row['referencias'];} else if($_POST){echo $_POST['referencias'];}?>"><span class="barra"></span>
                  <label>Referencias</label>
                </div>

                <div class="grupo">
                  <input type="text" name="T_casa" id="" value="<?php if($_GET){echo $row['T_casa'];} else if($_POST){echo $_POST['T_casa'];}?>"><span class="barra"></span>
                  <label>Teléfono de Casa</label>
                </div>

                <div class="grupo">
                  <input type="text" name="T_movil" id="" value="<?php if($_GET){echo $row['T_movil'];} else if($_POST){echo $_POST['T_movil'];}?>"><span class="barra"></span>
                  <label>Teléfono Móvil</label>
                </div>

                <div class="grupo">
                  <input type="text" name="rfc" id="" value="<?php if($_GET){echo $row['rfc'];} else if($_POST){echo $_POST['rfc'];}?>"><span class="barra"></span>
                  <label>RFC</label>
                </div>

                <div class="grupo">
                  <input type="text" name="curp" id="" value="<?php if($_GET){echo $row['curp'];} else if($_POST){echo $_POST['curp'];}?>"><span class="barra"></span>
                  <label>CURP</label>
                </div>

                <div class="grupo">
                  <input type="text" name="nss" id="" value="<?php if($_GET){echo $row['nss'];} else if($_POST){echo $_POST['nss'];}?>"><span class="barra"></span>
                  <label>NSS</label>
                </div>

                <div class="grupo">
                  <input type="text" name="T_sangre" id="" value="<?php if($_GET){echo $row['T_sangre'];} else if($_POST){echo $_POST['T_sangre'];}?>"><span class="barra"></span>
                  <label>Tipo de Sangre</label>
                </div>

                <div class="grupo">
                  <input type="text" name="enfermedades" id="" value="<?php if($_GET){echo $row['enfermedades'];} else if($_POST){echo $_POST['enfermedades'];}?>"><span class="barra"></span>
                  <label>Enfermedades</label>
                </div>

                <div class="grupo">
                  <input type="text" name="escolaridad" id="" value="<?php if($_GET){echo $row['escolaridad'];} else if($_POST){echo $_POST['escolaridad'];}?>"><span class="barra"></span>
                  <label>Escolaridad</label>
                </div>

                <div class="grupo">
                  <input type="text" name="N_familiar" id="" value="<?php if($_GET){echo $row['N_familiar'];} else if($_POST){echo $_POST['N_familiar'];}?>"><span class="barra"></span>
                  <label>Nombre de Contacto Familiar</label>
                </div>

                <div class="grupo">
                  <input type="text" name="T_familiar" id="" value="<?php if($_GET){echo $row['T_familiar'];} else if($_POST){echo $_POST['T_familiar'];}?>"><span class="barra"></span>
                  <label>Teléfono de Contacto Familiar</label>
                </div>

                <div class="grupo">
                  <input type="text" name="puesto" id="" value="<?php if($_GET){echo $row['puesto'];} else if($_POST){echo $_POST['puesto'];}?>"><span class="barra"></span>
                  <label>Puesto</label>
                </div>

                <div class="grupo">
                  <input type="text" name="E_civil" id="" value="<?php if($_GET){echo $row['E_civil'];} else if($_POST){echo $_POST['E_civil'];}?>"><span class="barra"></span>
                  <label>Estado Civil</label>
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
                <a href="/seveclon/login/reclutador/buscar_empleado.php"><button class="button-buscar"type="button">Buscar</button></a>
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