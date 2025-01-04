<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherResource;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{


    public function index()
    {
        $user = Auth::user();
        $stageId = $user->stage_id;
        $now = now();

        $teachers = Teacher::whereHas('courses', function ($query) use ($stageId) {
            $query->where('stage_id', $stageId);
        })
            ->with([
                'courses' => function ($query) use ($stageId) {
                    $query->where('stage_id', $stageId);
                },
                'courses.chapters.lectures' => function ($query) use ($now) {
                    $query->where('end', '>', $now);
                }
            ])
            ->get();


        return response()->api(TeacherResource::collection($teachers));
    }


    public function show($id)
    {
        $user = Auth::user();
        $stageId = $user->stage_id;
        $now = now();

        $teacher = Teacher::whereHas('courses', function ($query) use ($stageId) {
            $query->where('stage_id', $stageId);
        })
            ->with([
                'courses.chapters.lectures' => function ($query) use ($now) {
                    $query->where('end', '>', $now);
                }
            ])
            ->findOrFail($id);


        return response()->api(new TeacherResource($teacher));
    }


}
