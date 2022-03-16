<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Apartment Rental Management System</title>
    <!-- Favicon-->


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">





    <link href="{{asset('css/app.css')}}" rel="stylesheet" />
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>

<div class="d-flex layout" id="wrapper">




    <!-- Sidebar-->
    <div class="border-end bg-dark sidebar sidebar-heading" id="sidebar-wrapper">



        <div class="sidebar-heading border-bottom  text-center text-white sidebar-heading "><span class="sideheading">Apartment Rental Management System</span></div>
        <div class=" list-group-flush side-nav">
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation sidebar-heading " href="/"><span class="sideheading">Dashboard</span></a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation sidebar-heading" href="{{route('profile')}}"><span class="sideheading">Profile</span></a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation sidebar-heading" href="{{route('tenants')}}"><span class="sideheading">Tenants</span></a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation sidebar-heading" href="{{route('room')}}"><span class="sideheading">Rooms</span></a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation sidebar-heading" href="{{route('expenses')}}"><span class="sideheading">Landlord Expenses</span></a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation sidebar-heading" href="{{route('payment')}}"><span class="sideheading">Rent Payments</span></a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation sidebar-heading" href="{{route('report')}}"><span class="sideheading">Report</span></a>
            <!-- <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-top border-white navigation logout sidebar-heading" href="#!"><span class="sideheading">Log Out</span></a> --->
        </div>
    </div>
    <!-- Page content wrapper-->
    <div id="page-content-wrapper" class="main-container">
            @yield('content')
    </div>
</div>




@include('script.dashboard')
</body>
</html>

