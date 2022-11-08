<?php

include("db.php");

if(isset($_POST['solicite'])){
    if(strlen($_POST['nombres']) >= 1 && strlen($_POST['Telefono']) >= 1 && strlen($_POST['correo']) >= 1 && strlen($_POST['fecha']) >= 1 && strlen($_POST['datosauto']) >= 1 && strlen($_POST['servicio']) >= 1 ){
        $nombres = trim($_POST['nombres']);
        $telefono = trim($_POST['Telefono']);
        $correo = trim($_POST['correo']);
        $fecha = trim($_POST['fecha']);
        $datos = trim($_POST['datosauto']);
        $serv = trim($_POST['servicio']);
        $fechasol = date("d/m/y");
        $consulta ="INSERT INTO turnos (Nombre , Telefono, Correo, Fecha_Hora, Marca_Modelo, Servicio, Fecha_Solicitud) VALUES ('$nombres', '$telefono', '$correo', '$fecha','$datos', '$serv', '$fechasol')";
        $resultado = mysqli_query($conex, $consulta);
        if($resultado) {
            ?>
            <h3 class="turnok">Turno Solicitado Correctamente</h3>
            <?php
        } else {
            ?>
            <h3 class="turnno">Ha habido un error en la solicitud</h3>            
        <?php
        }
    } else{
        ?>
        <h3 class="turnno">Por favor complete los campos</h3>
        <?php
    }
}
?>