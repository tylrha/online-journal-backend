<?php
include (dirname(dirname(__FILE__)). "/config/config.php");
include (dirname(dirname(__FILE__)). "/config/Database.php");

class Admin extends Database{
    private $table = "admin";
    private $tbl_users = "users";
    private $tbl_notes = "notes";

    public $isset = null;

    public function construct(){
        parent ::__construct();
        
        if(isset($_POST["submit"])){
            $this->isset == true;
        }
    }

    public function Login($emailId, $password){
        $result = Database::select($this->table, "*", "email='$emailId'");

        if ($result->num_rows < 1){
            Database::redirect("login.php?login=fail&for=emailId");
        }else{
            $row = $result->fetch_assoc();
            $password_verified = password_verify($password, $row["password"]);
            
            if(!$password_verified){
                Database::redirect("login.php=fail&for=password");
            }else{

                session_start();

                $_SESSION["emailId"] ="$emailId" ;
                $_SESSION["adminIsLoggedIn"] = true;

                $duration = time() + (60 * 60 * 24 * 365);
                setcookie("admin_id", $emailId, $duration);
                setcookie("password", $row["password"], $duration);
    
                Database::redirect("dashboard.php?login=success");

            }
        }
    }


    // public function forgot_password($email){

    //     $base_url = BASE_URL;
    //     $link = "$base_url/resetpassword.php";
    //     $from = "rocketsoftwareltd@gmail.com";
    //     $to = $email;
    //     $subject = "Password Reset Link";
    //     $message = "Hello, Click this link $link to reset your password.<br>You can ignore this message if you did not for a password reset";

    // }

    public function logout(){
        session_destroy();
        $this->redirect(BASE_URL."/admin/login.php?logout=success");
        
    }
}


