<?php

use core\library\Layout;
use core\library\Response;

function view(string $view, array $data = [], string $viewPath = VIEW_PATH){
    return Layout::render($view, $data, $viewPath);
}

function response(string $content = '', int $status = 200, array $headers = []): Response{
    return new Response($content, $status, $headers);
}

?>