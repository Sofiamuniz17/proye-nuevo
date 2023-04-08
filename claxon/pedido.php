<?php

include("db.php");

if(isset($_POST['pedir'])){
    if(strlen($_POST['Nombre']) >= 1 && strlen($_POST['Telefono']) >= 1 && strlen($_POST['correo']) >= 1 && strlen($_POST['pedido']) >= 1 && strlen($_POST['cantidad']) >= 1){
        $Nombre = trim($_POST['Nombre']);
        $Telefono = trim($_POST['Telefono']);
        $correo = trim($_POST['correo']);
        $pedido = trim($_POST['pedido']);
        $cantidad = trim($_POST['cantidad']);
        $precio = trim($_POST['precio']);
        $consulta ="INSERT INTO pedidos (nombre , Telefono, correo, pedido, cantidad, precio) VALUES ('$Nombre', '$Telefono', '$correo', '$pedido','$cantidad', '$precio')";
        $resultado = mysqli_query($conex, $consulta);
        if($resultado) {
            $referer = $_SERVER['HTTP_REFERER'];
            header("Location: $referer");
        ?>
            <!-- <h3 class="consulok">pedido Enviado Correctamente</h3> -->
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