<a href="javascript:void(0)"
   class="btn btn-info btn-sm editLectureStatus" data-id="{{$id}}">
    <i class="fa fa-sellsy"></i></a>




@if (auth()->user()->hasPermission('update_lectures'))
    <a href="{{ route('admin.lectures.edit', $id) }}" class="btn btn-warning btn-sm"><i
            class="fa fa-edit"></i> @lang('site.edit')</a>
@endif

@if (auth()->user()->hasPermission('delete_lectures'))
    <form action="{{ route('admin.lectures.destroy', $id) }}" class="my-1 my-xl-0" method="post"
          style="display: inline-block;">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> @lang('site.delete')
        </button>
    </form>
@endif

