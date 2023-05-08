<?php

namespace App\Http\Controllers\Company;

use App\Actions\Company\CreateCompanyAction;
use App\Http\Controllers\BaseController;
use App\Http\Requests\CompanyRequest;
use Illuminate\Http\Request;

class CompanyController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request, CreateCompanyAction $action)
    {
        $action->execute($request->validated());
        return $this->successMessage();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
