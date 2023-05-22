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
        $company = Company::create($data);

        return $company;
    }
}
