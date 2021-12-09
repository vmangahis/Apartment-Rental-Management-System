<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{

    public function authenticate(Request $rq)
    {
        $creds = $rq->validate([

        ]);
    }

}
