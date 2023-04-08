<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: login.php');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count((array)$results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      if ($tipo == 'Administrador'){
        header("Location: home.php");
      }else {
        header("Location: index.php");
      }
  
    } else {
      $message = 'Email y/o Contraseña incorrectos';
    }
  }

?>


  <head>
    <!--<meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css"> -->
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="css/style1.css">
   <title>Login</title>
  </head>
  <body>
    <?php# require 'partials/header.php' ?>

    <?php #if(!empty($message)): ?>
      <p> <?#= $message ?></p> 
    <?php #endif; ?>

    <!--<h1>Login</h1>
    <span>or <a href="signup.php">SignUp</a></span> -->
    <a href="index.php"><img src="claxon2.png"  width="250px"
   height="200px"></a>	
    <form class="form-register" action="login.php" method="POST">
      <h4>Inicio de sesion</h4>
      <?php if(!empty($message)): ?>
        <p> <?= $message ?></p>
      <?php endif; ?>
      <input class="controls" name="email" type="text" placeholder="Ingrese su correo">
      <input class="controls" name="password" type="password" placeholder="Ingrese su contraseña">
      <button class="btnn" type="submit" value="Submit">Ingresar</button>
      <p><a href="signup.php">No tengo cuenta</a></p>      
    </form>
  </body>

