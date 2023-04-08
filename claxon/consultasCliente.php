

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

  if($tipo !== "Cliente") {
	die( "ERROR: invalid permissions to access file." );
  }


  $q= $conn->prepare("SELECT COUNT(id) FROM users WHERE Tipo = ('Administrador')");
  $q->execute();
  $admin = $q->fetchColumn();

  $q= $conn->prepare("SELECT COUNT(id) FROM users WHERE Tipo = ('Cliente')");
  $q->execute();
  $cliente = $q->fetchColumn();

  $q= $conn->prepare("SELECT COUNT(Marca_Modelo) FROM turnos");
  $q->execute();
  $auto = $q->fetchColumn();

?>

<?php 
	$email = $user['email'];
?>
<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
</head>
<body>
	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
		
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
				<a href="index.php"><img href="index.php" src="claxon2.png" alt="UserIcon"> </a>
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
					<a href="clienteHome.php">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Datos
					</a>
				</li>
				<li>
					<a class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-case zmdi-hc-fw"></i> Cliente <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
						<a href="pedidosCliente.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Ver Pedidos</a>
						</li>
						<li>
						<a href="consultasCliente.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i>Ver Consultas</a>
						</li>
						<li>
						<a href="turnosCliente.php"><i class="zmdi zmdi-timer zmdi-hc-fw"></i>Ver Turnos</a>
						</li>
					</ul>
				</li>

				
			</ul>
		</div>
	</section>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		<!-- NavBar -->
		
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles">Consultas</h1>
			  <button class="btnn" type="button" name = "nuevo"  onclick="window.location.href='consultas.php';"><b>NUEVO</b></button></div>

			</div>
		</div>
		<?php
	include("conexion.php");
     $query = "SELECT id, nombre, telefono, correo, consulta, fecha_solicitud FROM consultas WHERE correo = '".$email."'";
        $resultado = $conexion->query($query);
            ?>
            <form class="articulo" class="post" method="post">
				<br><br/>
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

	tr:nth-child(even) {
  		background-color: #dddddd;
		}
				
 </style>

<table>
  <tr>
    <th>Nombre y Apellido</th>
    <th>Telefono</th>
    <th>Correo</th>
	<th>Consulta</th>
	<th>Fecha Y Solicitud</th>
	<th></th>
  </tr>
  
  <?php 
     while ($row = $resultado -> fetch_assoc()) {  
  ?>
  <tr>
    <td><?php echo $row['nombre'] ?></td>
    <td><?php echo $row['telefono'] ?></td>
    <td><?php echo $row['correo'] ?></td>
	<td><?php echo $row['consulta'] ?></td>
	<td><?php echo $row['fecha_solicitud'] ?></td>
	<td style="display:flex; justify-content:center" ><a href="actualizarConsultas.php?id=<?php echo $row["id"]?>"  style="color:black; ">Modificar</a>
  </tr>
  <?php 
}
?>
	</table>
</form>
        
	</section>
	
	<!--====== Scripts -->
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