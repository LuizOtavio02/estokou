<?php

use app\controllers\HomeController;
use app\controllers\LoginController;
use core\library\Router;


/** @var \DI\Container $container */
$router = new Router($container);
$router->add('GET', '/', [HomeController::class, 'index']);
$router->add('GET', '/product/([a-z\-]+)', [HomeController::class, 'index']);
$router->add('GET', '/login', [LoginController::class, 'index']);
$router->add('POST', '/login', [LoginController::class, 'show']);
$router->execute();
