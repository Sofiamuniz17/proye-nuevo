<?php
  session_start();

  require 'database.php';

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TURNOS</title>
    <link rel="stylesheet" href="css/turnos.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap" rel="stylesheet"> 
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
	

    
</head>
<body>
    <header>
		<nav class="barranav">
			<div class="contenedorbtnnav">
				<a href="index.php">INICIO</a>
				<a href="catalogo.php">CATALOGO</a>
				<?php
					if ( isset( $_SESSION['user_id'] )) 
						if ($tipo == 'Administrador'){
          echo "<a href='verConsultas.php'>VER CONSULTAS</a>";
          echo "<a href='verPedidos.php'>VER PEDIDOS</a>";
					echo "<a href='verTurnos.php'>VER TURNOS</a>";
					echo "<a href='logout.php'>CERRAR SESION</a>";
					echo "<a href='home.php'>ADMINISTRADOR</a>";
					}else {
            echo "<a href='pedidos.php'>PEDIDOS</a>";
            echo "<a href='consultas.php'>CONSULTAS</a>";
          }	
					else 
					echo "<a href='loginin.php'>INICIAR SESION</a>";

				?>
			</div>
		</nav>
	</header>
      <form class="post" method="post">
        <h4> TURNOS</h4>
        
        <input class="controls" type="text" name="nombres" id="nombres" placeholder="Nombre y Apellido">
        <input class="controls" type="phone" name="Telefono" id="Telefono" placeholder="Telefono">
        <input class="controls" type="email" name="correo" id="correo" placeholder="Correo">
		    <input class="controls" type="datetime-local" name="fecha" id="fecha">
		    <input class="controls" type="text" name="datosauto" id="datosauto" placeholder="Marca y Modelo ">
		    <input class="controls" type="text" name="servicio" id="servicio" placeholder="Servicio">
		    <input class="turnos"type="submit" name="solicite">
      </form>
      <?php
      include("turn.php");
      ?>
    <body>
	<script src="js/main.js"></script>
</body>
</html>