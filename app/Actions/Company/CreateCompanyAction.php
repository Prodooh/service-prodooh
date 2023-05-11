<?php

namespace App\Actions\Company;

use App\Models\Company;

class CreateCompanyAction
{
    /**
     * Create a new company instance.
     *
     * @param array $data
     * @return Company
     */
    public function execute(array $data): Company
    {
        return Company::create([
            'country_id'    =>  $data['country_id'],
            'name'          =>  $data['name'],
            'multiplier'    =>  $data['multiplier'] ?? null,
            'cell_phone'    =>  $data['cell_phone'] ?? null,
            'phone_number'  =>  $data['phone_number'] ?? null,
            'fiscal_key'    =>  $data['fiscal_key'] ?? null,
            'fiscal_address' => $data['fiscal_address'] ?? null,
            'business_name' =>  $data['business_name'] ?? null,
            'billing_email' =>  $data['billing_email'] ?? null,
            'role'          =>  $data['role'] ?? null,
            'contact_name'  =>  $data['contact_name'] ?? null,
            'contact_phone' =>  $data['contact_phone'] ?? null,
            'contact_email' =>  $data['contact_email'] ?? null,
            'contact_position' => $data['contact_position'] ?? null
        ]);
    }
}