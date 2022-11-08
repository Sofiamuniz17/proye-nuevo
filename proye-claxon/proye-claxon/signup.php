<?php

  require 'database.php';

  /*$message = '';
  $q= $conn->prepare("SELECT email FROM users WHERE id = :id");
  $q->bindParam(':id', $_SESSION['user_id']);
  $q->execute();
  $tipo = $q->fetchColumn();*/

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
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

    <form class="form-register" action="signup.php" method="POST">
      <h4>Registro</h4>
      <input class="controls" name="email" type="text" placeholder="Enter your email">
      <input class="controls" name="password" type="password" placeholder="Enter your Password">
      <input class="controls" name="confirm_password" type="password" placeholder="Confirm Password">
      <button class="btnn" type="submit" value="Submit">Registrarse</button>
      <p><a href="login.php">Ya tengo cuenta</a></p>

      <?php if(!empty($message)): ?>
        <p> <?= $message ?></p>
      <?php endif; ?>

    </form>

  </body>

