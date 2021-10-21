@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-5">Dashboard</h1>

    <div class="container mt-5 dashboard-container">

        <div class="box">
           <a href="#" class="box-header"> <span>P</span> <span class="amount-pay">{{number_format($totalpayments,2)}}</span>
            <p>Total Payments<p></a>
            <a href="#" class="direct-button">To Payments</a>
        </div>



        <div class="box">
            <a href="#" class="box-header"><span> P</span> <span class="amount-expenses">{{number_format($totalexpense,2)}}</span>
                <p>Total Expenses</p></a>
                <a href="#" class="direct-button">To Expenses</a>
        </div>


        <div class="box last-box">
            <a href="#"> <span class ="tenant-count">{{$numbertenant}}</span>
                <p>Total Tenants</p> </a>
                <a href="#" class="direct-button">To Tenants</a>
        </div>

    </div>
@endsection
