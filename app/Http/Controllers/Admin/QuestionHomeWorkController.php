<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\QuestionHomeWork;
use Illuminate\Http\Request;

class QuestionHomeWorkController extends Controller
{

    public function index($lectureId)
    {
        $questionHomeWrok = QuestionHomeWork::where('lecture_id', $lectureId)->get();
        return view('admin.question_home_works.index', compact('questionHomeWrok', 'lectureId'));
    }


    public function create($lectureId)
    {
        $lecture = Lecture::findOrFail($lectureId);
        return view('admin.question_home_works.create', compact('lecture'));
    }




    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string',
            'lecture_id' => 'required|exists:lectures,id',
            'answers' => 'required|array',
            'answers.*.text' => 'required|string|max:255',
            'answers.*.is_right' => 'nullable|boolean',
        ]);

        $questionHomeWrok = QuestionHomeWork::create([
            'question' => $request->question,
            'lecture_id' => $request->lecture_id,
        ]);

        foreach ($request->input('answers') as $answer) {
            $questionHomeWrok->answerHomeWork()->create([
                'answer' => $answer['text'],
                'is_right' => isset($answer['is_right']) ? 1 : 0,
            ]);
        }

        return redirect()->route('admin.question_home_works.index', $questionHomeWrok->lecture_id)->with('success', 'Exam lecture created successfully.');
    }


    public function show($id)
    {
        $questionHomeWrok = QuestionHomeWork::with('answerHomeWork')->findOrFail($id);
        return view('admin.question_home_works.show', compact('questionHomeWrok'));
    }

    public function edit($id)
    {
        $questionHomeWrok = QuestionHomeWork::findOrFail($id);
        $answerHomeWork = $questionHomeWrok->answerHomeWork;
        return view('admin.question_home_works.edit', compact('questionHomeWrok', 'answerHomeWork'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'sometimes|required|string',
            'answers' => 'sometimes|required|array',
            'answers.*' => 'sometimes|required|string',
            'is_right' => 'array',
        ]);

        $questionHomeWrok = QuestionHomeWork::findOrFail($request->id);
        $questionHomeWrok->update([
            'question' => $request->question,
        ]);

        $answersData = $request->input('answers');
        $isRightData = $request->input('is_right', []);

        foreach ($questionHomeWrok->answerHomeWork as $index => $answer) {
            $answer->update([
                'answer' => $answersData[$index],
                'is_right' => in_array($answer->id, $isRightData),
            ]);
        }
        return redirect()->route('admin.question_home_works.index', $questionHomeWrok->lecture_id)->with('success', 'Exam lecture updated successfully.');
    }


    public function destroy($id)
    {
        $questionHomeWrok = QuestionHomeWork::findOrFail($id);
        $lectureId = $questionHomeWrok->lecture_id;
        $questionHomeWrok->delete();

        return redirect()->route('admin.question_home_works.index', $lectureId)->with('success', __('site.deleted_successfully'));
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->record_ids;
        QuestionHomeWork::whereIn('id', explode(',', $ids))->delete();
        return redirect()->route('admin.question_home_works.index');
    }
}