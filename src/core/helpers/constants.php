<?php 

define('NAME', 'Luiz Otavio');
define('REQUEST_URI',parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
define('REQUEST_METHOD',$_SERVER['REQUEST_METHOD']);
define('BASE_PATH', dirname(__DIR__,2));
define('VIEW_PATH', BASE_PATH . '/resources/views');
define('VIEW_PATH_CORE', BASE_PATH . '/core/resources/views');



?>