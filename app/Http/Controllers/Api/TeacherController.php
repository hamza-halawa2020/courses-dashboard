<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherResource;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    public function index()
    {
        $teachers = Teacher::with(['courses.chapters.lectures'])->get();
        return response()->api(TeacherResource::collection($teachers));
    }



    public function show($id)
    {
        $teacher = Teacher::with(['courses.chapters.lectures'])->findOrFail($id);

        return response()->api(new TeacherResource($teacher));

    }


}
