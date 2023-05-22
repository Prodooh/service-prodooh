<?php

namespace App\Http\Controllers\Company;

use App\Actions\Company\CreateCompanyAction;
use App\Actions\Company\ProcessCountriesAction;
use App\Http\Controllers\BaseController;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(
        CompanyRequest $request,
        CreateCompanyAction $companyAction,
        ProcessCountriesAction $countriesAction
    ): JsonResponse
    {
        $company = $companyAction->execute($request->validated());
        $countriesAction->execute($company, $request->countries);

        $this->createImage($request, $company);

        return $this->successMessage();
    }

    /**
     * @param Company $company
     * @return JsonResponse
     */
    public function show(Company $company): JsonResponse
    {
        return $this->showOne($company->load('images', 'country', 'countries'));
    }

    /**
     * @param CompanyRequest $request
     * @param ProcessCountriesAction $countriesAction
     * @param Company $company
     * @return JsonResponse
     */
    public function update(CompanyRequest $request, ProcessCountriesAction $countriesAction, Company $company): JsonResponse
    {
        $company->update(
            collect($request->validated())
                ->except('image', 'countries')
                ->toArray()
        );

        $countriesAction->execute($company, $request->countries);

        $this->createImage($request, $company);

        return $this->successMessage();
    }

    /**
     * @param Company $company
     * @return JsonResponse
     */
    public function destroy(Company $company): JsonResponse
    {
        $company->delete();
        return $this->successMessage();
    }

    // ******************
    //  Private Methods
    // ******************

    private function createImage(Request $request, Company $company)
    {
        if ($request->has('image_principal')) {
            $company->images()->create([
                "url" => $request->image,
                "image_type" => 'principal'
            ]);
        }

        if ($request->has('image_secondary')) {
            $company->images()->create([
                "url" => $request->image,
                "image_type" => 'secondary'
            ]);
        }
    }
}
