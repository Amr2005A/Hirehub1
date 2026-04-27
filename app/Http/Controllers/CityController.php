<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CityController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
         $this->authorizeResource(City::class, 'city');
    }

    public function index()
    {
        return response()->json(City::with('country')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        $city = City::create($data);

        return response()->json($city, 201);
    }

    public function show(City $city)
    {
        return response()->json($city->load('country'));
    }

    public function update(Request $request, City $city)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'country_id' => 'sometimes|exists:countries,id',
        ]);

        $city->update($data);

        return response()->json($city);
    }

    public function destroy(City $city)
    {
        $city->delete();

        return response()->json([
            'message' => 'City deleted successfully'
        ]);
    }
}
