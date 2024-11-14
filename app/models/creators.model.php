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
}