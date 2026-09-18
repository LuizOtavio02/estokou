<?php

namespace app\controllers;

use core\library\Request;

class UserController
{
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'user' => 'required',
        ]);

        if ($validated->hasErrors()) {
            //dd($validated->getErrors());
            return back()->with($validated->getErrors());
        }

        dd($validated->data);
    }
}
