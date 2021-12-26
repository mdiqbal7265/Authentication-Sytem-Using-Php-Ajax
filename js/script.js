$(document).ready(function () {
    
    $("#forgot_link").click(function () { 
        $("#login-box").hide();
        $("#forgot-box").show();
     });

     $("#register_link").click(function(){
        $("#register-box").show();
        $("#login-box").hide();
     });

     $("#login_link").click(function(){
        $("#register-box").hide();
        $("#login-box").show();
     });

     $("#back_link").click(function(){
        $("#forgot-box").hide();
        $("#login-box").show();
     });

    //  vlidate code

    $("#login-form").validate();
    $("#register-form").validate({
        rules:{
            cpass:{
                equalTo:"#pass",
            }
        }
    });

    $("#forgot-form").validate();

    // Form submit code

    // Register Form
    $("#register").click(function(e){
        if(document.getElementById('register-form').checkValidity()){
            e.preventDefault();
            $("#loader").show();
            $.ajax({
                type: "POST",
                url: "action.php",
                data: $('#register-form').serialize()+'&action=register',
                success: function (response) {
                    $("#alert").show();
                    $("#result").html(response);
                    $("#register-form")[0].reset();
                    $("#loader").hide();
                }
            });
        }
        return true;
    });

    // login form
    $("#login").click(function(e){
        if(document.getElementById('login-form').checkValidity()){
            e.preventDefault();
            $("#loader").show();
            $.ajax({
                type: "POST",
                url: "action.php",
                data: $('#login-form').serialize()+'&action=login',
                success: function (response) {
                    if(response == 1){ 
                        $("#loader").hide();
                        window.location.href ="profile.php", true;
                    }else{
                        $("#alert").show();
                        $("#result").html(response);
                        $("#loader").hide();
                    }
                    
                }
            });
        }
        return true;
    });

    // forgot password form
    $("#forgot").click(function(e){
        if(document.getElementById('forgot-form').checkValidity()){
            e.preventDefault();
            $("#loader").show();
            $.ajax({
                type: "POST",
                url: "action.php",
                data: $('#forgot-form').serialize()+'&action=forgot',
                success: function (response) {
                    $("#alert").show();
                    $("#result").html(response);
                    $("#loader").hide();
                }
            });
        }
        return true;
    });

});