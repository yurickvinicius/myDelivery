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

    if($this->request->get('cadName')){
      $rules = [
        'cadName' => 'required|min:3|max:70',
        'cadNeighborhood' => 'required|min:3|max:70',
        'cadAddress' => 'required|min:3|max:80',
        'cadNumber' => 'required|numeric',
        'cadTelCellPhone' => 'required|min:8',
      ];
    }

    if($this->request->get('cadBoard')){
      $rules = [
        'cadBoard' => 'required|min:1',
      ];
    }

    foreach($this->request->get('pizza') as $key => $val)
    {
      $rules['pizza.'.$key.'.edge'] = 'required|not_in:0';
      $rules['pizza.'.$key.'.size'] = 'required|not_in:0';
      $rules['pizza.'.$key.'.flavor'] = 'required';
    }

    return $rules;

  }

  /*
  public function messages()
  {
  return [
  'cadName.required' => 'Campo Nome é obrigatório.',
  'cadNeighborhood.required' => 'Campo Bairro é obrigatório.'
];
}
*/
}
