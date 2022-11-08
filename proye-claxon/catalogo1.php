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
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Filtrando elementos por categorias</title>

	<link rel="stylesheet" href="css/estilos.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">

	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/script.js"></script>
</head>
<body>

	
	<header>
		<nav class="barranav">
			<div class="contenedorbtnnav">
				<a href="index.php">INICIO</a>
				<a href="turnos.php">TURNOS</a>
				<a href="pedidos.php">PEDIDOS</a>
				<a href="consultas.php">CONSULTAS</a>
				<?php
					if ( isset( $_SESSION['user_id'] )) {
					echo "<a href='logoutcat.php'>CERRAR SESION</a>";
					}
					else 
					echo "<a href='login.php'>INICIAR SESION</a>";
					?>
			</div>
		</nav>
	</header>
	<div class="container">
			<div class="category_list">
				<a href="#" class="category_item" category="all">Todo</a>
				<a href="#" class="category_item" category="Estéreos">Estéreos</a>
				<a href="#" class="category_item" category="Parlantes">Parlantes</a>
				<a href="#" class="category_item" category="Potencias">Potencias</a>
				<a href="#" class="category_item" category="monitores">Monitores</a>
				<a href="#" class="category_item" category="audifonos">Audifonos</a>
				<h1 class="title">PRODUCTOS</h1>


	<?php
	include("conexion.php");
	$query = "SELECT  * FROM partes";
	$resultado = $conexion->query($query);
	while ($row = $resultado->fetch_assoc()) {
		?>

		<div class="card">
			<img src="data:image/jpg;base64, <?php echo base64_encode($row['imagen']); ?>">
			<h4 class="card-title"><?php echo $row['nombre']; ?></h4>
			<p><?php echo $row['descripcion']; ?></p>
			<p class="card-text">$ <?php echo number_format($row['precio'], 2, '.', ',');?>
			<a href="pedidos.php">Agregar</a>
		</div>


	<?php
	}
	?>

</div>

	</div>

</body>
</html>