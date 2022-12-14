
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
						<i class="zmdi zmdi-case zmdi-hc-fw"></i> Administraci??n <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
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
				<li>
					<a class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="clientes.php"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Cliente</a>
						</li>
						
					</ul>
				</li>
				<li>
				
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
  $query = "SELECT nombre, telefono, correo, fecha_hora, marca_modelo, servicio, fecha_solicitud FROM turnos";
        $resultado = $conexion->query($query);
        while ($row = $resultado -> fetch_assoc()) {  
            ?>
            <form class="articulo" class="post" method="post">
				    <br><br/>

				<style>
				  .labelRow {
            color: black;
				    display: block;
          }
				  input {
					  width: 50%;	
				  }
				  .row {
					  margin-left: 2rem;
					  margin-top: 0.5rem;
				}
        </style>


				<div class="row">
					<label for="nombres" class="labelRow"><b>Nombre y Apellido</b></label>
					<input class="controls" readonly="readonly" type="text" name="nombres" id="nombres" placeholder="Nombre y Apellido" value= "<?php echo $row['nombre'] ?>">
				</div>
				
				<div class="row">
					<label for="Telefono" class="labelRow"><b>Telefono</b></label>
        	<input class="controls" readonly="readonly" type="phone" name="Telefono" id="Telefono" placeholder="Telefono" value= "<?php echo $row['telefono'] ?>">
				</div>

				<div class="row">
					<label for="correo" class="labelRow"><b>Correo</b></label>
          <input class="controls" readonly="readonly" type="email" name="correo" id="correo" placeholder="Correo" value= "<?php echo $row['correo'] ?>">
				</div>

				<div class="row">
          <label for="fecha" class="labelRow"><b>Fecha</b></label>
		      <input class="controls" readonly="readonly" type="datetime-local" name="fecha" id="fecha" value= "<?php echo $row['fecha_hora'] ?>">
				</div>

				<div class="row">
          <label for="datosauto" class="labelRow"><b>Marca y Modelo</b></label>
		      <input class="controls" readonly="readonly" type="text" name="datosauto" id="datosauto" placeholder="Marca y Modelo" value= "<?php echo $row['marca_modelo'] ?>">
		    </div>

        <div class="row">
           <label for="text" class="labelRow"><b>Servicio</b></label>
		       <input class="controls" readonly="readonly" type="text" name="servicio" id="servicio" placeholder="Servicio" value= "<?php echo $row['servicio'] ?>">
		    </div>

         <div class="row">
          <label for="fechasolicitud" class="labelRow"><b>Fecha Solicitud</b></label>
          <input class="controls" readonly="readonly" type="datetime" name="fechasolicitud" id="fechasolicitud" placeholder="Fecha Solicitud" value= "<?php echo $row['fecha_solicitud'] ?>">
        </div>

				<!-- <input class="consul" type="submit" name="solicite" value="Eliminar consulta">     -->
            </form>
            <?php            
         }
         ?>
    <?php
      include("consul.php");
      ?>
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