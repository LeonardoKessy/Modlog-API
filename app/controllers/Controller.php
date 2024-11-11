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

        $orderBy = false;
        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;

        $order = false;
        if(isset($req->query->order))
            $order = $req->query->order;

        $wheres = [];
        foreach ($this->model->fields as $key => $value) {
            if (array_key_exists($value, (array) $req->query)) {
                $wheres[$value] = $req->query->$value;
            }
        }

        $page = 1;
        if(isset($req->query->page)) 
            $page = $req->query->page;
        $limit = 0;
        if(isset($req->query->limit))
            $limit = $req->query->limit;


        $results = $this->model->getAll($orderBy, $order, $wheres, $page, $limit);
        if (!empty($results)) 
            $this->view->response($results);
    }

    public function get($req, $res) {
        if (!empty($req->params->id)) {
            $result = $this->model->get($req->params->id);
            if (!empty($result)) 
                $this->view->response($result);
        }
    }
}