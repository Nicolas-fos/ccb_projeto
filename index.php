<?php
session_name("CCB");
session_start();
require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL);

$router->namespace("APP\Controller");

$router->get("/", "HomeController:index");
$router->get("/inicio", "HomeController:index");


$router->group("novo_evento");
$router->get("/","NovoEventoController:index");
$router->post("/salvar", "NovoEventoController:salvar");

$router->group('evento');
$router->get("/","NovoEventoController:index");
$router->post("/salvar", "NovoEventoController:salvar");
$router->get("/list_eventos", "NovoEventoController:eventos");



$router->group("nova_comum");
$router->get("/","ComunsController:index");
$router->post("/salvar", "ComunsController:salvar");
/**
 * ERROR
 */
$router->get("/ops/{error}", "HomeController:error");

/**
 * This method executes the routes
 */
$router->dispatch();

/*
* Redirect all errors
*/
if ($router->error()) {
    var_dump($router->error());
    //$router->redirect("/ops/{$router->error()}");
}