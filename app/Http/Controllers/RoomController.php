<?php

namespace App\Http\Controllers;
use App\Models\Rooms;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function index()
    {
        $rooms=DB::table('rooms')->get();
        return view('dashboard.rooms')->with('room', $rooms);
    }
}
