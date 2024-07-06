<?php

namespace App\Controllers;

use App\Models\Schedule;
use App\Services\SecurityManager;
use Carbon\Carbon;

class SchedulesController
{
    public static function index()
    {
        return Schedule::where('schedules_date', '>=', Carbon::now()->toDateString())
                ->orderBy('schedules_date')
                ->get();
    }

    public static function stord($request)
    {
        $validToken = SecurityManager::validateCSRFToken($request['csrf_token']);

        if (!$validToken) {
            return ['status' => false, 'message' => 'Invalid CSRF token'];
        }

        if (empty($request['day']) || empty($request['schedules_date']) || empty($request['schedules_time']) || empty($request['boat_id'])) {
            return ['status' => false, 'message' => 'All fields must be filled'];
        }

        // Find the user by email
        $schedule = Schedule::where('schedules_date', $request['schedules_date'])
            ->where('schedules_time', $request['schedules_time'])
            ->where('day', $request['day'])
            ->first();

        if (!$schedule) {
            $scheduleStatus = Schedule::create([
                'day' => $request['day'],
                'schedules_date' => $request['schedules_date'],
                'schedules_time' => $request['schedules_time'],
                'boat_id' => $request['boat_id'],
            ]);
            if ($scheduleStatus){
                $action = "Schedule exist". $request['schedules_date'] . " day " . $request['day']. " time ". $request['schedules_time'];
                LogsController::create($action);

                return ['status' => true, 'message' => 'Schedule has been created'];
            }else{
                LogsController::create("Something went wrong while adding Schedule, Schedule not created");
                return ['status' => false, 'message' => 'Something went wrong, please try again later'];
            }
        }

        LogsController::create("Adding Schedule while Schedule already exist");
        return ['status' => false, 'message' => 'Schedule already exists'];

    }
    public static function show($id)
    {

    }


}