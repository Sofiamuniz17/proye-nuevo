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
<head>
	<title>Pagos</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
</head>
<body>
	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				CLAXON <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<img src="./assets/img/avatar.jpg" alt="UserIcon">
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
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Tablero
					</a>
				</li>
				<li>
					<a class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-case zmdi-hc-fw"></i> Administración <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="period.php"><i class="zmdi zmdi-timer zmdi-hc-fw"></i> Periodo</a>
						</li>
						<li>
							<a href="catalogo.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Catalogo</a>
						</li>
					
					</ul>
				</li>
				<li>
					<a class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="clientes.php"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Administrador</a>
						</li>
						<li>
							<a href="admins.php"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Cliente</a>
						</li>		
					</ul>
				</li>
				<li>
					<a class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-settings zmdi-hc-fw"></i> Configuración del taller<i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="datostaller.php"><i class="zmdi zmdi-balance zmdi-hc-fw"></i> Datos de taller</a>
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
			  <h1 class="text-titles"><i class="zmdi zmdi-money zmdi-hc-fw"></i> Pagos</h1>
			</div>
			<p class="lead"></p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#new" data-toggle="tab">Nuevo</a></li>
					  	<li><a href="#list" data-toggle="tab">Lista</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">
									    <form action="">
											<div class="form-group label-floating">
											  <label class="control-label">Monto del dia</label>
											  <textarea class="form-control"></textarea>
											</div>
											<div class="form-group label-floating">
											  <label class="control-label">Inversion</label>
											  <input class="form-control" type="text">
											</div>
											
											<div class="form-group">
											  <label class="control-label">Fecha de ingreso</label>
											  <input class="form-control" type="date">
											</div>
											
										    <p class="text-center">
										    	<button href="#!" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
										    </p>
									    </form>
									</div>
								</div>
							</div>
						</div>
						<div class="table" id="tabla">
							<style type="text/css">
								table, th, td {
									border:1px solid black;
									border-collapse: collapse;
									text-align: center;
								}
								th, td {
								padding: 15px;
								padding-top: 15px;
							}
							</style>
							
							<table style="width: 100%">
								<tr>
									<th>Monto del dia</th>
									<th>Inversion</th>
									<th>Fecha de ingreso</th>
									
								</tr>
								<tr>
									<td>$15.000</td>
									<td>$5.000</td>
									<td>07/09/2022</td>
									
								</tr>

								<tr>
									<td>$96.000</td>
									<td>$38.000</td>
									<td>07/09/2022</td>
									
								</tr>

								<tr>
									<th>Rendimiento Mensual</th>

									<th>Inversion Mensual</th>

									<th>Fecha de Cierre</th>
									
								</tr>
								<tr>
									<td>$111.000</td>
									<td>$43.000</td>
									<td>07/10/2022</td>
									
								</tr>
							</table>
						</div>
					  	<div class="tab-pane fade" id="list">
							<div class="table-responsive">
								<table class="table table-hover text-center">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">Cliente</th>
											<th class="text-center">Monto</th>
											<th class="text-center">Suscripción</th>
											<th class="text-center">Pendiente</th>
											<th class="text-center">Datos</th>
											<th class="text-center">Periodo</th>
											<th class="text-center">Actualizar</th>
											<th class="text-center">Borrar</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>Carlos Alfaro</td>
											<td>$40</td>
											<td>$40</td>
											<td>$0</td>
											<td>01/01/2022</td>
											<td>Periodo 1</td>
											<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
											<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
										</tr>
										<tr>
											<td>2</td>
											<td>Claudia Rodriguez</td>
											<td>$40</td>
											<td>$40</td>
											<td>$0</td>
											<td>01/01/2022</td>
											<td>Periodo 1</td>
											<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
											<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
										</tr>
										<tr>
											<td>1</td>
											<td>Alicia Melendez</td>
											<td>$40</td>
											<td>$40</td>
											<td>$0</td>
											<td>01/01/2022</td>
											<td>Periodo 1</td>
											<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
											<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
										</tr>
										<tr>
											<td>1</td>
											<td>Sarai Mercado</td>
											<td>$40</td>
											<td>$40</td>
											<td>$0</td>
											<td>01/01/2022</td>
											<td>Periodo 1</td>
											<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
											<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
										</tr>
									</tbody>
								</table>
								<ul class="pagination pagination-sm">
								  	<li class="disabled"><a href="#!">«</a></li>
								  	<li class="active"><a href="#!">1</a></li>
								  	<li><a href="#!">2</a></li>
								  	<li><a href="#!">3</a></li>
								  	<li><a href="#!">4</a></li>
								  	<li><a href="#!">5</a></li>
								  	<li><a href="#!">»</a></li>
								</ul>
							</div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
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
