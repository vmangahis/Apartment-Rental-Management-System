<?php

namespace App\Http\Controllers;
use App\Models\Rooms;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $room=Rooms::with('tenant')->where('status', 'VACANT')->get();
        $getlastroomid=Rooms::with('tenant')->get();

        return view('dashboard.rooms', compact('room', 'getlastroomid'));
    }

    public function occupied()
    {

        $room=Rooms::with('tenant')->where('status', 'OCCUPIED')->get();
        $getlastroomid=Rooms::with('tenant')->get();

        return view('dashboard.rooms', compact('room', 'getlastroomid'));
    }

    public function addroom(Request $rq)
    {

        $res = '';



        Rooms::create([
            'status' => 'VACANT',
            'tenant_id' => 0
        ]);

        $rooms = Rooms::with('tenant')->get();
        //$last_record = DB::table('rooms')->orderBy('room_id', 'DESC')->first();

        foreach($rooms as $rm)
        {
            if($rm->status == "VACANT")
            {

                $res .= '<tr>'.
            '<th scope="row">'.$rm->room_id.'</th>'.

            '<td>'.'No Occupant'.'</td>'.

            '<td>'.$rm->status.'</td>'.

            '<td>'.
            '<button class="btn btn-primary fs-4 remove-room">Remove Room</button>'.
            '</td>'.
            '</tr>';
            }

        }



        return Response($res);
    }
}
