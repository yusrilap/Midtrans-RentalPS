<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index() {
        return view('home');
    }

    public function booking(Request $request){

            // dd($request->all());
            $request->validate([
                'user_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'booking_date' => 'required|date',
                'service_type' => 'required|string|in:PS4,PS5'
            ]);

            $basePrice = $request->service_type === 'PS4' ? 30000 : 40000;
            $isWeekend = in_array(date('N', strtotime($request->booking_date)), [6, 7]);
            $surcharge = $isWeekend ? 50000 : 0;
            $totalPrice = $basePrice + $surcharge;

            $request->request->add([
                'total_price' => $totalPrice,
                'status' => 'Unpaid'
            ]);

            $booking = Booking::create($request->all());

            \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => 'BOOK-' . $booking->id . '-' . time(),
                    'gross_amount'=> $booking->total_price,
                ),
                'customer_details' => array(
                    'first_name' => $request->user_name,
                    'email'      => $request->email,
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            //dd($snapToken);
            return view('payment', compact('snapToken', 'booking'));
    }

    public function callback(Request $request){
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

        if ($hashed === $request->signature_key) {
            if ($request->transaction_status === 'capture' || $request->transaction_status === 'settlement') {
                $orderIdParts = explode('-', $request->order_id);
                $bookingId = $orderIdParts[1] ?? null;

                if ($bookingId) {
                    $booking = Booking::find($bookingId);
                    if ($booking) {
                        $booking->update(['status' => 'Paid']);
                        return response()->json(['message' => 'Payment updated successfully'], 200);
                    }
                }
            }
        }
    }

    public function invoice($id){
        $booking = Booking::find($id);
        return view('invoice', compact('booking'));
    }
}