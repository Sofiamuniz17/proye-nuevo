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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consultas</title>
    <link rel="stylesheet" href="css/consul.css">
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
					if ( isset( $_SESSION['user_id'] )) {
					echo "<a href='pedidos.php'>PEDIDOS</a>";
					}
					else 
					echo "<a href='login.php'>PEDIDOS</a>";
					?>
				<?php
					if ( isset( $_SESSION['user_id'] )) {
					echo "<a href='turnos.php'>TURNOS</a>";
					}
					else 
					echo "<a href='login.php'>TURNOS</a>";
					?>
				<?php
					if ( isset( $_SESSION['user_id'] )) {
					echo "<a href='logout.php'>CERRAR SESION</a>";
					}
					else 
					echo "<a href='login.php'>INICIAR SESION</a>";
					?>
			</div>
		</nav>
	</header>
      <form class="post" method="post">
        <h4> Consultas</h4>
        
        <input class="controls" type="text" name="nombres" id="nombres" placeholder="Nombre y Apellido">
        <input class="controls" type="phone" name="Telefono" id="Telefono" placeholder="Telefono">
        <input class="controls" type="email" name="correo" id="correo" placeholder="Correo">
        <input class="controls" type="text" name="consulta" id="consulta" placeholder="Ingrese su consulta aqui">
	    <input class="consul"type="submit" name="consultar">
      </form>
      <?php
      include("consul.php");
      ?>
    <body>
	<script src="js/main.js"></script>
</body>
</html>