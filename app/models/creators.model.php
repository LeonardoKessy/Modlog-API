<?php 
require_once './app/models/Model.php';

class creatorsModel extends Model {

  public function __construct() {
    parent::__construct();
    $this->table = "creators";
    $this->fields = array(
      "id" => false, 
      "name" => true, 
      "profile_link" => true
    );
  }

  public function update($data) {
    extract($data);
    $query = $this->db->prepare("UPDATE creators SET name=:name, profile_link=:link WHERE id = :id");
    $this->executeQueryWithParams($query, [':name' => $name, ':link' => $link, ':id' => $id]);
  }

  public function delete($id) {
    $query = $this->db->prepare("DELETE FROM creators WHERE id = :id");
    $this->executeQueryWithParams($query, [':id' => $id]);
  }
}