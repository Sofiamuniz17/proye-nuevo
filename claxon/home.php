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
						<a href="verPedidos.php"><i class="zmdi zmdi-shopping-cart zmdi-hc-fw"></i> Ver Pedidos</a>
						</li>
						<li>
						<a href="verConsultas.php"><i class="zmdi zmdi-assignment zmdi-hc-fw"></i>Ver Consultas</a>
						</li>
						<li>
						<a href="verTurnos.php"><i class="zmdi zmdi-calendar zmdi-hc-fw"></i>Ver Turnos</a>
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
			  <h1 class="text-titles">Sistema</h1>
			</div>
		</div>
		<div class="full-box text-center" style="padding: 30px 10px;">
		
			<article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Productos
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-mall"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box"><?php echo "$productos" ?></p>
					<small>Registrados</small>
				</div>
			</article>
			<article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Cliente
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-male-alt"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box"><?php echo "$cliente"?></p>
					<small>Registrados</small>
				</div>
			</article>
			<article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Auto
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-car"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box"><?php echo "$auto"?></p>
					<small>Registrados</small>
				</div>
			</article>
			<article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Consultas
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-assignment"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box"><?php echo "$consultas"?></p>
					<small>Registrados</small>
				</div>
			</article>
			<article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Turnos
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-calendar"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box"><?php echo "$turnos"?></p>
					<small>Registrados</small>
				</div>
			</article>
			<article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Pedidos
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-shopping-cart"></i><i class="bi bi-bag-check-fill"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box"><?php echo "$pedidos"?></p>
					<small>Registrados</small>
				</div>
			</article>
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