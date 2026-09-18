<?php

use app\controllers\HomeController;
use app\controllers\LoginController;
use app\controllers\UserController;
use app\middlewares\AuthMiddleware;
use core\library\Router;


/** @var \core\library\App $app */
$router = $app->container->get(Router::class);
$router->add('GET', '/', [HomeController::class, 'index'])->middleware(AuthMiddleware::class);
$router->add('GET', '/product/([a-z\-]+)', [HomeController::class, 'index']);
$router->add('GET', '/login', [LoginController::class, 'index']);
$router->add('POST', '/login', [LoginController::class, 'store']);
$router->add('DELETE', '/user', [UserController::class, 'destroy']);
$router->execute();
