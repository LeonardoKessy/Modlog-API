<?php
require_once './app/models/Model.php';

class modsModel extends Model {
  
  public function __construct() {
    parent::__construct();
    $this->table = "mods";
    $this->fields = array("id", "game_id", "category_id", "creator_id", "name", "description", "creation_date", "github_link");
  }

  public function create($data) {
    extract($data);
    $query = $this->db->prepare("INSERT INTO mods(game_id, category_id, creator_id, name, description, creation_date, github_link, download_link, image) VALUES (:game, :category, :creator, :name, :description, :creation_date, :github_link, :download_link, :image)");
    $this->executeQueryWithParams($query, [':game' => $game, ':category' => $category, ':creator' => $creator, ':name' => $name, ':description' => $description, ':creation_date' => $creation_date, ':github_link' => $github_link, ':download_link' => $download_link, ':image' => $image ?? null]);
  }

  public function update($data) {
    extract($data);
    $queryText = "UPDATE mods SET game_id=:game, category_id=:category, creator_id=:category, name=:name, description=:description, creation_date=:creation_date, github_link=:github_link, download_link=:download_link" .  (isset($image) ? ", image=:image " : ' ') . "WHERE id = :id";
    $query = $this->db->prepare($queryText);
    $vars = [
      ':id' => $id,
      ':name' => $name, 
      ':category' => $category,
      ':creator' => $creator,
      ':game' => $game,
      ':description' => $description,
      ':creation_date' => $creation_date,
      ':github_link' => $github_link,
      ':download_link' => $download_link,
    ];
    if (isset($image)) $vars[':image'] = $image;
    $this->executeQueryWithParams($query, $vars);
  }

  public function delete($id) {
    $query = $this->db->prepare("DELETE FROM mods WHERE id = :id");
    $this->executeQueryWithParams($query, [':id' => $id]);
  }
}