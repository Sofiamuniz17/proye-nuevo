<?php

  require 'database.php';

  /*$message = '';
  $q= $conn->prepare("SELECT email FROM users WHERE id = :id");
  $q->bindParam(':id', $_SESSION['user_id']);
  $q->execute();
  $tipo = $q->fetchColumn();*/

  if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['Nombre']) && !empty($_POST['Telefono']) ) {
    echo("<script>console.log('PHP: " . $_POST['email'] . "');</script>");
    $sql = "INSERT INTO users (Nombre, email, Telefono, password) VALUES (:Nombre, :email, :Telefono, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':Nombre', $_POST['Nombre']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':Telefono', $_POST['Telefono']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    
    if ($stmt->execute()) {
      $message = 'Nuevo usuario creado';
    } else {
      $message = 'Hubo un problema creando la cuenta';
    }
  }
?>

  <head>
    <!-- <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css"> -->
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="css/style1.css">
   <title>Registrarse</title>
  </head>
  <body>

    <?php# require 'partials/header.php' ?>

    <?php# if(!empty($message)): ?>
      <p> <?#= $message ?></p>
    <?php #endif; ?>

    <!--<h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span> -->
    <a href="index.php"><img src="claxon2.png"  width="250px"
   height="200px"></a>	

    <form class="form-register" action="signup.php" method="POST">
      <h4>Registro</h4>
      <input class="controls" name="Nombre" type="text" placeholder="Ingrese su Nombre" required>
      <input class="controls" name="email" type="mail" placeholder="Ingrese su correo"  pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
      <input class="controls" name="Telefono" type="text" placeholder="Ingrese su Telefono" required>
      <input class="controls" name="password" type="password" placeholder="Ingrese su contraseña" minlength=8 maxlength=15 required>
      <input class="controls" name="confirm_password" type="password" placeholder="Confirmar contraseña" minlength=8 maxlength=15 required>
      <button class="btnn" type="submit" value="Submit" required>Registrarse</button>
      <p><a href="login.php">Ya tengo cuenta</a></p>

      <?php if(!empty($message)): ?>
        <p> <?= $message ?></p>
      <?php endif; ?>

    </form>

  </body>

