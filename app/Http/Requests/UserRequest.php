<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
//            'company_id'    =>   ['integer', 'exists:companies, id'],
//            'country_id'    =>   ['required', 'integer', 'exists:countries, id'],
            'name'          =>   ['required', 'string', 'max:255'],
            'surnames'      =>   ['required', 'string', 'max:255'],
//            'image'         =>   ['required','image'],
            'email'         =>   ['required', 'string', 'email', 'max:255', isset($this->user->id) ? 'unique:users,email,'. $this->user->id : 'unique:users'],
            'role'          =>   ['required', 'integer', 'exists:roles,id'],
            'password'      =>   ['string', 'min:8' ]
        ];
    }
}
