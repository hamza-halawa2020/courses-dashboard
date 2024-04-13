<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChapterRequest;
use App\Models\Chapter;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ChapterController extends Controller



{
    public function __construct()
    {
        $this->middleware('permission:read_chapters')->only(['index']);
        $this->middleware('permission:create_chapters')->only(['create', 'store']);
        $this->middleware('permission:update_chapters')->only(['edit', 'update']);
        $this->middleware('permission:delete_chapters')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.chapters.index');

    }// end of index


    public function show(Chapter $chapter)
    {
        return $chapter;
        //$chapter->delete();
    }// end of show

    public function data()
    {
        $chapters = Chapter::whenCourseId(request()->course_id);

        return DataTables::of($chapters)
            ->addColumn('record_select', 'admin.chapters.data_table.record_select')
            //->addColumn('related_apartments', 'admin.chapters.data_table.related_apartments')
            ->editColumn('created_at', function (Chapter $chapter) {
                return $chapter->created_at->format('Y-m-d');
            })/*->editColumn('stage', function ( Chapter $chapter) {
                $name = $chapter->stage->name;
                return view('admin.users.data_table.stage', compact('name'));
            })*/
            ->addColumn('actions', 'admin.chapters.data_table.actions')
            ->rawColumns(['record_select','actions','related_apartments'])
            ->toJson();

    }// end of data

    public function create()
    {
        $stages = Stage::all();
        return view('admin.chapters.create',compact('stages'));

    }// end of create

    public function store(ChapterRequest $request)
    {
        Chapter::create([
            'tittle'=>$request->tittle,
            'price'=>$request->price,
            'course_id'=>1,
        ]);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.chapters.index');

    }// end of store

    public function edit(Chapter $chapter)
    {
        $stages = Stage::all();
        return view('admin.chapters.edit', compact('chapter','stages'));

    }// end of edit

    public function update(ChapterRequest $request, Chapter $chapter)
    {


        //return $request;
        $chapter->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.chapters.index');

    }// end of update

    public function destroy(Chapter $chapter)
    {
        //$id = $chapter->id;
        $user = User::where('id', $chapter->id)->count();
        if ($user>0){
            session()->flash('error', __('site.can_not_chapter'));
            return response(__('site.can_not_chapter'));
        }
        else{
            $this->delete($chapter);
            session()->flash('success', __('site.deleted_successfully'));
            return response(__('site.deleted_successfully'));

        }

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $chapter = Chapter::FindOrFail($recordId);
            $this->delete($chapter);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Chapter $chapter)
    {
        $chapter->delete();
    }// end of delete
}
