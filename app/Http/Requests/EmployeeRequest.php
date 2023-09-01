<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->isMethod('PUT')) {
            return [
                'tax_id_number' => 'required|size:13',
                'name' => 'required',
                'last_name' => 'required',
                'birth_date' => 'required|date',
                'email' => 'required|email:filter',
                'cell_phone' => 'required',
            ];
        }

        return [
            'tax_id_number' => 'required|unique:employees,tax_id_number|size:13',
            'name' => 'required',
            'last_name' => 'required',
            'birth_date' => 'required|date',
            'email' => 'required|email:filter',
            'cell_phone' => 'required',
        ];
    }
}
