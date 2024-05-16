@extends('layouts.admin.app')

@section('content')


    <div>
        <h2>@lang('teachers.teacher')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('teachers.teachers')</li>
    </ul>
    <div class="tile shadow">

        <div class="row">
            <div class="col-md-12">
                <h1>@lang('teachers.teacher') {{ $teacher->name }}</h1>
            </div>
            <div class="col-md-12">
                {{ $teacher->details }}</div>
            <div class="col-md-12 h2">
                <a href="{{ route('admin.courses.index') }}">
                    @lang('courses.courses')
                </a>
            </div>
            <div class="col-md-12 text-center h3">

                @if ($teacher->courses->isEmpty())
                    <p>@lang('teachers.No_courses_available_for_this_teacher')</p>
                @else
            </div>

            <ul>
                @foreach ($teacher->courses as $course)
                    <li>
                        <a href="{{ route('admin.courses.show', $course->id) }}">{{ $course->title }}</a>
                    </li>
                    <li>{{ $course->stage_id }}</li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
@endsection
