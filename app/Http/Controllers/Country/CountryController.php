<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Country::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Country::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        return $country;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        return $country->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        return $country->delete();
    }
}
