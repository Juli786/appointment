<?php

namespace App\Http\Requests;

use App\Appointment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize()
    {
      

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
            'start_time'  => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'finish_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'location.*'  => [
                'integer',
            ],
            // 'location'    => [
            //     'array',
            // ],
        ];
    }
}
