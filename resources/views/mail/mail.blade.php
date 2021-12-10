<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartment Rental Management System</title>
    <style>
        *{
            text-align:center;
            box-sizing: border-box;
            padding:0;
            margin:0;
        }

        body{
            margin:0;
            padding:0;
        }

        .main-container{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height:100vh;
            width:100vw;
        }

        .header-container{
            display:flex;
            justify-content: center;
            align-items:center;
            background-color:#EAAA00;
            height:20%;
            width:100%;
        }

        .body-container{
            background-color:#FFFFCC;
            height:80%;
            width:100%;
        }



    </style>
</head>
<body>

<div class="main-container">
    <div class = "header-container">
        <h1 class = "header">
            Apartment Rental Management System
        </h1>
    </div>

    <div class= "body-container">
        <p class= "mail-body">Hi {{$surname}}, {{$first}} {{$middle}}</p>
    </div>

</div>


</body>
</html>
