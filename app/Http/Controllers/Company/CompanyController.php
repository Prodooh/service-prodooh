<?php

namespace App\Http\Controllers\Company;

use App\Actions\Company\CreateCompanyAction;
use App\Http\Controllers\BaseController;
use App\Http\Requests\CompanyRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request, CreateCompanyAction $action): JsonResponse
    {
        $action->execute($request->validated());
        return $this->successMessage();
    }
}
