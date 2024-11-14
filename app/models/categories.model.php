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
}