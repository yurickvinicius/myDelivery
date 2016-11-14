<?php

namespace myDelivery\Http\Requests;

use myDelivery\Http\Requests\Request;

class SizePizzaRequest extends Request
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
            'size' => 'required|min:1|max:60',
            'parts' => 'required|not_in:0',
            'price' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'size.required' => 'O campo Tamanho é obrigatório',
            'parts.required' => 'O campo Dividido é obrigatório',
            'price.required' => 'O campo Preço é obrigatório'
        ];
    }
}
