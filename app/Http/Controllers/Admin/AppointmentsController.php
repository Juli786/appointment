<?php

namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\AppointmentSlot;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AppointmentsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Appointment::with(['services'])->select(sprintf('%s.*', (new Appointment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                
                $crudRoutePart = 'appointments';
                $shareLink = url("/share").'/'.Auth::user()->email.'/'.$this->enc($row->id);
                
                $duration =  ($row->duration_type == "min") ? $row->duration ." Minutes" : $row->duration ." hrs";
                $sm_duration =  ($row->duration_type == "min") ? $row->duration ." Min" : $row->duration ." hrs";
                return view('partials.datatablesActions', compact(
                    'crudRoutePart',
                    'shareLink',
                    'sm_duration',
                    'duration',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('duration', function ($row) {
                return $row->duration ? $row->duration : '';
            });
            

            // $table->editColumn('comments', function ($row) {
            //     return $row->comments ? $row->comments : "";
            // });
            $table->editColumn('services', function ($row) {
                $labels = [];

                foreach ($row->services as $service) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $service->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder',  'services']);

            return $table->make(true);
        }

        return view('admin.appointments.index');
    }

    public function create()
    {
        

        
        $services = Service::all()->pluck('name', 'id');

        return view('admin.appointments.create', compact('services'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        
        // dd($request->all());
        $available_hr = [];
        $slot = [];
        foreach($request->available_hr_start_time as $k=>$range){
            $available_hr[] = $range.'='.$request->available_hr_finish_time[$k];
              
             // Create Carbon instances for start and end times
             if( $range != "" && $request->available_hr_finish_time[$k] != '' ){
                $start = Carbon::createFromFormat('Y-m-d H:i', $range);
                $end = Carbon::createFromFormat('Y-m-d H:i', $request->available_hr_finish_time[$k]);

                     $minutesToAdd = (int)$request->duration;

                    // Loop until the start time is greater than or equal to the end time
                    while ($start->lessThan($end)) {
                        // Output the current start time
                        $slot[]  = $start->format('Y-m-d H:i');
                        // Calculate remaining minutes
                        $remainingMinutes = $start->diffInMinutes($end);
                        
                        // Add minutes to the start time
                        if ($remainingMinutes < $minutesToAdd) {
                            $minutesToAdd = $remainingMinutes;
                        }
                        
                        $start->addMinutes($minutesToAdd);
                    }
            }
                
        }
      
        
        $appointment = Appointment::create(['name' => $request->name , 'duration' => $request->duration , 'duration_type' => $request->duration_type , 'service' => $request->service , 'available_hr' => json_encode($available_hr) ] );

        $slote_id = [];
        $slot = array_unique($slot);
        foreach($slot as $slot_data){
            
            if($slot_data != ''){
                $appointment_slot = AppointmentSlot::create(['appointment_id' => $appointment->id , 'start_time' => $slot_data]);
                $slote_id[] = $appointment_slot->id;    
            }
        }
        $appointment->update(['slot' => implode(',', $slote_id)]);
        return redirect()->route('admin.appointments.index');
    }

    public function edit(Appointment $appointment)
    {
        
        
        $services = Service::all()->pluck('name', 'id');

        $appointment->load( 'services');
        $appointment->available_hr = json_decode($appointment->available_hr);
        $date = [];
        foreach($appointment->available_hr  as $k=>$time ){
            $times = explode('=' ,$time );
            $date[$k]['start_time'] = $times[0];
            $date[$k]['finish_time'] = $times[1];
        }
        return view('admin.appointments.edit', compact( 'services', 'appointment' ,'date'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        // dd($request->all());
        $available_hr = [];
        $slot = [];
        foreach($request->available_hr_start_time as $k=>$range){
            
            $available_hr[] = $range.'='.$request->available_hr_finish_time[$k];
            
            // Create Carbon instances for start and end times
             if( $range != "" && $request->available_hr_finish_time[$k] != '' ){
                $start = Carbon::createFromFormat('Y-m-d H:i', $range);
                $end = Carbon::createFromFormat('Y-m-d H:i', $request->available_hr_finish_time[$k]);

                $minutesToAdd = (int)$request->duration;
                
                    // Loop until the start time is greater than or equal to the end time
                    while ($start->lessThan($end)) {
                        // Output the current start time
                        $slot[]  = $start->format('Y-m-d H:i');
                        // Calculate remaining minutes
                        $remainingMinutes = $start->diffInMinutes($end);
                        
                        // Add minutes to the start time
                        if ($remainingMinutes < $minutesToAdd) {
                            $minutesToAdd = $remainingMinutes;
                        }
                        // dd($start);
                        $start->addMinutes($minutesToAdd);
                        
                    }
                }
        }
        
        

        $slote_id = [];
        $slot = array_unique($slot);
        AppointmentSlot::where('appointment_id' , $appointment->id)->delete();
        foreach($slot as $slot_data){
            
            if($slot_data != ''){
                $appointment_slot = AppointmentSlot::create(['appointment_id' => $appointment->id , 'start_time' => $slot_data]);
                $slote_id[] = $appointment_slot->id;    
            }
        }
        $appointment->update(['name' => $request->name , 'duration' => $request->duration , 'duration_type' => $request->duration_type , 'service' => $request->service , 'available_hr' => json_encode($available_hr) , implode(',', $slote_id) ] );
        

        return redirect()->route('admin.appointments.index');
    }

    public function show(Appointment $appointment)
    {
        $appointment->load('services');
        $slots = AppointmentSlot::where('appointment_id' ,  $appointment->id )->get()->toArray();
        $appointment->available_hr = json_decode($appointment->available_hr);
        return view('admin.appointments.show', compact('appointment' ,'slots'));
    }

    public function destroy(Appointment $appointment)
    {

        AppointmentSlot::where('appointment_id' , $appointment->id )->delete();
        $appointment->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentRequest $request)
    {
        Appointment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
