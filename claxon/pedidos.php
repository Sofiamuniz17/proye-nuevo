<?php
  ob_start();   
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, Nombre, Telefono, password FROM users WHERE id = :id');
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

  if( $tipo !== "Administrador") {
	die( "ERROR: invalid permissions to access file." );
  }

$email = $user['email'];
$Telefono = $user['Telefono'];
$Nombre = $user['Nombre'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consultas</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/consul.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap" rel="stylesheet"> 
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
	<div class="container">
		<?php
			if ($tipo == 'Cliente'){
		?>
			<div class="btn-menu">
				<label for="btn-menu">☰</label>
			</div>
				<div class="logo">
					<h1>Menu</h1>
				</div>
		<?php
			} else{
				?>
					<a href="index.php"><img src="claxon2.png"  width="250px"
					height="200px">
					</a>
				<?php	
			}		
		?>
	</div>
</header>

  <input type="checkbox" id="btn-menu">
<div class="container-menu">
	<div class="cont-menu">
	<h3 style='color: white; display:flex; justify-content:center'>Mi perfil</h3>
		<nav>
      <a href='index.php'>Volver al menu principal</a>
			<hr></hr>
			<a href='verTurnos.php'>Mis Turnos</a>
			<a href="verConsultas.php">Mis consultas</a>
			<a href="verPedidos.php">Mis pedidos</a>
			<hr></hr>
			<a href="carrito.php">Mi carrito</a>
		</nav>
		<label for="btn-menu">✖️</label>
	</div>
</div>

      <form class="post" method="post">
        <h4> Pedidos</h4>        
        <input class="controls" type="text" name="Nombre" id="Nombre" placeholder="Nombre y Apellido" <?php if($tipo === 'Cliente') { echo 'readonly'; } ?> value="<?php echo $tipo === 'Administrador' ? '' : $Nombre; ?>"/>
		    <input class="controls" type="text" name="Telefono" id="Telefono" placeholder="Telefono" <?php if($tipo === 'Cliente') { echo 'readonly'; } ?> value="<?php echo $tipo === 'Administrador' ? '' : $Telefono; ?>"/>
		    <input class="controls" type="text" name="correo" id="correo" placeholder="Correo" <?php if($tipo === 'Cliente') { echo 'readonly'; } ?> value="<?php echo $tipo === 'Administrador' ? '' : $email; ?>"/>

        <input class="controls" type="text" name="pedido" id="pedido" placeholder="Ingrese su pedido aqui">
        <input class="controls" type="text" name="cantidad" id="cantidad" placeholder="Ingrese cuantas unidades del producto requiere">
		<input class="controls" type="text" name="precio" id="precio" placeholder="Ingrese el precio del producto aquí">
	    <input class="consul" type="submit" name="pedir">
      </form>
      <?php
      include("pedido.php");
      ?>
    <body>
	<script src="js/p.js"></script>
</body>
</html>