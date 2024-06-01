<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamLecture;
use App\Models\Lecture;
use Illuminate\Http\Request;

class ExamLectureController extends Controller
{

    public function index($lectureId)
    {
        $examLecture = ExamLecture::where('lecture_id', $lectureId)->get();
        return view('admin.exam_lectures.index', compact('examLecture', 'lectureId'));
    }


    public function create($lectureId)
    {
        $lecture = Lecture::findOrFail($lectureId);
        return view('admin.exam_lectures.create', compact('lecture'));
    }




    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string',
            'lecture_id' => 'required|exists:lectures,id',
            'answers' => 'required|array',
            'answers.*' => 'required|string',
            'is_right' => 'array',
        ]);

        $examlecture = ExamLecture::create([
            'question' => $request->question,
            'lecture_id' => $request->lecture_id,
        ]);

        foreach ($request->answers as $index => $answer) {
            $examlecture->answerLecture()->create([
                'answer' => $answer,
                'is_right' => in_array($index, $request->is_right ?? []),
            ]);
        }

        return redirect()->route('admin.exam_lectures.index', $examlecture->lecture_id)->with('success', 'Exam lecture created successfully.');
    }


    public function show($id)
    {
        $examlecture = ExamLecture::with('answerlecture')->findOrFail($id);
        return view('admin.exam_lectures.show', compact('examlecture'));
    }

    public function edit($id)
    {
        $examlecture = ExamLecture::findOrFail($id);
        $answerlecture = $examlecture->answerlecture;
        return view('admin.exam_lectures.edit', compact('examlecture', 'answerlecture'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'sometimes|required|string',
            'answers' => 'sometimes|required|array',
            'answers.*' => 'sometimes|required|string',
            'is_right' => 'array',
        ]);

        $examlecture = ExamLecture::findOrFail($request->id);
        $examlecture->update([
            'question' => $request->question,
        ]);

        $answersData = $request->input('answers');
        $isRightData = $request->input('is_right', []);

        foreach ($examlecture->answerlecture as $index => $answer) {
            $answer->update([
                'answer' => $answersData[$index],
                'is_right' => in_array($answer->id, $isRightData),
            ]);
        }
        return redirect()->route('admin.exam_lectures.index', $examlecture->lecture_id)->with('success', 'Exam lecture updated successfully.');
    }


    public function destroy($id)
    {
        $examlecture = ExamLecture::findOrFail($id);
        $lectureId = $examlecture->lecture_id;
        $examlecture->delete();

        return redirect()->route('admin.exam_lectures.index', $lectureId)->with('success', __('site.deleted_successfully'));
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->record_ids;
        ExamLecture::whereIn('id', explode(',', $ids))->delete();
        return redirect()->route('admin.exam_lectures.index');
    }
}