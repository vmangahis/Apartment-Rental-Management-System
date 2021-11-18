@extends('layouts.app')

@section('content')


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

<h1 class = 'text-center p-5 main-header'>Payments</h1>
<ul class="nav nav-pills bg-gray">
    <li class="nav-item nav-link">
        <a class="nav-link" aria-current="page" href="{{route('payment')}}">Expenses</a>
    </li>
    <li class="nav-item nav-link">
        <a class="nav-link active" href="{{route('tenantpayment')}}">Payments</a>
    </li>

</ul>

<table class="table mt-5">
    <button class = 'btn btn-success expensebutton mt-5 fs-3' data-bs-toggle="modal" data-bs-target="#paymentModal">+New Payment</button>
    <thead>
    <tr>
        <th scope="col" class="'text-center">Transaction ID</th>
        <th scope="col">Surname</th>
        <th scope="col">First Name</th>
        <th scope="col">Amount Paid</th>
        <th scope="col">Date Paid</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">1</th>
        <td>TestSurname</td>
        <td>TestFirstName</td>
        <td>2000.00</td>
        <td>2021-05-02</td>
    </tr>
    </tbody>
</table>


    @endsection
