<form action="{{ route('admin.courses.show', $id) }}" class="my-1 my-xl-0" style="display: inline-block;">

    <button type="submit" class="btn btn-info btn-sm "><i class="fa fa-euro"></i> @lang('site.show')</button>
</form>


@if (auth()->user()->hasPermission('update_courses'))
    <a href="{{ route('admin.courses.edit', $id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
@endif

@if (auth()->user()->hasPermission('delete_courses'))
    <form action="{{ route('admin.courses.destroy', $id) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> @lang('site.delete')</button>
    </form>
@endif
