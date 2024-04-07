<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Apartment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_posts')->only(['index']);
        $this->middleware('permission:create_posts')->only(['create', 'store']);
        $this->middleware('permission:update_posts')->only(['edit', 'update']);
        $this->middleware('permission:delete_posts')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {


        return view('admin.posts.index');
    }

    public function data()
    {
        $posts = Post::select();

        return DataTables::of($posts)
            ->addColumn('record_select', 'admin.posts.data_table.record_select')
            ->editColumn('created_at', function (Post $post) {
                return $post->created_at->format('Y-m-d');
            })->editColumn('user', function (Post $post) {
                $user =User::find($post->user_id);
                $name = $user->name;
                return view('admin.posts.data_table.user', compact('name'));
            })
            ->addColumn('actions', 'admin.posts.data_table.actions')
            ->rawColumns(['record_select', 'related_coupons', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.posts.create');

    }// end of create

    public function store(PostRequest $request)
    {
        Post::create(
            [
                'body' => $request->body,
                'phone' => $request->phone,
                'user_id' =>auth()->id(),
            ]);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.posts.index');

    }// end of store

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));

    }// end of edit

    public function update(PostRequest $request, Post $post)
    {
        $requestData = $request->validated();
        $post->update($requestData);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.posts.index');

    }// end of update

    public function destroy(Post $post)
    {
        Storage::disk('local')->delete('public/uploads/posts/' . $post->image);
        $this->delete($post);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $post = Post::FindOrFail($recordId);
            $this->delete($post);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Post $post)
    {
        $post->delete();

    }// end of delete
}
