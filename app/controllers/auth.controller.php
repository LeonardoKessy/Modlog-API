<?php
require_once './app/models/users.model.php';

class authController extends Controller {
    public function __construct() {
        parent::__construct(new usersModel());
    }

    public function getToken() {
        $auth_header = $_SERVER['HTTP_AUTHORIZATION'];
        $auth_header = explode(' ', $auth_header); 

        if(count($auth_header) != 2 || $auth_header[0] != 'Basic') 
            return $this->view->response("Wrong request.", 400);

        $user_pass = base64_decode($auth_header[1]);

        $user_pass = explode(':', $user_pass); 

        $user = $this->model->getByEmail($user_pass[0]);

        if($user == null || !password_verify($user_pass[1], $user->password)) 
            return $this->view->response("Wrong password.", 400);
        
            
        $token = createJWT(array(
            'sub' => $user->id,
            'email' => $user->email,
            'role' => $user->admin == 1 ? 'admin' : 'user',
            'iat' => time(),
            'exp' => time() + 3600
        ));

        return $this->view->response($token);
    }

    public function register($req, $res) {
        if ($req->body->username && $req->body->email && $req->body->password) 
            return $this->model->createUser($req->body->username, $req->body->email, $req->body->password);

        return $this->view->response("Missing or wrong data.");
    }

}