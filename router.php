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

$router->addRoute('categories', 'GET', 'categoriesController', 'getAll');
$router->addRoute('categories/:id', 'GET', 'categoriesController', 'get');

$router->addRoute('creators', 'GET', 'creatorsController', 'getAll');
$router->addRoute('creators/:id', 'GET', 'creatorsController', 'get');

$router->addRoute('mods', 'GET', 'modsController', 'getAll');
$router->addRoute('mods/:id', 'GET', 'modsController', 'get');


$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);


























































// session_start();
// $action = 'games';
// if (!empty($_GET['action'])) {
//   $action = $_GET['action'];
// }

//Normal routes
// $router->addRoute('games', 'games', 'showPage');
// $router->addRoute('catalog/:id', 'catalog', 'showPage');
// $router->addRoute('catalog/:id/:category', 'catalog', 'showPage');
// $router->addRoute('modpage/:id', 'modpage', 'showPage');
// $router->addRoute('creators', 'creators', 'showCreators');
// $router->addRoute('creator/:id', 'creators', 'showCreator');
// $router->addRoute('login', 'login', 'handleLogin');
// $router->addRoute('logout', 'login', 'handleLogout');
// $router->addRoute('register', 'login', 'handleRegister');

// //Admin
// $router->addRoute('edit/game/:id', 'games', 'showEdit');
// $router->addRoute('new/game/', 'games', 'showNew');
// $router->addRoute('create/game/', 'games', 'create');
// $router->addRoute('update/game/:id', 'games', 'update');
// $router->addRoute('delete/game/:id', 'games', 'delete');

// $router->addRoute('edit/category/:game/:id', 'catalog', 'showEditCategory');
// $router->addRoute('new/category/:game/', 'catalog', 'showNewCategory');
// $router->addRoute('create/category/', 'catalog', 'createCategory');
// $router->addRoute('update/category/:id', 'catalog', 'updateCategory');
// $router->addRoute('delete/category/:id', 'catalog', 'deleteCategory');

// $router->addRoute('edit/mod/:game/:id', 'catalog', 'showEditMod');
// $router->addRoute('new/mod/:game/', 'catalog', 'showNewMod');
// $router->addRoute('create/mod/', 'catalog', 'createMod');
// $router->addRoute('update/mod/:id', 'catalog', 'updateMod');
// $router->addRoute('delete/mod/:id', 'catalog', 'deleteMod');

// $router->addRoute('edit/creator/:id', 'creators', 'showEdit');
// $router->addRoute('new/creator/', 'creators', 'showNew');
// $router->addRoute('create/creator/', 'creators', 'create');
// $router->addRoute('update/creator/:id', 'creators', 'update');
// $router->addRoute('delete/creator/:id', 'creators', 'delete');

// $router->route($action);