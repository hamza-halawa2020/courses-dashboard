<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StageRequest;
use App\Models\Apartment;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_stages')->only(['index']);
        $this->middleware('permission:create_stages')->only(['create', 'store']);
        $this->middleware('permission:update_stages')->only(['edit', 'update']);
        $this->middleware('permission:delete_stages')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.stages.index');

    }// end of index

    public function data()
    {
        $stages = Stage::whereNotIn('id', [1])->get();

        return DataTables::of($stages)
            ->addColumn('record_select', 'admin.stages.data_table.record_select')
            ->editColumn('created_at', function (Stage $stage) {
                return $stage->created_at->format('Y-m-d');
            })
            ->editColumn('users_count', function (Stage $stage) {
                return $stage->users->count();
            })
            ->addColumn('actions', 'admin.stages.data_table.actions')
            ->rawColumns(['record_select', 'actions', 'related_apartments'])
            ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.stages.create');

    }// end of create

    public function store(StageRequest $request)
    {
        Stage::create($request->only(['name']));
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.stages.index');

    }// end of store

    public function edit(Stage $stage)
    {
        return view('admin.stages.edit', compact('stage'));

    }// end of edit

    public function update(StageRequest $request, Stage $stage)
    {


        return $request;
        $stage->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.stages.index');

    }// end of update

    public function destroy(Stage $stage)
    {
        //$id = $stage->id;
        $user = User::where('id', $stage->id)->count();
        if ($user > 0) {
            session()->flash('error', __('site.can_not_stage'));
            return response(__('site.can_not_stage'));
        } else {
            $this->delete($stage);
            session()->flash('success', __('site.deleted_successfully'));
            return response(__('site.deleted_successfully'));

        }

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $user = User::where('stage_id', $recordId)->count();
            if ($user > 0) {
                session()->flash('error', __('site.can_not_stage'));
                return response(__('site.can_not_stage'));
            } else {
                $stage = Stage::FindOrFail($recordId);
                $this->delete($stage);

            }

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Stage $stage)
    {
        $stage->delete();
    }// end of delete
}
