<?php 

require_once './app/models/Model.php';

class usersModel extends Model {
  
  public function __construct() {
    parent::__construct();
  }

  public function createUser($name, $email, $pass) {
    $pass = password_hash($pass, PASSWORD_BCRYPT);
    $query = $this->db->prepare("INSERT INTO users(username, email, password, admin) VALUES (:name, :email, :pass, 0)");
    $this->executeQueryWithParams($query, [':name' => $name, ':email' => $email, ':pass' => $pass]);
  } 
}