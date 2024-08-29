<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Appointment;

class SystemCalendarController extends Controller
{

    public function index()
    {
        $events = [];

        $appointments = Appointment::get();

        foreach ($appointments as $appointment) {
            if (!$appointment->start_time) {
                continue;
            }

            $events[] = [
                'title' => $appointment->name,
                'start' => $appointment->start_time,
                'url'   => route('admin.appointments.edit', $appointment->id),
            ];
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
