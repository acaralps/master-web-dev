<?php
    require '../bbdd/conexion.php';
    session_start();
    $usuario=$_SESSION['username'];
    
    global $usuario;
    global $id;
    $sql="SELECT * FROM users WHERE email='$usuario'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
        $array=array(); 
        while($row=mysqli_fetch_array($result)){
            $id=$row["id"];
           
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
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" />
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <title>Mensajes enviados</title>
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
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <?php
                        echo $usuario;
                        ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                &nbsp;
                                My Profile
                            </a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="../paginasUsuario/misDatos.php">
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
    </nav>
    <h1 class="box-header">
        Mensajes recibidos
    </h1>
    <div class="container mt-5">
        <table id="usetTable" class="table">
            <thead>
                <th>De</th>
                <th>Mensaje</th>
                <th>Documento</th>
                <th>Imagen</th>
            </thead>
            <tbody id="a">

            </tbody>
        </table>
    </div>
</body>
<?php
    $arrayMensajes = array();
    $arrayDocumento = array();
    $arrayImagen = array();
    $sql = "SELECT * FROM private_messages WHERE private_messages.receiver='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            array_push($arrayMensajes, $row["message"]);
            if ($row["file"] == NULL) {
                array_push($arrayDocumento, "");
            } else {
                array_push($arrayDocumento, $row["file"]);
            }
            if ($row["image"] == NULL) {
                array_push($arrayImagen, "");
            } else {
                array_push($arrayImagen, $row["image"]);
            }
        }
    }
    $arrayNombre = array();
    $sql="SELECT users.name,users.surname,users.id FROM users INNER JOIN private_messages ON users.id=private_messages.emitter WHERE private_messages.receiver=$id";
    $result2 = $conn->query($sql);
    if ($result2->num_rows > 0) {
        while ($row = mysqli_fetch_array($result2)) {
            array_push($arrayNombre,$row["name"]);
        }
    }

?>
<script>
    $("#usetTable").DataTable();
    $("#usetTable th").css("text-align", "center");
    $("#usetTable").css("text-align", "center");
    var nombre = <?php echo json_encode($arrayNombre); ?>;
    var mensajes = <?php echo json_encode($arrayMensajes); ?>;
    var documento = <?php echo json_encode($arrayDocumento); ?>;
    var imagen = <?php echo json_encode($arrayImagen); ?>;
    var t = $('#usetTable').DataTable();
    for (var i = 0; i < mensajes.length; i++) {
        t.row.add([
            nombre[i],
            mensajes[i],
            documento[i],
            imagen[i]
        ]).draw(false);
    }
</script>

</html>