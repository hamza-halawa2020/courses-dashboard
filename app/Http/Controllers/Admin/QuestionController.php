<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;
use App\Models\Stage;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_questions')->only(['index']);
        $this->middleware('permission:create_questions')->only(['create', 'store']);
        $this->middleware('permission:update_questions')->only(['edit', 'update']);
        $this->middleware('permission:delete_questions')->only(['delete', 'bulk_delete']);
    } // end of __construct

    public function index()
    {
        // $questions = Question::all();
        return view('admin.questions.index');
        // return DataTables::of($questions)->toJson();
    } // end of index

    public function data()
    {
        // $questions = Question::with('stage')->get();
        $questions = Question::all();


        return DataTables::of($questions)
            ->addColumn('record_select', 'admin.questions.data_table.record_select')
            ->editColumn('id', function (Question $question) {
                return $question;
            })
            ->addColumn('stage_withal', function (Question $question) {
                return $question->stage->name;
            })
            ->addColumn('actions', 'admin.questions.data_table.actions')
            ->rawColumns(['record_select', 'stage_withal', 'actions'])
            ->toJson();
    }



    public function create()
    {
        $stages = Stage::all();

        return view('admin.questions.create', compact('stages'));
    }


    // public function store(Request $request)
    // {
    //     Question::create($request->only(['question', 'answer', 'stage_id']));
    //     session()->flash('success', __('site.added_successfully'));
    //     return redirect()->route('admin.questions.index');
    // }

    public function store(Request $request)
    {
        // Create the question
        $question = Question::create([
            'question' => $request->input('question'),
            'stage_id' => $request->input('stage_id'),
        ]);

        // Store answers
        $answers = $request->input('answers');
        $is_right = $request->input('is_right');

        foreach ($answers as $index => $answer) {
            $question->answers()->create([
                'answer' => $answer,
                'is_right' => isset($is_right[$index]),
                'question_id' => $question->id
            ]);
        }

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.questions.index');
    }


    public function edit()
    {
        return view('admin.questions.edit', compact('question'));
    } // end of edit

    // public function update(Request $request, Request $place)
    // {
    //     $place->update($request->validated());

    //     session()->flash('success', __('site.updated_successfully'));
    //     return redirect()->route('admin.questions.index');
    // } // end of update


    // private function delete(Request $place)
    // {
    //     $place->delete();
    // } // end of delete
}
