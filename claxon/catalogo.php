<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    

    $user = null;

    if (count((array)$results) > 0) {
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
    <header class="head"> 
  
    
    <nav class="barranav">
    
			<div class="contenedorbtnnav">
      <a href="index.php"><img src="claxon2.png"  width="250px"
     height="200px"></a>				
      <?php
					if ( isset( $_SESSION['user_id'] ))
						if ($tipo == 'Administrador'){
          echo "<a href='editcata.php' style='color:white'>EDITAR CATALOGO</a>";
					echo "<a href='home.php' style='color:white'>ADMINISTRADOR</a>";
					}	
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
        $query = "SELECT imagen, nombre, stock, id FROM partes WHERE activo = 1";
        $resultado = $conexion->query($query);
        while ($row = $resultado -> fetch_assoc()) {  
            ?>
            <a>
            <form class="articulo" method="post">
                <img src="data:image/jpg;base64, <?php echo base64_encode($row['imagen']); ?>">
                <h4 class="card-title"><?php echo $row['nombre']; ?></h4>
                </a>              
            </form>
                        
          <?php 
         }
        ?>
		</div>    
      </main>
</body>
</html>