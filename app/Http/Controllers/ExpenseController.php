<?php

namespace App\Http\Controllers;

class ExpenseController extends Controller
{
    public function index()
    {


        return view('dashboard.expense');
    }
}
