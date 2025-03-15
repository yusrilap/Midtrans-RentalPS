<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental PS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <h2 class="text-center">Invoice Booking Rental PlayStation</h2>

    <div class="card p-4">
         <div class="card p-4">
            <div class="mb-3">
                <label>Nama</label>
                <label> : {{$booking->user_name}}</label>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <label> : {{$booking->email}}</label>
            </div>

            <div class="mb-3">
                <label>Tanggal Booking</label>
                <label> : {{$booking->booking_date}}</label>
            </div>

            <div class="mb-3">
                <label>Rental</label>
                <label> : {{$booking->service_type}}</label>
            </div>

            <div class="mb-3">
                <h5>Total Harga: <span id="total_price"><label> : {{$booking->total_price}}</label></span></h5>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <label> : {{$booking->status}}</label>
            </div>
    </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
