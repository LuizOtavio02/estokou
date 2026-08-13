<?php

use app\controllers\HomeController;
use core\library\Router;


/** @var \DI\Container $container */
$router = new Router($container);
$router->add('GET', '/', [HomeController::class, 'index']);
$router->add('GET', '/product/([a-z\-]+)', [HomeController::class, 'index']);
$router->execute();
