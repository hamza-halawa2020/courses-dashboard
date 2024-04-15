

<a href="{{route('admin.chapters.index', ['course_id' =>$id])}}"  class="btn btn-primary btn-sm showChapters" >@lang('site.show'){{' '}}@lang('chapters.chapters')</a>

{{--
<a href="#" class="btn btn-primary btn-sm showChapters">@lang('site.show')@lang('chapters.chapters')</a>
--}}


{{--test the new branch --}}
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

