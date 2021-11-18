<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Tenants;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{


    public function index()
    {
        $tenants = DB::table('tenants')->get();
        return view('dashboard.tenants')->with('tenant', $tenants);
    }

    public function register(Request $req)
    {


       /* $this->validate($req, [
            'tenantSurname' => 'required|max:255',
            'tenantFirstname'=>'required|max:255',
            'tenantEmail'=>'required|max:255',
            'tenantAge'=>'required',
        ]);*/

        $validator = Validator::make($req->all(), ['tenantSurname' => 'required|max:255',
            'tenantFirstname'=>'required|max:255',
            'tenantEmail'=>'required|max:255',
            'tenantAge'=>'required',

        ]);



        // IF form validation failed
        if($validator->fails())
        {
            return response()->json(array(
                'success' => false,
                'message' => 'Missing or incorrect',
                'errors' =>$validator->getMessageBag()->toArray()
            ),422);
        }

        //storing tenants to database
        Tenants::create([
            'surname' => $req->tenantSurname,
            'firstname'=>$req->tenantFirstname,
            'email'=>$req->tenantEmail,
            'age'=>$req->tenantAge,
            'mobile'=>$req->tenantMobile,
            'rental_status'=>$req->get('rent_status')
        ]);

        return redirect()->route('tenants');



    }

    public function edit(Request $rq)
    {


        Tenants::where('id', $rq->id)
            ->update(['surname' => $rq->surname,
                'firstname' => $rq->firstname,
                'email'=>$rq->email,
                'age' => $rq->age,
                'mobile' => $rq->mobileNum,
                'rent_date' => $rq->rent_date,
                'rental_status' => $rq->rental_status
                
                ]
            
            
            );

    }

    public function destroy(Request $req)
    {
       Tenants::destroy($req->id);
    }





}
