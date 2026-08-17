<?php

use core\library\Request;

require '../core/helpers/constants.php';
require '../core/helpers/functions.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__,2));
$dotenv->load();

$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    Request::class => Request::create()
]);
$container = $builder->build();

?>