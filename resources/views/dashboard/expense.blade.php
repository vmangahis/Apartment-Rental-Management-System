@extends('layouts.app')

@section('content')




<!---- Pending for refactoral ---->

<div class="expenses-payments-header d-flex justify-content-center">
    <h1 class="text-center main-header m-4">Expenses & Payments</h1>
    <div class="tab-nav d-flex flex-column align-items-center justify-content-around">
        <button class="btn btn-primary" onClick="location.href = '/payment'">Expenses</button>
        <button class="btn btn-primary" onClick="location.href = '/payment/tenant'">Payments</button>
    </div>
</div>





  <!-- Modal -->
  <div class="modal fade" id="expenseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Expenses</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Add</button>
        </div>
      </div>
    </div>
  </div>

<button class = 'btn btn-primary expenseButton mt-5 ms-auto  d-block fs-5' data-bs-toggle="modal" data-bs-target="#expenseModal">+New Expense</button>
    <!---- Expenses Table ----->
    <table class="table mt-5 expense-table">
        <h1 class="text-center">Expenses Table</h1>
        <thead>
        <tr class="expense-table-header">
            <th scope="col" class="'text-center">Transaction ID</th>
            <th scope="col">Description</th>
            <th scope="col">Amount</th>
            <th scope="col">Transaction Date</th>
        </tr>
        </thead>
        <tbody>
        @if(count($expenses) > 0 )
            @foreach($expenses as $exp)
            <tr>
            <th scope="row">{{$exp->transaction_id}}</th>
            <td>{{$exp->description}}</td>
            <td>{{$exp->amount}}</td>
            <td>{{$exp->transaction_date}}</td>
            </tr>
            @endforeach


        @else
            <tr>
                <td colspan="42">
                <h1 class="text-center">No Records</h1>
                </td>
            </tr>
            @endif
        </tbody>
    </table>

@endsection
