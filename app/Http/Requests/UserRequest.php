<?php

namespace myDelivery\Http\Requests;

use myDelivery\Http\Requests\Request;

class UserRequest extends Request
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
    if(isset($this->id)){
      return [
        'name' => 'required|min:3|max:60',
        'email' => 'required|email|max:70',
        'role' => 'required|min:3',
      ];
    }else{
      return [
        'name' => 'required|min:3|max:60',
        'email' => 'required|email|max:70|unique:users,email',
        'role' => 'required|min:3',
        'password' => 'required|min:5|confirmed',
      ];
    }


  }

}
