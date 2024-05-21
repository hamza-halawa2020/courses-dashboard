<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LectureResource;
use App\Models\Lecture;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lectures = Lecture::all();
        return response()->api(LectureResource::collection($lectures));
    }


    public function show($id)
    {
        $lecture = Lecture::findOrFail($id);
        return response()->api(new LectureResource($lecture));
    }

}
