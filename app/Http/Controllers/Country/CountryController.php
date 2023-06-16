<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StatesRequest;
use App\Models\Country;
use App\Models\Screen;
use App\Models\State;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        return Country::whereRaw('unaccent(LOWER(name)) like \'%'. strtolower($request->word) . '%\'')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Country::create($request->all());
        return $this->showMessageSuccess();
    }

    public function index(){
        if (count(auth()->user()->company->countries) > 0) {
            $countries = auth()->user()->company->countries;
        } else {
            $countries = Country::orderBy( 'name', 'asc' )->get();
        }
        return $this->showAll($countries);
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        return $this->showOne($country);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        $country->update($request->only(
            'name', 'dollar_change', 'tax', 'type_of_currency'
        ));
        return $this->showMessageSuccess();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return $this->showMessageSuccess();
    }

    /**
     * @param StatesRequest $request
     * @return JsonResponse
     */
    public function getStatesCountry(StatesRequest $request): JsonResponse
    {
        $states = State::whereIn('country_id', $request->countries_ids)->get();
        return $this->showAll($states);
    }

}
