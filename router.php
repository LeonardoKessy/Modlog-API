<?php
require_once './config/base_url.php';
require_once './config/db.php';
require_once './libs/router.php';

require_once './app/controllers/Controller.php';
require_once './app/controllers/games.controller.php';
require_once './app/controllers/mods.controller.php';
require_once './app/controllers/categories.controller.php';
require_once './app/controllers/creators.controller.php';
require_once './app/controllers/users.controller.php';

$router = new Router();

$router->addRoute('games', 'GET', 'gamesController', 'getAll');
$router->addRoute('games/:id', 'GET', 'gamesController', 'get');
$router->addRoute('games', 'POST', 'gamesController', 'create');

$router->addRoute('categories', 'GET', 'categoriesController', 'getAll');
$router->addRoute('categories/:id', 'GET', 'categoriesController', 'get');
$router->addRoute('categories', 'POST', 'categoriesController', 'create');

$router->addRoute('creators', 'GET', 'creatorsController', 'getAll');
$router->addRoute('creators/:id', 'GET', 'creatorsController', 'get');
$router->addRoute('creators', 'POST', 'creatorsController', 'create');

$router->addRoute('mods', 'GET', 'modsController', 'getAll');
$router->addRoute('mods/:id', 'GET', 'modsController', 'get');
$router->addRoute('mods', 'POST', 'modsController', 'create');


$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);