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
            'pieces' => 'required|numeric|between:1,50',
            'price' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'size.required' => 'O campo Tamanho é obrigatório',
            'parts.not_in' => 'O campo Dividido é obrigatório',
            'pieces.required' => 'O campo Pedaços é obrigatório, deve conter um numero maior que zero',
            'pieces.between' => 'Pedaços deve estar entre 1 e 50.',
            'price.required' => 'O campo Preço é obrigatório'
        ];
    }
}
