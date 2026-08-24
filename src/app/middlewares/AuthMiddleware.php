<?php

namespace app\middlewares;

use Closure;
use core\interfaces\MiddlewareInterface;
use core\library\Request;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next) 
    {
        dump('authMiddleware');

        return $next($request);
    }
}
