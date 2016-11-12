<?php

namespace myDelivery\Http\Requests;

use myDelivery\Http\Requests\Request;

class OrderRequest extends Request
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
            'cadName' => 'required|min:3',
            'cadNeighborhood' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'cadName.required' => 'Campo Nome é obrigatório.',
            'cadNeighborhood.required' => 'Campo Bairro é obrigatório.'
        ];
    }
}
