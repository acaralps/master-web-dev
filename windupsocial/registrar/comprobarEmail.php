<?php


    require('../bbdd/conexion.php');
    sleep(1);
    //si han enviat algo desde el formuulari, anem a comprovarho
    if(isset($_POST)){
        $email=$_POST["email"];
        $result=$conn->query(
            'SELECT * FROM users WHERE email="'.strtolower($email).'"'
        );
        $email=filter_var($email,FILTER_SANITIZE_EMAIL);

if(filter_var($email,FILTER_SANITIZE_EMAIL)){
    if($result->num_rows<1){
        echo '<div class="alert alert-success" id="bien"><strong>Email disponible</strong></div>';
}else{
    echo '<div class="alert alert-danger" id="mal"><strong>Email NO disponible</strong></div>';
}
    }
    else{
        echo '<div class="alert alert-danger" id="mal"><strong>Email disponible</strong></div>';
    }
    
}

?>