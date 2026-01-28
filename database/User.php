<?php
class User{
    private $conn;
    private $table_name = 'user';

    public function __construct($db){
        $this->conn = $db;
    }

    public function register($role, $username, $email, $password){
        $query = "INSERT INTO {$this->table_name}(role, username, email, password) VALUES(:role, :username, :email, :password)";

        $stmt = $this->conn->prepare($query);

        //Bind parameters
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function login($email, $password){
        $query = "SELECT id, role, username, email, password FROM {$this->table_name} WHERE email = :email";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email',$email);
        $stmt->execute();

        if($stmt->rowCount()>0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password, $row['password'])){
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                return true;
            }   
        }
        return false;
}
}
?>