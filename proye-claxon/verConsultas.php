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
				<a href="catalogo.php">VER CATALOGO</a>
				<?php
					if ( isset( $_SESSION['user_id'] )) {
					echo "<a href='verPedidos.php'>VER PEDIDOS</a>";
					}
					else 
					echo "<a href='login.php'>PEDIDOS</a>";
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
        $query = "SELECT nombre, telefono, correo, consulta, fecha_solicitud FROM consultas";
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

				<label for="nombres">Nombre y Apellido</label>
				<input class="controls" type="text" name="nombres" id="nombres" placeholder="Nombre y Apellido" value= "<?php echo $row['nombre'] ?>">

				<label for="Telefono">Telefono</label>
        		<input class="controls" type="phone" name="Telefono" id="Telefono" placeholder="Telefono" value= "<?php echo $row['telefono'] ?>">

				<label for="correo">Correo</label>
        		<input class="controls" type="email" name="correo" id="correo" placeholder="Correo" value= "<?php echo $row['correo'] ?>">

				<label for="consulta">Consulta</label>
        		<input class="controls" type="text" name="consulta" id="consulta" placeholder="consulta" value= "<?php echo $row['consulta'] ?>">

				<label for="fecha_solicitud">Fecha y Solicitud</label>
				<input class="controls" type="datetime" name="fecha_solicitud" id="fecha_solicitud" placeholder="fecha y solicitud" value= "<?php echo $row['fecha_solicitud'] ?>">
		        <!-- <input class="consul" type="submit" name="solicite" value="Eliminar consulta">     -->
            </form>
            <?php            
         }
         ?>
    <?php
      include("consul.php");
      ?>
    <body>
	<script src="js/p.js"></script>
</body>
</html>