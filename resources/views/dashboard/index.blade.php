@extends('layouts.app')

@section('content')
    <h1 class="text-center m-4 main-header">Apartment Rental Management System (Dashboard)</h1>


    <div class="parent-container">
    <div class="container m-5 dashboard-container">

        <div class="box">
           <a href="{{route('tenantpayment')}}" class="box-header"> <span>P</span> <span class="amount-pay">{{number_format($totalpayments,2)}}</span>
            <p>Total Payments<p></a>
            <a href="{{route('tenantpayment')}}" class="direct-button">To Payments</a>
        </div>



        <div class="box">
            <a href="{{route('payment')}}" class="box-header"><span> P</span> <span class="amount-expenses">{{number_format($totalexpenses,2)}}</span>
                <p>Total Expenses</p></a>
                <a href="{{route('payment')}}" class="direct-button">To Expenses</a>
        </div>


        <div class="box last-box">
            <a href="{{route('tenants')}}" class="box-header"> <span class ="tenant-count">{{$tenantcount}}</span>
                <p>Total Tenants</p> </a>
                <a href="{{route('tenants')}}" class="direct-button">To Tenants</a>
        </div>

        <div class="box last-box">
            <a href="{{route('tenants')}}" class="box-header"> <span class ="tenant-count">{{$vacantcount}}</span>
                <p>Vacant Rooms</p> </a>
            <a href="{{route('tenants')}}" class="direct-button">To Rooms</a>
        </div>

    </div>
    </div>
@endsection
