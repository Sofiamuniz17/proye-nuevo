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

  // if($tipo !== "Cliente") {
	// die( "ERROR: invalid permissions to access file." );
  // }
  ;  
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/stylecat.css">
    <title>Catalogo</title>
</head>
<body>
    <header class="head"> 
  
    <a href="index.php"><img src="claxon2.png"  width="250px"
     height="200px"></a>	
    <nav class="barranav">
    
			<div class="contenedorbtnnav" style='justify-content: center'>		
    	  <div style='color:#fff958; font-size: 20px; justify-content:center; display:flex'>
							<h1>Catalogo</h1>
				</div>
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
    <style>

		.btnn{
	background-color: yellow;
	color:black;
	width: 250px;
	height: 80px;
	border-radius: 15px;
  margin-top: 350px;
  margin-left:600px;
 
}
.btnns{
	background-color: yellow;
	color:black;
	width: 250px;
	height: 80px;
	border-radius: 15px;
  margin-left:870px;
</style>
		</div>    
      </main>
</body>
</html>