$(document).ready(function(){
    $("#login_btn").click(function(){
        var username = $("#email").val();
        var password = $("#password").val();
        json = {'username' : username, 'password' : password};
        $.post("index.php/C_login/api_login", json, function(data){
            if(data.status == 0){

                alert(data.msg);
            }else{

                if ($('#remember_me').is(':checked')) {
                    // save username and password
                    localStorage.userName = $('#email').val();
                    localStorage.password = $('#password').val();
                    localStorage.checkBoxValidation = $('#remember_me').val();
                } else {
                    localStorage.userName = '';
                    localStorage.password = '';
                    localStorage.checkBoxValidation = '';
                }

                window.location.href  = "index.php/C_manual";
            }
        }, "json");
    });
});