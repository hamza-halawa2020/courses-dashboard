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
        return view('admin.exam_chapters.index', compact('examChapters', 'chapterId'));
    }


    public function create()
    {
        return view('admin.exam_chapters.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string',
            'chapter_id' => 'required|exists:chapters,id',
        ]);

        // Create a new exam chapter
        $examChapter = ExamChapter::create($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('admin.exam_chapters.index')->with('success', 'Exam chapter created successfully.');
    }


    public function show($id)
    {
        $examChapter = ExamChapter::with('answerChapter')->findOrFail($id);
        return view('admin.exam_chapters.show', compact('examChapter'));
    }

    public function edit($id)
    {
        $examChapter = ExamChapter::findOrFail($id);
        return view('admin.exam_chapters.edit', compact('examChapter'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'question' => 'required|string',
            'chapter_id' => 'required|exists:chapters,id',
        ]);

        // Find the exam chapter by ID
        $examChapter = ExamChapter::findOrFail($id);

        // Update the exam chapter with the validated data
        $examChapter->update($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('admin.exam_chapters.index')->with('success', 'Exam chapter updated successfully.');
    }

    public function destroy($id)
    {
        $examChapter = ExamChapter::findOrFail($id);
        $examChapter->delete();
        return redirect()->route('admin.exam_chapters.index');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->record_ids;
        ExamChapter::whereIn('id', explode(',', $ids))->delete();
        return redirect()->route('admin.exam_chapters.index');
    }
}