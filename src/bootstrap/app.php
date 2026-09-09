<?php

use core\library\App;

require '../core/helpers/constants.php';
require '../core/helpers/functions.php';

$app = App::create()
    ->withSession()
    ->withEnvironmentVariables()
    ->withDependencyInjectionContainer()
    ->withServiceContainer();
