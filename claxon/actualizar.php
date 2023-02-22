
<?php
  session_start();

  require 'db.php';
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
<?php
$id = $_GET['id'];
?>
<head>
    <link rel="stylesheet" type="text/css" href="css/extras.css">
    <title>Actualizar Producto</title>
</head>
<body>
    <header class="head"> 
    <div allign="center"><a class="titulo" href="lista_productos.php"><img src="claxon2.png" width="150px" height="150px"></a>
       
			<div class="cata">
    <?php
        include("conexion.php");
        $query = "SELECT * FROM partes WHERE id = $id";
        $resultado = $conexion->query($query);
        while ($row = $resultado -> fetch_assoc()) {
            ?>


<div class="login-box">
  <h2>Producto</h2>
      <form  id="form" type="submit" method="post">
            <div class="user-box">                
              <input required="" type="text" class="in" name ="nombre" value = "<?php echo $row['nombre']; ?>"></input>
              <label>Nombre</label>                    
            </div>

            <div class="user-box">
                <input class="in" required="" type="text" name ="precio" value = "<?php echo $row['precio']; ?>"></input>
                <label>Precio</label>       
            </div>

            <div class="user-box">
              <input class="in" required="" type="text" name ="categoria" value = "<?php echo $row['id_categoria']; ?>"></input>
              <label>Categoria</label>            
            </div>

            <div class="user-box">
              <input class="in" required="" type="text" name ="activo" value = "<?php echo $row['activo']; ?>"></input>
              <label>Activo</label>            
            </div>

            <div class="user-box">              
                <input class="in" required="" type="text" name ="descripcion" value = "<?php echo $row['descripcion']; ?>"></input>  
                <label for="description">Descripcion</label>           
            </div>

            <div class="user-box">            
              <input class="in" required="" type="text" name ="destacados" value = "<?php echo $row['destacados']; ?>"></input> 
              <label for="destacados">Destacados</label>            
            </div>

            <div class="user-box">
              <input class="in" required="" type="text" name ="stock" value = "<?php echo $row['stock']; ?>"></input>  
              <label for="stock">stock</label>                   
            </div>

            <a >
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <button name = "actualice" type="submit" class="btnn">Cambiar</button>
           </a>

           <a>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <button  class="btnn"  type="submit" name = "borrar" >Eliminar</button>
           </a>  
  </div>      
                <?php
              }
            if(isset($_POST['actualice']))
              {
              if(strlen($_POST['nombre']) >= 1 )
                {
                $nombre = trim($_POST['nombre']);
                $precio = trim($_POST['precio']);
                $idcat = trim($_POST['categoria']);
                $descripcion = trim($_POST['descripcion']);
                $activo = trim($_POST['activo']);
                $destacados = trim($_POST['destacados']);
                $stock = trim($_POST['stock']);
                $consulta ="UPDATE partes set nombre = '".$nombre."',precio = '".$precio."',id_categoria = '".$idcat."',descripcion = '".$descripcion."',activo = '".$activo."',destacados = '".$destacados."',stock = '".$stock."' WHERE id = '".$id."'";
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
              if(isset($_POST['borrar']))
                {
                $consulta ="DELETE FROM partes WHERE id = '".$id."'";
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
        ?>
              </form>
           
            

</body>
