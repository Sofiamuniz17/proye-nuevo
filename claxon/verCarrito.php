<?php
  session_start();
  ob_start();    

  include("database.php");
  include("conexion.php");
  
  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, Telefono, Nombre FROM users WHERE id = :id');
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

  $correo = trim($user['email']);
  $telefono = trim($user['Telefono']);
  $nombre = trim($user['Nombre']);


  if($tipo !== "Cliente") {
	die( "ERROR: invalid permissions to access file." );
  }

  ;  
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/carrito.css?v=<?php echo time(); ?>">
    
    <title>Carrito de compras</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <header id="header">  
        <a href='carrito.php'><h1>Volver atras</h1> </a>
    </header>
    <div id="contenedor" class="contenedor">

    <?php
        $query = "SELECT id, nombre, pedido, cantidad, precio, imagen FROM pedidos WHERE correo = '$correo'";   
        $resultado = $conexion->query($query);

        if ($resultado->num_rows === 0) {
          echo "<h1>El carrito se encuentra vacio</h1>";
        }else {
        while ($row = $resultado -> fetch_assoc()) {  
        ?>
        <div>

                <form method="post" type="submit" class="informacion">

                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>" />


                    <p name="nombre"><?php echo $row['pedido'] ?></p>
                    <p name="precio" class="precio"><?php echo $row['precio']?> $</p>
                    <p class="cantidad"><?php echo $row['cantidad']?> Productos reservado</p>
                    <button type='submit' name="removerCarrito">Remover</button>
                </form>                          
        </div> 
        <?php 
         }
      }   
        ?>

        <?php
            include("eliminarCarrito.php");
        ?>  

    </div>
    <script src="js/main.js"></script>
</body>

</html>