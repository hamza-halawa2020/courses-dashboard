<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LectureResource;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $stageId = $user->stage_id;
        $lectures = Lecture::with('chapter')
            ->whereHas('chapter.course', function ($query) use ($stageId) {
                $query->where('stage_id', $stageId);
            })->get();
        return response()->api(LectureResource::collection($lectures));

    }


    public function show($id)
    {
        $user = Auth::user();
        $stageId = $user->stage_id;
        $lecture = Lecture::with('chapter', 'questionHomeWorks')
            ->whereHas('chapter.course', function ($query) use ($stageId) {
                $query->where('stage_id', $stageId);
            })->findOrFail($id);

        return response()->api(new LectureResource($lecture));
    }

}
