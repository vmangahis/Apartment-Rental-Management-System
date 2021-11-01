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
    <div class="border-end bg-dark sidebar" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom bg-dark text-center text-white try">Apartment Rental Management System</div>
        <div class=" list-group-flush">
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation" href="/">Profile</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation" href="{{route('summary')}}">Summary</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation" href="{{route('tenants')}}">Tenants</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation" href="{{route('room')}}">Rooms</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation" href="{{route('payment')}}">Payments</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-white navigation" href="{{route('report')}}">Reports</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-dark border-bottom border-top border-white navigation logout" href="#!">Log Out</a>
        </div>

    </div>
    <!-- Page content wrapper-->
    <div id="page-content-wrapper" class="main-container">
        @yield('content')
    </div>
</div>




</body>
</html>

