<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ExpenseController extends Controller
{
    public function index()
    {

        $expenses= DB::table('expenses')->get();
        return view('dashboard.expense', compact('expenses'));
    }

    public function addrecord(Request $rq)
    {
        $expenseVal = Validator::make($rq->all(),[
            'description-input' => 'required|max:255' ],

            ['description-input.required' => 'Please include description']
        );

        if($expenseVal->fails())
        {
            return response()->json(['code' => 0, 'error' => $expenseVal->errors()->toArray()]);
        }

        DB::table('expenses')->insert(
            ['description' => strtoupper($rq->get('description-input')),
                'amount' => $rq->get('expense-amount'),
                'transaction_date' => $rq->get('transaction-date-input')
                ]
        );
        $html = '';
        $table = DB::table('expenses')->get();
        foreach($table as $tab)
        {
            $html .= '<tr class="text-center" id='.$tab->transaction_id.'>'.
            '<th class="text-center" scope="row" id='.$tab->transaction_id.'>'.$tab->transaction_id.'</th>'.
            '<td class="text-center" id='.$tab->transaction_id.'>'.$tab->description.'</td>'.
            '<td class="text-center" id='.$tab->transaction_id.'>'.$tab->amount.'</td>'.
            '<td class="text-center" id='.$tab->transaction_id.'>'.$tab->transaction_date.'</td>'.
                '<td class="d-flex flex-column justify-content-center align-items-center" id='.$tab->transaction_id.'>'.
                '<button type="button" class="btn btn-primary editExpense fs-4" id='.$tab->transaction_id.'>'.'Edit'.'</button>'.
                '<button type="button" class="btn btn-primary deleteExpense fs-4 mt-2" id='.$tab->transaction_id.'>'.'Delete'.'</button>'.
                '</td>'.
            '</tr>';
        }


        return response()->json(['code' => strtoupper($rq->get('description-input')), 'update' => $html]);
    }

    public function getMonthlyReport(Request $rq, $year, $month)
    {
        if($rq->ajax())
        {
            $html = '';
            $total = 0.00;
            $currentRecords = Expenses::all();
            foreach($currentRecords as $curr)
            {
                $currDate = explode('-', $curr->transaction_date);

                if($currDate[0] == $year && $currDate[1] == $month)
                {
                    $total+=$curr->amount;

                    $html.="<tr>
            <th scope='row' class='text-center'>$curr->transaction_id</th>
            <td class='text-center'>$curr->description</td>
            <td class='text-center'>$curr->transaction_date</td>
            <td class='text-center'>$curr->amount</td>
            </tr>";
                }
            }
            $formatted_amount = number_format($total,2);

            return response()->json(['response' => $html, 'amount' => $formatted_amount]);

        }

    }

    public function getAnnualReport(Request $rq, $year)
    {
        if($rq->ajax())
        {
            $all = Expenses::all();
            $html = "";
            $total = 0.00;

            foreach($all as $a )
            {
                $transaction_year = explode('-', $a->transaction_date);

                if($year == $transaction_year[0])
                {
                    $total+=$a->amount;

                    $html.="<tr>
            <th scope='row' class='text-center'>$a->transaction_id</th>
            <td class='text-center'>$a->description</td>
            <td class='text-center'>$a->transaction_date</td>
            <td class='text-center'>$a->amount</td>
            </tr>";

                }
            }
            $formatted_amount = number_format($total, 2);

            return response()->json(['html' => $html, 'total' => $formatted_amount]);
        }


    }

}
