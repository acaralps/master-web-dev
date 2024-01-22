$(document).ready(function(){
    var name=$("#name");
    var surname=$("#surname");
    var email=$("#email");
    var nick=$("#nick");
    var password=$("#password");

    var nameInfo=$("#nameInfo");
    name.blur(validateName);  //quan faji click sobre el seguent camp a omplir, es guardara
   
    var surnameInfo=$("#surnameInfo");
    surname.blur(validateSurname);

    var nickInfo=$("#nickInfo");
    nick.blur(validateNick);

    var emailInfo=$("#emailInfo");
    email.blur(validateEmail);

    var passwordInfo=$("#passwordInfo");
    password.blur(validatePassword);

    $a=0;
    $b=0;
    $c=0;
    $d=0;
    $e=0;

    var current_progress=0;

    function validateName(){
        if($a==1&&name.val().length<1){
            jQuery(".progress-bar").css("width",function(){
                current_progress=current_progress-20;  //si borra el nom, la barra disminueix
                $(".progress-bar")
                    .css("width",current_progress+"%")
                    .attr("aria-valuenow",current_progress);
            });  
            $a=0;          
        }
        if(name.val().length<1){
            nameInfo.text("Introduce nombre");
            $a=0;
        }else{
            if($a==0){
                nameInfo.text("");
                jQuery(".progress-bar").css("width",function(){
                    current_progress=current_progress+20;
                    $(".progress-bar")
                        .css("width",current_progress+"%")
                        .attr("aria-valuenow",current_progress);
                });       
                $a=1;        
            }
        }
    }




    function validateSurname(){
        if($b==1&&surname.val().length<1){
            jQuery(".progress-bar").css("width",function(){
                current_progress=current_progress-20;  //si borra el nom, la barra disminueix
                $(".progress-bar")
                    .css("width",current_progress+"%")
                    .attr("aria-valuenow",current_progress);
            });  
            $b=0;          
        }
        if(surname.val().length<1){
            surnameInfo.text("Introduce apellido");
            $b=0;
        }else{
            if($b==0){
                surnameInfo.text("");
                current_progress=current_progress+20;
                $(".progress-bar")
                    .css("width",current_progress+"%")
                    .attr("aria-valuenow",current_progress);       
                $b=1;        
            }
        }
    }




    function validateNick(){
        if($c==1&&nick.val().length<1){
            jQuery(".progress-bar").css("width",function(){
                current_progress=current_progress-20;  //si borra el nom, la barra disminueix
                $(".progress-bar")
                    .css("width",current_progress+"%")
                    .attr("aria-valuenow",current_progress);
            });  
            $c=0;          
        }
        if(nick.val().length<1){
            nickInfo.text("Introduce nick");
            $c=0;
        }else{
            if($c==0){
                nickInfo.text("");
                jQuery(".progress-bar").css("width",function(){
                    current_progress=current_progress+20;
                    $(".progress-bar")
                        .css("width",current_progress+"%")
                        .attr("aria-valuenow",current_progress);
                });       
                $c=1;        
            }
        }
    }







    function validateEmail(){
        if($d==1&&email.val().length<1){
                current_progress=current_progress-20;  //si borra el nom, la barra disminueix
                $(".progress-bar")
                    .css("width",current_progress+"%")
                    .attr("aria-valuenow",current_progress);  
            $d=0;          
        }
        if(email.val().length<1){
            emailInfo.text("Introduce email");
            $d=0;
        }else{
            if($d==0){
                emailInfo.text("");
                    current_progress=current_progress+20;
                    $(".progress-bar")
                        .css("width",current_progress+"%")
                        .attr("aria-valuenow",current_progress);       
                $d=1;        
            }
        }
    }






    function validatePassword(){
        if($e==1&&password.val().length<1){
            jQuery(".progress-bar").css("width",function(){
                current_progress=current_progress-20;  //si borra el nom, la barra disminueix
                $(".progress-bar")
                    .css("width",current_progress+"%")
                    .attr("aria-valuenow",current_progress);
            });  
            $e=0;          
        }
        if(password.val().length<1){
            passwordInfo.text("Introduce password");
            $e=0;
        }else{
            if($e==0){
                passwordInfo.text("");
                    current_progress=current_progress+20;//augmento la barra
                    $(".progress-bar")
                        .css("width",current_progress+"%")
                        .attr("aria-valuenow",current_progress);       
                $e=1;        
            }
        }
    }




//altres comprovacions importants

//si el nick ja esta utilitzat, enviare uun missatge mitjansant ajax que el mostrara al formulari

$("#nick").on('blur',function(){
    var nick=$(this).val();
    var dataString='nick='+nick;
    $.ajax({
        type:"POST",
        url:"comprobarNick.php",
        data:dataString,
        success: function(data){
            $("#estadoNick").fadeIn(1000).html(data);
        }
    });
});




$("#email").on('blur',function(){
    var email=$(this).val();
    var dataString='email='+email;
    $.ajax({
        type:"POST",
        url:"comprobarEmail.php",
        data:dataString,
        success: function(data){
            $("#estadoEmail").fadeIn(1000).html(data);
        }
    });
});



//si el formulari no envia correctament, mostrare missatge no enviado

$("form").on("submit",function(event){
    if($("#mal").length){
        alert("No enviado");
        event.preventDefault();
    }
});














/*fin */
});