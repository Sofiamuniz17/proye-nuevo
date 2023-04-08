<?php

include("db.php");

if(isset($_POST['consultar'])){
    if(strlen($_POST['Nombre']) >= 1 && strlen($_POST['Telefono']) >= 1 && strlen($_POST['correo']) >= 1 && strlen($_POST['consulta']) >= 1){
        $nombres = trim($_POST['Nombre']);
        $telefono = trim($_POST['Telefono']);
        $correo = trim($_POST['correo']);
        $consul = trim($_POST['consulta']);
        $fechasol = date("d/m/y");
        $consulta ="INSERT INTO `consultas` (Nombre , Telefono, Correo, Consulta, Fecha_Solicitud) VALUES ('$nombres', '$telefono', '$correo', '$consul','$fechasol')";
        $resultado = mysqli_query($conex, $consulta);
        if($resultado) {
            $referer = $_SERVER['HTTP_REFERER'];
            header("Location: $referer");
            ?>  
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