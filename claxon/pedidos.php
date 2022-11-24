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
    <img src="claxon2.png"    width="250px"
     height="200px"></a>
		<nav class="barranav">
			<div class="contenedorbtnnav">
				<a href="index.php">INICIO</a>
				<a href="catalogo.php">CATALOGO</a>
				<?php
					if ( isset( $_SESSION['user_id'] )) {
					echo "<a href='turnos.php'>TURNOS</a>";
					}
					else 
					echo "<a href='login.php'>TURNOS</a>";
					?>
          <?php
					if ( isset( $_SESSION['user_id'] )) {
					echo "<a href='consultas.php'>CONSULTAS</a>";
					}
					else 
					echo "<a href='login.php'>CONSULTAS</a>";
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
        <h4> Pedidos</h4>        
        <input class="controls" type="text" name="nombre" id="nombre" placeholder="Nombre y Apellido">
        <input class="controls" type="phone" name="telefono" id="telefono" placeholder="Telefono">
        <input class="controls" type="email" name="correo" id="correo" placeholder="Correo">
        <input class="controls" type="text" name="pedido" id="pedido" placeholder="Ingrese su pedido aqui">
        <input class="controls" type="text" name="cantidad" id="cantidad" placeholder="Ingrese cuantas unidades del producto requiere">
	    <input class="consul" type="submit" name="pedir">
      </form>
      <?php
      include("pedido.php");
      ?>
    <body>
	<script src="js/p.js"></script>
</body>
</html>