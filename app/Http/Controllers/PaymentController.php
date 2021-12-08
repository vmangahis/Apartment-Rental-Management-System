<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Tenants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('tenant')->get();
        $tenantCount = Tenants::count();
        $tenant = Tenants::all();
        return view('dashboard.payment', compact('payments', 'tenantCount','tenant'));
    }

    public function addPayment(Request $rq)
    {
        $amount = $rq->get('expense-amount');
        $transactionDate = $rq->get('payment-date-input');
        $html = '';
        $tenantID = $rq->get('input-tenant-pay');
        Payment::create([
            'tenant_id' => $tenantID,
            'amount_paid' => $amount,
            'transaction_date' => $transactionDate
        ]);

        $data = Payment::with('tenant')->get();

        foreach($data as $dat)
        {
            $html.='<tr>'.
        '<th scope="row" class="text-center">'.$dat->transaction_id.'</th>'.
        '<td class="text-center">'.$dat->tenant->surname.'</td>'.
        '<td class="text-center">'.$dat->tenant->firstname.'</td>'.
        '<td class="text-center">'.$dat->tenant->middle_name.'</td>'.
        '<td class="text-center">'.$dat->amount_paid.'</td>'.
        '<td class="text-center">'.$dat->transaction_date.'</td>'.
        '<td class ="d-flex flex-column align-items-center">'.
            '<button type="button" class="btn btn-primary" id='.$dat->transaction_id.'>Edit</button>'.
            '<button type="button" class="btn btn-primary mt-2 "id='.$dat->transaction_id.'>Delete</button>
        </td>'.
    '</tr>';
        }


        return response()->json(['html' => $html, 'response' => 'Successfully added record']);
    }

    public function delete()
    {

    }

    public function edit()
    {

    }

    public function getMonthly(Request $rq, $yr, $month)
    {
        $all_records = Payment::all();
        error_log($all_records);
        $html = "";

        $total = 0.00;
        foreach($all_records as $all)
        {
            $sliced_date = explode('-', $all->transaction_date);

            if($yr == $sliced_date[0] && $month == $sliced_date[1])
            {

                $total+=$all->amount_paid;
                $html.= "<tr>
                                <th scope='row' class='text-center'>" . $all->transaction_id . "</th>
                                <td class='text-center'>" . $all->tenant->surname . "</td>
                                <td class='text-center'>" . $all->tenant->firstname . "</td>
                                <td class='text-center'>" . $all->tenant->middle_name . "</td>
                                <td class='text-center'>" . $all->transaction_date . "</td>
                                <td class='text-center'>" . $all->amount_paid . "</td>
                            </tr>";
            }
        }

        error_log($html);

        return response()->json(['html' => $html, 'total' => $total]);
    }

    public function getAnnual(Request $rq, $yr)
    {
        return response()->json(['response' => 'Annual Payments']);
    }

}
