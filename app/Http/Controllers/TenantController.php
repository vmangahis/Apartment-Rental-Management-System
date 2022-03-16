<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\TenantRegister;
use App\Models\Landlord;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Tenants;
use App\Models\Rooms;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Mail\TestMail;

class TenantController extends Controller
{


    //Active in Default
    public function index(Request $rq)
    {
        $tenant = DB::table('tenants')->where('rental_status','ACTIVE')->get();
        $alltenant = Tenants::all();
        $rooms = DB::table('rooms')->where('status', 'VACANT')->get();
        $allroom = DB::table('rooms')->get();
        $roomCount = Rooms::where('status', 'VACANT')->count();
        return view('dashboard.tenants', compact('tenant', 'rooms','allroom', 'roomCount', 'alltenant'));

    }


    //Archive filter
    public function filter(Request $rq)
    {
        $tenant = DB::table('tenants')->where('rental_status', 'ARCHIVED')->get();
        $rooms = DB::table('rooms')->get();
        $allroom = DB::table('rooms')->get();
        $roomCount = Rooms::all()->count();
        $alltenant = Tenants::all();
        return view('dashboard.tenants', compact('tenant', 'rooms', 'allroom', 'roomCount', 'alltenant'));
    }

    public function search_tenants(Request $rq)
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
                    $res.='<tr class="clickable-row" id='.$ten->id.'href="#info-modal" data-bs-target="#info-modal" data-bs-toggle="modal">'.
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
                    '<td class = "d-flex flex-column align-items-center"'.$ten->id.'>'.

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
        $validator = Validator::make($req->all(), ['tenantSurname' => 'required|alpha',
            'tenantFirstname'=>'required|alpha|max:255',
            'tenantEmail'=>'required',
            'tenantAge'=>'required',
            'tenantMiddlename'=>'required|alpha',
            'tenantImage'=>'mimes:jpeg,jpg,png,gif|max:10000',
            'monthly' => 'required'

        ],[
            'tenantSurname.required' => 'Surname required',
            'tenantSurname.alpha' => 'Surname cannot contain numbers or special characters',
            'tenantMiddlename.alpha' => 'Middle Name cannot contain numbers or special characters',
            'tenantImage.mimes' => 'Tenant Image must be in image format',
            'tenantEmail.required' => 'Email is required'
        ]);




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
            }

            else{
                $image_filename = $req->file('tenantImage');
                $hashed_fname = time().'_'.$image_filename->getclientOriginalName();
                $upload = $image_filename->storeAs($path, $hashed_fname, 'public');
            }


        }

        $room_status = "OCCUPIED";

        if($req->get('rent_status') == "ARCHIVED")
        {
            $room_status="VACANT";
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
            'room_id'=> $req->get('room_number'),
            'monthly' => $req->get('monthly')
        ]);
        $info = [
            'title' => 'Confirmation Email',
            'body' => ''
        ];
        $landlord_info = Landlord::orderBy('id', 'DESC')->first();
        $roomnum = Rooms::where('room_id', $req->get('room_number'))->first();

        Mail::to($req->tenantEmail)->send(new TenantRegister($info,$req->tenantFirstname,$landlord_info->surname, $req->tenantRentdate, $req->monthly,$roomnum->room_number));

        //Getting te last tenant ID upon creation
        $latest_tenant_id = DB::table('tenants')->orderBy('id', 'DESC')->value('id');


        //Update vacant room
        Rooms::where('room_number', $req->get('room_number'))
        ->update(['tenant_id' => $latest_tenant_id,
        'status' => $room_status]
        );

        return redirect()->route('tenants');
    }

    public function edit(Request $rq, $id)
    {

        $hashed_file = "";


        $validator = Validator::make($rq->all(), ['tenantSurnameEdit' => 'required',
                'tenantFirstnameEdit' => 'required',
                'tenantMiddlenameEdit' => 'required',
                'tenantEmailEdit' => 'required',
                'tenantAgeEdit' => 'required',
                'tenantMobile' => 'required'],

            ['tenantSurnameEdit.required' => 'This field is required',
             'tenantFirstnameEdit.required' => 'This field is required',
              'tenantMiddlenameEdit.required' => 'This field is required',
                'tenantEmailEdit.required' => 'This field is required',
                'tenantAgeEdit.required' => 'This field is required',
                'tenantMobile.required' => 'This field is required'
            ]
        );


        if($validator->fails())
        {

            return response()->json(['code' => 1,'error' => $validator->errors()->toArray()]);
        }


        //Make the room available upon change to archived status of tenants
        if($rq->get('rent_status') == "ARCHIVED")
        {
                Rooms::where('room_number', $rq->get('room_number'))->update(['tenant_id' => 0, 'status' => "VACANT"]);
        }
        else if($rq->get('rent_status') == "ACTIVE")
        {
            Rooms::where('room_number', $rq->get('room_number'))->update(['tenant_id' => $id , 'status' => "OCCUPIED"]);
        }


        $prev_tenantImage = Tenants::where('id', $id)->first();
        if($rq->file('editTenantImage') == '')
        {
            $hashed_file = $prev_tenantImage->image_name;
        }

        else{
            $previous_image = Tenants::where('id', $id)->first();

            // If previous image is blank
            if($previous_image->image_name != "blankimage.png")
            {

                $path = public_path()."/storage/tenantimages/".$previous_image->image_name;
                //Storage::disk('public')->delete('tenantimages/'.$previous_image->image_name);

                unlink($path);
            }

            $origFile = $rq->file('editTenantImage');
            $path = "/tenantimages";


            $hashed_file = time().'_'.$origFile->getclientOriginalName();



           $upload =  $origFile->storeAs($path, $hashed_file, 'public');
        }



        if($rq->get('currentRoom') != $rq->get('room_number') && $rq->get('rent_status') != "ARCHIVED")
        {
            error_log('Updating room number');
            Rooms::where('room_number', $rq->get('room_number'))->update(['status' => "OCCUPIED",
                'tenant_id' => $id
            ]);

            Rooms::where('room_number', $rq->get('currentRoom'))->update(['status' => 'VACANT',
                    'tenant_id' => 0
                ]);

        }



        Tenants::where('id', $id)
            ->update(['surname' => $rq->get('tenantSurnameEdit'),
                'firstname' => $rq->get('tenantFirstnameEdit'),
                'email'=>$rq->get('tenantEmailEdit'),
                'age' => $rq->get('tenantAgeEdit'),
                'mobile' => $rq->get('tenantMobile'),
                'rent_date' => $rq->get('tenantRentdate'),
                'rental_status' => $rq->get('rent_status'),
                'middle_name' => $rq->get('tenantMiddlenameEdit'),
                'monthly' => $rq->get('monthly-edit'),
                'image_name' => $hashed_file,
                'room_id' => $rq->get('room_number')
        ]);

    }

    public function destroy(Request $req)
    {
        $rooms = Rooms::all();

        //Make the room available upon deletion
        foreach($rooms as $rm)
        {
            error_log($rm->tenant_id);

            if($rm->tenant_id == $req->id)
            {
                Rooms::where('tenant_id', $req->id)->update(['status' => 'VACANT', 'tenant_id' => 0]);
            }
        }


        Tenants::destroy($req->id);

    }


}
