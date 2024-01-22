<?php
     require '../bbdd/conexion.php';
    session_start();
     $usuario = $_SESSION['username'];
    if (empty($usuario)) {
        header('location:../index.php');
    }
        global $usuario;
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
    <title>My Account</title>
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
        <div class="col-lg-8 box-form">
            <h2>My Account</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="name" class="form-name form-control" placeholder="" value="" name="nombre">
                </div>
                <div class="form-group">
                    <label for="surname">Apellidos</label>
                    <input type="surname" class="form-surname form-control" placeholder="" name="apellidos">
                </div>
                <div class="form-group">
                    <label for="nick">Nick</label>
                    <input type="nick" class="form-nick form-control" placeholder="" readonly="readonly">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-email form-control" placeholder="" readonly="readonly">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-password form-control" placeholder="" name="contraseña">
                </div>
                
                    <input type="file" name="file" />
                <button type="submit" class="btn btn-default">Enviar</button>
            </form>
        </div>
    </header>
    <?php
        if (!isset($usuario)) {
            header("location:../index.php");
        } else {
            
            $nombreUsuario = $_SESSION['username'];
            $query = "SELECT * FROM users WHERE email='$nombreUsuario' ";
            $result = $conn->query($query);
            $nombre;
            $apellidos;
            $nick;
            $email;
            $contraseña;
            $imagen;
            while ($row = mysqli_fetch_array($result)) {
                $nombre = $row["name"];
                $apellidos = $row["surname"];
                $nick = $row["nick"];
                $email = $row["email"];
                $contraseña = $row["password"];
                $imagen = $row["image"];
            }
        }
    ?>
    <script>
        $(document).ready(function() {
            var nombre = "<?php echo $nombre; ?>";
            var apellidos = "<?php echo $apellidos; ?>";
            var nick = "<?php echo $nick; ?>";
            var email = "<?php echo $email; ?>";
            var contraseña = "<?php echo $contraseña; ?>";
            var imagen = "<?php echo $imagen; ?>";
            $(".form-name").attr("value", nombre);
            $(".form-surname").attr("value", apellidos);
            $(".form-nick").attr("value", nick);
            $(".form-email").attr("value", email);
            $(".form-password").attr("value", contraseña);
            $(".form-image").attr("value", imagen);
            $("input[name=nombre]").change(function() {
                $(".form-name").attr("value", $(this).val());
            });

            $("input[name=apellidos]").change(function() {
                $(".form-surname").attr("value", $(this).val());
            });

            $("input[name=contraseña]").change(function() {
                $(".form-password").attr("value", $(this).val());
            });
        });
    </script>
    <?php
    if (!empty($_POST)) {
        $nombreModificado = $_POST["nombre"];
        $apellidosModificados = $_POST["apellidos"];
        $contraseñaModificada = $_POST["contraseña"];
        $imagenModificada;
        if(isset($_FILES['file'])){
            $name=$_FILES['file']['name'];
            $tmp=$_FILES['file']['tmp_name'];
            $ruta="../assets/images/";
            
            move_uploaded_file($tmp,$ruta.$name);
        }
        $imagenModificada=$name;
        
        $info = new SplFileInfo($imagenModificada);
       
    
     if ($nombreModificado == $nombre && $apellidosModificados == $apellidos && $contraseñaModificada == $contraseña && empty($imagenModificada)) {
              ?>
              <div class="alert" role="alert">
                  <h4 class="alert-heading">No has modificado nada</h4>
              </div>
              <?php
            } else { 
                if(empty($imagenModificada)){
                    $imagenModificada=$imagen;
                }          
                $sql = "UPDATE users SET name='$nombreModificado',surname='$apellidosModificados',password='$contraseñaModificada',image='$imagenModificada' WHERE email='$email'  ";
                if (mysqli_query($conn, $sql)) {    
                
                ?>
                <div class="alert" role="alert">
                  <h4 class="alert-heading">Modificado</h4>
              </div>
              <?php
             } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }
            }
        }

    ?> 
</body>

</html>