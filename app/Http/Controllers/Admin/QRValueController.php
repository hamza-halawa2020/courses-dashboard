<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QRvalueRequest;
use App\Models\Apartment;
use App\Models\QRvalue;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class QRValueController extends Controller

{
    public function __construct()
    {
        $this->middleware('permission:read_qRvalues')->only(['index']);
        $this->middleware('permission:create_qRvalues')->only(['create', 'store']);
        $this->middleware('permission:update_qRvalues')->only(['edit', 'update']);
        $this->middleware('permission:delete_qRvalues')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.qRvalues.index');

    }// end of index

    public function data()
    {
        $qRvalues = QRvalue::all();

        return DataTables::of($qRvalues)
            ->addColumn('record_select', 'admin.qRvalues.data_table.record_select')
            /*->addColumn('related_apartments', 'admin.qRvalues.data_table.related_apartments')*/
            ->editColumn('created_at', function (QRvalue $qRvalue) {
                return $qRvalue->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.qRvalues.data_table.actions')
            ->rawColumns(['record_select','actions','related_apartments'])
            ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.qRvalues.create');

    }// end of create

    public function store(QRvalueRequest $request)
    {
        QRvalue::create($request->only(['tittle','value']));
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.qRvalues.index');

    }// end of store

    public function edit(QRvalue $qRvalue)
    {

        //return  $qRvalue;
        return view('admin.qRvalues.edit', compact('qRvalue'));

    }// end of edit

    public function update(QRvalueRequest $request, QRvalue $qRvalue)
    {
        $qRvalue->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.qRvalues.index');

    }// end of update

    public function destroy(QRvalue $qRvalue)
    {
        //after qr
        /*$user = User::where('id', $stage->id)->count();
        if ($user>0){
            session()->flash('error', __('site.can_not_stage'));
            return response(__('site.can_not_stage'));
        }
        else{
            $this->delete($stage);
            session()->flash('success', __('site.deleted_successfully'));
            return response(__('site.deleted_successfully'));

        }*/

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $qRvalue = QRvalue::FindOrFail($recordId);
            $this->delete($qRvalue);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(QRvalue $qRvalue)
    {
        $qRvalue->delete();
    }// end of delete
}
