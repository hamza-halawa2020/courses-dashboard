<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LectureResource;
use App\Models\Balance;
use App\Models\BalanceDetail;
use App\Models\BuyCourseBalance;
use App\Models\Lecture;
use App\Models\UserCanAccess;
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
        $now = now();
        $lectures = Lecture::where('end', '>', $now)
            ->whereHas('chapter.course', function ($query) use ($stageId) {
                $query->where('stage_id', $stageId);
            })->get();
        return response()->api(LectureResource::collection($lectures));

    }

    public function videoWatched(Lecture $lecture)
    {
        $userId = Auth::id();
        UserCanAccess::where('user_id', $userId)
            ->where('lecture_id', $lecture->id)
            ->update(['watched' => 1]);
        return response()->api([], '', 'done.');
    }

    public function buyLecture($lectureId)
    {
        $user = Auth::user();
        $lecture = Lecture::findOrFail($lectureId);

        if (!$lecture) {
            return response()->api([], 1, 'lecture not found.');
        }

        $userHaslecture = UserCanAccess::where('user_id', $user->id)
            ->where('lecture_id', $lectureId)
            ->exists();

        if ($userHaslecture) {
            return response()->api([], 1, 'You have already purchased this lecture.');
        }

        $userBalance = Balance::where('user_id', $user->id)->first();

        if (!$userBalance || $userBalance->total < $lecture->price) {
            return response()->api([], 1, 'Insufficient balance.');
        }

        $userBalance->total -= $lecture->price;
        $userBalance->save();

        $balanceDetail = BalanceDetail::create([
            'amount' => -$lecture->price,
            'balance_id' => $userBalance->id,
        ]);

        $userCanAccess = UserCanAccess::create([
            'user_id' => $user->id,
            'lecture_id' => $lectureId,
        ]);

        BuyCourseBalance::create([
            'balance_detail_id' => $balanceDetail->id,
            'user_can_access_id' => $userCanAccess->id,
            'user_id' => $user->id,
        ]);

        return response()->api(new LectureResource($lecture), 0, 'lecture purchased successfully.');
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
