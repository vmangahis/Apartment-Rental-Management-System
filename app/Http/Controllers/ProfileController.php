<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function index(Request $rq)
    {
        $landlord_name = DB::table('landlord_table')->orderBy('id', 'DESC')->get();

            if($rq->ajax())
            {
                return response()->json(['response' => $landlord_name]);
            }




        return view('dashboard.profile')->with('landlord', $landlord_name);
    }

    public function change_username(Request $rq)
    {
        $validator = Validator::make($rq->all(), ['old-username-input' => 'required',
            'new-username-input' => 'required|min:5',
            'password-input' => 'required'],

            ['old-username-input.required' => 'This is a required field',
                'new-username-input.required' => 'This is a required field',
                'password-input.required' => 'This is a required field']
        );

        //Missing field
        if($validator->fails())
        {
            return response()->json(['code' => 5, 'error' => $validator->errors()->toArray()]);
        }

        $username = DB::table('landlord_login')->select('username', 'password')->get();


        if($username[0]->username != $rq->get('old-username-input'))
        {
            return response()->json(['code' => 8, 'error' => ['old-username-input'=>'Incorrect username. Please try again.']]);
        }

        else if($rq->get('new-username-input') == $rq->get('old-username-input')){
            return response()->json(['code' => 10, 'error' => ['new-username-input' => 'New username cannot be the old username']]);
        }

        else if(!Hash::check($rq->get('password-input'), $username[0]->password))
        {
            return response()->json(['code' => 6, 'error' => ['password-input' => 'Incorrect password. Please try again']]);
        }

        else{
            DB::table('landlord_login')->update(['username' => $rq->get('new-username-input')]);
            return response()->json(['code' => 0, 'response' => 'Username changed']);
        }


        return response()->json(['code' => 1 ,'response' => 'unknown']);
    }

    public function change_password(Request $rq)
    {
        $val = Validator::make($rq->all(), ['current-username-input' => 'required|string',
            'new-password-input' => 'required|min:5|max:128'
        ],
        // Custom Messages
        ['current-username-input.required' => 'This field cannot be empty.',
            'new-password-input.required' => 'This field cannot be empty',
            'new-password-input.min' => 'Password should not be less than 5 characters'
        ]
        );

        //If something is missing
        if($val->fails())
        {
            return response()->json(['code' => 5, 'error' => $val->errors()->toArray()]);
        }

        $admin = DB::table('landlord_login')->select('username','password')->get();

        if($rq->get('current-username-input') != $admin[0]->username )
        {
            return response()->json(['code' => 8, 'error' => ['current-username-input' => 'Wrong username']]);
        }

        if($rq->get('new-password-input') != $rq->get('confirm-password-input'))
        {
            return response()->json(['code' => 7, 'error' => ['confirm-password-input' => 'Password do not match with the new password']]);
        }

        //aptproject
        if(Hash::check($rq->get('old-password-input'), $admin[0]->password ))
        {
            $hashed = Hash::make($rq->get('new-password-input'));
            DB::table('landlord_login')->update(['password' => $hashed]);
            return response()->json(['code' => 0, 'result' => 'Password Changed']);
        }

        // Wrong Old Password
        else{
            return response()->json(['code'=> 6 ,'error' => ['old-password-input' => 'Incorrect Password']]);
        }



        return response()->json(['response' =>'done']);


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
        $landlord = DB::table('landlord_table')->update(['surname' => $rq->get('landlordSurname'),
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
