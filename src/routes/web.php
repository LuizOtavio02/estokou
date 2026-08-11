<?php

use app\controllers\HomeController;
use core\library\Router;

try {
    $router = new Router;
    $router->add('GET','/',[HomeController::class, 'index']);
    $router->add('GET','/product/([a-z\-]+)',[HomeController::class, 'index']);
    $router->execute();
} catch (\Throwable $e) {
    # code...
}

?>