<?php

class Request {
    public $body = null;
    public $params = null;
    public $query = null;

    public function __construct() {
        try {
            $json = file_get_contents('php://input');
            $this->body = json_decode($json);
        }
        catch (Error $e) {
            $this->body = null;
        }
        $this->query = (object) $_GET;
    }
}