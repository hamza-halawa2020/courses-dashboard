@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('teachers.teachers')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.teachers.index') }}">@lang('teachers.teachers')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.teachers.update', $teacher) }}">
                    @csrf
                    @method('put')

                    @include('admin.partials._errors')

                    {{-- teacher --}}
                    <div class="form-group">
                        <label>@lang('teachers.teacher') <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('teacher', $teacher->teacher) }}" required>
                    </div>
                    <div class="form-group">
                        <label>@lang('teachers.details') <span class="text-danger">*</span></label>
                        <input type="text" name="details" class="form-control"
                            value="{{ old('details', $teacher->teacher) }}" required>
                    </div>

                    {{-- Button --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.update')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection
