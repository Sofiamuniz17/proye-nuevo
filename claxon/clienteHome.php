<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, Telefono, Nombre, imagen, Tipo password FROM users WHERE id = :id');
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
  
$email = $user['email'];
$Telefono = $user['Telefono'];
$Nombre = $user['Nombre'];
$imagen = $user['imagen'];

  $q= $conn->prepare("SELECT COUNT(id) FROM pedidos WHERE correo = '".$email."'");
  $q->execute();
  $pedidos = $q->fetchColumn();
  
  $q= $conn->prepare("SELECT COUNT(id) FROM consultas WHERE correo = '".$email."'");
  $q->execute();
  $consultas = $q->fetchColumn();

  $q= $conn->prepare("SELECT COUNT(id) FROM turnos WHERE correo = '".$email."'");
  $q->execute();
  $turnos = $q->fetchColumn();

?>

<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

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
						<a href="pedidosCliente.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i>Mis Pedidos</a>
						</li>
						<li>
						<a href="consultasCliente.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i>Mis Consultas</a>
						</li>
						<li>
						<a href="turnosCliente.php"><i class="zmdi zmdi-timer zmdi-hc-fw"></i>Mis Turnos</a>
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
	
	<a href="consultasCliente.php">
		<article class="full-box tile" >
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Mis Consultas
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-assignment"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box"><?php echo "$consultas"?></p>
					<small>Registrados</small>
				</div>
			</article>
		</a>
			
		<a href="turnosCliente.php">
			<article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Mis Turnos
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-calendar"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box"><?php echo "$turnos"?></p>
					<small>Registrados</small>
				</div>
			</article>
		</a>

		<a href="pedidosCliente.php">
			<article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Mis Pedidos
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-shopping-cart"></i><i class="bi bi-bag-check-fill"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box"><?php echo "$pedidos"?></p>
					<small>Registrados</small>
				</div>
			</article>
		</a>

		</div>

<div class="container">
      <div class="row">
      <form method="post" id="perfil">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
   
   
          <div class="panel panel-success"><br>
              <h2 class="panel-title"><center><font size="5"><i class='glyphicon glyphicon-user'></i>PERFIL</font></center></h2>

            <div class="panel-body">
              <div class="row">
			  
                <div class="col-md-3 col-lg-3 " align="center"> 
				<div id="load_img">
				<img class="img-responsive"  src="data:image/jpg;base64, <?php echo base64_encode($imagen); ?>">
					<!-- <img  src="<?php echo $imagen;?>" alt="Logo"> -->
					
				</div>
				<br>				
					<div class="row">
  						<div class="col-md-12">
							<div style='cursor:pointer;' class="form-group">
								<!-- <input class='filestyle' data-buttonText="Logo" type="file" name="imagefile" id="imagefile" onchange="upload_image();"><i style='font-size:24px' class='fas'>&#xf382;</i></input> -->
							</div>
						</div>
						
					</div>
				</div>	
				
                
               
	<div class=" col-md-9 col-lg-9 ">        
		<table class="table table-condensed">
                    <tbody>
                      <tr>
                        <td class='col-md-3'>Nombre y Apellido:</td>
                        <td><input style='font-size: 13px' type="text" class="form-control input-sm" name="nombre_apellido" value="<?php echo $Nombre?>" required></td>
                      </tr>
                      <tr>
                        <td>Telefono</td>
                        <td><input style='font-size: 13px' type="text" class="form-control input-sm" name="Telefono" value="<?php echo $Telefono?>" required></td>
                      </tr>
                      <tr>
                        <td>Correo electrónico:</td>
                        <td><input style='font-size: 13px' type="email" class="form-control input-sm" name="correo" value="<?php echo $email?>" ></td>
                      </tr>
					  <tr>
                        <td>Tipo de usuario:</td>
                        <td><input style='font-size: 13px' type="text" class="form-control input-sm" required name="Tipo" value="<?php echo $tipo?>"></td>
                      </tr>
                    </tbody>
                  </table>
				</div>

				<div class='col-md-12' id="resultados_ajax"></div><!-- Carga los datos ajax -->
              </div>
            </div>
                 <div class="panel-footer text-center">
                    
                     
                <!-- <button type="submit" name='actualice' class="btn btn-sm btn-success"><i class="glyphicon glyphicon-refresh"></i> Actualizar hoja de vida</button> -->

				<?php
              
            if(isset($_POST['actualice']))
              {
              if(strlen($_POST['Nombre']) >= 1 )
                {
                $Nombre = trim($_POST['Nombre']);
                $Telefono = trim($_POST['Telefono']);
                $Correo = trim($_POST['Correo']);
                $Imagen = trim($_POST['Imagen']);
                $consulta ="UPDATE users set Nombre = '".$Nombre."',Telefono = '".$Telefono."',email = '".$Correo."',imagen = '".$Imagen."'  WHERE id = '".$id."'";
                $resultado = mysqli_query($conex, $consulta);
                if($resultado) 
                  { ?>
                  <?php
                  $referer = $_SERVER['HTTP_REFERER'];
                  header("Location: $referer");
                  } 
                else 
                  { ?>
                  <h3 class="actno">Ha habido un error en la solicitud</h3>            
                  <?php
                  } 
                }
              }

			  ?>       
                       
                    </div>
            
          </div>
        </div>
		</form>
      </div>
		
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