<?php

namespace App\Http\Controllers;

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
            $html .= '<tr id='.$tab->transaction_id.'>'.
            '<th scope="row" id='.$tab->transaction_id.'>'.$tab->transaction_id.'</th>'.
            '<td id='.$tab->transaction_id.'>'.$tab->description.'</td>'.
            '<td id='.$tab->transaction_id.'>'.$tab->amount.'</td>'.
            '<td id='.$tab->transaction_id.'>'.$tab->transaction_date.'</td>'.
                '<td class="d-flex justify-content-evenly" id='.$tab->transaction_id.'>'.
                '<button type="button" class="btn btn-primary editExpense" id='.$tab->transaction_id.'>'.'Edit'.'</button>'.
                '<button type="button" class="btn btn-primary deleteExpense" id='.$tab->transaction_id.'>'.'Delete'.'</button>'.
                '</td>'.
            '</tr>'
            ;
        }


        return response()->json(['code' => strtoupper($rq->get('description-input')), 'update' => $html]);
    }
}
