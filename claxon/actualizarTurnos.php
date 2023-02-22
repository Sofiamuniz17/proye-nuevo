
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
?>
<?php
$id = $_GET['id'];
?>
<head>
    <link rel="stylesheet" type="text/css" href="css/extras.css">
    <title>Actualizar Turnos</title>
</head>
<body>
    <header class="head"> 
    <div allign="center"><a class="titulo" href="lista_productos.php"><img src="claxon2.png" width="150px" height="150px"></a>
       
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
              <input required="" type="text" class="in" name ="Nombre" value = "<?php echo $row['Nombre']; ?>"></input>
              <label>Nombre</label>                    
            </div>

            <div class="user-box">
                <input class="in" required="" type="text" name ="Telefono" value = "<?php echo $row['Telefono']; ?>"></input>
                <label>Telefono</label>       
            </div>

            <div class="user-box">
              <input class="in" required="" type="text" name ="Correo" value = "<?php echo $row['Correo']; ?>"></input>
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

            <a >
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <button name = "actualice" type="submit" class="btnn">Cambiar</button>
           </a>

           <a>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <button  class="btnn"  type="submit" name = "borrar" >Eliminar</button>
           </a>  
  </div>      
                <?php
              }
            if(isset($_POST['actualice']))
              {
              if(strlen($_POST['Nombre']) >= 1 )
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
              }
              if(isset($_POST['borrar']))
                {
                $consulta ="DELETE FROM turnos WHERE id = '".$id."'";
                $resultado = mysqli_query($conex, $consulta);
                if($resultado) 
                  { ?>
                     <h3 class="actsi">Borrado Correctamente</h3>                 
                  <?php
                         $referer = $_SERVER['HTTP_REFERER'];
                         header("Location: verTurnos.php");
                         
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
