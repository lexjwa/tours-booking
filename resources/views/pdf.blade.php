<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Reports</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>--}}
    <style type="text/css" media="all">

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100% !important;

        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            font-size: 9px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

<div class="" style="margin-top: 5%;">
    <h2 style="text-align: center;margin-bottom: 30px;">  <a href="#" style="color:#128ced;text-decoration:none;outline:0"><img height="100" width="100" alt="" src="{{config('app.url').'img/logo.png'}}" border="0"></a></h2>
    <h2 style="text-align: center;margin-bottom: 30px;">Tours Booking</h2>

    {{--<p>The .table-bordered class adds borders to a table:</p>--}}
    <table class="table "  >
        <thead class="thead">
        <tr>
            <th>Date</th>
            <th>Event Title</th>
            <th>Participant Name</th>

            <th style="width: 120px;">Email</th>
            <th>Mobile</th>
            <th>(£)Total AMount</th>
            <th>(£)Paid Amount</th>
            <th>(£)Balance Due</th>

        </tr>
        </thead>
        <tbody>
        @foreach($order as $value)
            <tr >

                <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value['created_at'])->format('d m Y')}}</td>
                <td>{{$value['event_title']}}</td>
                <td>{{$value['participantName']}}</td>

                <td style="width: 120px;">{{$value['email']}}</td>
                <td>{{$value["mobile"]}}</td>
                <td>{{$value["total_payable"]}}</td>
                <td>{{$value["amountPaid"]}}</td>
                <td>{{$value["balanceDue"]}}</td>



            </tr>
        @endforeach
        {{--<tr >
            <td>2</td>
            <td>tour to charsada</td>
            <td>arsalan</td>

            <td>sikandarbajwalex@gmail.com</td>
            <td>03920222211</td>
            <td>121</td>
            <td>212</td>
            <td>2222</td>



        </tr>
--}}

        </tbody>
    </table>
</div>

</body>
</html>

