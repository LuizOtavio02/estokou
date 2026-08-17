<?php

namespace app\controllers;

use core\library\Request;

class LoginController
{
    public function index()
    {
        return view('login', [
            'title' => 'login'
        ]);
    }

    public function show(Request $request)
    {
        dd($request);
    }
}
