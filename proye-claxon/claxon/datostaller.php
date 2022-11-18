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
?>

	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>CLAXON</title>
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&display=swap" rel="stylesheet"/>
		<link rel="stylesheet" href="css/datos.css" />
	</head>
	<body>
	
		<div class="contenedor">
			
			<div class=ima>
			<img src="cla.PNG" >
	 		</div>
			 <div class="sesion">
				<?php
					if ( isset( $_SESSION['user_id'] )) {
					echo "<a href='logout.php'>CERRAR SESION</a>";
					}
					else 
					echo "<a href='loginin.php'>INICIAR SESION</a>";
				?>
			 
			</div>
			<main class="contenido">
                <div>                    
                </div>
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
				echo "<a href=''>ADMINISTRADOR</a>";
				}?>
				</div>
				<?php
				if(!empty($user)): ?>
      			<br> Bienvenido <?= $user['email']; ?>
      			<br>
     		<?php else: ?>
     		<?php endif; ?>
			 </div>
			</aside>
			

			<footer class="footer">
				<p>Copyright © 2022 SDEJ</p>
			</footer>
		</div>
	</body>