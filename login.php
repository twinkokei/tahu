<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Page </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <script src="assets/jquery-3.min.js"></script>
<style type="text/css">
    html{
        background-image: url("bg.jpg");
    }
    body{
        background-image: url("bg-body.jpg");
    }
    .alert {
        display: none;
    }
</style>
    </head>
    <body>
        <div class="login_logo"></div>
        <div class="form-box" id="login-box">
            <div class="header">
                <div class="bg-logo">
                    <span style="font-size: 3em !important;">
                            <strong>Login</strong>
                    </span>
                </div>
            </div>        
            <form id="form_login">
                <div class="body bg-white">
                    <br>
                     <div class="alert alert-warning alert-dismissable">
                        <i class="fa fa-warning"></i>
                        <button class="close" aria-hidden="true" data-dismiss="alert" type="button"></button>
                        <b>Error !</b>
                        User login or Password incorrect
                    </div>
                    <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                        <input style="border:1px solid #eee;" required type="text" name="i_login" class="form-control" placeholder="User Login"/>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                        <input style="border:1px solid #eee;" required type="password" name="i_password" class="form-control" placeholder="Password"/>
                    </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-info btn-block" style="margin-top:10px;">LOGIN</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
<script type="text/javascript">
    $("#form_login").submit(function(e) {

    var url = "controllers/login.php?page=login"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $("#form_login").serialize(), // serializes the form's elements.
           dataType: 'json',
           success: function(data)
           {
               login_response(data); // show response from the php script.
           }
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});

    function login_response(status){
        if (status ==1) {
            window.location.href = "controllers/home.php";
        }  else {
                  $(".alert").fadeIn(1000, function(){      
                    $(".alert").fadeOut(2000);
                });
       }
    }
</script>