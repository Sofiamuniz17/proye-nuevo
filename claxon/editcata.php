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
    <link rel="stylesheet" type="text/css" href="css/styleedit.css">
    <title>Catalogo</title>
</head>
<body>
<a href="index.php"><img src="claxon2.png"    width="250px"
     height="200px" margin-top:15% ></a>	
    <header class="head">
  
    
    <nav class="barranav">
			<div class="contenedorbtnnav">
     <a href="home.php">ADMINISTRADOR</a>
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
            <a href="detalles.php?id=<?php echo $row["id"]?>">
            <form class="articulo" method="post">
                <img src="data:image/jpg;base64, <?php echo base64_encode($row['imagen']); ?>">
                <h4 class="card-title"><?php echo $row['nombre']; ?></h4>
                </a>  
                <style>
                  h6 {
                  color: white;
                }
                </style>
                <?php                   
                  if($tipo === 'Administrador') {
                    ?>
                <h6>STOCK: <input class="button-stock" type="text" name="stock" readonly="readonly" value= "<?php echo $row['stock'] ?>"/></h6>
                <input class="button-stock" hidden readonly="readonly" type="text" name="id" value="<?php echo $row['id'] ?>">                    
                  
                      <input class="button-stock" type="submit" name="agregarStock" value="+1">
                      <input class="button-stock" type="submit" name="removeStock" value="-">  
                    <?php 
                  }  
                  ?>               
            </form>
                        
          <?php include("stock.php");
         }
         
        ?>
		</div>    
      </main>
</body>
</html>