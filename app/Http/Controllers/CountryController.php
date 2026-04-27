<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PHPUnit\Framework\Constraint\Count;

class CountryController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
         $this->authorizeResource(Country::class, 'country');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::all();

        return response()->json([
            'countries'=>$countries
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $country = $request->validate([
            'name'=>'required|string'
        ]);

         try {
             $country = Country::create(['name'=>$request->name]);

            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json([
                    'message' => 'the country is alredy here'
                ], 400);
            }


        return response()->json([
            'massege'=>'Country created'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name'=>'nullable|string'
        ]);

        $country->update([
            'name'=> $request->name ?? $country->name
        ]);

        return response()->json([
            'massege'=>'country updated',
            $country
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
}
