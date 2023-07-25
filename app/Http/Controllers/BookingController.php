<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $index = Booking::where('order_id','like','%' . $request->get('q') . '%')->where('active', '1')->orderBy('created_at', 'DESC')->paginate(6);
        $history = Booking::where('order_id','like','%' . $request->get('q') . '%')->where('active', '0')->orderBy('created_at', 'DESC')->paginate(6);
        return view('admin.meeting.index', compact('index','history'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = $this->validate($request, [
            'room' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        Booking::where('id', $id)->update($update);

        return redirect()->back()->with(['success' => 'Data succesfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
    public function done($id)
    {
        Booking::where('id', $id)->where('active','1')->update([
            'active' => '0',
        ]);

        return redirect()->back()->with(['success' => 'Data has been moved to draft!']);
    }

    public function storeAppointment(Request $request)
    {
        $request->validate([
            'room' => 'required',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'duration' => 'required',
            'total' => 'required',
            'capacity' => 'required',
        ]);

        $name = Auth()->User()->name;
        $roomName = $request->input('room');
        $date = $request->input('date');
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
        $duration = $request->input('duration');
        $total = $request->input('total');
        $capacity = $request->input('capacity');
        if ($capacity <= 8 && $capacity >= 1 ) {
             // $currentTime = now()->format('H:i:s'); // Current time

            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            // Check for overlapping appointments
            $overlappingAppointment = Booking::where('room', $roomName)
            ->where('date', $date)
            ->where('status', 'paid')
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($query) use ($startTime, $endTime) {
                    $query->where('start_time', '<', $endTime)
                        ->where('end_time', '>', $startTime);
                })->orWhere(function ($query) use ($startTime, $endTime) {
                    $query->where('start_time', '>', $startTime)
                        ->where('start_time', '<', $endTime);
                });
            })->first();

            if ($overlappingAppointment) {
                return redirect()->back()->with('error', 'Maaf, Ruang meeting pada jam yang dipilih telah di pesan.');
            }
            
            // check if order is same
            $countOrder = Booking::where('date', $date)
                ->where('start_time', $startTime)
                ->where('end_time', $endTime)
                ->where('status', 'unpaid')
                ->where('user_email', Auth()->User()->email)->get();

            $generate_id = rand();
            while (Booking::where('order_id', $generate_id)->exists()) {
                $generate_id = rand();
            }
            // dd($countOrder);
            if (count($countOrder) == 1) {
                $update = ([
                    'order_id' => $generate_id,
                ]);
                DB::table('bookings')->where('status', 'unpaid')->where('user_email', Auth()->User()->email)
                ->update($update);
            }else{
                // Save the appointment to the database
                $appointment = new Booking();
                $appointment->user_email = Auth()->User()->email;
                $appointment->username = Auth()->User()->name;
                $appointment->room = $roomName;
                $appointment->date = $date;
                $appointment->order_id = $generate_id;
                $appointment->start_time = $startTime;
                $appointment->end_time = $endTime;
                $appointment->duration = $duration;
                $appointment->total = $total;
                $appointment->capacity = $capacity;
                $appointment->save();
            }
            $params = array(
                'transaction_details' => array(
                    'order_id' => $generate_id,
                    'gross_amount' => $total,
                ),
                'customer_details' => array(
                    'first_name' => Auth()->user()->name,
                    'email' => Auth()->user()->email,
                ),
            );
            $order_id = $params['transaction_details']['order_id'];

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $get = Booking::latest('created_at')->get()[0];

        } else {
            return redirect()->back()->with('error', 'Maaf, kapasitas maksimal ruang meeting 8 orang');
        }
        // return redirect()->back()->with('success', 'Pemesanan ruang meeting berhasil dibuat!');

        return view('frontend.checkoutRoom', [
            'name' => $name,
            'room' => $roomName,
            'date' => $date,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'duration' => $duration,
            'total' => $total,
            'snapToken' => $snapToken,
            'order_id' => $order_id,
            'capacity' => $capacity,
            'get' => $get,
        ]);
    }
    public function callback()
    {
        $order_id = Booking::orderBy('created_at', 'desc')->value('order_id');

        Booking::where('order_id', $order_id)
                    ->where('user_email', Auth()->User()->email)
                    ->where('status', 'unpaid')
                    ->update([
                        'status' => 'paid'
                    ]);

        return $order_id;
    }
    public function invoice($order_id)
    {
        $orders = Booking::where('order_id', $order_id)
            ->where('user_email', Auth()->User()->email)
            ->where('status', 'paid')->get();

        return view('frontend.bookingInvoice',compact('orders'));
    }
    public function back(Booking $booking, $get)
    {
        $booking->where('created_at', $get)->delete();

        return redirect()->route('meeting');
    }
}
