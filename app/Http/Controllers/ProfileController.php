<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $landlord_name = DB::table('landlord_table')->orderBy('id', 'DESC')->get();



        return view('dashboard.profile')->with('landlord', $landlord_name);
    }

}
