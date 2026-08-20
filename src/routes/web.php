<?php

use app\controllers\HomeController;
use app\controllers\LoginController;
use core\library\Router;


/** @var \core\library\App $app */
$router = $app->container->get(Router::class);
$router->add('GET', '/', [HomeController::class, 'index']);
$router->add('GET', '/product/([a-z\-]+)', [HomeController::class, 'index']);
$router->add('GET', '/login', [LoginController::class, 'index']);
$router->add('POST', '/login', [LoginController::class, 'show']);
$router->execute();
