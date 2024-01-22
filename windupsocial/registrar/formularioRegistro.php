<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
    <link href="../assets/css/bootstrap.cosmo.min.css" type="text/css" rel="stylesheet"/>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <link href="../assets/css/bootstrap.css" type="text/css" rel="stylesheet" />
    <script src="progressbar.js"></script>
</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapse" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Navegacion</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">
                <span class="glyphicon glyphicon-cloud" aria-hidden="true"></span>
                &nbsp;
                WINDUP
                </a>
            </div>
        </div>
    </nav>

    <form method="POST" action="registrarse.php">
        <div class="container">
            <h1>Regístrate</h1>
            <div class="progress"><!--Estic creant una barra de progress que a mesura que li entri coses sanira fent gran o petita-->
                <div id="dynamic" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                <span id="curren-progress"></span>   
                </div>
            </div>
            <fieldset>
                <h2>Crea tu cuenta</h2>
                <br>
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="name" class="form-control" id="name" name="name" placeholder="Nombre" required>
                    <span id="nameInfo"></span>
                </div>

                <div class="form-group">
                    <label for="surname">Apellido</label>
                    <input type="surname" class="form-control" id="surname" name="surname" placeholder="Apellido" required>
                    <span id="surnameInfo"></span>
                </div>

                <div class="form-group">
                    <label for="nick">Nick</label>
                    <input type="nick" class="form-control" id="nick" name="nick" placeholder="Nombre de usuario" required>
                    <span id="nickInfo"></span>
                    <span id="estadoNick"></span>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    <span id="emailInfo"></span>
                    <span id="estadoEmail"></span>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Password" required>
                    <span id="passwordInfo"></span>
                </div>

                <input type="submit" name="data[password]" class="next btn btn-info" value="Enviar">
            </fieldset>
        </div>
    </form>
</body>
<footer>
        <hr>
        <div style="color:white;text-align:center;">Windup @2022</div>
    </footer>
</html>