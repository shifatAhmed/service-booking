<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    // customer to view their won bookings
    public function myBookings()
    {
        $bookings = Booking::with('service')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return response()->json(['bookings' => $bookings]);
    }

    // for customer to book service
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id'    => 'required|exists:services,id',
            'booking_date'  => 'required|date|after_or_equal:today',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $service = Service::find($request->service_id);
        if (!$service || !$service->status) {
            return response()->json(['message' => 'Service is not available'], 400);
        }

        $booking = Booking::create([
            'user_id'      => auth()->id(),
            'service_id'   => $request->service_id,
            'booking_date' => $request->booking_date,
            'status'       => 1,
        ]);

        return response()->json([
            'message' => 'Booking successful',
            'booking' => $booking
        ], 201);
    }

    // For admin to view all bookings
    public function allBookings()
    {
        $bookings = Booking::with(['service', 'user'])
            ->latest()
            ->get();

        return response()->json(['bookings' => $bookings]);
    }
}
