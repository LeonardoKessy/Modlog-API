<?php 
require_once './app/models/Model.php';

class gamesModel extends Model {
  
  public function __construct() {
    parent::__construct();
    $this->table = "games";
    $this->fields = array(
      "id" => false, 
      "name" => true, 
      "description" => false, 
      "image" => false
    );
  }



  public function update($data) {
    extract($data);
    $queryText = "UPDATE games SET name=:name, description=:description" .  (isset($image) ? ", image=:image " : ' ') . "WHERE id = :id";
    $query = $this->db->prepare($queryText);
    $vars = [
      ':id' => $id,
      ':name' => $name, 
      ':description' => $description
    ];
    if (isset($image)) $vars[':image'] = $image;
    $this->executeQueryWithParams($query, $vars);
  }

  public function delete($id) {
    $query = $this->db->prepare("DELETE FROM `games` WHERE id = :id");
    $this->executeQueryWithParams($query, [':id' => $id]);
  }
}