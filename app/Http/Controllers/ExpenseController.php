<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index()
    {

        $expenses= DB::table('expenses')->get();
        return view('dashboard.expense', compact('expenses'));
    }
}
