<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentSlot;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController  extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function sharEventLink($email , $id){
        // dd($this->enc($id , true));
        $user = User::where('email' , $email)->first();
        $event = Appointment::find($this->enc($id , true));
        $event->available_hr = json_decode($event->available_hr);
        $selected_date = [];
        foreach($event->available_hr as $slot){
            $selected_date[] = explode('=' , $slot)[0];
        }
        
        return view('schedule-appointment' , compact('event' ,'user' , 'selected_date'));

    }
    public function availableSlot(Request $request){
       
        $data = AppointmentSlot::with('appointment')->whereDate('start_time' , $request->date)->get()->map(function ($e){
            $data = [];
            $data['start_time'] = $e->start_time;
            $time = Carbon::parse($e->start_time);
            $data['finish_time'] = ($e->appointment->duration_type == "min") ? $time->addMinutes((int)$e->appointment->duration)->format('Y-m-d H:i') :  $time->start_time->addHours((int)$e->appointment->duration)->format('Y-m-d H:i');
            $data['slot'] = date('h:iA',  strtotime($e->start_time));
            return $data;
        });
        return response()->json([
            'status'  => true,
            'data'    =>  $data,    
        ]);
    }
    public function scheduleDetail(Meeting $Metting) {
        
        // dd($Metting);
        return view('schedule-detail' , compact('Metting'));
    }
    public function submitScheduleDetail(Request $request) {
        
        
        $Metting = Meeting::create(['name' => $request->name , 'email' => $request->email , 'timezone' => 'Indian Standard Time' , 'duration' => $request->duration , 'start_time' => $request->start_time , 'finish_time' => $request->finish_time , 'appointment_id' => $request->appointment_id , 'comments' => $request->comments]);


        return redirect(route('schedule-detail' , $Metting->id));
         
    }
}
