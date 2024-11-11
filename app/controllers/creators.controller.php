<?php
require_once './app/models/creators.model.php';

class creatorsController extends Controller {
  public function __construct() {
      parent::__construct(new creatorsModel());
  }
}