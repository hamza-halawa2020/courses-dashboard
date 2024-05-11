<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LectureRequest;
use App\Models\Chapter;
use App\Models\Lecture;
use App\Models\Course;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LectureController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_lectures')->only(['index']);
        $this->middleware('permission:create_lectures')->only(['create', 'store']);
        $this->middleware('permission:update_lectures')->only(['edit', 'update']);
        $this->middleware('permission:delete_lectures')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index(Request $request)
    {
        // return $request->course;
        //return Course::find($request->course);


        //return $request->chapter_id;
        $currentChapter = new Chapter();
        if ($request->chapter_id == null) {

            $currentChapter = null;
        } else {
            $currentChapter = Chapter::find($request->chapter_id);
        }
        //$currentChapter= Chapter::find($request->chapter_id);
        return view('admin.lectures.index', compact('currentChapter'));

    }// end of index


    public function show(Lecture $lecture)
    {
        return $lecture;
        //$lecture->delete();
    }// end of show

    public function data()
    {
        $lectures = Lecture::whenChapterId(request()->chapter_id);

        return DataTables::of($lectures)
            ->addColumn('record_select', 'admin.lectures.data_table.record_select')
            ->editColumn('created_at', function (Lecture $lecture) {
                return $lecture->created_at->format('Y-m-d');
            })

            ->editColumn('status', function (Lecture $lec) {
                if ($lec->status == '0') {
                    return '<h5><span class="badge badge-danger">غير نشطة</span></h5>';
                } else {
                    return '<h5><span class="badge badge-success">نشطة</span></h5>';

                }
            })
            ->addColumn('actions', 'admin.lectures.data_table.actions')
            ->rawColumns(['record_select', 'actions', 'related_apartments', 'status'])
            ->toJson();

    }// end of data

    public function create(Request $request)
    {
        // return $request;
        $currentChapter = Chapter::find($request->chapter_id);
        $stages = Stage::whereNotIn('id', [1])->get();

        return view('admin.lectures.create', compact('stages', 'currentChapter'));

    }// end of create

    public function store(LectureRequest $request)
    {
        // return $request;

        Lecture::create([
            'chapter_id' => $request->chapter_id,
            'title' => $request->title,
            'price' => $request->price,
            'video_url' => $request->video_url,
            'note_book_url' => $request->note_book_url,
            'des' => $request->des,
            'notes' => $request->notes,
            'start' => $request->start,
            'end' => $request->end,
        ]);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.lectures.index', ['chapter_id' => $request->chapter_id]);

    }// end of store

    public function edit(Lecture $lecture)
    {
        $stages = Stage::whereNotIn('id', [1])->get();
        return view('admin.lectures.edit', compact('lecture', 'stages'));

    }// end of edit

    public function update(LectureRequest $request, Lecture $lecture)
    {
        //return  $request;
        if ($request->meth == 'lectureStatus') {

            $currentLecture = Lecture::find($request->lectureIDStatus);

            if ($currentLecture) {

                if ($request->statusLecValue == 0) {

                    $currentLecture->update([
                        'status' => '1',
                    ]);
                } else {
                    $currentLecture->update([
                        'status' => '0',
                    ]);
                }
                return 'تم تغيير حالة المحاضرة بنجاح';

            } else
                return 'لقد حدث حضأ ما !!!';

        } else {

            $lecture->update($request->validated());
            session()->flash('success', __('site.updated_successfully'));
            return redirect()->route('admin.lectures.index', ['chapter_id' => $request->chapter_id]);

        }


    }// end of update

    public function destroy(Lecture $lecture)
    {
        //$id = $lecture->id;
        $user = User::where('id', $lecture->id)->count();
        if ($user > 0) {
            session()->flash('error', __('site.can_not_lecture'));
            return response(__('site.can_not_lecture'));
        } else {
            $this->delete($lecture);
            session()->flash('success', __('site.deleted_successfully'));
            return response(__('site.deleted_successfully'));

        }

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $lecture = Lecture::FindOrFail($recordId);
            $this->delete($lecture);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Lecture $lecture)
    {
        $lecture->delete();
    }// end of delete


    public function find($id)
    {
        $lecture = Lecture::find($id);

        if (!$lecture) {
            abort(404);
        }
        return $lecture;
    }// end of create
}
