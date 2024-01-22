<?php
    require '../bbdd/conexion.php';
    session_start();

    if(isset($_POST['usuario'],$_POST['contraseña'])){  //comprovo que estigui enviant dades, que no envio algo vuit
        $usuario=$_POST['usuario'];
        $contraseña=$_POST['contraseña'];
        $q="SELECT COUNT(*) as contar FROM users WHERE email='$usuario' AND password='$contraseña'";
        //aquesta query comprovara si ala bbdd a users hi ha algun camp correu i contrasenya que coincideixi, si coincideic em deixara entrar
        $consulta2=mysqli_query($conn,$q);
        $array=mysqli_fetch_array($consulta2);
        if($array['contar']>0){
            $_SESSION['username']=$usuario;
            header("location:../home.php");
        }else{
            header("location:../index.php");
        }
    }

    else{
        header("location:../index.php");
    }
        //comprovo si la longitud del array es 0 mes gran, si es major hi ha algu user, sino menviara ala principal.php
?>