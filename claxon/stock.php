<?php

include("db.php");

if(isset($_POST['agregarStock'])){            
    if(($_POST['stock']) >= 0 ){      
        $actualStock = $_POST['stock'] + 1;
        $actualId = $_POST['id'];
        $consulta = "UPDATE partes SET stock = $actualStock WHERE id = $actualId";
        $resultados = mysqli_query($conex, $consulta); 
    }
}else if (isset($_POST['removeStock'])) {                  
    if(($_POST['stock']) >= 1 ) {
        $actualStock = $_POST['stock'] - 1;
        $actualId = $_POST['id'];
        $consulta = "UPDATE partes SET stock = $actualStock WHERE id = $actualId";
        $resultados = mysqli_query($conex, $consulta);
 }
}
?>