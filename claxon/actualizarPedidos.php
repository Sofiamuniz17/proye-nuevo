
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
    <link rel="stylesheet" type="text/css" href="css/extras.css">
    <title>Actualizar Pedido</title>
</head>
<body>
    <header class="head"> 
    <div allign="center"><a class="titulo" href="<?php echo $tipo === 'Cliente' ? 'pedidosCliente.php' : 'verPedidos.php'; ?>" ><img src="claxon2.png" width="150px" height="150px"></a>
       
			<div class="cata">
    <?php
        include("conexion.php");
        $query = "SELECT * FROM pedidos WHERE id = $id";
        $resultado = $conexion->query($query);
        while ($row = $resultado -> fetch_assoc()) {
            ?>


<div class="login-box">
  <h2>Pedido</h2>
      <form  id="form" type="submit" method="post">
            <div class="user-box">                
              <input disabled="true" required="" type="text" class="in" name ="Nombre" value = "<?php echo $row['nombre']; ?>"></input>
              <label>Nombre</label>                    
            </div>

            <div class="user-box">
                <input disabled="true" class="in" required="" type="text" name ="Telefono" value = "<?php echo $row['telefono'] ?>"></input>
                <label>Telefono</label>       
            </div>

            <div class="user-box">
              <input disabled="true" class="in" required="" type="text" name ="Correo" value = "<?php echo $row['correo'] ?>"></input>
              <label>Correo</label>            
            </div>

            <div class="user-box">
              <input disabled="true" class="in" required="" type="text" name ="Consulta" value = "<?php echo $row['pedido'] ?>"></input>  
              <label>Pedido</label>                   
            </div>

            <div class="user-box">
              <input disabled="true" class="in" required="" type="text" name ="Fecha_Solicitud" value = "<?php echo $row['cantidad'] ?>"></input>  
              <label>Cantidad</label>                   
            </div>


           <a style="display:flex; justify-content:center">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <button  class="btnn"  type="submit" name = "borrar" >Confirmar</button>
           </a>  
  </div>      
                <?php
              }
              if(isset($_POST['borrar']))
                {
                $consulta ="DELETE FROM pedidos WHERE id = '".$id."'";
                $resultado = mysqli_query($conex, $consulta);
                if($resultado) 
                  { ?>
                     <h3 class="actsi">Borrado Correctamente</h3>                 
                  <?php
                         if($tipo === "Cliente") {
                          $referer = $_SERVER['HTTP_REFERER'];
                          header("Location: pedidosCliente.php");   
                         }else {
                          $referer = $_SERVER['HTTP_REFERER'];
                          header("Location: verPedidos.php");   
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
