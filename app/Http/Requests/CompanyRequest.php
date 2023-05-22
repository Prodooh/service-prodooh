<?php

namespace App\Http\Requests;

use App\Enums\CompanyImageEnum;
use App\Enums\CompanyRoleEnum;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\In;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'country_id'        =>  ['required', 'integer'],
            'name'              =>  ['required', 'string', 'max:255'],
            'multiplier'        =>  ['numeric', 'nullable'],
            'countries'         =>  ['array', 'nullable'],
            'countries.*.country_id' => ['required', 'numeric'],
            'countries.*.discount'   => ['required', 'numeric'],
            'countries.*.increase'   => ['required', 'numeric'],
            'cell_phone'        => ['string', 'min:5', 'max:20', 'nullable'],
            'phone_number'      => ['string', 'min:5', 'max:20', 'nullable'],
            'fiscal_key'        => ['string', 'max:255', 'nullable'],
            'fiscal_address'    => ['string', 'max:255', 'nullable'],
            'business_name'    => ['string', 'max:255', 'nullable'],
            'billing_email'     => ['string', 'email', 'max:255', 'nullable'],
            'role'              => [
                'required',
                'string',
                'max:50',
                new In([
                    CompanyRoleEnum::Administrator->value,
                    CompanyRoleEnum::Provider->value,
                    CompanyRoleEnum::Seller->value,
                    CompanyRoleEnum::Client->value
                ])
            ],
            'contact_name'      => ['string', 'min:1', 'nullable'],
            'contact_phone'     => ['string', 'min:1', 'nullable'],
            'contact_email'     => ['string', 'email', 'nullable'],
            'contact_position'  => ['string', 'min:1', 'nullable'],
            'image'             => ['string', 'nullable'],
            'images'            => ['array', 'nullable'],
            'images.*.name'     => ['required', 'string'],
            'images.*.type'     => [
                'required',
                'string',
                new In([
                    CompanyImageEnum::Principal->value,
                    CompanyImageEnum::Secondary->value,
                ])
            ]
        ];
    }
}
