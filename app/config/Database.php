<?php
class Database{
    private $username = "root";
    private $password = "";
    private $dbname   = "online_journal";
    private $connection;

    public function __construct()
    {
        $this->connection = new Mysqli($_SERVER["SERVER_NAME"], $this->username, $this->password, $this->dbname);
        if(!$this->connection){
            $this->connction->error;
        }
    }

    private function tableExist($table){
        $sql= "SHOW TABLES FROM $this->dbname LIKE '$table'";
        $result = $this->connection->query($sql);
        if(!$result){
            $this->connection->error;
        }else{
            if($result->num_rows === 1){
                return true;
            }else{
                return false;
            }
        }
    }

    public function safe_data($data){
        return $this->connection->real_escape_string(trim($data));
    }

    public function validate($data, $options =[]){

        if(empty($data)){
            return "Required field missing";
        }else{
            $sanitized_data = $this->safe_data($data);
            if($options["max"] != null){
                if(strlen($sanitized_data) > $options["max"]){
                     $max_val = $options["max"];
                    return "Field value cannot be more than $max_val";
                }
            }
        }
    }

    public function redirect($new_location){
        header("Location: ".$new_location);
    }

    public function insert($table, $parameters=[]){
        if($this->tableExist){
            
            $arrayKeys = array_keys($parameters);
            $columns   = "`".implode("`, ` ".$arrayKeys)."`";
            $values    = "'".implode("', '", $parameters)."'";

            $sql = "INSERT INTO $table ($columns) VALUES($values)";
            $result = $this->connection->query($sql);
            if(!$result){
                $this->connection->error;
            }else{
                return true;
            }
        }else{
            echo "Table $table does not exist";
        }
    }

    public function select($table, $rows="*", $where = null, $order_by = null){
        if($this->tableExist($table)){
            $sql = "SELECT $rows FROM $table";

            if($where != null){
                $sql .= " WHERE $where";
            }

            if($order_by != null){
                $sql .= " WHERE $order_by";
            }

            $result = $this->connection->query($sql);
            if(!$result){
                $this->connection->error;
            }else{
                return $result;
            }
        }
    }

    public function update($table, $parameters=[], $where = null){
        if($this->tableExist($table)){
            $fields_and_values = [];
            foreach($parameters as $column=>$value){

                $fields_and_values = implode(",", $fields_and_values);
  
            }
            $set_columns = implode("," , $fields_and_values);
            $sql = "UPDATE $table SET $set_columns WHERE $where";
            $result = $this->connection->query($sql);
            if(!$result){
                $this->connection->error;
            }else{
                return true;
            }
        }
    }

    public function delete($table, $where){

        if($this->tableExist($table)){
            $sql="DELETE FROM $table WHERE $where";
            $result = $this->connection->error;
            if(!$result){
                $this->connection->error;
            }else{
                return $result;
            }
        }
    }



}

$db = new Database();