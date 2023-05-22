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
        $company = $companyAction->execute(
            collect($request->validated())
                ->except('images', 'countries')
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
                ->except('images', 'countries')
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

    /**
     * @param Request $request
     * @param Company $company
     * @return void
     */
    private function createImage(Request $request, Company $company): void
    {
        if ($company->images()->count()) {
            $company->images()->delete();
        }

        if ($request->has('images')) {
            foreach ($request->images as $image) {
                $company->images()->create([
                    "url" => $image['name'],
                    "image_type" => $image['type']
                ]);
            }
        }
    }
}
