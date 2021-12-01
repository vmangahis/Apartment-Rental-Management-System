<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = DB::table('payments')->get();
        return view('dashboard.payment', compact('payments'));
    }
}
