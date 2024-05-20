<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseRequest;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Stage;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_courses')->only(['index']);
        $this->middleware('permission:create_courses')->only(['create', 'store']);
        $this->middleware('permission:update_courses')->only(['edit', 'update']);
        $this->middleware('permission:delete_courses')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.courses.index');

    }// end of index




    // public function show($id)
    // {
    //     $course = Course::findOrFail($id);
    //     return view('admin.courses.show', compact('course'));
    // }

    public function show($id)
    {
        $course = Course::with('chapters')->findOrFail($id);
        return view('admin.courses.show', compact('course'));
    }
    public function data()
    {
        $courses = Course::all();

        return DataTables::of($courses)
            ->addColumn('record_select', 'admin.courses.data_table.record_select')
            //->addColumn('related_apartments', 'admin.courses.data_table.related_apartments')
            ->editColumn('created_at', function (Course $course) {
                return $course->created_at->format('Y-m-d');
            })->editColumn('stage', function (Course $course) {
                $name = $course->stage->name;
                return view('admin.users.data_table.stage', compact('name'));
            })
            ->editColumn('chapters_count', function (Course $course) {
                return $course->chapters->count();
            })
            ->addColumn('actions', 'admin.courses.data_table.actions')
            ->rawColumns(['record_select', 'actions', 'related_apartments'])
            ->toJson();
    }// end of data

    // public function create()
    // {
    //     $stages = Stage::whereNotIn('id', [1])->get();
    //     return view('admin.courses.create', compact('stages'));

    // }// end of create
    public function create()
    {
        $stages = Stage::all();
        $teachers = Teacher::all();

        return view('admin.courses.create', compact('stages', 'teachers'));
    }


    public function store(CourseRequest $request)
    {
        Course::create($request->only(['title', 'stage_id', 'teacher_id']));
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.courses.index');

    }// end of store

    public function edit(Course $course)
    {
        $stages = Stage::whereNotIn('id', [1])->get();
        return view('admin.courses.edit', compact('course', 'stages'));

    }// end of edit

    public function update(CourseRequest $request, Course $course)
    {


        //return $request;
        $course->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.courses.index');

    }// end of update

    public function destroy(Course $course)
    {

        //return $course->id;

        $chapters = Chapter::where('course_id', $course->id)->count();
        if ($chapters == 0) {
            $course = Course::FindOrFail($course->id);
            $this->delete($course);
            session()->flash('success', __('site.deleted_successfully'));
            return response(__('site.deleted_successfully'));
        }

        session()->flash('error', __('site.can_not_course'));
        return response(__('site.can_not_course'));

        /*//$id = $course->id;
        $user = User::where('id', $course->id)->count();
        if ($user>0){
            session()->flash('error', __('site.can_not_course'));
            return response(__('site.can_not_course'));
        }
        else{
            $this->delete($course);
            session()->flash('success', __('site.deleted_successfully'));
            return response(__('site.deleted_successfully'));

        }*/

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {


            $chapters = Chapter::where('course_id', $recordId)->count();
            if ($chapters == 0) {
                $course = Course::FindOrFail($recordId);
                $this->delete($course);
            } else {
                session()->flash('error', __('site.can_not_course'));
                return response(__('site.can_not_course'));
            }

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Course $course)
    {
        $course->delete();
    }// end of delete


    public function getCourse($id)
    {
        $course = Course::find($id);

        if (!$course) {
            abort(404);
        }
        return $course;
    }// end of create
}

