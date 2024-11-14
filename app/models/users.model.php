<?php 

require_once './app/models/Model.php';

class usersModel extends Model {
  
  public function __construct() {
    parent::__construct();
  }

  public function getByEmail($email) {
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $query = $this->executeQuery($sql);
    $query = $query->fetch(PDO::FETCH_OBJ);
    return $query;
  }

  public function createUser($name, $email, $pass) {
    $pass = password_hash($pass, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users(username, email, password, admin) VALUES (:name, :email, :pass, 0)";
    $this->executeQueryWithParams($sql, [':name' => $name, ':email' => $email, ':pass' => $pass]);
  } 
}