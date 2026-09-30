<?php

namespace app\controllers;

use app\database\models\User;

class HomeController
{
    public function index()
    {
        $user = new User;
        $user->delete(['id' => 1]);
        
        return view('home',['title' => 'Home Page']);
    }
}
