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
            array_push($array,$row["image"]);               
            if($row["image"] == NULL){ //si la bbdd no te imatge del usuari, automatimaticament li posara la imatge per defecte
                $imagen="default.png";
            }else{
                $imagen=$row["image"]; //sino es null, doncs agafara la imatge del usuari
            }
            $nombre=$row["name"];
            $apellido=$row["surname"];
            $nick=$row["nick"];
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <title>Private Messages</title>
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
                            <a href="../userPage/miPerfil.php">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                &nbsp;
                                My Profile
                            </a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="../userPage/misDatos.php">
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




    <div class="container">
        <div class="col-lg-12 box-default" id="mensajesPrivados">
            <div class="col-lg-6">
                <form enctype="multipart/form-data" name="formulario" id="formularioMensajes" action="" method="POST">
                    <h3>New Private Message</h3>
                    <hr />
                    <label for="comment">Usuarios:</label>
                    <br>
                    <!--llista de tots els amics, que despres omplo amb jquery-->
                    <select class="selectpicker" data-live-search="true" name="idUsuario">

                    </select>


                    <div class="form-group">
                        <label for="comment">Mensaje:</label>
                        <textarea class="form-control" rows="5" id="comment" name="mensaje"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="custom-file-label" for="customFile">Imagen</label>
                        <input type="file" name="file" accept="image/*" />
                    </div>
                    <div class="custom-file">
                        <label class="custom-file-label" for="customFile">Documento</label>
                        <input type="file" name="documento" accept=".doc,.docx,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Enviar</button>
                    </div>
                </form>
                <br />
                <a href="mensajesEnviados.php" class="btn btn-warning">Ver mensajes enviados</a>
                <a href="mensajesRecibidos.php" class="btn btn-warning">Ver mensajes recibidos</a>
            </div>

        </div>
    </div>
</body>
<?php
//faig consulta dels amics que segueixo (excloientme a mi de la llista) per poder mostrarlos despres a la llista amb jquery
    $arrayUsuarios = array();
    $arrayUsuariosId = array();
    $sql = "SELECT users.name,users.surname,users.id,users.nick,following.followed FROM users INNER JOIN following ON users.id=following.followed WHERE following.followed!=$id";
    $result2 = $conn->query($sql);
    if ($result2->num_rows > 0) {
        while ($row = mysqli_fetch_array($result2)) {
            array_push($arrayUsuarios, $row["name"] . "&nbsp;" . $row["surname"] . "&nbsp;" . " ' " . $row["nick"] . " ' ");
            array_push($arrayUsuariosId, $row["id"]);
        }
    }
?>
<script>
    //mostrar usuaris a la llista damics per enviar missatge
    var usuarios = <?php echo json_encode($arrayUsuarios); ?>;
    var usuariosId = <?php echo json_encode($arrayUsuariosId); ?>;
    for (var i = 0; i < usuarios.length; i++) {
        $(".selectpicker").append("<option value=" + usuariosId[i] + ">" + usuarios[i] + "</option>");
    }
    $(".btn-default").unbind('click').click(function() {
        $.ajax({
            type: 'POST'
        });
    });
</script>
<?php
    $mensaje;
    $imagen;
    $documento;
    if (isset($_POST["mensaje"])) {
        $mensaje = $_POST["mensaje"];
    }
    if (isset($_FILES['file'])) {
        $name = $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];
        $ruta = "../assets/images/";
        move_uploaded_file($tmp, $ruta . $name);
        $imagen = $name;
    }
    if (isset($_FILES['documento'])) {
        $name = $_FILES['documento']['name'];
        $tmp = $_FILES['documento']['tmp_name'];
        $ruta = "../assets/documents/";
        move_uploaded_file($tmp, $ruta . $name);
        $documento = $name;
    }
    if(!empty($_POST["idUsuario"])){
        if (!empty($mensaje) || !empty($documento) || !empty($imagen)) {
            $idUsuario = $_POST["idUsuario"];
            $sql = "INSERT INTO private_messages (message,emitter,receiver,file,image,created_at,readed) VALUES ('$mensaje','$id','$idUsuario','$documento','$imagen',now(),0)";
            $result = $conn->query($sql);
            $sql="INSERT INTO notifications (user_id,type,type_id,readed,created_at) VALUES('$idUsuario','mensaje privado','$id',0,now())";
            $result = $conn->query($sql);
        }
    }
?>

</html>



