<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamChapter;
use Illuminate\Http\Request;

class ExamChapterController extends Controller
{

    public function index()
    {
        $examChapters = ExamChapter::all();
        return view('admin.examChapters.index', compact('examChapters'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(ExamChapter $examChapter)
    {
        return view('admin.examChapters.show', compact('examChapter'));
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
