<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
    <link href="../assets/css/bootstrap.cosmo.min.css" type="text/css" rel="stylesheet"/>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <link href="../assets/css/bootstrap.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <form method="POST" action="login/loguear.php">
    <div class="container">
        <h2>Login</h2>
        <div class="form-group">
            <label for="name">Email</label>
            <input type="name" class="form-control" id="name" name="usuario" placeholder="Email">
        </div>
        <br>
        <div class="form-group">
            <label for="exampleInoutPassword">Password</label>
            <input type="password" class="form-control" id="Contraseña" name="contraseña" placeholder="Password">
           <br>
           <br>
            <p>No tienes cuenta?  <a href="registrar/formularioRegistro.php">Crear Cuenta</a></p>
        </div>
        <input type="submit" name="data[password]" class="next btn btn-info" value="Enviar">
        
    </div>

    </form>
</body>
</html>