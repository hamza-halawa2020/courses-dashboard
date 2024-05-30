@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('courses.course')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">@lang('courses.courses')</a></li>
        <li class="breadcrumb-item">@lang('courses.course') {{ $course->title }}</li>
    </ul>

    <div class="tile shadow">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h1>@lang('courses.course'): {{ $course->title }}</h1>
                <p>{{ $course->details }}</p>
            </div>

            <div class="col-md-12 mb-4">
                <a href="{{ route('admin.chapters.index', ['course_id' => $course->id]) }}" class="btn btn-primary">
                    @lang('chapters.chapters')
                </a>
            </div>

            <div class="col-md-12">
                @if ($course->chapters->isEmpty())
                    <div class="alert alert-info text-center h3">@lang('courses.no_chapters_available')</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>@lang('chapters.title')</th>
                                    <th>@lang('chapters.price')</th>
                                    <th>@lang('site.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course->chapters as $chapter)
                                    <tr>
                                        <td>{{ $chapter->title }}</td>
                                        <td>{{ $chapter->price }}</td>
                                        <td>
                                            <a href="{{ route('admin.chapters.show', $chapter->id) }}"
                                                class="btn btn-info btn-sm">
                                                @lang('lectures.lectures')
                                            </a>
                                            <a href="{{ route('admin.exam_chapters.index', ['chapterId' => $chapter->id]) }}
                                                "
                                                class="btn btn-info btn-sm">
                                                @lang('questions.exams_chapter')
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
