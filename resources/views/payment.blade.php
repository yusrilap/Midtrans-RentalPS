<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <title>Rental PS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <h2 class="text-center">Payment</h2>

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

            <button class="btn btn-primary w-100" id="pay-button">Payment</button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
      // Also, use the embedId that you defined in the div above, here.
      window.snap.pay('{{$snapToken}}', {
        onSuccess: function (result) {
          /* You may add your own implementation here */
        //   alert("payment success!"); console.log(result);
        window.location.href = '/invoice/{{$booking->id}}'
        },
        onPending: function (result) {
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
        },
        onError: function (result) {
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
        },
        onClose: function () {
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      });
    });
  </script>

</body>
</html>
