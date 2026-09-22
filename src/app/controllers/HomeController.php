<?php

namespace app\controllers;

use app\database\models\User;

class HomeController
{
    public function index()
    {
        $user = User::where('id','>','7');
        dd($user);
        return view('home',['title' => 'Home Page']);
    }
}
