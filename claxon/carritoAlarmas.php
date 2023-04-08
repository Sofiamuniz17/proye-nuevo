
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
    
    <link rel="stylesheet" type="text/css" href="css/stylecat.css">
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

    <header >
   

        <h1>Carrito</h1> 
        <a href='verCarrito.php'><img class="carrito img" src="carrito.png" alt="carrito"/></a>
   

    </header>
         


    <a href="index.php"><img class="marginImage" src="claxon2.png" width="300px" height="250px"></a>

    <main class="contenido">
		
        <div class="cata">
    
        <div class="categorias">
              <div class="categorias-content">
                  <a href="carrito.php">Categorias</a>
                  <a href="carrito.php">Todo</a>
                  <a href="carritoAlarmas.php">Alarmas</a>
                  <a href="carritoStereos.php">Stereos</a>
                  <a href="carritoAudio.php">Audio</a>
                  <a href="carritoAcCc.php">Alza Cristales y Cierre Centralizados</a>
                  <a href="carritoelec.php">Electricidad</a>
              </div>
    </div>


    <div id="contenedor" class="contenedor">

    

    <?php
        $query = "SELECT imagen, nombre, stock, precio, id FROM partes WHERE activo = 1 && id_categoria=1";
        $resultado = $conexion->query($query);
        while ($row = $resultado -> fetch_assoc()) {  
        ?>
        <div>
            <img class="img" src="data:image/jpg;base64, <?php echo base64_encode($row['imagen']); ?>"/>
                <form method="post" type="submit" class="informacion">
                    


                    <input type="hidden" name='nombre' value="<?php echo $row['nombre'] ?>" > </input>
                    <input type="hidden" name='stock' value="<?php echo $row['stock'] ?>" > </input>
                    <input type="hidden" name='precio' value="<?php echo $row['precio'] ?>" > </input>

                    <p name='nombre'><?php echo $row['nombre'] ?></p>
                    <p name='precio' class="precio"><?php echo $row['precio']?> $</p>
                    <p class="precio"><?php echo $row['stock']?> Productos disponibles</p>
                    <button type='submit' name="agregarCarrito">Reservar</button>
                </form>                          
        </div> 
        <?php 
         }
        ?>

        <?php
            include("pedirCarrito.php");
        ?>  

    </div>
    <script src="js/main.js"></script>
</body>

</html>