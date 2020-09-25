<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Auth;

class VerifyCode extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|alpha_num|between:5,5'
        ];
    }

    public function messages() {
      return [
        'code.required' => 'You must enter the code before verifying',
        'code.alpha_num' => 'The verification code is in the incorrect format',
        'code.between' => 'The verification code is in the incorrect format'
      ];
    }

}
