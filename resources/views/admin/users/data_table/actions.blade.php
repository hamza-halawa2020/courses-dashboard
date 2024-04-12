@if (auth()->user()->hasPermission('update_users'))
    <a href="{{ route('admin.users.edit',$id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
@endif

@if (auth()->user()->hasPermission('delete_users'))
    <form action="{{ route('admin.users.destroy', $id) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> </button>
    </form>

@endif

<a href="javascript:void(0)" class="btn btn-info btn-sm editUserStatus" data-id="{{$id}}" ><i class="fa fa-edit"  ></i></a>
<a href="javascript:void(0)" class="btn btn-secondary btn-sm editUserPassword" data-id="{{$id}}" ><i class="fa fa-key"  ></i></a>
<a href="javascript:void(0)" class="btn btn-success btn-sm editUserBalance" data-id="{{$id}}" ><i class="fa fa-money"  ></i></a>
<a href="javascript:void(0)" class="btn btn-dark btn-sm editUserDevice" data-id="{{$id}}" ><i class="fa fa-mobile"  ></i></a>


