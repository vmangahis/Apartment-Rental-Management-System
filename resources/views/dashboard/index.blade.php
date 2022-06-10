@extends('layouts.app')

@section('content')


<div class="dropdown admin">
    <button class="btn btn-primary dropdown-toggle admin-button" type="button" id="admin-dropdown" data-bs-toggle="dropdown">
        Admin
    </button>

    <ul class="dropdown-menu" aria-labelledby="admin-dropdown">
        <li><a class="dropdown-item log-out" >Log out</a></li>
    </ul>
</div>

    <h1 class="text-center m-4 main-header">Apartment Rental Management System (Dashboard)</h1>


    <div class="parent-container">
    <div class="container m-5 dashboard-container">

        <div class="box">
           <a href="{{route('payment')}}" class="box-header"> <span>P</span> <span class="amount-pay">{{number_format($totalpayments,2)}}</span>
            <p>Total Payments<p></a>
            <a href="{{route('payment')}}" class="direct-button">To Payments</a>
        </div>



        <div class="box">
            <a href="{{route('expenses')}}" class="box-header"><span> P</span> <span class="amount-expenses">{{number_format($totalexpenses,2)}}</span>
                <p>Total Expenses</p></a>
                <a href="{{route('expenses')}}" class="direct-button">To Expenses</a>
        </div>


        <div class="box last-box">
            <a href="{{route('tenants')}}" class="box-header"> <span class ="tenant-count">{{$tenantcount}}</span>
                <p>Total Active Tenants</p> </a>
                <a href="{{route('tenants')}}" class="direct-button">To Tenants</a>
        </div>

        <div class="box last-box">
            <a href="{{route('room')}}" class="box-header"> <span class ="tenant-count">{{$vacantcount}}</span>
                <p>Vacant Rooms</p> </a>
            <a href="{{route('room')}}" class="direct-button">To Rooms</a>
        </div>

    </div>
    </div>
@endsection
