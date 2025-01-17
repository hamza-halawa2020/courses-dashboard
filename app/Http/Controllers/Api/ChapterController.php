<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChapterResource;
use App\Models\Balance;
use App\Models\BalanceDetail;
use App\Models\BuyCourseBalance;
use App\Models\Chapter;
use App\Models\Lecture;
use App\Models\UserCanAccess;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{


    public function index()
    {
        $user = Auth::user();
        $stageId = $user->stage_id;
        $now = now();

        // $chapters = Chapter::whereHas('course', function ($query) use ($stageId) {
        //     $query->where('stage_id', $stageId);
        // })->with([
        //             'lectures' => function ($query) use ($now) {
        //                 $query->where('end', '>', $now);
        //             }
        //         ])->get();

        $chapters = Chapter::with('lectures')
            ->whereHas('course', function ($query) use ($stageId) {
                $query->where('stage_id', $stageId);
            })->get();
        return response()->api(ChapterResource::collection($chapters));
    }




    public function buyChapter($chapterId)
    {
        $user = Auth::user();
        $chapter = Chapter::findOrFail($chapterId);

        if (!$chapter) {
            return response()->api([], 1, 'Chapter not found.');
        }

        $userHasChapter = UserCanAccess::where('user_id', $user->id)
            ->where('chapter_id', $chapterId)
            ->exists();

        if ($userHasChapter) {
            return response()->api([], 1, 'You have already purchased this chapter.');
        }

        $userBalance = Balance::where('user_id', $user->id)->first();

        if (!$userBalance || $userBalance->total < $chapter->price) {
            return response()->api([], 1, 'Insufficient balance.');
        }

        $userBalance->total -= $chapter->price;
        $userBalance->save();

        $balanceDetail = BalanceDetail::create([
            'amount' => -$chapter->price,
            'balance_id' => $userBalance->id,
        ]);

        $lectureIds = Lecture::where('chapter_id', $chapterId)->pluck('id');

        foreach ($lectureIds as $lectureId) {
            $userCanAccess = UserCanAccess::create([
                'user_id' => $user->id,
                'lecture_id' => $lectureId,
            ]);
        }

        BuyCourseBalance::create([
            'balance_detail_id' => $balanceDetail->id,
            'user_can_access_id' => $userCanAccess->id,
            'user_id' => $user->id,
        ]);



        return response()->api(new ChapterResource($chapter), 0, 'Chapter purchased successfully.');
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
