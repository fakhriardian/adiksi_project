<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'room_name' => 'required',
            'date' => 'required|date_format:Y-m-d',
            'time_range' => 'required',
        ]);
    
        $roomName = $request->input('room_name');
        $date = $request->input('date');
        $timeRange = $request->input('time_range');
    
        // Check if the selected date and time range overlaps with existing appointments
        $overlappingAppointments = Booking::where('room_name', $roomName)
            ->where('date', $date)
            ->where(function ($query) use ($timeRange) {
                list($startTime, $endTime) = explode(' - ', $timeRange);
                $query->where(function ($query) use ($startTime, $endTime) {
                    $query->where('start_time', '<=', $startTime)
                        ->where('end_time', '>', $startTime);
                })->orWhere(function ($query) use ($startTime, $endTime) {
                    $query->where('start_time', '<', $endTime)
                        ->where('end_time', '>=', $endTime);
                });
            })
            ->first();
    
        if ($overlappingAppointments) {
            return redirect()->back()->with('error', 'The selected date and time range overlaps with an existing appointment.');
        }
    
        // Save the room name, date, and time range to the database
        $appointment = new Booking();
        $appointment->room_name = $roomName;
        $appointment->date = $date;
        $appointment->start_time = explode(' - ', $timeRange)[0];
        $appointment->end_time = explode(' - ', $timeRange)[1];
        $appointment->save();
    
        return redirect()->back()->with('success', 'Appointment created successfully.');
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
    public function update(Request $request, Booking $booking)
    {
        //
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
}
