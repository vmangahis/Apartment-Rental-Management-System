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

            <form class="d-flex flex-column justify-content-center">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>

            </form>
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
        <td scope="col">Actions</td>
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
        <td>
            <button type="button" class="btn btn-primary">Edit</button>
            <button type="button" class="btn btn-primary">Delete</button>
        </td>
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
