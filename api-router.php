<?php
require_once './libs/Router.php';
require_once './app/controllers/infocontable_app.controller.php';
require_once './app/controllers/categorias_app.controller.php';
// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('infoContable', 'GET', 'InfoContableApiController', 'getinfocs');
$router->addRoute('infoContable/:ID', 'GET', 'InfoContableApiController', 'getinfoc');
$router->addRoute('infoContable/:ID', 'DELETE', 'InfoContableApiController', 'deleteinfo');
$router->addRoute('infoContable', 'POST', 'InfoContableApiController', 'insertinfo'); 
$router->addRoute('infoContable/:ID', 'PUT', 'InfoContableApiController', 'updateinfo'); 

$router->addRoute('categoria', 'GET', 'CategoriasApiController', 'gets');
$router->addRoute('categoria/:ID', 'GET', 'CategoriasApiController', 'get');
$router->addRoute('categoria/:ID', 'DELETE', 'CategoriasApiController', 'delete');
$router->addRoute('categoria', 'POST', 'CategoriasApiController', 'insert');
$router->addRoute('categoria/:ID', 'PUT', 'CategoriasApiController', 'update'); 
// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
