<?php

namespace app\controllers;

use app\database\models\User;

class HomeController
{
    public function index()
    {
        $user = new User;
        $users = $user->select('firstName')->where('id', '>', '1')->first();
        dd($users);
        return view('home',['title' => 'Home Page']);
    }
}
