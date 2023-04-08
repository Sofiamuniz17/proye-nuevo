<?php

include("db.php");

if(isset($_POST['removerCarrito'])){
    $id = trim($_POST['id']);
    if(isset($id)){
        $consulta ="DELETE FROM pedidos WHERE id = '$id'";
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