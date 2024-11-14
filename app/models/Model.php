<?php

class Model {
  protected $db;
  public $table = "";
  public $fields = []; // Fieldname<String> => Required<Boolean>

  public function __construct() {
    try {
      $this->db = new PDO('mysql:host='. MYSQL_HOST . ';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
    } catch (Exception) {
      $this->createDB();
    }
    $this->deploy();
  }

  public function getAll($sort = false, $order = false, $wheres =[], $page = 1, $limit = 0) {  
    $sql = "SELECT * FROM $this->table";

    $isFirst = true;
    foreach ($wheres as $key => $value) {
      if ($isFirst) $sql .= " WHERE ";
      else $sql .= " AND ";
      $sql .= "$key = '$value'";
      $isFirst = false;
    }
    
    if (key_exists($sort, $this->fields)) { 
      $sql .= " ORDER BY $sort ";
      switch ($order) {
        case 'DESC': $sql .='DESC'; break;
        default: $sql .= 'ASC'; break;
      }
    }

    if ($limit != 0) {
      $offset = ($page -1) * $limit;
      $sql .= " LIMIT $offset, $limit";
    }

    $query = $this->executeQuery($sql);
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    return $results;
  }

  public function get($id) {
    $sql = "SELECT * FROM $this->table WHERE id = $id";

    $query = $this->executeQuery($sql);
    $result = $query->fetch(PDO::FETCH_OBJ);
    return $result;
  }

  public function create($values = []) {
    $sql = "INSERT INTO $this->table(";
    $insertFields = "";
    $insertValues = ") VALUES (";
    foreach ($this->fields as $key => $value) {
      if ($value == true && !key_exists($key, $values))
        return false;
      
      if ($key == 'id') continue;
      
      if (key_exists($key, $values)) {
        $insertFields .= $key . ", ";
        $insertValues .= "'" . $values[$key] . "', ";
      }
    }

    $sql .= trim($insertFields, ', ') . trim($insertValues, ', ') . ")";

    $this->executeQuery($sql);
    return true;
  }

  public function patch($values = []) {
    if (!key_exists('id', $values))
      return false;

    $sql = "UPDATE $this->table SET ";
    foreach ($this->fields as $key => $value) {
      if ($key == 'id') continue;
      if (key_exists($key, $values)) {
        $sql .= "$key='$values[$key]' ";
      }
    }
    $sql .= "WHERE id = '$values[id]'";

    $this->executeQuery($sql);
    return true;
  }

  public function delete($id) {
    $sql = "DELETE FROM $this->table WHERE id = '$id'";
    
    $this->executeQuery($sql);
  }  

  public function executeQuery($sql) {
    $query = $this->db->prepare($sql);
    $query->execute();
    return $query;
  }

  public function executeQueryWithParams($query, $params) {
    $query = $this->db->prepare($query);
    $query->execute($params);
    return $query;
  }


  public function createDB() {
    $sql_connection = "mysql:host=". MYSQL_HOST .";charset=utf8mb4";
    $pdo = new PDO($sql_connection, MYSQL_USER, MYSQL_PASS);
    $pdo->exec("CREATE DATABASE ". MYSQL_DB ." CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    header('Location: ' . BASE_URL);
  }

  public function deploy() {
    $query = $this->db->query('SHOW TABLES');
    $tables = $query->fetchAll();
    if (count($tables) == 0) {
      $sql = file_get_contents('./modlog.sql');
      $sqlStatements = explode(";", $sql); 
      foreach ($sqlStatements as $statement) {
        if (trim($statement) != "") {
            $this->db->exec($statement);
        }
      }
    }
  }
}