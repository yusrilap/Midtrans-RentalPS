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
    <h2 class="text-center">Booking Rental PlayStation</h2>

    <div class="card p-4">
        <form action="/booking" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="user_name"  name="user_name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="booking_date" class="form-label">Tanggal Booking</label>
                <input type="date" class="form-control" id="booking_date" name="booking_date" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Pilih Rental</label>
                <select class="form-select" id="service_type" name="service_type">
                    <option value="PS4">Rental PS4 - Rp 30.000</option>
                    <option value="PS5">Rental PS5 - Rp 40.000</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">* Tambahan Rp 50.000 jika pemesanan dilakukan pada hari Sabtu atau Minggu.</label>
                <h5>Total Harga: <span id="total_price">Rp 30.000</span></h5>
            </div>
            <button type="submit" class="btn btn-primary w-100" id="pay-button">Pesan Sekarang</button>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const serviceType = document.getElementById("service_type");
    const bookingDate = document.getElementById("booking_date");
    const totalPriceElement = document.getElementById("total_price");

    function updateTotalPrice() {
        let basePrice = serviceType.value === "PS4" ? 30000 : 40000;

        let isWeekend = false;
        if (bookingDate.value) {
            const selectedDate = new Date(bookingDate.value);
            const day = selectedDate.getDay();
            isWeekend = (day === 6 || day === 0); // Sabtu (6) atau Minggu (0)
        }

        let surcharge = isWeekend ? 50000 : 0;
        let totalPrice = basePrice + surcharge;

        totalPriceElement.textContent = `Rp ${totalPrice.toLocaleString("id-ID")}`;
    }

    serviceType.addEventListener("change", updateTotalPrice);
    bookingDate.addEventListener("change", updateTotalPrice);
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
