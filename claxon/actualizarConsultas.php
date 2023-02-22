
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
        $query = "SELECT * FROM consultas WHERE id = $id";
        $resultado = $conexion->query($query);
        while ($row = $resultado -> fetch_assoc()) {
            ?>


<div class="login-box">
  <h2>Consulta</h2>
      <form  id="form" type="submit" method="post">
            <div class="user-box">                
              <input required="" type="text" class="in" name ="Nombre" value = "<?php echo $row['Nombre']; ?>"></input>
              <label>Nombre</label>                    
            </div>

            <div class="user-box">
                <input class="in" required="" type="text" name ="Telefono" value = "<?php echo $row['Telefono'] ?>"></input>
                <label>Telefono</label>       
            </div>

            <div class="user-box">
              <input class="in" required="" type="text" name ="Correo" value = "<?php echo $row['Correo'] ?>"></input>
              <label>Correo</label>            
            </div>

            <div class="user-box">
              <input class="in" required="" type="text" name ="Consulta" value = "<?php echo $row['Consulta'] ?>"></input>  
              <label>Consulta</label>                   
            </div>

            <div class="user-box">
              <input class="in" required="" type="text" name ="Fecha_Solicitud" value = "<?php echo $row['Fecha_Solicitud'] ?>"></input>  
              <label>Fecha de Solicitud</label>                   
            </div>

            <a href="mailto: <?php echo $row['Correo'] ?>">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <button class="btnn" type="button" >Responder</button>
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
              if(isset($_POST['borrar']))
                {
                $consulta ="DELETE FROM consultas WHERE id = '".$id."'";
                $resultado = mysqli_query($conex, $consulta);
                if($resultado) 
                  { ?>
                     <h3 class="actsi">Borrado Correctamente</h3>                 
                  <?php
                         $referer = $_SERVER['HTTP_REFERER'];
                         header("Location: verConsultas.php");
                         
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
