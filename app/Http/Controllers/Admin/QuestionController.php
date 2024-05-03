<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
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
        return view('admin.questions.index');
    }

    public function data()
    {
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

    public function show(Question $question)
    {
        return $question;
    }


    public function create()
    {
        $stages = Stage::all();

        return view('admin.questions.create', compact('stages'));
    }


    public function store(Request $request)
    {
        $question = Question::create([
            'question' => $request->input('question'),
            'stage_id' => $request->input('stage_id'),
        ]);
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


    public function edit(Question $question)
    {
        $answer = Answer::where('question_id', $question->id)->get();
        $stages = Stage::all();

        return view('admin.questions.edit', compact('question', 'stages', 'answer'));
    }
    // public function update(Request $request, $id)
    // {
    //     $question = Question::findOrFail($id);
    //     $question->update([
    //         'question' => $request->input('question'),
    //         'stage_id' => $request->input('stage_id'),
    //     ]);

    //     $answersData = $request->input('answers');
    //     $isRightData = $request->input('is_right');

    //     // foreach ($answersData as $index => $answer) {
    //     $answer = Answer::update([
    //         'answer' => $answersData,
    //         'is_right' => $isRightData
    //     ]);
    //     // }

    //     session()->flash('success', __('site.updated_successfully'));
    //     return redirect()->route('admin.questions.index');
    // }


    public function update($id, Request $request)
    {
        $question = Question::findOrFail($id);
        $question->update([
            'question' => $request->input('question'),
            'stage_id' => $request->input('stage_id'),
        ]);

        $answers = $question->answers;


        foreach ($answers as $answer) {
            $answersData = $request->input('answers');
            $isRightData = $request->input('is_right');
            $answer->update([
                'answer' => $answersData,
                'is_right' => $isRightData
            ]);
        }

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.questions.index');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));
        // }
    } // end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $question = question::FindOrFail($recordId);
            $question->delete();

        } //end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));
    } // end of bulkDelete
}
