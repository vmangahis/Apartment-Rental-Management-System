<?php

namespace App\Http\Controllers;

use App\Models\Landlord;
use App\Models\LandlordLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function authenticate(Request $rq)
    {
        return view('auth.login')->with(['error' => 0, 'message' => ""]);
    }

    public function checkLogin(Request $rq)
    {
        $val = Validator::make($rq->all(), [
            'loginUsername' => 'required',
            'loginPassword' => 'required'
        ],
        ['loginUsername.required' => 'Invalid input. Please try again',
            'loginPassword.required' => 'Invalid input. Please try again']
        );

        if($val->fails())
        {
            return response()->json(['code' => 1,'error' => $val->errors()->toArray()]);
        }

        $loginCreds = LandlordLogin::where('username', '=', $rq->get('loginUsername'))->first();

        // Wrong Uname
        if(!$loginCreds)
        {
            return response()->json(['code' => 2, 'error' => ['loginUsername' => 'Wrong username. Please try again']]);
        }

        else{

            //Check pass
            if(Hash::check($rq->get('loginPassword'), $loginCreds->password)){
                if(Auth::guard('landlord')->attempt(['username' => $rq->get('loginUsername'), 'password' => $rq->get('loginPassword')]))
                {
                    $rq->session()->put(['loginID' => $loginCreds->id]);
                    return redirect()->route('main');
                }
                else{
                    return response()->json(['response' => 'Not Logged in!']);
                }
            }

            //Wrong password
            else{
                return response()->json(['code' => 3, 'error' => ['loginPassword' => 'Incorrect password']]);
            }
        }

        return response()->json(['resp' => 'login success']);
    }


    public function logout()
    {
        Session::forget('loginID');
        if(!Session::has('loginID')){
            return response()->json(['response' => 'Logged out']);
        }
    }

}
