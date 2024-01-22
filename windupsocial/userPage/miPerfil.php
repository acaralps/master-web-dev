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
    <title>Mi perfil</title>
</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
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
    <div class="card">

    </div>

</body>
<?php
    $arrayNombre = array();
    $arrayApellidos = array();
    $arrayEmail = array();
    $arrayNick = array();
    $arrayImagen = array();
    if(empty($_GET["id"])){
        $id;
    }
    else{
        $id = $_GET["id"];
    }
    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            array_push($arrayNombre, $row["name"]);
            array_push($arrayApellidos, $row["surname"]);
            array_push($arrayEmail, $row["email"]);
            array_push($arrayNick, $row["nick"]);
            if(empty($row["image"])){
                array_push($arrayImagen,"default.png");
            }
            else{
                array_push($arrayImagen,$row["image"]);
            }
        }
    }
?>

</html>
<script>
    var nombre = <?php echo json_encode($arrayNombre); ?>;
    var apellidos = <?php echo json_encode($arrayApellidos); ?>;
    var email = <?php echo json_encode($arrayEmail); ?>;
    var nick = <?php echo json_encode($arrayNick); ?>;
    var imagen=<?php echo json_encode($arrayImagen); ?>;
    $(".card").append(
        '<img class="card-img-top" src = "../assets/images/' + imagen + '">'+
        '<ul class="list-group list-group-flush">'+
            '<li class="list-group-item">'+nombre+" "+apellidos+'</li>'+
            '<li class="list-group-item">'+email+'</li>'+
            '<li class="list-group-item">'+nick+'</li>'+
        '</ul>'
    );
</script>