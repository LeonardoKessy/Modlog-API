<?php
require_once './app/models/Model.php';

class modsModel extends Model {
  
  public function __construct() {
    parent::__construct();
    $this->table = "mods";
    $this->fields = array(
      "id" => false, 
      "game_id" => true, 
      "category_id" => true, 
      "creator_id" => true, 
      "name" => true, 
      "description" => false, 
      "creation_date" => true, 
      "github_link" => false, 
      "download_link" => true, 
      "image" => false
    );
  }
}