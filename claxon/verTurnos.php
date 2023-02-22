
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

<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
		
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
				<img src="claxon2.png" alt="UserIcon">
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
		
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles">Turnos</h1>
			</div>
		</div>
		<?php
	include("conexion.php");
  $query = "SELECT id, nombre, telefono, correo, fecha_hora, marca_modelo, servicio, fecha_solicitud FROM turnos";
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
	<th>Fecha</th>
	<th>Marca y Modelo</th>
	<th>Servicio</th>
	<th>Fecha Solicitud</th>
	<th></th>
  </tr>
  
  <?php 
     while ($row = $resultado -> fetch_assoc()) {  
  ?>
  <tr>
    <td><?php echo $row['nombre'] ?></td>
    <td><?php echo $row['telefono'] ?></td>
    <td><?php echo $row['correo'] ?></td>
	<td><?php echo $row['fecha_hora'] ?></td>
    <td><?php echo $row['marca_modelo'] ?></td>
    <td><?php echo $row['servicio'] ?></td>
	<td><?php echo $row['fecha_solicitud'] ?></td>
	<td style="display:flex; justify-content:center" ><a href="actualizarTurnos.php?id=<?php echo $row["id"]?>"  style="color:black; ">Modificar</a>
  </tr>
	<input hidden readonly="readonly" type="text" name="id" value="<?php echo $row['id'] ?>" />
  <?php 
}
?>
</table>
</form>
	</section>

	<!-- Notifications area -->
	<section class="full-box Notifications-area">
		<div class="full-box Notifications-bg btn-Notifications-area"></div>
		<div class="full-box Notifications-body">
			<div class="Notifications-body-title text-titles text-center">
				Notificationes <i class="zmdi zmdi-close btn-Notifications-area"></i>
			</div>
			<div class="list-group">
			  	<div class="list-group-item">
				    <div class="row-action-primary">
				      	<i class="zmdi zmdi-alert-triangle"></i>
				    </div>
				    <div class="row-content">
				      	<div class="least-content">17m</div>
				      	<h4 class="list-group-item-heading">Tile with a label</h4>
				      	<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus.</p>
				    </div>
			  	</div>
			  	<div class="list-group-separator"></div>
			  	<div class="list-group-item">
				    <div class="row-action-primary">
				      	<i class="zmdi zmdi-alert-octagon"></i>
				    </div>
				    <div class="row-content">
				      	<div class="least-content">15m</div>
				      	<h4 class="list-group-item-heading">Tile with a label</h4>
				      	<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus.</p>
				    </div>
			  	</div>
			  	<div class="list-group-separator"></div>
				<div class="list-group-item">
				    <div class="row-action-primary">
				      	<i class="zmdi zmdi-help"></i>
				    </div>
				    <div class="row-content">
				      	<div class="least-content">10m</div>
				      	<h4 class="list-group-item-heading">Tile with a label</h4>
				      	<p class="list-group-item-text">Maecenas sed diam eget risus varius blandit.</p>
				    </div>
				</div>
			  	<div class="list-group-separator"></div>
			  	<div class="list-group-item">
				    <div class="row-action-primary">
				      	<i class="zmdi zmdi-info"></i>
				    </div>
				    <div class="row-content">
				      	<div class="least-content">8m</div>
				      	<h4 class="list-group-item-heading">Tile with a label</h4>
				      	<p class="list-group-item-text">Maecenas sed diam eget risus varius blandit.</p>
				    </div>
			  	</div>
			</div>

		</div>
	</section>

	<!-- Dialog help -->
	<div class="modal fade" tabindex="-1" role="dialog" id="Dialog-Help">
	  	<div class="modal-dialog" role="document">
		    <div class="modal-content">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    	<h4 class="modal-title">Ayuda</h4>
			    </div>
			    <div class="modal-body">
			        <p>
			        	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt beatae esse velit ipsa sunt incidunt aut voluptas, nihil reiciendis maiores eaque hic vitae saepe voluptatibus. Ratione veritatis a unde autem!
			        </p>
			    </div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-primary btn-raised" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> Ok</button>
		      	</div>
		    </div>
	  	</div>
	</div>
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