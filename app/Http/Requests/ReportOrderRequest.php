<?php

namespace myDelivery\Http\Requests;

use myDelivery\Http\Requests\Request;

class ReportOrderRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'startDate' => 'required|min:1',
            'endDate' => 'required|min:1',
            'status' => 'required|not_in:0'
        ];
    }

    public function messages()
    {
        return [
            'startDate.required' => 'Campo Data Inicial é obrigatorio!',
            'endDate.required' => 'Campo Data Final é obrigatorio!',
            'status.required' => 'Campo Status é obrigatorio!'
        ];
    }
}
