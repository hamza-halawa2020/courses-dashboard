@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('courses.course')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">@lang('courses.courses')</a></li>
        <li class="breadcrumb-item">@lang('courses.course_details')</li>
    </ul>
    <div class="tile shadow">
        <div class="row">
            <div class="col-md-12">
                <h1>@lang('courses.course') {{ $course->title }}</h1>
            </div>
            <div class="col-md-12">
                <p>{{ $course->details }}</p>
            </div>
            <div class="col-md-12 h2">
                <a href="{{ route('admin.courses.index') }}">
                    @lang('courses.courses')
                </a>
            </div>
            <div class="col-md-12 text-center h3">
                @if ($course->chapters->isEmpty())
                    <p>@lang('courses.no_chapters_available')</p>
                @else
                    <ul>
                        @foreach ($course->chapters as $chapter)
                            <li>
                                <a href="{{ route('admin.chapters.show', $chapter->id) }}">{{ $chapter->title }}</a>
                            </li>
                            <li>{{ $chapter->details }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
