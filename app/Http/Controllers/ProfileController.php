<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    public function index()
    {
        $landlord_name = DB::table('landlord_table')->orderBy('id', 'DESC')->get();
        return view('dashboard.profile')->with('landlord', $landlord_name);
    }
    public function edit(Request $rq){
        $name = $rq->get('landlord-surname');

        $val = Validator::make($rq->all(), ['landlordSurname' => 'required|alpha',
            'landlordFirstname' => 'required|alpha',
            'landlordMiddlename' => 'required|alpha',
            'landlordAge' => 'required',
            'landlordAddress-1' => 'required',
            'landlordCity' => 'required',
            'landlordState' => 'required'
            ],

        // Customized Error messages
        // Add more
            ['landlordSurname.required' => 'Surname cannot be left empty',
                'landlordSurname.alpha' => 'Surname cannot contain special characters/numbers']
        );

        //Show Error
        if($val->fails())
        {
            return response()->json(['code'=> 1, 'error' => $val->errors()->toArray()]);
        }
        DB::table('landlord_table')->update(['surname' => $rq->get('landlordSurname'),
            'firstname' => $rq->get('landlordFirstname'),
            'middlename' => $rq->get('landlordMiddlename'),
            'age' => $rq->get('landlordAge'),

            'address_1' => $rq->get('landlordAddress-1'),
            'address_2' => $rq->get('landlordAddress-2'),
            'city' => $rq->get('landlordCity'),
            'state' => $rq->get('landlordState'),
            ]);

        return response()->json(['value' => [$rq->get('landlordSurname'), $rq->get('landlordFirstname'),
            $rq->get('landlordMiddlename'), $rq->get('landlordAge'),
            $rq->get('landlordAddress-1'),$rq->get('landlordAddress-2'),
            $rq->get('landlordCity'), $rq->get('landlordState')
            ]]);
    }

}
