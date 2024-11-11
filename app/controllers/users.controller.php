<?php
require_once './app/models/users.model.php';

class usersController extends Controller {
    public function __construct() {
        parent::__construct(new usersModel());
    }
}