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

  $q= $conn->prepare("SELECT COUNT(id) FROM partes");
  $q->execute();
  $productos = $q->fetchColumn();

  $q= $conn->prepare("SELECT COUNT(id) FROM pedidos");
  $q->execute();
  $pedidos = $q->fetchColumn();
  
  $q= $conn->prepare("SELECT COUNT(id) FROM consultas");
  $q->execute();
  $consultas = $q->fetchColumn();

  $q= $conn->prepare("SELECT COUNT(id) FROM turnos");
  $q->execute();
  $turnos = $q->fetchColumn();

  $q= $conn->prepare("SELECT COUNT(id) FROM users WHERE Tipo = ('Cliente')");
  $q->execute();
  $cliente = $q->fetchColumn();

  $q= $conn->prepare("SELECT COUNT(Marca_Modelo) FROM turnos");
  $q->execute();
  $auto = $q->fetchColumn();

?>

<head>
	<title>Productos</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/lista.css">
</head>
<body>
	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
		
			<a href="index.php"><img src="claxon2.png" width="250px" height="200px"></a>

			
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					
					<figcaption class="text-center text-titles"><?= $user['email']; ?></figcaption>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="index.php">
							<i class="zmdi zmdi-tag-close"></i>
						</a>
					</li>
					<li>
						<a href="logout.php" class="btn-exit-system">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					<a href="home.php">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Datos
					</a>
				</li>
				<li>
					<a class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-case zmdi-hc-fw"></i> Administración <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
                		<a href="lista_productos.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i>Ver productos</a>					
						</li>
						<li>
						<a href="editcata.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i>Editar Catalogo</a>
						</li>
						<li>
						<a href="verPedidos.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Ver Pedidos</a>
						</li>
						<li>
						<a href="verConsultas.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i>Ver Consultas</a>
						</li>
						<li>
						<a href="verTurnos.php"><i class="zmdi zmdi-timer zmdi-hc-fw"></i>Ver Turnos</a>
						</li>
					
					</ul>
				</li>
			
				
			</ul>
		</div>
	</section>

      
		<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		<!-- NavBar -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles">Productos</h1>
			  <button class="btnn" type="button" name = "nuevo"  onclick="window.location.href='nuevoprod.php';"><b>NUEVO</b></button></div>
			</div>
		</div>
		<!-- Content page -->

		<style>
	table {
  		font-family: arial, sans-serif;
  		border-collapse: collapse;
  		width: 100%;
		}

	td, th {
  		border: 1px solid #dddddd;
  		text-align: left;
  		padding: 8px;
		}

	tr:nth-child(even), tr:nth-child(even) a{
  		background-color: #dddddd;
		color: black;
		}

</style>



<table class="tabla">
  <tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>IMAGEN</th>
	<th>Modificar</th>
  </tr>
  
  <?php 
   include("conexion.php");
   $query = "SELECT imagen, nombre, id FROM partes WHERE activo ='1'";
   $resultado = $conexion->query($query);
    while ($row = $resultado -> fetch_assoc()) {  
  ?>
  <tr>
  	<td class="fila"><?php echo $row['id']; ?></td>
    <td class="fila"><?php echo $row['nombre']; ?></td>
    <td class="fila"><img src="data:image/png;base64, <?php echo base64_encode($row['imagen']); ?>"></td>
    <td class="fila"> <a href="actualizar.php?id=<?php echo $row["id"]?>">Modificar</a></td>
  </tr>

  <?php 
}
?>
</table>
	</section>
	<script src="./js/jquery-3.1.1.min.js"></script>
	<script src="./js/sweetalert2.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/material.min.js"></script>
	<script src="./js/ripples.min.js"></script>
	<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="./js/main.js"></script>
	<script>
		$.material.init();
	</script>
</body>
</html>
