<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Http\Resources\ApartmentFOResource;
use App\Http\Resources\PostResource;
use App\Models\Apartment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function getAll()
    {
        $posts = Post::all();

        return response()->api(PostResource::collection($posts),0,'Data fetched successfully');

    }//end of getAll

    public function getOwn()
    {
        $posts = Post::where('user_id','=',auth()->id())->get();

        return response()->api(PostResource::collection($posts),0,'Data fetched successfully');

    }//end of getAll




    public function store(Request $request){


        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/|max:11,min:11'
        ]);


        if ($validator->fails()) {
            return response()->api([], 1, $validator->errors()->first());
        }else{

            $post=Post::create(
                [
                    'body' => $request->body,
                    'phone' => $request->phone,
                    'user_id' =>auth()->id(),
                ]);
            return response()->api(new PostResource($post),0,'Post added successfully');
        }

    }//end of store

    public function update(Request $request){



        if ($request->post_id)
        {
            $post = Post::find($request->post_id);

            if ($post) {
                if ($post->user_id == auth()->id())
                {
                    $validator = Validator::make($request->all(), [
                        'body' => 'required',
                        'phone' => 'required|regex:/(01)[0-9]{9}/|max:11,min:11'
                    ]);
                    if ($validator->fails()) {
                        return response()->api([], 1, $validator->errors()->first());
                    }
                    $post->update($request->except('post_id'));
                    return response()->api(new PostResource($post), 0, 'The post updated successfully');;
                } else {
                    return response()->api([], 1, 'You can not update this post');
                }
            }
            else
            {
                return response()->api([], 1, 'the post does not exist');
            }
        }
        else
        {
            return response()->api([], 1, 'please send post_id');
        }

    }//end of update

    public function delete(Request $request)
    {

        if ($request->post_id) {
            $post = Post::find($request->post_id);

            if ($post) {
                if ($post->user_id == auth()->id()) {
                    $post->delete();
                    return response()->api([], 0, 'The post deleted successfully');
                } else {

                    return response()->api([], 1, 'You can not update this post');
                }
            } else {
                return response()->api([], 1, 'The post does not exist');
            }
        } else {
            return response()->api([], 1, 'Please send post_id');
        }
    }//end of delete

   /* function messages()
    {
        return [
            'name.required'=>'الاسم مطلوب',
            'password.min'=>'كلمة السر قصيرة',
            'password.required'=>'كلمة السر مطلوبة',
            'phone.required'=>'رقم المحمول مطلوب',
            'type.required'=>'نوع المستخدم مطلوب',
            'phone.unique'=>'رقم المحمول مستخدم مسبقا',
            'phone.max'=>'رقم المحمول مستخدم غير صالج',
            'phone.numeric'=>'رقم المحمول مستخدم غير صالج',
        ];
    }// end of messages*/



}
