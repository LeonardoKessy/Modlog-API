<?php
require_once './app/models/Model.php';

class categoriesModel extends Model {
  
  public function __construct() {
    parent::__construct();
    $this->table = "categories";
    $this->fields = array(
      "id" => false, 
      "id_game" => true, 
      "name" => true
    );
  }

  public function update($data) {
    extract($data);
    $query = $this->db->prepare("UPDATE categories SET name=:name WHERE id = :id");
    $this->executeQueryWithParams($query, [':name' => $name, ':id' => $id]);
  }

  public function delete($id) {
    $query = $this->db->prepare("DELETE FROM categories WHERE id = :id");
    $this->executeQueryWithParams($query, [':id' => $id]);
  }
}