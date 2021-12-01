@extends('layouts.app')

@section('content')



<div class="expenses-payments-header d-flex justify-content-center">
        <h1 class="text-center main-header m-4">Expenses & Payments</h1>
        <div class="tab-nav d-flex flex-column align-items-center justify-content-around">
            <button class="btn btn-primary" onClick="location.href = '/payment'">Expenses</button>
            <button class="btn btn-primary" onClick="location.href = '/payment/tenant'">Payments</button>
        </div>
</div>


<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
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

<button class = 'btn btn-primary paymentButton d-block ms-auto mt-5 fs-5' data-bs-toggle="modal" data-bs-target="#paymentModal">+New Payment</button>
<table class="payment-table table mt-5">
    <h1 class="text-center">Payments Table</h1>
    <thead>
    <tr class="payment-table-header">
        <th scope="col" class="'text-center">Transaction ID</th>
        <th scope="col">Surname</th>
        <th scope="col">First Name</th>
        <th scope="col">Amount Paid</th>
        <th scope="col">Date Paid</th>
    </tr>
    </thead>
    <tbody>
    @if(count($payments) > 0)
        @foreach($payments as $pay)
    <tr>
        <th scope="row">{{$pay->transaction_id}}</th>
        <td>surname</td>
        <td>firstname</td>
        <td>{{$pay->amount_paid}}</td>
        <td>{{$pay->transaction_date}}</td>
    </tr>
        @endforeach

    @else
    <tr>
        <td colspan = "42"><h1 class="text-center">No Records</h1></td>
    </tr>
        @endif

    </tbody>
</table>


    @endsection
