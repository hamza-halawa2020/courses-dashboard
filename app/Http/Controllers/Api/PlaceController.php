<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlaceResource;
use App\Models\Place;

class PlaceController extends Controller
{
    public function index()
    {
        // $places = Place::all();
        $places = Place::where('id', '!=', 1)->get();
        return response()->api(PlaceResource::collection($places));
    }

}//end of controller
