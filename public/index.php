<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PaginasController;



$router = new Router();

// Zona Publica
$router->get("/ruralpyme/test/Proyecto-Andanatura/public/", [PaginasController::class, "index"]);
$router->get("/acelerapyme/test/Proyecto-Andanatura/public/", [PaginasController::class, "index"]);
$router->post("/ruralpyme/test/Proyecto-Andanatura/public/", [PaginasController::class, "index"]);
$router->post("/acelerapyme/test/Proyecto-Andanatura/public/", [PaginasController::class, "index"]);


$router->comprobarRutas();