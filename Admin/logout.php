<?php

    session_start();

    if(isset($_SESSION["adminIsLoggedIn"])){

        if(isset($_GET["action"])){

            include (dirname(dirname(__FILE__))."/app/models/Admin.php");

            $admin = new Admin;

            $admin->logout();
        }
    }else{
        header("Location: login.php?status=loggedout");
    }

?>