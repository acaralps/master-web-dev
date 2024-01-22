<?php
require('../bbdd/conexion.php');
sleep(1);
if(isset($_POST)){
    $nick=$_POST["nick"];
    $result=$conn->query(
        'SELECT * FROM users WHERE nick="'.strtolower($nick).'"'
    );
    if($result->num_rows>0){
        echo '<div class="alert alert-danger" id="mal"><strong>Usuario no disponible</strong></div>';
    }else{
        echo '<div class="alert alert-success" id="bien"><strong>Usuario disponible</strong></div>';
    }
}


//comprovo si el nick introduit ja esta dins la bbdd, sino hi es, em diu que esta ok, (encara no ho insereixo ala bbdd)
?>