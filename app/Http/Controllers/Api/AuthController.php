<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Rules\CheckOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'phone' => 'required',
    //         'password' => 'required',
    //     ], $this->message());

    //     if ($validator->fails()) {
    //         return response()->api([], 1, $validator->errors()->first());
    //     }

    //     $credentials = $request->only('phone', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();

    //         if ($user->status == 0) {
    //             Auth::logout();
    //             return response()->api([], 1, 'Your account is inactive. Please contact support.');
    //         }

    //         $data['user'] = new UserResource($user);
    //         $data['token'] = $user->createToken('my-app-token')->plainTextToken;

    //         return response()->api($data, 0, 'تم تسجيل الدخول بنجاح');
    //     } else {
    //         return response()->api([], 1, __('auth.failed'));
    //     }
    // }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ], $this->message());

        if ($validator->fails()) {
            return response()->api([], 1, $validator->errors()->first());
        }

        $credentials = $request->only('phone', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->status == 0) {
                Auth::logout();
                return response()->api([], 1, 'Your account is inactive. Please contact support.');
            }

            $data['user'] = new UserResource($user);
            $data['token'] = $user->createToken('my-app-token')->plainTextToken;

            return response()->api($data, 0, 'تم تسجيل الدخول بنجاح');
        } else {
            $existingUser = User::where('phone', $request->phone)->first();

            if ($existingUser) {
                return response()->api([], 1, 'Incorrect password.');
            } else {
                return response()->api([], 1, 'User not found with this phone number.');
            }
        }
    }



    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|unique:users,phone|max:11|string',
            'password' => 'required|min:6',
            'parent_phone' => 'required|max:11|string',
            'parent_name' => 'required',
            'place_id' => 'required',
            'stage_id' => 'required'
        ], $this->message());

        if ($validator->fails()) {
            return response()->api([], 1, $validator->errors()->first());
        }

        $user = User::create([
            'name' => $request->name,
            'type' => 'user',
            'status' => '1',
            'phone' => $request->phone,
            'parent_phone' => $request->parent_phone,
            'parent_name' => $request->parent_name,
            'place_id' => $request->place_id,
            'stage_id' => $request->stage_id,
            'password' => bcrypt($request->password),

        ]);

        $data['user'] = new UserResource($user);
        $data['token'] = $user->createToken('my-app-token')->plainTextToken;

        return response()->api($data, 0, 'تم تسجيل الدخول بنجاح');

    }//end of register

    public function user()
    {
        $data['user'] = new UserResource(auth()->user('sanctum'));
        return response()->api($data, 0, 'done');

    }// end of user


    public function updateUser(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string',
            'phone' => 'sometimes|required|unique:users,phone,' . $user->id . '|max:11|string',
            'parent_phone' => 'sometimes|required|max:11|string',
            'parent_name' => 'sometimes|required|string',
            'place_id' => 'sometimes|required|integer',
            'stage_id' => 'sometimes|required|integer',
            'password' => 'sometimes|required|string|min:8'
        ], $this->message());

        if ($validator->fails()) {
            return response()->api([], 1, $validator->errors()->first());
        }

        $user->update($request->only([
            'name',
            'phone',
            'parent_phone',
            'parent_name',
            'place_id',
            'stage_id',
            'password'
        ]));

        $data['user'] = new UserResource($user);
        return response()->api($data, 0, 'User data updated successfully');
    }


    public function changePassword(Request $request)
    {
        if (!Hash::check($request->input('current-password'), Auth::user()->password)) {
            return response()->api([], 1, 'Your current password does not match.');
        }
        if ($request->input('current-password') === $request->input('new-password')) {
            return response()->api([], 1, 'New Password cannot be same as your current password.');
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required',
        ]);
        $user = Auth::user();
        $user->password = bcrypt($request->input('new-password'));
        $user->save();

        return response()->api([], 0, 'Your password has been changed successfully.');
    }

    public function logout(Request $request)
    {
        // Get the currently authenticated user
        $user = $request->user();

        // Revoke the token that was used to authenticate the current request
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return response()->json(['message' => 'تم تسجيل الخروج بنجاح'], 200);
    }


    function message()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'password.min' => 'كلمة السر قصيرة',
            'password.required' => 'كلمة السر مطلوبة',
            'phone.required' => 'رقم المحمول مطلوب',
            'type.required' => 'نوع المستخدم مطلوب',
            'phone.unique' => 'رقم المحمول مستخدم مسبقا',
            'phone.max' => 'رقم المحمول مستخدم غير صالج',
            'phone.numeric' => 'رقم المحمول مستخدم غير صالج',
        ];
    }

}//end of controller
