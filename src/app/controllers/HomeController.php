<?php

namespace app\controllers;

use app\database\models\User;

class HomeController
{
    public function index()
    {
        $user = new User;
        $users = $user->find(4);
        $users->firstName = 'Maria';
        $users->lastName = 'Aparecida';
        

        $users->save();

        dd($users);
        return view('home',['title' => 'Home Page']);
    }
}
