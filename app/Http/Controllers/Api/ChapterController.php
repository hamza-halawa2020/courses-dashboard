<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChapterResource;
use App\Models\Chapter;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{


    public function index()
    {
        $user = Auth::user();
        $stageId = $user->stage_id;

        $chapters = Chapter::with('lectures')
            ->whereHas('course', function ($query) use ($stageId) {
                $query->where('stage_id', $stageId);
            })->get();

        return response()->api(ChapterResource::collection($chapters));
    }



    public function show($id)
    {
        $user = Auth::user();
        $stageId = $user->stage_id;

        $chapter = Chapter::with('lectures')
            ->whereHas('course', function ($query) use ($stageId) {
                $query->where('stage_id', $stageId);
            })->findOrFail($id);

        return response()->api(new ChapterResource($chapter));
    }


}
