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
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('css/app.css')}}" rel="stylesheet" />
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</head>
<body>
<div class="d-flex " id="wrapper">
    <!-- Sidebar-->
    <div class="border-end bg-dark sidebar sidebar-heading" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom  text-center text-white sidebar-heading "><span class="sideheading">Apartment Rental Management System</span></div>
        <div class=" list-group-flush side-nav">
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation sidebar-heading " href="/"><span class="sideheading">Dashboard</span></a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation sidebar-heading" href="{{route('summary')}}"><span class="sideheading">Summary</span></a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation sidebar-heading" href="{{route('tenants')}}"><span class="sideheading">Tenants</span></a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation sidebar-heading" href="{{route('room')}}"><span class="sideheading">Rooms</span></a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation sidebar-heading" href="{{route('payment')}}"><span class="sideheading">Payments</span></a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation sidebar-heading" href="{{route('report')}}"><span class="sideheading">Reports</span></a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-top border-white navigation logout sidebar-heading" href="#!"><span class="sideheading">Log Out</span></a>
        </div>
    </div>
    <!-- Page content wrapper-->
    <div id="page-content-wrapper" class="main-container">
            @yield('content')
    </div>
</div>




</body>
</html>

