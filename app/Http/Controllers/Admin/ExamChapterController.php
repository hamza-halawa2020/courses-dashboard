<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\ExamChapter;
use Illuminate\Http\Request;

class ExamChapterController extends Controller
{


    public function index($chapterId)
    {
        $examChapters = ExamChapter::where('chapter_id', $chapterId)->get();
        return view('admin.total_exams.index', compact('examChapters', 'chapterId'));
    }


    public function create($chapterId)
    {
        $chapter = Chapter::findOrFail($chapterId);
        return view('admin.total_exams.create', compact('chapter'));
    }




    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string',
            'chapter_id' => 'required|exists:chapters,id',
            'answers' => 'required|array',
            'answers.*' => 'required|string',
            'is_right' => 'array',
        ]);

        $examChapter = ExamChapter::create([
            'question' => $request->question,
            'chapter_id' => $request->chapter_id,
        ]);

        foreach ($request->answers as $index => $answer) {
            $examChapter->answerChapter()->create([
                'answer' => $answer,
                'is_right' => in_array($index, $request->is_right ?? []),
            ]);
        }

        return redirect()->route('admin.total_exams.index', $examChapter->chapter_id)->with('success', 'Exam chapter created successfully.');
    }


    public function show($id)
    {
        $examChapter = ExamChapter::with('answerChapter')->findOrFail($id);
        return view('admin.total_exams.show', compact('examChapter'));
    }

    public function edit($id)
    {
        $examChapter = ExamChapter::findOrFail($id);
        $answerChapter = $examChapter->answerChapter;
        return view('admin.total_exams.edit', compact('examChapter', 'answerChapter'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'sometimes|required|string',
            'answers' => 'sometimes|required|array',
            'answers.*' => 'sometimes|required|string',
            'is_right' => 'array',
        ]);

        $examChapter = ExamChapter::findOrFail($request->id);
        $examChapter->update([
            'question' => $request->question,
        ]);

        $answersData = $request->input('answers');
        $isRightData = $request->input('is_right', []);

        foreach ($examChapter->answerChapter as $index => $answer) {
            $answer->update([
                'answer' => $answersData[$index],
                'is_right' => in_array($answer->id, $isRightData),
            ]);
        }
        return redirect()->route('admin.total_exams.index', $examChapter->chapter_id)->with('success', 'Exam chapter updated successfully.');
    }


    public function destroy($id)
    {
        $examChapter = ExamChapter::findOrFail($id);
        $chapterId = $examChapter->chapter_id;
        $examChapter->delete();

        return redirect()->route('admin.total_exams.index', $chapterId)->with('success', __('site.deleted_successfully'));
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->record_ids;
        ExamChapter::whereIn('id', explode(',', $ids))->delete();
        return redirect()->route('admin.total_exams.index');
    }
}