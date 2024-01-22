<?php
    require 'bbdd/conexion.php';
    session_start();
    $usuario=$_SESSION['username'];
    if(empty($usuario)){
        header('location:index.php');
    }
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

    global $totalPublicaciones;
    global $totalSeguidos;
    global $totalMeSiguen;
    global $totalMeGustan;

    $sql = "SELECT * FROM publications WHERE user_id='$id' OR user_id IN(SELECT followed FROM following WHERE user='$id')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $totalPublicaciones = mysqli_num_rows($result);
    }
    $sql = "SELECT * FROM following WHERE user='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $totalSeguidos = mysqli_num_rows($result);
    }
    $sql = "SELECT * FROM following WHERE followed='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $totalMeSiguen = mysqli_num_rows($result);
    }
    $sql = "SELECT * FROM likes WHERE user='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $totalMeGustan = mysqli_num_rows($result);
    }
    $sql = "SELECT * FROM notifications WHERE (notifications.user_id='$id' AND readed=0) OR (notifications.type_id='$id' AND notifications.user_id='$id' AND readed=0)";
    $result = mysqli_query($conn, $sql);
    $numeroNotificacionesSinLeer = $result->num_rows;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="assets/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/bootstrap.cosmo.min.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/styles.css" type="text/css" rel="stylesheet">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
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
                    <a class="navbar-brand" href="userPage/gente.php">
                        <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                        &nbsp;
                        People
                    </a>
                </div> 

                <!--Desplegable dret-->
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <?php
                                echo $nick;  //imprimeixo nick del usuari sobre el desplegable
                            ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="userPage/miPerfil.php">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                    &nbsp;
                                    My Profile
                                </a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="userPage/misDatos.php">
                                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                    &nbsp;
                                    My Account
                                </a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="login/salir.php">
                                    <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                                    &nbsp;
                                    Exit
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul> 
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="userPage/notificaciones.php">
                            <span class="glyphicon glyphicon-bell" aria-hidden="true"></span>
                            &nbsp;
                            Notifications
                            <span class="label label-success label-notifications"><?php echo $numeroNotificacionesSinLeer; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="userPage/mensajesPrivados.php">
                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                            &nbsp;
                            Direct Messages
                        </a>
                    </li>
                </ul>        
            </div>
        </nav>

        <!--Creacio de les publicacions-->
        <div class="container">
            <div id="timeline" class="col-lg-7 box-default pull-left">
                <h1 class="box-header">Timeline</h1>
                <br>
                <div class="box-content">
                    <div class="col-lg-12 publication-item">

                    </div>
                </div>
                <div class="navigation">

                </div>
            </div>

            <!--Targeta user-->
            <div id="user-card" class="col-lg-4 pull-left box-default">
                <div class="avatar">
                    <img src="assets/images/<?php echo $imagen; ?>">
                </div>
                <div class="name-surname">
                    <a href="userPage/miPerfil.php?id=<?php echo $id; ?>"><?php echo $nombre;?> <?php echo $apellido;?></a>
                    <div class="clear-fix"></div>
                    <span class="nickname">
                        <?php echo $nick; ?>
                    </span>
                </div>
                <div class="clear-both"></div>

                <div class="following-data">
                    <span class="label-stat">
                        Siguiendo
                    </span>
                    <span class="number-stat">
                        <?php echo $totalSeguidos; ?>
                    </span>
                </div>
                <div class="following-data">
                    <span class="label-stat">
                        Seguidores
                    </span>
                    <span class="number-stat">
                        <?php echo $totalMeSiguen; ?>
                    </span>
                </div>
                <div class="following-data">
                    <span class="label-stat">
                        Publicaciones
                    </span>
                    <span class="number-stat">
                        <?php echo $totalPublicaciones; ?>
                    </span>
                </div>
                <div class="following-data">
                    <span class="label-stat">
                        Likes
                    </span>
                    <span class="number-stat">
                        <?php echo $totalMeGustan; ?>
                    </span>
                </div>
            </div>

            <!--publicacio-->
            <div id="new-publication" class="col-lg-4 pull-left box-default">
                <h1 class="box-header">New Post</h1>
                <hr />
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="comment">Message</label>
                        <textarea class="form-control" name="mensaje" id="comment" cols="30" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="custom-file-label" for="customFile">Image</label>
                        <input type="file" name="file" accept="image/*" />
                    </div>
                    <div class="custom-file">
                        <label class="custom-file-label" for="customFile">Document</label>
                        <input type="file" name="documento" accept=".doc,.docx,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"> 
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </header>


    <?php

    if(!isset($usuario)){
        header("location:index.php");
    }else{
        global $usuario;
    }
    if(!empty($_POST["mensaje"])||!empty($_POST["file"])||!empty($_POST["documento"])){   //si senvia misatge,imatge, o document i algun estigui buit
        $mensaje=$_POST["mensaje"];
        if(isset($_FILES["file"])){  //enviara la imatge a la ruta de moveuploadedfile
            $name=$_FILES["file"]["name"];
            $tmp=$_FILES["file"]["tmp_name"];
            $ruta="assets/images/";
            move_uploaded_file($tmp,$ruta.$name);
            $imagen=$name;
        }

        if(isset($_FILES["documento"])){
            $name=$_FILES["documento"]["name"];
            $tmp=$_FILES["documento"]["tmp_name"];
            $ruta="assets/documents/";
            move_uploaded_file($tmp,$ruta.$name);
            $documento=$name;
        }
        $status="Uploaded";
        $sql="SELECT id FROM users WHERE email='$usuario'";
        $result=$conn->query($sql);
        if($result->num_rows>0){
            $array=array();
            while($row=mysqli_fetch_array($result)){
                array_push($array,$row["id"]); //agafo id de qui publica
            }
            $idUsuarioLocal=reset($array);
            global $idUsuarioLocal;
            //amb el id que he agafat, linserto dins de publicacions 
            $q="INSERT INTO publications (user_id,text,document,image,status,created_at) VALUES ('$idUsuarioLocal','$mensaje','$documento','$imagen','$status',now())";
            $result=$conn->query($q);
        }
    }
    
    //buscar les publicacions
    $sql="SELECT id FROM users WHERE email='$usuario'";
    $result=$conn->query($sql);
    if($result->num_rows > 0){
        $array=array();
        while($row=mysqli_fetch_array($result)){
            array_push($array,$row["id"]); //agafo id de qui publica
        }
        $idUsuarioLocal=reset($array);
        global $idUsuarioLocal;
    }
    //mostrara les publicacions segons id 
    $sql2="SELECT users.name,users.surname,users.id,users.nick,users.image,publications.user_id,publications.text,publications.document,publications.image,publications.created_at,publications.id FROM publications INNER JOIN users ON users.id=publications.user_id WHERE publications.user_id='$idUsuarioLocal' OR publications.user_id IN(SELECT followed FROM following WHERE user='$idUsuarioLocal')";
    $arrayNick=array();
    $arrayImagen=array();
    $arrayNombreApellido=array();
    $arrayTexto=array();
    $arrayImagenUsuario=array();
    $arrayDocumento=array();
    $arrayUserId=array();
    $arrayFecha=array();
    $arrayId=array();
    $result2=$conn->query($sql2);

    //ens posara el nick de les publicacions que shan creat i ho posara dins larray del nick
    if($result2->num_rows > 0){
        while($row=mysqli_fetch_array($result2)){
            array_push($arrayNick,$row["nick"]);
            array_push($arrayNombreApellido,$row["name"]);
            array_push($arrayTexto,$row["text"]);
            //si la imatge esta buida, posa la de per defecte sino posa la del user
            if(empty($row[4])){
                $imagen="default.png";
            }else{
                $imagen=$row[4];
            }
            if(empty($row["document"])){
                $documento="";
            }else{
                $documento=$row["document"];
            }
           
            array_push($arrayId,$row[2]);
            array_push($arrayDocumento,$documento);
            array_push($arrayImagenUsuario,$imagen);
            array_push($arrayUserId,$row["id"]);
            array_push($arrayFecha,$row["created_at"]);

            //comprovo si la imatge que es puja a la publicacio si esta buida, no posa imatge, si sha pujat imatge la mostrara
            if(empty($row[8])){
                $imagen="";
            }else{
                $imagen=$row[8];
            }
            array_push($arrayImagen,$imagen);  
        }
    }
    ?>

    <script>
        
        //amb jquery fare que mostri totes les publicacions al timeline 
        var variable=<?php echo json_encode($arrayTexto);?>;
        var variable2=<?php echo json_encode($arrayImagenUsuario);?>;
        var variable3=<?php echo json_encode($arrayFecha);?>;
        var variable4=<?php echo json_encode($arrayNick);?>;
        var variable5=<?php echo json_encode($arrayNombreApellido);?>;
        var variable6=<?php echo json_encode($arrayTexto);?>;
        var variable7=<?php echo json_encode($arrayDocumento);?>;
        var variable8=<?php echo json_encode($arrayImagen);?>;
        var variable9=<?php echo json_encode($arrayUserId);?>;
        var variable10=<?php echo json_encode($arrayId);?>;

        for(var i=0;i<variable.length;i++){
            if(variable7[i]!=''){
                variable7[i]='<a class="btn-doc glyphicon glyphicon-save" aria-hidden="true" target="_blank" href="assets/documents/'+variable7[i]+'">'+"</a>";
            }
            if(variable8[i]!=''){
                variable8[i]='<a class="btn-img glyphicon glyphicon-picture" aria-hidden="true" target="_blank" href="assets/images/'+variable8[i]+'">'+"</a>";
            }
            $(".col-lg-12").append(
                '<img class="avatar" src="assets/images/'+variable2[i]+'">'+
                "<div class='publication-content'>"+
                "<p>"+
                "<a href='userPage/miPerfil.php?id="+variable10[i]+"' class='pub-name-link' href='#'>"+variable4[i]+"</a>"+
                " - "+variable5[i]+" - "+
                "<span class='pub-date'>"+variable3[i]+"</span>"+
                "</p>"+
                variable6[i]+
                "<p>"+
                variable7[i]+variable8[i]+
                '<form name="formulario" id="formulario action="" method="POST">'+
                "<button name='name' id='name' type='submit' class='btnEliminar' value='"+variable9[i]+"'>"+"Eliminar"+"</button>"+
                "<div class='pull-right like'>"+
                "<button name='meGusta' type='submit'  class='btn-like glyphicon glyphicon-heart-empty' aria-hidden='true' data-toggle='tooltip' data-placement='botom' title='Me gusta' value='"+
                variable9[i]+"'>"+
                "</button>"+
                "<button name='noMeGusta' type='submit'  class='btn-unlike active glyphicon glyphicon-heart-empty' aria-hidden='true' data-toggle='tooltip' data-placement='botom' title='No me gusta' value='"+
                variable9[i]+"'>"+
                "</button>"+
                "</div>"+
                "</form>"+
                "</p>"+
                "<div class='clearfix'></div>"+
                "</div>"+
                "<hr/>"
            );
   //quan ens donin like, que es guradi a la bbdd
   $(".btn-like").unbind('click').click(function() {
                $.ajax({
                    type: 'POST'
                });
            });
            $(".btn-unlike").unbind('click').click(function() {
                $.ajax({
                    type: 'POST'
                });
            });
        }
    </script>
    <?php
    //boto eliminar publicacio
    if (!empty($_POST["name"])) {
        $id = $_POST["name"];
        $sql = "DELETE FROM likes WHERE publication='$id'";
        $result = $conn->query($sql);
        $sql = "DELETE FROM notifications WHERE extra='$id'";
        $result = $conn->query($sql);
        $sql = "DELETE FROM publications WHERE id='$id'";
        $result = $conn->query($sql);
    }

    //boto de likes
    if (!empty($_POST['meGusta'])) {
        $id = $_POST['meGusta'];
        $sql = "INSERT INTO likes (user,publication) VALUES ('$idUsuarioLocal','$id')";
        $result = $conn->query($sql);
        //Obtener el id del usuario que ha dado me gusta
        $sql = "SELECT user_id,id FROM publications WHERE publications.id='$id'";
        $result2 = $conn->query($sql);
        if ($result2->num_rows > 0) {
            while ($row = mysqli_fetch_array($result2)) {
                $idUsuarioLike = $row["user_id"];
            }
        }
        //afegir dins de notificacions
        $sql = "INSERT INTO notifications (user_id,type,type_id,extra,readed,created_at) VALUES ('$idUsuarioLike','like','$idUsuarioLocal','$id','0',now())";
        $result = $conn->query($sql);
    }

     //boto no me gusta
    if (!empty($_POST['noMeGusta'])) {
        $id = $_POST['noMeGusta'];
        $sql = "DELETE FROM likes WHERE publication='$id'";
        $result = $conn->query($sql);
        $sql="DELETE FROM notifications WHERE extra='$id'";
        $result = $conn->query($sql);
        echo $id;
    }

    $arraySeguidos = array();
    //comprovar si la publicacio que surt al timeline es meva o dun altre usuari, si es dun altre usuari comprovar si lestic seguint, sino el segueixo no sha de mostrar
    $sql = "SELECT publications.id,likes.publication FROM publications INNER JOIN likes ON publications.id=likes.publication WHERE likes.user='$idUsuarioLocal'";
    $result2 = $conn->query($sql);
    if ($result2->num_rows > 0) {
        while ($row = mysqli_fetch_array($result2)) {
            $id = $row["id"];
            array_push($arraySeguidos, $row["id"]);
        }
    }
    //comprovo als que no segueixo
    $arrayNoSeguidos = array();
    $sql = "SELECT id FROM publications WHERE NOT EXISTS(SELECT publication FROM likes WHERE publications.id=likes.publication AND likes.user='$idUsuarioLocal')";
    $result2 = $conn->query($sql);
    if ($result2->num_rows > 0) {
        while ($row = mysqli_fetch_array($result2)) {
            array_push($arrayNoSeguidos, $row["id"]);
        }
    }
    ?>
    <script>
        //ara mitjançant jquery fare que es mostri el boto de like o no
        var seguidos = <?php echo json_encode($arraySeguidos); ?>;
        var noSeguidos = <?php echo json_encode($arrayNoSeguidos); ?>;
    
        //recorro les variables
        //quan es mostri un post mostrara dos botons, un de like i un dislike, si ala bbdd te que ja li he donat like, amb el jquuery que he fet mostrare nomes el de dislike i alreves
        for (var i = 0; i < seguidos.length; i++) {
            $(".hidden[value=" + seguidos[i] + "]").removeClass();
            $(this).addClass("btn-unlike active glyphicon glyphicon-heart-empty");
            $(".hidden[value=" + seguidos[i] + "]").css("background-color", "red");
            $(".btn-like[value=" + seguidos[i] + "]").hide();
        }
        for (var i = 0; i < noSeguidos.length; i++) {
            $(".btn-unlike[value=" + noSeguidos[i] + "]").hide();
        }
             
        //si el que ha fet el post no soc jo, el boto eliminar del post no surt:
        var nick=<?php echo json_encode($nick); ?>;
        var variable9 = <?php echo json_encode($arrayUserId); ?>;
        for(var i=0;i<variable4.length;i++){
            if(variable4[i]!=nick){
                $(".btnEliminar[value=" + variable9[i] + "]").hide();
            }
        }
    </script>
</body>

</html>