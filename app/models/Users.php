<?php 
require_once "../config/Database.php";
class Users extends Database {
    private $table = "users";
    public $isset = null;
    private function __construct()
    {
        parent::__construct();
        if(isset($_POST["submit"])){
            $this->isset == true;
        }
    }

    public function Register(){
        //check if a form is submitted before running this code
        if($this->isset != null){
            //check email duplicate
            $user_email = $_SESSION["email"];
            $result = Database::select($this->table, "email", "email=$user_email");

            if($result->num_rows > 0){
                Database::redirect("../../registration.php?error=duplicate&&email=$user_email");
            } else {
                $parameters = [
                    "username"    => $_POST["username"],
                    "first_name"    => $_POST["first_name"],
                    "last_name"    => $_POST["last_name"],
                    "email"         =>  $_SESSION["email"],
                    "password"      => password_hash($_POST['password'], PASSWORD_DEFAULT)
                ];

                $response = Database::insert($this->table, $parameters);
                if(!$response){
                    echo $response;
                } else {
                    Database::redirect("../../dashboard.php?registration=success");
                }
            }
        }
    }

    public function Login(){

    }

    public function Logout(){

    }

    public function forgot_password(){

    }

    public function save_journal(){

    }

    public function update_profile(){

    }

    public function edit_journal(){

    }

    public function delete_page(){

    }

    public function delete_all_pages(){

    }

    public function delete_acct(){

    }



}

?>