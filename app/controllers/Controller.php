<?php 

require_once './app/views/JSONView.php';

class Controller {
    protected $view;
    protected $model;

    public function __construct($model) {
        $this->view = new JSONView();
        $this->model = $model;
    }

    public function getAll($req, $res) {

        $sort = false;
        if(isset($req->query->sort))
            $sort = $req->query->sort;

        $order = false;
        if(isset($req->query->order))
            $order = $req->query->order;

        $wheres = [];
        foreach ($this->model->fields as $key => $value) {
            if (array_key_exists($key, (array) $req->query)) {
                $wheres[$key] = $req->query->$key;
            }
        }

        $page = 1;
        if(isset($req->query->page)) 
            $page = $req->query->page;
        $limit = 0;
        if(isset($req->query->limit))
            $limit = $req->query->limit;


        $results = $this->model->getAll($sort, $order, $wheres, $page, $limit);
        if (!$results) 
            return $this->view->response("No data found with this criteria...", 404);
        $this->view->response($results);
    }

    public function get($req, $res) {
        $id = $req->params->id;
        $result = $this->model->get($id);
        if (!$result) 
            return $this->view->response("No element with id $id in DB.", 404);

        $this->view->response($result);
    }

    public function create($req, $res) {
        $values = [];
        foreach ($this->model->fields as $key => $value) {
            if (array_key_exists($key, (array) $req->body)) {
                $values[$key] = $req->body->$key;
            }
        }

        $result = $this->model->create($values);
        if ($result)
            $this->view->response("Created succesfully.");
        else 
            $this->view->response("Required fields are missing.", 400);
    }
}