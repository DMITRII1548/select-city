<?php

namespace App\Http\Controllers;

use App\Http\Resources\City\CityResource;
use App\Models\City;

class CityController extends Controller
{
    /**
     * Return city by id
     */
    public function show(City $city): array
    {
        return CityResource::make($city)->resolve();
    }

    /**
     * Return cities by prefix
     */
    public function getCityByPrefix(string $city): array
    {
        $cities = City::where('name', 'LIKE', "%$city%")->get();

        return CityResource::collection($cities)->resolve();
    }
}
