<?php

namespace myDelivery\Http\Requests;

use myDelivery\Http\Requests\Request;

class AdminFlavorRequest extends Request
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
            'name' => 'required|min:1|max:60',
            'description' => 'required|min:1|max:200',
            'price' => 'required|min:1'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Campo Nome é obrigatorio!',
            'description.required' => 'Campo Descrição é obrigatorio!',
            'price.required' => 'Campo Preço é obrigatorio!'
        ];
    }
}
