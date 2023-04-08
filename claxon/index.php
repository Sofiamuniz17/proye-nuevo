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

	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>CLAXON</title>
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&display=swap" rel="stylesheet"/>
		<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>" />
		<div class="container">

	<?php
		if ($tipo == 'Cliente'){
	?>
		<div class="btn-menu">
			<label for="btn-menu">☰</label>
		</div>
			<div class="logo">
				<h1>Perfil</h1>
			</div>
	<?php
		}		
	?>
			<nav class="menu">
				
				<a href="#"></a>
				<?php
					if ( isset( $_SESSION['user_id'] )) {
					echo "<a href='logout.php'>CERRAR SESION</a>";					
					}
					else 
					echo "<a href='loginin.php'>INICIAR SESION</a>";
				?>
			 
			</nav>
		</div>
	</head>
	<body>
	
		<div class="contenedor">
			
			<div class=ima>
			<img src="cla.PNG" >
	 		</div>
		
			<main class="contenido">
			<div class="dest">
			<?php
        include("conexion.php");

        $query = "SELECT  id,imagen,nombre, stock FROM partes  WHERE destacados=1 && activo=1";
        $resultado = $conexion->query($query);
        while ($row = $resultado->fetch_assoc()) {
            ?>
		<a>
            <div class="articulo">
			<img src="data:image/jpg;base64, <?php echo base64_encode($row['imagen']); ?>">
                <h4 class="card-title"><?php echo $row['nombre']; ?></h4>
            </div>
		</a>


        <?php
        }
        ?>
		<input type="checkbox" id="btn-menu">
<div class="container-menu">
	<div class="cont-menu">
	<h3 style='color: white; display:flex; justify-content:center'>Mi perfil</h3>
		<nav>
			<hr></hr>
			<a href='turnosCliente.php'>Mis Turnos</a>
			<a href="consultasCliente.php">Mis consultas</a>
			<a href="pedidosCliente.php">Mis pedidos</a>
			<hr></hr>
			<a href='turnos.php'>Saca tu Turno</a>
			<a href="consultas.php">Realiza tu consulta</a>
			<hr></hr>
			<a href="carrito.php">Mi carrito</a>
		</nav>
		<label for="btn-menu">✖️</label>
	</div>
</div>
<?php 
		if ($tipo == 'Cliente'){
		  echo "<button class='btnn' type='submit' value='Submit'><a href='carrito.php'>Ver Carrito</a></button>";
		}
		else if($tipo == 'Administrador') {
			echo "<button class='btnn' type='submit' value='Submit'><a href='editcata.php'>Editar Catalogo</a></button>";
		}else {
			echo "<button class='btnn' type='submit' value='Submit'><a href='catalogo.php'>Ver Catalogo</a></button>";
		}
		?>		</div>
								<div class="ubicacion" style = "float: left">
						<div class="somos">
							<h1>¿Quienes somos?</h1>
							<h2>Somos una empresa que hace 14 años se dedica a la venta, instalacion y reparacion de accesorios vehiculares y polarizados.</h2>
						</div>
						<div class="texto">
							<h2>Moliere 2903, C1419 CABA</h2>
							<div class="map">
							<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13134.198727817124!2d-58.5274228!3d-34.615547!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x87d74818f23833ae!2sClaxon%20Autoradio!5e0!3m2!1ses!2sar!4v1658344405640!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
							</div>
							</div>
						</div>
			
			</main>

			<aside class="sidebar">
				<div class="ses">
			<div class="admin">
			<?php 
			if ($tipo == 'Administrador'){
				echo "<a href='home.php'>ADMINISTRADOR</a>";
				}?>
				</div>
				<?php
				if(!empty($user)): ?>
      			<br> Bienvenido <?= $user['email']; ?>
      			<br>
     		<?php else: ?>
     		<?php endif; ?>
			 </div>
				<div class="acerca-de">
					<img src="turno.png" class="img-perfil" alt="" />

					<div class="bio">
                        <p>
						    <?php 
								if ($tipo == 'Administrador'){
									?>	
									<br><b>¡Hola!</b></br>Hace click aqui para administrar los turnos.
										<?php 
									}else {
										?>
										<br><b>¡Hola!</b></br>Pedi tu turno para reparación y/o colocación de tus accesorios.
									<?php 
									}
						    ?>					
						</p>
						<div class="sesturn">
						<?php

							if (isset( $_SESSION['user_id'] )) {
								if ($tipo == 'Administrador'){
									echo "<a href='verTurnos.php'>AQUI</a>";
								}else {
									echo "<a href='turnos.php'>AQUI</a>";									
								}
							}
							else 
								echo "<a href='login.php'>AQUI</a>";
						?>
						</div>
					</div>
				</div>
				

			</aside>

			

			<footer class="footer">
				<p>Copyright © 2022 SDEJ</p>
			</footer>
		</div>
	</body>
