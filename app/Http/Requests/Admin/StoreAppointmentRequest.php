<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'patient_id'   => 'required|exists:patients,id',
            'name'         => 'nullable|string',
            'date'         => 'required|string',
            'start_time'   => 'required|string'
        ];
    }
}
