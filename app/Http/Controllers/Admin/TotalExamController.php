<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TotalExam;
use Illuminate\Http\Request;

class TotalExamController extends Controller
{


    public function index($teacherId)
    {
        $totalExam = TotalExam::where('teacher_id', $teacherId)->get();
        return view('admin.total_exams.index', compact('totalExam', 'teacherId'));
    }


    public function create($teacherId)
    {
        $teacher = Teacher::findOrFail($teacherId);
        return view('admin.total_exams.create', compact('teacher'));
    }




    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string',
            'start_at' => 'required',
            'end_at' => 'required',
            'teacher_id' => 'required|exists:teachers,id',
            'answers' => 'required|array',
            'answers.*' => 'required|string',
            'is_right' => 'array',
        ]);

        $totalExam = TotalExam::create([
            'question' => $request->question,
            'teacher_id' => $request->teacher_id,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);

        foreach ($request->answers as $index => $answer) {
            $totalExam->answerTotalExam()->create([
                'answer' => $answer,
                'is_right' => in_array($index, $request->is_right ?? []),
            ]);
        }

        return redirect()->route('admin.total_exams.index', $totalExam->teacher_id)->with('success', 'Exam teacher created successfully.');
    }


    public function show($id)
    {
        $totalExam = TotalExam::with('answerTotalExam')->findOrFail($id);
        return view('admin.total_exams.show', compact('totalExam'));
    }

    public function edit($id)
    {
        $totalExam = TotalExam::findOrFail($id);
        $answerTotalExam = $totalExam->answerTotalExam;
        return view('admin.total_exams.edit', compact('totalExam', 'answerTotalExam'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'sometimes|required|string',
            'answers' => 'sometimes|required|array',
            'answers.*' => 'sometimes|required|string',
            'is_right' => 'array',
        ]);

        $totalExam = TotalExam::findOrFail($request->id);
        $totalExam->update([
            'question' => $request->question,
        ]);

        $answersData = $request->input('answers');
        $isRightData = $request->input('is_right', []);

        foreach ($totalExam->answerTotalExam as $index => $answer) {
            $answer->update([
                'answer' => $answersData[$index],
                'is_right' => in_array($answer->id, $isRightData),
            ]);
        }
        return redirect()->route('admin.total_exams.index', $totalExam->teacher_id)->with('success', 'Exam teacher updated successfully.');
    }


    public function destroy($id)
    {
        $totalExam = TotalExam::findOrFail($id);
        $teacherId = $totalExam->teacher_id;
        $totalExam->delete();

        return redirect()->route('admin.total_exams.index', $teacherId)->with('success', __('site.deleted_successfully'));
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->record_ids;
        TotalExam::whereIn('id', explode(',', $ids))->delete();
        return redirect()->route('admin.total_exams.index');
    }
}