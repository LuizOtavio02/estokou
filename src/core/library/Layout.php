<?php

namespace core\library;

use core\exceptions\ViewNotFoundException;
use League\Plates\Engine;

class Layout
{
    public static function render(string $view, array $data = [], string $viewPath = VIEW_PATH, int $status = 200): Response
    {
        if (!file_exists($viewPath . '/' . $view . '.php')) {
            throw new ViewNotFoundException("View not found: $view");
        }

        $templates = new Engine($viewPath);

        return response(content:$templates->render($view, $data), status: $status, headers:['Content-Type' => 'text/html']);
    }
}
