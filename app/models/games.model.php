<?php 
require_once './app/models/Model.php';

class gamesModel extends Model {
  
  public function __construct() {
    parent::__construct();
    $this->table = "games";
    $this->fields = array("id", "name", "description", "image");
  }

  public function create($data) {
    extract($data);
    $query = $this->db->prepare("INSERT INTO games(name, description, image) VALUES (:name, :description, :image)");
    $this->executeQueryWithParams($query, [':name' => $name, ':description' => $description, ':image' => $image ?? null]);
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