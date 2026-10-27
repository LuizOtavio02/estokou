<?php

namespace app\controllers;

use core\auth\Auth;
use core\library\Request;

class LoginController
{
    public function __construct(private Auth $auth) {
    }
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
            $request->session->flash()->set($validated->getErrors());
            return back();
        }

        if ($this->auth->attempt($request->get('email'), $request->get('password'))) {
            return redirect('/');
        }

        $request->session->flash()->set(['error' => 'Invalid credentials']);
        die();
    }

    public function destroy()
    {
        $this->auth->logout();

        return redirect('/');
    }
}
