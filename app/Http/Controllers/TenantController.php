<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Tenants;
use App\Models\Rooms;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{


    //Active in Default
    public function index(Request $rq)
    {
        $tenant = DB::table('tenants')->where('rental_status','ACTIVE')->get();
        $rooms = DB::table('rooms')->get();
        error_log($rooms);
        return view('dashboard.tenants', compact('tenant', 'rooms'));
        
    }


    //Archive filter
    public function filter(Request $rq)
    {
        $tenant = DB::table('tenants')->where('rental_status', 'ARCHIVED')->get();
        $rooms = DB::table('rooms')->get();
        return view('dashboard.tenants', compact('tenant', 'rooms'));
    }

    public function search_active(Request $rq)
    {
        
        $rent_stat = "";
        $columnquery = $rq->input('column');
        $parameter = $rq->input('path');
        $res ="";
        

        //Check what column will the search base from
        switch ($columnquery){
            case 'id':
                $columnquery = 'id';
                break;


                case 'age':
                    $columnquery = 'age';
                    break;


                case 'surname':
                    $columnquery = 'surname';
                    break;

                case 'fname':
                    $columnquery = 'firstname';
                    break;

                case 'mname':
                    $columnquery = 'middle_name';
                    break;

                case 'email':
                    $columnquery = 'email';
                    break;

        }

        

        // Check Status from Data sent by AJAX
        if($rq->input('path') == "ACTIVE")
        {
            $rent_stat = "ACTIVE";
            
        }
        else{
            $rent_stat = "ARCHIVED";
        }
        
        
        
        if($rq->ajax())
        {
            $tenants = DB::table('tenants')->where('rental_status', $rent_stat)->get();
            
            if($rq->get('query') == '') // empty input
            {
                foreach($tenants as $ten)
                {
                    $res.='<tr class="clickable-row" id="{$ten->id}" href="#info-modal" data-bs-target="#info-modal" data-bs-toggle="modal">'.
                    '<th scope="row" id="{$ten->id}">'.$ten->id.'</th>'.
                    '<td id="{$ten->id}">'.$ten->surname.'</td>'.
                    '<td id="{$ten->id}">'.$ten->firstname.'</td>'.
                    '<td id="{$ten->id}">'.$ten->middle_name.'</td>'.
                    '<td id="{$ten->id}">'.$ten->email.'</td>'.
                    '<td id="{$ten->id}">'.$ten->age.'</td>'.
                    '<td id="{$ten->id}">'.$ten->mobile.'</td>'.
                    '<td id="{$ten->id}">'.$ten->rent_date.'</td>'.
                    '<td id="{$ten->id}">'.$ten->rental_status.'</td>'.
                    '<td id="{$ten->id}">'.$ten->balance_due.'</td>'.
                    '<td class = "d-flex flex-column align-items-center">'.

                    '<button type="button" class="btn btn-primary editEntry fs-4 mb-3" data-bs-target="#editModal" data-bs-toggle="modal" id='.$ten->id.'>Edit'.'</button>'.
                    '<button type="button" class="btn btn-primary deleteEntry fs-4 " data-bs-target="#deleteModal" data-bs-toggle="modal" id='.$ten->id.'>Delete</button>'.
                    
                    '</td>'.
                    '</tr>';
                }
                return Response($res);
            }

            else{
                
                
                $tenants = DB::table('tenants')->where($columnquery, 'LIKE', '%'.$rq->get('query').'%')
                ->where('rental_status','=', $rent_stat)
                ->get();

                if(count($tenants) > 0)
                {
                    foreach($tenants as $ten)
                    {
                    $res.='<tr class="clickable-row" id='.$ten->id.' href="#info-modal" data-bs-target="#info-modal" data-bs-toggle="modal">'.
                    '<th scope="row" id='.$ten->id.'>'.$ten->id.'</th>'.
                    '<td id='.$ten->id.'>'.$ten->surname.'</td>'.
                    '<td id='.$ten->id.'>'.$ten->firstname.'</td>'.
                    '<td id='.$ten->id.'>'.$ten->middle_name.'</td>'.
                    '<td id='.$ten->id.'>'.$ten->email.'</td>'.
                    '<td id='.$ten->id.'>'.$ten->age.'</td>'.
                    '<td id='.$ten->id.'>'.$ten->mobile.'</td>'.
                    '<td id='.$ten->id.'>'.$ten->rent_date.'</td>'.
                    '<td id='.$ten->id.'>'.$ten->rental_status.'</td>'.
                    '<td id='.$ten->id.'>'.$ten->balance_due.'</td>'.
                    '<td class = "d-flex flex-column align-items-center" id='.$ten->id.'>'.

                    '<button type="button" class="btn btn-primary editEntry fs-4 mb-3" data-bs-target="#editModal" 
                     data-bs-toggle="modal" id='.$ten->id.'>Edit'.'</button>'.
                    '<button type="button" class="btn btn-primary deleteEntry fs-4"  data-bs-target="#deleteModal" data-bs-toggle="modal" id='.$ten->id.'>Delete'.'</button>'.
                    
                    '</td>'.
                    '</tr>';
                    }
                }


                // If nothing found
                else
                {
                    $res = '<tr>'.
                    '<td colspan="42">'.
                    '<h1 class ="text-center no-tenant">'."No Result".'</h1>'.
                    '</td>'.
                    '</tr>';
                }


                return Response($res);
              
            }


            
        }
      // no  ajax request
        else{
            $tenants = DB::table('tenants')->get();
            return view('dashboard.tenants')->with('tenant', $tenants);
        }    
        
    }

    public function register(Request $req)
    {
        $id = 1;



        $validator = Validator::make($req->all(), ['tenantSurname' => 'required|alpha',
            'tenantFirstname'=>'required|alpha|max:255',
            'tenantEmail'=>'required',
            'tenantAge'=>'required',
            'tenantMiddlename'=>'required|alpha',
            'tenantImage'=>'mimes:jpeg,jpg,jpg,png,gif|max:10000'

        ],[
            'tenantSurname.required' => 'Surname required',
            'tenantSurname.alpha' => 'Surname cannot contain numbers or special characters',
            'tenantMiddlename.alpha' => 'Middle Name cannot contain numbers or special characters',
            'tenantImage.mimes' => 'Tenant Image must be in image format'
        ]);

        error_log($req->file('tenantImage'));
        

        // IF form validation failed
        if(!$validator->passes())
        {
            return response()->json(['code'=> 0, 'error'=>$validator->errors()->toArray()]);
            
        }        

        else{

            $path = "tenantimages/";

            // If no image was uploaded
            if($req->file('tenantImage') == '')
            {
                $hashed_fname = 'blankimage.png';
                error_log('no image uploaded');
            }

            else{
                $image_filename = $req->file('tenantImage');
                $hashed_fname = time().'_'.$image_filename->getclientOriginalName();
                $upload = $image_filename->storeAs($path, $hashed_fname, 'public');

                if($upload)
                {
                    error_log('non blank image uploaded');
                }
            }

        
        }

        

        //storing tenants to database
        Tenants::create([
            'surname' => $req->tenantSurname,
            'firstname'=>$req->tenantFirstname,
            'middle_name'=>$req->tenantMiddlename,
            'email'=>$req->tenantEmail,
            'rent_date'=>$req->tenantRentdate,
            'age'=>$req->tenantAge,
            'mobile'=>$req->tenantMobile,
            'rental_status'=>$req->get('rent_status'),
            'image_name'=>$hashed_fname,
            'room_id'=> $req->get('room_number')
        ]);

        Rooms::where('room_id', $req->get('room_number'))
        ->update(['tenant_id' => $id,
        'status' => 'OCCUPIED']
        );

        

        return redirect()->route('tenants');



    }

    public function edit(Request $rq)
    {

        
        $validator = Validator::make($rq->all(), array('surname' => 'required|max:255',
            'firstname'=>'required|max:255',
            'email'=>'required|max:255',
            'age'=>'required',
            'middle_n'=>'required'

        ));

        error_log('reach');
        if($validator->fails())
        {
            error_log($validator->errors());

            return  Redirect::route('dashboard.tenants')->withInput()->withErrors($validator->errors());
           /* return response()->json(array(
                'success' => false,
                'message' => 'Missing or incorrect',
                'errors' =>$validator->getMessageBag()->toArray()
            ),422);*/
        }

        

        Tenants::where('id', $rq->id)
            ->update(['surname' => $rq->surname,
                'firstname' => $rq->firstname,
                'email'=>$rq->email,
                'age' => $rq->age,
                'mobile' => $rq->mobileNum,
                'rent_date' => $rq->rent_date,
                'rental_status' => $rq->rental_status,
                'middle_name' => $rq->middle_n
                ]
            
            
            );

    }

    public function destroy(Request $req)
    {
       Tenants::destroy($req->id);
    }





}
