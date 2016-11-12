<?php

namespace myDelivery\Http\Requests;

use myDelivery\Http\Requests\Request;

class DeliverieRequest extends Request
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
        return [];
        /*
        return [
            'order_id' => 'required|unique:deliveries,order_id',
        ];
         * 
         */
    }
}
