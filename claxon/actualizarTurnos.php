
<?php
  session_start();

  require 'db.php';
  require 'database.php';
  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    

    $user = null;

    if (count((array)$results) > 0) {
      $user = $results;
    }
  }
  $q= $conn->prepare("SELECT Tipo FROM users WHERE id = :id");
  $q->bindParam(':id', $_SESSION['user_id']);
  $q->execute();
  $tipo = $q->fetchColumn();  

  if($tipo !== "Cliente" && $tipo !== "Administrador") {
	die( "ERROR: invalid permissions to access file." );
  }
   
?>
<?php
$id = $_GET['id'];
?>
<head>
  <link rel="stylesheet" type="text/css" href="css/extras.css?v=<?php echo time(); ?>">
    <title>Actualizar Turnos</title>
</head>
<body>
    <header class="head">
       
  <?php
    if($tipo === "Administrador") {
  ?>
      <div allign="center"><a class="titulo" href="verTurnos.php" ><img src="claxon2.png" width="150px" height="150px"></a>
  <?php
     }
  ?>

<?php
    if($tipo === "Cliente") {
  ?>
      <div allign="center"><a class="titulo" href="turnosCliente.php" ><img src="claxon2.png" width="150px" height="150px"></a>
  <?php
     }
  ?>
       
			<div class="cata">
    <?php
        include("conexion.php");
        $query = "SELECT * FROM turnos WHERE id = $id";
        $resultado = $conexion->query($query);
        while ($row = $resultado -> fetch_assoc()) {
    ?>


<div class="login-box">
  <h2>Turno</h2>
      <form  id="form" type="submit" method="post">
            <div class="user-box">                
              <input readonly={<?php $tipo === 'Cliente' ?>} required="" type="text" class="in" name ="Nombre" value = "<?php echo $row['Nombre']; ?>"></input>
              <label>Nombre</label>                    
            </div>

            <div class="user-box">
                <input readonly={<?php $tipo === 'Cliente' ?>} class="in" required="" type="text" name ="Telefono" value = "<?php echo $row['Telefono']; ?>"></input>
                <label>Telefono</label>       
            </div>

            <div class="user-box">
              <input readonly={<?php $tipo === 'Cliente' ?>} class="in" required="" type="text" name ="Correo" value = "<?php echo $row['Correo']; ?>"></input>
              <label>Correo</label>            
            </div>

            <div class="user-box">
              <input class="in" required="" type="text" name ="Fecha_Hora" value = "<?php echo $row['Fecha_Hora']; ?>"></input>
              <label>Fecha y Hora</label>            
            </div>

            <div class="user-box">              
                <input class="in" required="" type="text" name ="Marca_Modelo" value = "<?php echo $row['Marca_Modelo']; ?>"></input>  
                <label>Marca y Modelo</label>           
            </div>

            <div class="user-box">            
              <input class="in" required="" type="text" name ="Servicio" value = "<?php echo $row['Servicio']; ?>"></input> 
              <label>Servicio</label>            
            </div>

            <div class="user-box">
              <input class="in" required="" type="text" name ="Fecha_Solicitud" value = "<?php echo $row['Fecha_Solicitud']; ?>"></input>  
              <label>Fecha de solicitud</label>                   
            </div>

          <?php 
             if($tipo === 'Administrador') {
          ?>
              <a >
              <span></span>
              <span></span>
              <span></span>
              <span></span>
              <button name = "actualice" type="submit" class="btnn">Cambiar</button>
             </a>
             <?php 
             }
            ?>
         
          <a style="<?php echo $tipo === 'Cliente' ? 'display:flex; justify-content:center' : '' ?>">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <button   class="btnn"  type="submit" name = "borrar" >Eliminar</button>
           </a>  
  </div>      
                <?php
              }
            if(isset($_POST['actualice']))
              {
                $Nombre = trim($_POST['Nombre']);
                $Telefono = trim($_POST['Telefono']);
                $Correo = trim($_POST['Correo']);
                $Fecha_Hora = trim($_POST['Fecha_Hora']);
                $Marca_Modelo = trim($_POST['Marca_Modelo']);
                $Servicio = trim($_POST['Servicio']);
                $Fecha_Solicitud = trim($_POST['Fecha_Solicitud']);
                $consulta ="UPDATE turnos set Nombre = '".$Nombre."',Telefono = '".$Telefono."',Correo = '".$Correo."',Fecha_Hora = '".$Fecha_Hora."',Marca_Modelo = '".$Marca_Modelo."',Servicio = '".$Servicio."',Fecha_Solicitud = '".$Fecha_Solicitud."' WHERE id = '".$id."'";
                $resultado = mysqli_query($conex, $consulta);
                if($resultado) 
                  { ?>
                  <?php
                  $referer = $_SERVER['HTTP_REFERER'];
                  header("Location: $referer");
                  } 
                else 
                  { ?>
                  <h3 class="actno">Ha habido un error en la solicitud</h3>            
                  <?php
                  } 
                
              }
              if(isset($_POST['borrar']))
                {
                $consulta ="DELETE FROM turnos WHERE id = '".$id."'";
                $resultado = mysqli_query($conex, $consulta);
                if($resultado) 
                  { ?>              
                  <?php
                        if($tipo === "Cliente") {
                          $referer = $_SERVER['HTTP_REFERER'];
                          header("Location: turnosCliente.php");   
                         }else {
                          $referer = $_SERVER['HTTP_REFERER'];
                          header("Location: verTurnos.php");   
                         }                                     
                  } 
                else 
                  { ?>
                  <h3 class="actno">Ha habido un error en la solicitud</h3>            
                  <?php
                  } 
                }
        ?>
              </form>
           
            

</body>
