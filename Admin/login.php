<?php

    // require ("..app/models/Admin.php");
    include (dirname(dirname(__FILE__))."/app/models/Admin.php");
    

    $incorrect_password = $incorrect_emailId = " ";

    if(isset($_POST["submit"])){
        $admin = new Admin;
        $admin->login($_POST["emailId"], $_POST["password"]);
    }
    if(isset($_GET["login"]) && $_GET["login"] == "fail"){

        switch ($_GET["for"]) {
            case 'emailID':
                $incorrect_emailId = '<div class="alert alert-danger"><strong>Incorrect Email</strong></div>';
                break;
            
            case 'password':
                $incorrect_password = '<div class="alert alert-danger"><strong>Incorrect Password</strong></div>';
            break;
            
            default:
                header("Location: login.php");
            break;
        }
    }

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>|SJN| -- ADMIN</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>
<body>

    <header class="nav-bar header text-white">
        <div class="d-flex justify-content-between p-2">
            
            <div class="navbar-brand">
                <h1><i class="bi bi-journals"></i>|SJN|</h1>
            </div>
            <div class="p-4">
            <h3>Welcome Back!</h3>
            </div>
        </div>
    </header>
    <div class="container form-body text-white">
        <div class="row justify-content-center">
            <div class="col-md-5 text-center"><br>
            <h2>LOGIN TO CONTINUE</h2><br>                
                <?= $incorrect_password ?>
                <?= $incorrect_emailId ?>
                <form action="login.php" method="post">
                    <div class="form-group">
                    <input type="email" name="emailId" class="form-control form-control-lg"  placeholder="Your Email">
                    </div>
                    <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg " placeholder="Your Password">
                    </div>
                    <div class="form-group mt-3">
                    <button type="submit" name="submit" class="btn btn-lg bg-light btn-lg font-weight-bold text-dark">SIGN IN</button>
                    </div>
            
                    <div class="my-2 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                        </div>
                        <a href="#" class="auth-link text-black">Forgot password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>