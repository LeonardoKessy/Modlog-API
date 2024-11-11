<?php
require_once './app/models/games.model.php';

class gamesController extends Controller {
    public function __construct() {
        parent::__construct(new gamesModel());
    }
}