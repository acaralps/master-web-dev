<?php
    require '../bbdd/conexion.php';;
    session_start();
    $usuario = $_SESSION['username'];
    global $usuario;
    global $id;
    $sql = "SELECT * FROM users WHERE email='$usuario'";
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="../assets/css/bootstrap.cosmo.min.css" type="text/css" rel="stylesheet" />
    <link href="../assets/css/styles.css" type="text/css" rel="stylesheet" />
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <title>Notificaciones</title>
</head>

<body>
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
                    
                    <a class="navbar-brand" href="gente.php">
                        <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                        &nbsp;
                        People
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <div class="avatar">
                                    <img src="../assets/images/<?php echo $imagen; ?>" />
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
    <div class="container">
        <div class="col-lg-12 box-default box-notifications">
            <h1 class="box-header">Notificaciones</h1>
            <div class="box-content">
                
            </div>
        </div>
    </div>

    <?php
        $sql="UPDATE notifications SET readed=1 WHERE user_id='$id'";
        $result2 = $conn->query($sql);
        $arrayNotificacionesTipo=array();
        $arrayNotificacionesUsuarioId=array();
        $arrayNotificacionesUsuarioNombreApellido=array();
        $sql="SELECT * FROM notifications WHERE  (type_id=user_id AND type_id='$id') OR (user_id='$id' AND type_id!='$id')";
        $result2 = $conn->query($sql);
        if ($result2->num_rows > 0) {
            while ($row = mysqli_fetch_array($result2)) {
                array_push($arrayNotificacionesTipo,$row["type"]);
                array_push($arrayNotificacionesUsuarioId,$row["type_id"]);
            }
        }
        for($i=0;$i<count($arrayNotificacionesUsuarioId);$i++){
            $id=$arrayNotificacionesUsuarioId[$i];
            $sql="SELECT name,surname FROM users WHERE id='$id'";
            $result2 = $conn->query($sql);
            if ($result2->num_rows > 0) {
                while ($row = mysqli_fetch_array($result2)) {
                    array_push($arrayNotificacionesUsuarioNombreApellido,$row["name"]." ".$row["surname"]."<br>");
                }
            }
        }
    ?>
    <script>
        var notificacionesTipo = <?php echo json_encode($arrayNotificacionesTipo); ?>;
        var notificacionesUsuarioId = <?php echo json_encode($arrayNotificacionesUsuarioId); ?>;
        var notificacionesUsuarioNombreApellido = <?php echo json_encode($arrayNotificacionesUsuarioNombreApellido); ?>;
        for(var i=0;i<notificacionesTipo.length;i++){   
            $(".box-content").append("<p>"+notificacionesUsuarioNombreApellido[i]+notificacionesTipo[i]+"</p>");
        }
    </script>
</body>

</html>