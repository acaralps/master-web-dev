<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="assets/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
    <link href="assets/css/bootstrap.cosmo.min.css" type="text/css" rel="stylesheet"/>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <link href="assets/css/bootstrap.css" type="text/css" rel="stylesheet" />
    

    <title>WINDUP</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button"class="navbar-toggle collapse" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Navegación</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="">
                        <span class="glyphicon glyphicon-cloud" aria-hidden="true"></span>
                        &nbsp;
                        WINDUP
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="registrar/formularioRegistro.php">
                                <span class="glyphicon glyphicon-user" aria-expanded="true"></span>
                                &nbsp;
                                Register
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <?php
            require 'login/login.php';
        ?>
        

    </header>

    <footer class="col-lg-12">
        <hr>
        <div style="text-align:center"class="text-mutted">Windup @2022 </div>
    </footer>
</body>
</html>