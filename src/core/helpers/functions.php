<?php

use core\library\Layout;

function view(string $view, array $data = [], string $viewPath = VIEW_PATH){
    return Layout::render($view, $data, $viewPath);
}


?>