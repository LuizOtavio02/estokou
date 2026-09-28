<?php

namespace app\controllers;

use app\database\models\User;

class HomeController
{
    public function index()
    {
        $user = new User;
        $user->firstName = 'Luiz';
        $user->lastName = 'Otavio';
        $user->save();
        
        return view('home',['title' => 'Home Page']);
    }
}
