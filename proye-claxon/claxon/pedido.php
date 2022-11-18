<?php

include("db.php");

if(isset($_POST['pedir'])){
    if(strlen($_POST['nombre']) >= 1 && strlen($_POST['telefono']) >= 1 && strlen($_POST['correo']) >= 1 && strlen($_POST['pedido']) >= 1 && strlen($_POST['cantidad']) >= 1){
        $nombre = trim($_POST['nombre']);
        $telefono = trim($_POST['telefono']);
        $correo = trim($_POST['correo']);
        $pedido = trim($_POST['pedido']);
        $cantidad = trim($_POST['cantidad']);
        $consulta ="INSERT INTO pedidos (nombre , telefono, correo, pedido, cantidad) VALUES ('$nombre', '$telefono', '$correo', '$pedido','$cantidad')";
        $resultado = mysqli_query($conex, $consulta);
        if($resultado) {
            ?>
            <h3 class="consulok">pedido Enviado Correctamente</h3>
            <?php
        } else {
            ?>
            <h3 class="consulno">Ha habido un error en la solicitud</h3>            
        <?php
        }
    } else{
        ?>
        <h3 class="consulno">Por favor complete los campos</h3>
        <?php
    }
}
?>