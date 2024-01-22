<?php

    require('../bbdd/conexion.php');
    session_start();
    if(!empty($_POST["name"]&& $_POST["contraseña"]&&$_POST["surname"]&&$_POST["email"]&&$_POST["nick"])){
        $name=$_POST["name"];
        $surname=$_POST["surname"];
        $nick=$_POST["nick"];
        $email=$_POST["email"];
        $contraseña=$_POST["contraseña"];
        $q="INSERT INTO users(name,surname,nick,email,password) VALUES ('$name','$surname','$nick','$email','$contraseña')";

        //si puc fer aixo:  enviara a la pagina principal
        if($conn->query($q)===TRUE){
            header("location:../index.php");
        }else{
            header("location:formularioRegistro.php");
        }
    }else{  //i si ho envio sense dades envio a formularioRegistro tambe
        header("location:formularioRegistro.php");
    }
?>