<?php

namespace App\Http\Requests;

use App\Service;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateServiceRequest extends FormRequest
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
            'link' => [
                'required',
            ],
        ];
    }
}
