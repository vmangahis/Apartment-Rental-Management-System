<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = DB::table('payments')->get();
        $tenants = DB::table('tenants')->get();
        return view('dashboard.payment', compact('payments', 'tenants'));
    }

    public function addPayment(Request $rq)
    {
        //DB::table('')
        return response()->json(['response' => 'Successfully called controller']);
    }
}
