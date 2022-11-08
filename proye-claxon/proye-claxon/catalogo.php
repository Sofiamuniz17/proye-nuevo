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
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/stylecat.css">
    <title>Catalogo</title>
</head>
<body>
    <header class="head"> <h1 class="title">PRODUCTOS</h1>
    <nav class="barranav">
			<div class="contenedorbtnnav">
				<a href="index.php">INICIO</a>
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
                <a href="consultas.php">CONSULTAS</a>
				<?php
					if ( isset( $_SESSION['user_id'] )) 
						if ($tipo == 'Administrador'){
					echo "<a href='consultas.php'>EDITAR CATALOGO</a>";
					echo "<a href='logout.php'>CERRAR SESION</a>";
					echo "<a href='home.php'>ADMINISTRADOR</a>";
					}	
					else 
					echo "<a href='loginin.php'>INICIAR SESION</a>";
				?>
			</div>
		</nav>
        </header>
		
        <main class="contenido">
		
			<div class="cata">
			<div class="categorias">
  				<div class="categorias-content">
				  	<a href="catalogo.php">Categorias</a>
  					<a href="catalogo.php">Todo</a>
  					<a href="Alar.php">Alarmas</a>
					<a href="Stereos.php">Stereos</a>
  					<a href="Audio.php">Audio</a>
  					<a href="AcCc.php">Alza Cristales y Cierre Centralizados</a>
  					<a href="elec.php">Electricidad</a>
  				</div>
		</div>
			<?php
        include("conexion.php");

        $query = "SELECT  imagen,nombre FROM partes  WHERE activo=1";
        $resultado = $conexion->query($query);
        while ($row = $resultado->fetch_assoc()) {
            ?>

            <div class="articulo">
                <img src="data:image/jpg;base64, <?php echo base64_encode($row['imagen']); ?>">
            </div>


        <?php
        }
        ?>
		</div>
        </main>
</body>
</html>