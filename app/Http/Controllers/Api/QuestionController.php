<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class QuestionController extends Controller
{

    public function index()
    {
        $userStageId = auth()->user()->stage_id;

        $questions = Question::with('answers')->where('stage_id', $userStageId)->get();

        return response()->api(QuestionResource::collection($questions));

    }

    public function show($id)
    {
        $userStageId = auth()->user()->stage_id;

        $Question = Question::with('answers')->where('stage_id', $userStageId)->findOrFail($id);
        return response()->api(new QuestionResource($Question));
    }

    public function randomQuestion()
    {
        $userId = auth()->id();
        $userStageId = auth()->user()->stage_id;
        $viewCountKey = 'question_view_count_' . $userId;
        $lastViewedAtKey = 'last_question_viewed_at_' . $userId;

        $viewCount = Cache::get($viewCountKey, 0);
        $lastViewedAt = Cache::get($lastViewedAtKey);
        if ($viewCount >= 2 && $lastViewedAt && Carbon::parse($lastViewedAt)->addHours(24)->isFuture()) {
            return response()->api([], 1, 'You have already viewed the maximum number of questions within the last 24 hours.');
        }
        $question = Question::with('answers')->where('stage_id', $userStageId)->inRandomOrder()->limit(1)->get();

        $viewCount++;
        Cache::put($viewCountKey, $viewCount, now()->addHours(24));
        Cache::put($lastViewedAtKey, Carbon::now(), now()->addHours(24));

        return response()->api(QuestionResource::collection($question));
    }

}


