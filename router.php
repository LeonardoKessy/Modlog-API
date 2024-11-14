<?php
require_once './config/base_url.php';
require_once './config/db.php';
require_once './libs/router.php';

require_once './app/middlewares/Middleware.php';
require_once './app/middlewares/jwt.auth.middleware.php';
require_once './libs/jwt.php';

require_once './app/controllers/Controller.php';
require_once './app/controllers/games.controller.php';
require_once './app/controllers/mods.controller.php';
require_once './app/controllers/categories.controller.php';
require_once './app/controllers/creators.controller.php';
require_once './app/controllers/auth.controller.php';

$router = new Router();

$router->addMiddleware(new JWTAuthMiddleware);

$router->addRoute('games', 'GET', 'gamesController', 'getAll');
$router->addRoute('games/:id', 'GET', 'gamesController', 'get');
$router->addRoute('games', 'POST', 'gamesController', 'create');
$router->addRoute('games', 'PATCH', 'gamesController', 'patch');
$router->addRoute('games/:id', 'DELETE', 'gamesController', 'delete');

$router->addRoute('categories', 'GET', 'categoriesController', 'getAll');
$router->addRoute('categories/:id', 'GET', 'categoriesController', 'get');
$router->addRoute('categories', 'POST', 'categoriesController', 'create');
$router->addRoute('categories', 'PATCH', 'categoriesController', 'patch');
$router->addRoute('categories/:id', 'DELETE', 'categoriesController', 'delete');

$router->addRoute('creators', 'GET', 'creatorsController', 'getAll');
$router->addRoute('creators/:id', 'GET', 'creatorsController', 'get');
$router->addRoute('creators', 'POST', 'creatorsController', 'create');
$router->addRoute('creators', 'PATCH', 'creatorsController', 'patch');
$router->addRoute('creators/:id', 'DELETE', 'creatorsController', 'delete');

$router->addRoute('mods', 'GET', 'modsController', 'getAll');
$router->addRoute('mods/:id', 'GET', 'modsController', 'get');
$router->addRoute('mods', 'POST', 'modsController', 'create');
$router->addRoute('creators', 'PATCH', 'creatorsController', 'patch');
$router->addRoute('mods/:id', 'DELETE', 'modsController', 'delete');

$router->addRoute('users/register', 'POST', 'authController', 'register');
$router->addRoute('users/token', 'GET', 'authController', 'getToken');


$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);