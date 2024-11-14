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

        $sort = $req->query->sort ?? false;

        $order = $req->query->order ?? false;

        $wheres = [];
        foreach ($this->model->fields as $key => $value) 
            if (array_key_exists($key, (array) $req->query)) 
                $wheres[$key] = $req->query->$key;

        $page = $req->query->page ?? 0;

        $limit = $req->query->limit ?? 0;


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
        if (!checkAdmin($res))
            return $this->view->response('Access denied.', 403);

        $values = [];
        foreach ($this->model->fields as $key => $value) 
            if (array_key_exists($key, (array) $req->body)) 
                $values[$key] = $req->body->$key;

        $result = $this->model->create($values);
        if ($result)
            $this->view->response("Created succesfully.");
        else 
            $this->view->response("Required fields are missing.", 400);
    }

    public function patch($req, $res) {
        if (!checkAdmin($res))
            return $this->view->response('Access denied.', 403);

        $values = [];
        foreach ($this->model->fields as $key => $value) 
            if (array_key_exists($key, (array) $req->body)) 
                $values[$key] = $req->body->$key;

        $result = $this->model->patch($values);
        if ($result)
            $this->view->response("Modified succesfully.");
        else 
            $this->view->response("No element with id " . $values['id'] ." found in DB.", 400);
    }

    public function delete($req, $res) {
        if (!checkAdmin($res))
            return $this->view->response('Access denied.', 403);
        
        $id = $req->params->id;
        $this->model->delete($id);
        
        return $this->view->response("Deleted succesfully.");
    }
}