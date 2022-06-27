<?php

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

    public function Login(){
        $result = Database::select($this->table, "*", "email=email");

        if ($result->num_rows < 1){
            Database::redirect("login.php?login=fail&for=password");
        }else{
            sesson_start();

            $_SESSION[""] ="" ;
            
            $duration = time() + (60 * 60 * 24 * 365);
            setcookie("admin_id", $adminID, $duration);
            setcookie("password", $row["password"], $duration);

            Database::redirect("index.php?login=success");
        }
    }


    public function forgot_password($email){

        $base_url = BASE_URL;
        $link = "$base_url/resetpassword.php";
        $from = "rocketsoftwareltd@gmail.com";
        $to = $email;
        $subject = "Password Reset Link";
        $message = "Hello, Click this link $link to reset your password.<br>You can ignore this message if you did not for a password reset";

    }

    public function logout(){
        session_destroy();
        $this->redirect(BASE_URL."/admin/login.php?logout=success");
        
    }
}


