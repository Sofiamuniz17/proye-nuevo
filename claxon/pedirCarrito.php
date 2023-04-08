<?php

include("db.php");

if(isset($_POST['agregarCarrito'])){
    $pedido = trim($_POST['nombre']);
    if(isset($pedido)){
        $cantidad = 1;
        $precio = trim($_POST['precio']);
        $consulta ="INSERT INTO pedidos (nombre , telefono, correo, pedido, cantidad, precio) VALUES ('$nombre', '$telefono', '$correo', '$pedido','$cantidad', '$precio')";
        $resultado = mysqli_query($conex, $consulta);
        unset($pedido);
        
        if($resultado) {
            $referer = $_SERVER['HTTP_REFERER'];
            header("Location: $referer");
        } else {
            ?>
            <h3 class="consulno">Ha habido un error en la solicitud</h3>            
        <?php
        }

    }
}
?>