<?php 
require_once './app/models/mods.model.php';

class modsController extends Controller {
    public function __construct() {
        parent::__construct(new modsModel());
    }
}