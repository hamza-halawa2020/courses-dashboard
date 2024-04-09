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

<button type="button" class="button x-small" data-toggle="modal" data-target="#editBalance"> <i class="fa fa-money" aria-hidden="true"></i> </button>
<a class="btn btn-danger" role="button" data-toggle="modal" data-target="#modal-delete-{{ $id }}">Delete </a>
