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

}