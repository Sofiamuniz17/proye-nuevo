<?php
  session_start();

  require 'database.php';
  require 'db.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);    
    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
  $q= $conn->prepare("SELECT Tipo FROM users WHERE id = :id");
  $q->bindParam(':id', $_SESSION['user_id']);
  $q->execute();
  $tipo = $q->fetchColumn();  

  if($tipo !== "Administrador") {
	  die( "ERROR: invalid permissions to access file." );
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Nuevo Producto</title>
    <link rel="stylesheet" href="css/turnos.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap" rel="stylesheet"> 
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
	

    
</head>
<body>
<div allign="center"><a class="titulo" href="home.php"><img src="claxon2.png" width="150px" height="150px"></a>

      <form class="post" method="post">
        <h4> NUEVO PRODUCTO</h4>
        <input class="controls" type="text" name="nombre" placeholder="Ingrese el nombre del producto" required></input>
        <input class="controls" type="file" name="imagen" required></input>
        <input class="controls" type="number" name="precio" placeholder="Seleccione el precio del producto" min = 500 max = 100000 step="500"required></input>
        <input class="controls" type="number" name="categoria" placeholder="Seleccione el numero de categoria del producto" min = 1 max = 5 required></input>
        <input class="controls" type="text" name="descripcion" placeholder="Ingrese la descripcion del producto"required></input>

		<button class="turnos"type="submit" name="agregar">AGREGAR </button>
      </form>
      <?php
            if(isset($_POST['agregar']))
              {
              if(strlen($_POST['nombre']) >= 1 )
                {
                $nombre = trim($_POST['nombre']);
                $imagen = trim($_POST['imagen']);
                $precio = trim($_POST['precio']);
                $idcat = trim($_POST['categoria']);
                $descripcion = trim($_POST['descrpicion']);
                $consulta ="INSERT INTO `partes`(nombre, precio, id_categoria, imagen, descripcion) VALUES ('$nombre','$precio','$idcat','$imagen','$descripcion')";
                $resultado = mysqli_query($conex, $consulta);
                if($resultado) 
                  { ?>
                  <h3 class="actsi">Cargado Correctamente</h3>
                  <?php
                  } 
                else 
                  { ?>
                  <h3 class="actno">Hubo un error en la carga</h3>            
                  <?php
                  } 
                }
              }
              ?>
    <body>
	<script src="js/main.js"></script>
</body>
</html>