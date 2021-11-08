@extends('layouts.app')

@section('content')

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
        <button class = 'btn btn-success expensebutton mt-5 fs-3'>+New Expense</button>
        <thead>
        <tr>
            <th scope="col" class="'text-center">Transaction ID</th>
            <th scope="col">Description</th>
            <th scope="col">Amount</th>
            <th scope="col">Date Paid</th>
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
