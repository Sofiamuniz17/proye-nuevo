

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
						<i class="zmdi zmdi-case zmdi-hc-fw"></i> Administración <i class="zmdi zmdi-caret-down pull-right"></i>
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
			</div>
		</div>
		<?php
	include("conexion.php");
     $query = "SELECT nombre, telefono, correo, consulta, fecha_solicitud FROM consultas";
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
					<input class="controls" type="text" name="nombres" id="nombres" placeholder="Nombre y Apellido" value= "<?php echo $row['nombre'] ?>">
				</div>
				
				<div class="row">
					<label for="Telefono" class="labelRow"><b>Telefono</b></label>
        			<input class="controls" type="phone" name="Telefono" id="Telefono" placeholder="Telefono" value= "<?php echo $row['telefono'] ?>">
				</div>

				<div class="row">
					<label for="correo" class="labelRow"><b>Correo</b></label>
        			<input class="controls" type="email" name="correo" id="correo" placeholder="Correo" value= "<?php echo $row['correo'] ?>">
				</div>

				<div class="row">
					<label for="consulta" class="labelRow"><b>Consulta</b></label>
        			<input class="controls" type="text" name="consulta" id="consulta" placeholder="consulta" value= "<?php echo $row['consulta'] ?>">
				</div>

				<div class="row">
					<label for="fecha_solicitud" class="labelRow"><b>Fecha y Solicitud</b></label>
					<input class="controls" type="datetime" name="fecha_solicitud" id="fecha_solicitud" placeholder="fecha y solicitud" value= "<?php echo $row['fecha_solicitud'] ?>">
		        </div>
				<button>
 <b>responder</b>

<a href="https://accounts.google.com/v3/signin/identifier?dsh=S469924971%3A1669322540836789&continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&rip=1&sacu=1&service=mail&flowName=GlifWebSignIn&flowEntry=ServiceLogin&ifkv=ARgdvAuNOUCrn2qb5gysonEdErG4MxTFG9Dyfi_UJyq_iMyhcqkWTcMcPc24uDP3Gv9AVIH7oEtl9Q" width="261" height="35" alt=""><a>
</button>
				<!-- <input class="consul" type="submit" name="solicite" value="Eliminar consulta">     -->
            </form>
            <?php            
         }
         ?>
    <?php
      include("consul.php");
      ?>
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