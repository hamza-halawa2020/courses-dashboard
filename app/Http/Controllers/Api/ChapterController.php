<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChapterResource;
use App\Models\Chapter;

class ChapterController extends Controller
{


    public function index()
    {
        // $userStageId = Auth::user()->stage_id;
        // $chapters = Course::where('stage_id', $userStageId)->get();
        $chapters = Chapter::with('lectures')->get();
        return response()->api(ChapterResource::collection($chapters));
    }



    public function show($id)
    {
        $chapter = Chapter::with('lectures')->findOrFail($id);

        return response()->api(new ChapterResource($chapter));
    }


}
