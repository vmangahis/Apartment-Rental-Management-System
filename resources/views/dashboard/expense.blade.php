@extends('layouts.app')

@section('content')





  
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


    <h1 class = 'text-center p-5 main-header'>Expenses</h1>
    <ul class="nav nav-pills bg-gray">
        <li class="nav-item nav-link">
            <a class="nav-link active" aria-current="page" href="{{route('payment')}}">Expenses</a>
        </li>
        <li class="nav-item nav-link">
            <a class="nav-link" href="{{route('tenantpayment')}}">Payments</a>
        </li>

    </ul>

    <table class="table mt-5">
        <button class = 'btn btn-success expensebutton mt-5 fs-4' data-bs-toggle="modal" data-bs-target="#expenseModal">+New Expense</button>
        <thead>
        <tr>
            <th scope="col" class="'text-center">Transaction ID</th>
            <th scope="col">Description</th>
            <th scope="col">Amount</th>
            <th scope="col">Transaction Date</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Utilities Expenses</td>
            <td>1500.00</td>
            <td>2021-08-02</td>
        </tr>
        </tbody>
    </table>

@endsection
