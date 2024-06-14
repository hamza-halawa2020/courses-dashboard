<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\EditUserRequest;
use App\Models\Balance;
use App\Models\Coupon;
use App\Models\Place;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_users')->only(['index']);
        $this->middleware('permission:create_users')->only(['create', 'store']);
        $this->middleware('permission:update_users')->only(['edit', 'update', 'sss']);
        $this->middleware('permission:delete_users')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.users.index');

    }// end of index

    public function data()
    {
        // Eager load the stage, place, and balances relationships to minimize database queries
        $users = User::with([
            'stage',
            'place',
            'balances' => function ($query) {
                $query->orderBy('created_at', 'desc'); // Ensure the latest balance is first
            }
        ])->where('type', 'user')->get();

        return DataTables::of($users)
            ->addColumn('record_select', 'admin.users.data_table.record_select')
            ->editColumn('image', function (User $user) {
                return view('admin.users.data_table.image', compact('user'));
            })
            ->editColumn('created_at', function (User $user) {
                return $user->created_at->format('Y-m-d');
            })
            ->editColumn('status', function (User $user) {
                return $user->status == '0'
                    ? '<h5><span class="badge badge-danger">غير نشط</span></h5>'
                    : '<h5><span class="badge badge-success">نشط</span></h5>';
            })
            ->editColumn('gender', function (User $user) {
                return $user->gender == 'male' ? 'ذكر' : 'انثي';
            })
            ->editColumn('stage', function (User $user) {
                $name = $user->stage ? $user->stage->name : 'N/A';
                return view('admin.users.data_table.stage', compact('name'));
            })
            ->editColumn('place', function (User $user) {
                $name = $user->place ? $user->place->name : 'N/A';
                return view('admin.users.data_table.place', compact('name'));
            })
            ->editColumn('balance', function (User $user) {
                $latestBalance = $user->balances->first();
                return $latestBalance ? $latestBalance->total : 0;
            })
            ->editColumn('edit', function ($row) {
                return '<a href="javascript:void(0)" class="btn btn-warning btn-sm editUser" data-id="' . $row->id . '"><i class="fa fa-edit"></i></a>';
            })
            ->addColumn('actions', 'admin.users.data_table.actions')
            ->rawColumns(['record_select', 'actions', 'edit', 'status'])
            ->toJson();
    }


    public function create()
    {  // whereNotIn('id',[1])->get();
        $stages = Stage::whereNotIn('id', [1])->get();
        $places = Place::whereNotIn('id', [1])->get();
        return view('admin.users.create', compact('stages', 'places'));

    }// end of create


    public function editUserStatus($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404);
        }
        return $user;
    }// end of create


    public function sss(UserRequest $request)
    {
        return $request;
    }// end of create

    public function store(UserRequest $request)
    {
        $requestData = $request->validated();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => 'user',
            'gender' => $request->gender,
            'password' => bcrypt($request->password),
            'parent_phone' => $request->parent_phone,
            'parent_name' => $request->parent_name,
            'status' => '1',
            'stage_id' => $request->stage_id,
            'place_id' => $request->place_id,
        ]);

        if ($request->balance) {
            $balance = $user->balances()->create(['total' => $request->balance]);
            if ($balance) {
                $balanceDetails = $balance->balanceDetails()->create(['amount' => $request->balance]);
                if ($balanceDetails) {
                    $user->adminAddedBalances()->create(['balance_detail_id' => $balanceDetails->id]);
                } else {
                    // Handle error if balance details creation fails
                    $balance->delete(); // Rollback balance creation
                    $user->delete(); // Rollback user creation
                    return back()->with('error', __('site.error_message'));
                }
            } else {
                // Handle error if balance creation fails
                $user->delete(); // Rollback user creation
                return back()->with('error', __('site.error_message'));
            }
        }

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        $stages = Stage::whereNotIn('id', [1])->get();
        $places = Place::whereNotIn('id', [1])->get();
        return view('admin.users.edit', compact('user', 'stages', 'places'));



    }// end of edit

    public function update(EditUserRequest $request, User $user)
    {

        //return $request->meth;

        if ($request->meth == 'status') {

            $currentUser = User::find($request->userIDStatus);

            if ($currentUser) {

                if ($request->statusValue == 0) {
                    $currentUser->update([
                        'status' => '1',
                    ]);
                } else {
                    $currentUser->update([
                        'status' => '0',
                    ]);

                }
                return 'تم تغيير حالة الطالب بنجاح';

            } else
                return 'لقد حدث حضأ ما !!!';

        } else if ($request->meth == 'password') {
            $currentUser = User::find($request->userIDPassword);
            if ($currentUser) {
                $currentUser->update([
                    'password' => bcrypt($request->password),
                ]);

                return 'تم اعادة تعيين كلمة السر بنجاح';

            } else
                return 'لقد حدث حضأ ما !!!';

        } else if ($request->meth == 'edit') {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'type' => 'user',
                'gender' => $request->gender,
                'parent_phone' => $request->parent_phone,
                'parent_name' => $request->parent_name,
                'stage_id' => $request->stage_id,
                'place_id' => $request->place_id,
            ]);


            session()->flash('success', __('site.updated_successfully'));
            return redirect()->route('admin.users.index');



        } elseif ($request->meth == 'balance') {
            $selectedUser = User::find($request->userIDBalance);

            if (!$selectedUser) {
                return 'User not found';
            }
            $balance = $selectedUser->balances()->first();

            if (!$balance) {
                $balance = $selectedUser->balances()->create(['total' => 0]);
            }

            $balanceDetail = $balance->balanceDetails()->create(['amount' => $request->balance]);

            if ($balanceDetail) {
                $balance->total += $request->balance;
                $balance->save();

                $selectedUser->adminAddedBalances()->create(['balance_detail_id' => $balanceDetail->id]);
            } else {
                return back()->with('error', __('site.error_message'));
            }
        } else if ($request->meth == 'device') {
            $currentUser = User::find($request->userIDDevice);
            if ($currentUser) {
                $currentUser->update([
                    'device_id' => null,
                ]);

                return 'تم اعادة تعيين الهاتف بنجاح';

            } else
                return 'لقد حدث حضأ ما !!!';


        } else {
            //return $request;
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'parent_phone' => $request->parent_phone,
                'parent_name' => $request->parent_name,
                'stage_id' => $request->stage_id,
                'place_id' => $request->place_id,
            ]);

            session()->flash('success', __('site.added_successfully'));
            return redirect()->route('admin.users.index');
        }


    }// end of update

    public function destroy(User $user)
    {
        $this->delete($user);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $user = User::FindOrFail($recordId);
            $this->delete($user);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(User $user)
    {
        $user->delete();

    }// end of delete

}//end of controller
