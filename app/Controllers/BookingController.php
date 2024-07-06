<?php

namespace App\Controllers;

use App\Models\Booking;
use App\Models\LockedAccount;
use App\Models\Log;
use App\Models\User;
use App\Services\SecurityManager;

class BookingController
{
    public static function index()
    {
        return Booking::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public static function store($request)
    {
        $validToken = SecurityManager::validateCSRFToken($request['csrf_token']);

        if (!$validToken) {
            return ['status' => false, 'message' => 'Invalid CSRF token'];
        }

        // Find the user by email
        $booking = Booking::where('schedule_id', $request['schedule_id'])
            ->where('user_id', Auth::user()->id)
            ->first();

        if (!$booking) {
            $bookingStatus = Booking::create([
                'schedule_id' => $request['schedule_id'],
                'user_id' => Auth::user()->id,
            ]);
            if ($bookingStatus){
                $action = "Boat booked ". $request['boat'] . " day " . $request['day']. " time ". $request['time'];
                LogsController::create($action);

                return ['status' => true, 'message' => 'Booking has been created'];
            }else{
                LogsController::create("Something went wrong while booking, Booking not found");
                return ['status' => false, 'message' => 'Something went wrong, please try again later'];
            }
        }

        LogsController::create("Booking while booking already exist");
        return ['status' => false, 'message' => 'Booking already exists'];
    }

    public static function allBookings()
    {
        return Booking::orderBy('created_at', 'desc')
            ->get();
    }


}