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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validated->hasErrors()) {
            //dd($validated->getErrors());
            return back()->with($validated->getErrors());
        }

        dd($validated->data);
    }
}
