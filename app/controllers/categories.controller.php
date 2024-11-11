<?php 
require_once './app/models/categories.model.php';

class categoriesController extends Controller {
    public function __construct() {
        parent::__construct(new categoriesModel());
    }

}