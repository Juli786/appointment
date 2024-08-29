<?php

namespace App\Http\Requests;

use App\Appointment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAppointmentRequest extends FormRequest
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
            'duration' => [
                'required',
            ],
            'duration_type' => [
                'required',
            ],
            'duration_type' => [
                'required',
            ],
            'service'  => [
                'integer',
            ],
            'available_hr_start_time.*'  => [
                'required',
            ],
            'available_hr_finish_time.*'  => [
                'required',
            ],
            'available_hr_start_time'    => [
                'array',
            ],
            'available_hr_finish_time'    => [
                'array',
            ],
        ];
    }
}
