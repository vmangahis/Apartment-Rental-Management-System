<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartment Rental Management System</title>
    <style>
        body{
            Margin:0;
            padding:0;
            background-color: #FFFFCC;
        }

        table{
            border-spacing:0;

        }

        td{
            padding:0;
        }
        img{
            border:0;
        }

        .wrapper{
            width:100%;
            table-layout: fixed;
            background-color: #FFFFCC;
            padding-bottom:40px;
        }

        .webkit{
            max-width:600px;
            background-color:#EAAA00;
        }

        .outer{
            Margin:0 auto;
            width:100%;
            max-width:600px;
            border-spacing:0;
            font-family: sans-serif;

        }

        .message{
            background-color:#FFFFCC;
        }

        @media screen and(max-width:600px) {


        }

        @media screen and(max-width:400px) {

        }


    </style>
</head>
<body>

<center class="wrapper">
    <div class="webkit">
        <table class="outer" align="center">
            <tr>
                <td>
                    <table width="100%" style ="border-spacing:0;">

                        <tr>
                            <td>
                                <h1>Apartment Rental Management System</h1>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>


            <tr class="message">
                <td>
                    <h3>Hi <span class="tenant-name"></span>,</h3>
                    <h4 class="message-body">This email serves as confirmation of your rent to <span class="owner-name"></span> apartment dated <span class="rent-date"></span> and your room number is Your room number is <span class="room-number"></span>.
                        Your monthly payment is <span class="monthly"></span>. If you don't recognize this activity, please feel free to disregard this message.
                    </h4>
                </td>
            </tr>

            <tr>
                <td>
                    <table width="100%" style ="border-spacing:0;">

                        <tr>
                            <td>
                                <h3>- APT Project</h3>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

        </table>

    </div>
</center>


</body>
</html>
