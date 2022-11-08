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
    <title>Pedidos</title>
    <link rel="stylesheet" href="css/consul.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap" rel="stylesheet"> 
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
	

    
</head>
<body>
    <header>
		<nav class="barranav">
			<div class="contenedorbtnnav">
				<a href="index.php">INICIO</a>
				<a href="catalogo.php">VER CATALOGO</a>
				<?php
					if ( isset( $_SESSION['user_id'] )) {
					echo "<a href='verConsultas.php'>VER CONSULTAS</a>";
					}
					else 
					echo "<a href='login.php'>VER CONSULTAS</a>";
					?>
				<?php
					if ( isset( $_SESSION['user_id'] )) {
					echo "<a href='verTurnos.php'>VER TURNOS</a>";
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
<?php
	include("conexion.php");
        $query = "SELECT nombre, telefono, correo, pedido, cantidad FROM pedidos";
        $resultado = $conexion->query($query);
        while ($row = $resultado -> fetch_assoc()) {  
            ?>
            <form class="articulo" class="post" method="post">
				<br><br/>

				<style>
                  h2 {
                  color: white;
                }
				  label {
                  color: white;
                }
                </style>

                <h2 color="white" >TURNO DE <?php echo $row['nombre'] ?></h2>

				<label for="nombre">Nombre</label>
				<input class="controls" type="text" name="nombre" id="nombre" placeholder="Nombre y Apellido" value= "<?php echo $row['nombre'] ?>">

				<label for="Telefono">Telefono</label>
        		<input class="controls" type="phone" name="telefono" id="telefono" placeholder="Telefono" value= "<?php echo $row['telefono'] ?>">

				<label for="correo">Correo</label>
        		<input class="controls" type="email" name="correo" id="correo" placeholder="Correo" value= "<?php echo $row['correo'] ?>">

				<label for="pedido">Pedido</label>
        		<input class="controls" type="text" name="pedido" id="pedido" placeholder="Pedido" value= "<?php echo $row['pedido'] ?>">

				<label for="cantidad">Cantidad</label>
				<input class="controls" type="datetime" name="cantidad" id="cantidad" placeholder="Cantidad" value= "<?php echo $row['cantidad'] ?>">
		        <!-- <input class="consul" type="submit" name="solicite" value="Eliminar consulta">     -->
            </form>
            <?php            
         }
         ?>
  
    <body>
	<script src="js/p.js"></script>
</body>
</html>