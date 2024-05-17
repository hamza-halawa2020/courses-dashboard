@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('courses.courses')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">@lang('courses.courses')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <form method="post" action="{{ route('admin.courses.store') }}">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    <div class="col-md-6">
                        {{-- title --}}
                        <div class="form-group">
                            <label>@lang('courses.title')<span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required
                                autofocus>
                        </div>
                    </div><!-- end of col -->

                    <div class="col-md-6">
                        {{-- stage --}}
                        <div class="form-group">
                            <label>@lang('stages.stage_withal')<span class="text-danger">*</span></label>
                            <select name="stage_id" class="form-control" required>
                                <option value="">@lang('users.select_stage')</option>
                                @foreach ($stages as $stage)
                                    <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!-- end of col -->

                    <div class="col-md-6">
                        {{-- teacher --}}
                        <div class="form-group">
                            <label>@lang('teachers.teacher')<span class="text-danger">*</span></label>
                            <select name="teacher_id" class="form-control" required>
                                <option value="">@lang('users.select_teacher')</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- submit button --}}
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i> @lang('site.create')
                            </button>
                        </div>
                    </div><!-- end of col -->
                </form><!-- end of form -->
            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->
@endsection
