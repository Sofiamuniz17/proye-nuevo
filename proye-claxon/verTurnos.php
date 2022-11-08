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
    <?php
        include("conexion.php");
        $query = "SELECT nombre, telefono, correo, fecha_hora, marca_modelo, servicio, fecha_solicitud FROM turnos";
        $resultado = $conexion->query($query);
        while ($row = $resultado -> fetch_assoc()) {  
            ?>
            <form class="articulo" class="post" method="post">
                <br><br>
                <style>
                  h2 {
                  color: white;
                }
				        label {
                  color: white;
                }
                </style>
                <h2 color="white" >TURNO DE <?php echo $row['nombre'] ?></h2>

                <label for="nombre">Nombre y Apellido</label>
                <input class="controls" readonly="readonly" type="text" name="nombre" id="nombres" placeholder="Nombre y Apellido" value= "<?php echo $row['nombre'] ?>" >

                <label for="Telefono">Telefono</label>
                <input class="controls" readonly="readonly" type="phone" name="Telefono" id="Telefono" placeholder="Telefono" value= "<?php echo $row['telefono'] ?>">

                <label for="correo">Correo</label>
                <input class="controls" readonly="readonly" type="email" name="correo" id="correo" placeholder="Correo" value= "<?php echo $row['correo'] ?>">

                <label for="fecha">Fecha</label>
		            <input class="controls" readonly="readonly" type="datetime-local" name="fecha" id="fecha" value= "<?php echo $row['fecha_hora'] ?>">

                <label for="datosauto">Marca y Modelo</label>
		            <input class="controls" readonly="readonly" type="text" name="datosauto" id="datosauto" placeholder="Marca y Modelo" value= "<?php echo $row['marca_modelo'] ?>">

                <label for="text">Servicio</label>
		            <input class="controls" readonly="readonly" type="text" name="servicio" id="servicio" placeholder="Servicio" value= "<?php echo $row['servicio'] ?>">

                <label for="fechasolicitud">Fecha Solicitud</label>
                <input class="controls" readonly="readonly" type="datetime" name="fechasolicitud" id="fechasolicitud" placeholder="Fecha Solicitud" value= "<?php echo $row['fecha_solicitud'] ?>">
		        <!-- <input class="turnos" type="submit" name="solicite" value="Eliminar Turno">     -->
            </form>
            <?php            
         }
         ?>     
    <body>
	<script src="js/main.js"></script>
</body>
</html>