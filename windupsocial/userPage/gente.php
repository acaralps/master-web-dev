<?php

    //comprovo que si al entrar no he introduit mail i pasword em porti al login
    session_start();
    if(empty($_SESSION['username'])) {
        header('location:../index.php');
    }else{
        require '../bbdd/conexion.php';
        $usuario = $_SESSION['username'];
        global $usuario;
        $usuarioRoot = $usuario;
        global $usuarioRoot;
        global $id;
        
     

        $sql="SELECT * FROM users WHERE email='$usuario'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $array = array();
            while ($row = mysqli_fetch_array($result)) {
                array_push($array, $row["image"]);
                if ($row["image"] == NULL) {
                    $imagen = "default.png";
                } else {
                    $imagen = $row["image"];
                }
                $apellido = $row["surname"];
                $nick = $row["nick"];
                $id = $row["id"];
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head> <!--mateix header que a home-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="../assets/css/bootstrap.cosmo.min.css" type="text/css" rel="stylesheet" />
    <link href="../assets/css/styles.css" type="text/css" rel="stylesheet" />
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" />
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>    
    
    <title>People</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <span id="estado"></span>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapse" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Navegación</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../home.php">
                        <span class="glyphicon glyphicon-cloud" aria-hidden="true"></span>
                        &nbsp;
                        WINDUP
                    </a>

                   
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <div class="avatar">
                                    <img src="assets/images/<?php echo $imagen; ?>" />
                                </div>
                                <?php
                                echo $usuario;
                                ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="miPerfil.php">
                                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                        &nbsp;
                                        My Profile
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="misDatos.php">
                                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                        &nbsp;
                                        My Account
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="../login/salir.php">
                                        <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                                        &nbsp;
                                        Exit
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-5">
            <table id="usetTable" class="table">
                <thead>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Seguir</th>
                </thead>
                <tbody id="a">

                </tbody>
            </table>
        </div>
    </header>
    <?php
         //mostrara tots els usuaris de la xarxa social, excepte un mateix
        $sql = "SELECT * FROM following INNER JOIN users ON users.id=following.followed WHERE users.id!='$id' AND following.user='$id'";
        $result = $conn->query($sql);
        $arrayNombre = array();
        $arrayApellido = array();
        $arrayImagen = array();
        $arraySeguidos = array();
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {
                array_push($arrayNombre, $row["name"]);
                array_push($arrayApellido, $row["surname"]);
                if ($row["image"] == NULL) {
                    $imagen = "default.png";
                } else {
                    $imagen = $row["image"];
                }
                array_push($arrayImagen, $imagen);
                array_push($arraySeguidos, $row["id"]);
            }
        }
        $arrayNoSeguidos = array();
        $arrayNoSeguidosNombre = array();
        $arrayNoSeguidosApellido = array();
        $arrayNoSeguidosImagen = array();

        //mostrara tots els usuaris que no segueixo
        $sql = "SELECT * FROM users WHERE id!='$id' AND NOT EXISTS(SELECT * FROM following WHERE users.id=following.followed AND following.user='$id')";
        $result2 = $conn->query($sql);
        if($result2->num_rows > 0) {
            while ($row = mysqli_fetch_array($result2)) {
                array_push($arrayNoSeguidos, $row["id"]);
                array_push($arrayNoSeguidosNombre, $row["name"]);
                array_push($arrayNoSeguidosApellido, $row["surname"]);
                if ($row["image"] == NULL) {
                    $imagen = "default.png";
                } else {
                    $imagen = $row["image"];
                }
                array_push($arrayNoSeguidosImagen, $imagen);
            }
        }
    ?>

    <script>
        //insertar els usuaris ala taula amb jquery
        $("#usetTable").DataTable();
        $("#usetTable th").css("text-align", "center");
        $("#usetTable").css("text-align", "center");
        $("#nombre").hide();
        $("#id").hide();
        $("#boton").hide();

        var variable = <?php echo json_encode($arrayNombre); ?>;
        var variable2 = <?php echo json_encode($arrayApellido); ?>;
        var variable3 = <?php echo json_encode($arrayImagen); ?>;
        var variable4 = <?php echo json_encode($arraySeguidos); ?>;
        var variable5 = <?php echo json_encode($arrayNoSeguidosNombre); ?>;
        var variable6 = <?php echo json_encode($arrayNoSeguidosApellido); ?>;
        var variable7 = <?php echo json_encode($arrayNoSeguidosImagen); ?>;
        var variable8 = <?php echo json_encode($arrayNoSeguidos); ?>;
        var t = $('#usetTable').DataTable();


        //afegir nom, imatge i boto de deixar de seguir a la taula
        for (var i = 0; i < variable.length; i++) {
            t.row.add([
                '<img class="avatar" src = "../assets/images/' + variable3[i] + '">',
                variable[i],
                variable2[i],
                "<form name='formulario' action='' method='POST'>"+"<button type='submit' name='dejarSeguir' class='btn btn-danger' value=" + variable4[i] + ">" + "Dejar de seguir" + "</button>"+"</form>"
            ]).draw(false);
        }

        //afegir nom, imatge i boto de seguir a la taula
        for (var i = 0; i < variable6.length; i++) {
            t.row.add([
                '<img class="avatar" src = "../assets/images/' + variable7[i] + '">',
                variable5[i],
                variable6[i],
                "<form name='formulario' action='' method='POST'>"+"<button type='submit' name='seguir' class='btn btn-success' value=" + variable8[i] + ">" + "Seguir" + "</button>"+"</form>"
 /**/       ]).draw(false); //????
        }

        //envio mitjançant ajax segons si dono a seguir o deixar de seguir
        $(".btn-success").unbind('click').click(function() {
            $.ajax({
                type: 'POST'
            });
        });
        $(".btn-danger").unbind('click').click(function() {
            $.ajax({
                type: 'POST'
            });
        });
    </script>

    <?php
    //al fer click agafo les dades i les introdueixo a la base de dades
        if(!empty($_POST["seguir"])){
            $idSeguir=$_POST["seguir"];
            $sql="INSERT INTO following (user,followed) VALUES ('$id','$idSeguir')";
            $result = $conn->query($sql);
            $sql="INSERT INTO notifications (user_id,type,type_id,readed,created_at) VALUES('$idSeguir','Te esta siguiendo','$id',0,now())";
            $result = $conn->query($sql);
        }
        if(!empty($_POST["dejarSeguir"])){
            $idSeguir=$_POST["dejarSeguir"];
            $sql="DELETE FROM following WHERE followed='$idSeguir'";
            $result = $conn->query($sql);
            $sql="DELETE FROM notifications WHERE type='seguir' AND user_id='$idSeguir'";
            $result = $conn->query($sql);
        }
    ?>

</body>

</html>