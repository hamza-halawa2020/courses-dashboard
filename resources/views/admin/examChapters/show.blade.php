@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('teachers.teacher')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('teachers.teachers')</li>
        <li class="breadcrumb-item">@lang('teachers.teacher') {{ $teacher->name }}</li>

    </ul>

    <div class="tile shadow">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h1>@lang('teachers.teacher'): {{ $teacher->name }}</h1>
                <p class="h5">{{ $teacher->details }}</p>
            </div>

            <div class="col-md-12 mb-4">
                <a href="{{ route('admin.courses.index') }}" class="btn btn-primary">
                    @lang('courses.courses')
                </a>
            </div>

            <div class="col-md-12">
                @if ($teacher->courses->isEmpty())
                    <div class="alert alert-info text-center h3">@lang('teachers.No_courses_available_for_this_teacher')</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>@lang('courses.title')</th>
                                    <th>@lang('stages.stage_withal')</th>
                                    <th>@lang('site.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teacher->courses as $course)
                                    <tr>
                                        <td>
                                            <a
                                                href="{{ route('admin.courses.show', $course->id) }}">{{ $course->title }}</a>
                                        </td>
                                        <td>{{ $course->stage->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.courses.show', $course->id) }}"
                                                class="btn btn-info btn-sm">
                                                @lang('chapters.chapters')
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
