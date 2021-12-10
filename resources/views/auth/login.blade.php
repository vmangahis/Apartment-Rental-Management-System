<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" />
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />

    <title>Login</title>
</head>
<body>
        @if($error == 4)
            <div class = "text-danger">{{$message}}</div>
            @endif
        <div class="login-container">
                    <h4>Login</h4>
                    <h5 class="login-error text-danger"></h5>
                    <form method = "POST" id="login">
                        <div class="form-group">
                            <label>Username:</label>
                            <input type="text" name="loginUsername" placeholder="Input username..." class="form-control">
                        </div>
                        <div class="text-danger error loginUsername-error"></div>

                        <div class="form-group mt-3">
                            <label>Password:</label>
                            <input type="password" name="loginPassword" placeholder="Input password..." class="form-control">
                        </div>
                        <div class="text-danger error loginPassword-error"></div>

                        <div class="d-flex flex-column justify-content-center align-items-center">
                        <button type="button" class="btn  btn-primary mt-2 loginbutton">Login</button>
                        </div>
                    </form>
        </div>
@include('script.loginscript')
</body>
</html>
