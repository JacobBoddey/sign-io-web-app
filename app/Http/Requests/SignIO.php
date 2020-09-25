<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignIO extends FormRequest
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
            'reason' => 'required_without:reason_dropdown|string'
        ];
    }

    public function messages() {

      return [
        'reason.required_without' => "You must enter a reason",
        'reason.string' => "The reason must be a string"
      ];

    }

}
