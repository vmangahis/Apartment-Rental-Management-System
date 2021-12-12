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

        $allRoom = Rooms::with('tenant')->count();

        return view('dashboard.rooms', compact('room',  'allRoom'));
    }

    public function occupied()
    {

        $room=Rooms::with('tenant')->where('status', 'OCCUPIED')->get();
        $allRoom =  Rooms::with('tenant')->count();

        return view('dashboard.rooms', compact('room', 'allRoom'));
    }

    public function addroom(Request $rq)
    {

        $res = '';


        $roomNumber = 0;
        if(Rooms::with('tenant')->orderBy('room_number', 'DESC')->first() == null)
        {
            $roomNumber = 1;
        }
        else{
            $lastRoom = (Rooms::with('tenant')->orderBy('room_number', 'DESC')->first());
            $roomNumber = $lastRoom->room_number + 1;
        }
        Rooms::create([
            'status' => 'VACANT',
            'tenant_id' => 0,
            'room_number' => $roomNumber
        ]);

        $rooms = Rooms::with('tenant')->get();
        $roomCount = count($rooms);

        foreach($rooms as $rm)
        {
            if($rm->status == "VACANT")
            {

                $res .= '<tr>'.
            '<th scope="row">'.$rm->room_number.'</th>'.

            '<td>'.'No Occupant'.'</td>'.
                    '<td>'.'-'.'</td>'.
                    '<td>'.'-'.'</td>'.

            '<td>'.$rm->status.'</td>';
            if($roomCount == $rm->room_number)
            {
                $res.='<td>'.
                "<button class='btn btn-primary fs-4 deleteRoom' id=$rm->room_id>Remove Room</button>".
                '</td>';
            }
            else{
                $res.='<td></td>';
            }

                $res.='</tr>';
            }
        }



        return Response($res);
    }

    public function deleteRoom(Request $rq)
    {

        Rooms::where('room_id', $rq->room_id)->delete();

    }
}
