@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('chapters.chapter')</h2>
    </div>

    <ul class="breadcrumb mt-2">

        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('chapters.chapters')</li>
        <li class="breadcrumb-item">@lang('chapters.chapter') {{ $chapter->title }}</li>
    </ul>

    <div class="tile shadow">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h1>{{ $chapter->title }}</h1>
                <p>{{ $chapter->details }}</p>
                @if ($chapter->course)
                    <p>@lang('courses.course'): <a
                            href="{{ route('admin.courses.show', $chapter->course->id) }}">{{ $chapter->course->title }}</a>
                    </p>
                @endif
            </div>

            <div class="col-md-12 mb-4">
                <h2>@lang('lectures.lectures')</h2>
                @if ($chapter->lectures->isEmpty())
                    <div class="alert alert-info">@lang('chapters.no_lectures_available')</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>@lang('lectures.title')</th>
                                    <th>@lang('lectures.price')</th>
                                    <th>@lang('lectures.video_url')</th>
                                    <th>@lang('lectures.note_book_url')</th>
                                    <th>@lang('lectures.des')</th>
                                    <th>@lang('lectures.notes')</th>
                                    <th>@lang('lectures.start')</th>
                                    <th>@lang('lectures.end')</th>
                                    <th>@lang('lectures.status')</th>
                                    <th>@lang('site.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chapter->lectures as $lecture)
                                    <tr>
                                        <td>{{ $lecture->title }}</td>
                                        <td>{{ $lecture->price }}</td>
                                        <td>{{ $lecture->video_url }}</td>
                                        <td>{{ $lecture->note_book_url }}</td>
                                        <td>{{ $lecture->des }}</td>
                                        <td>{{ $lecture->notes }}</td>
                                        <td>{{ $lecture->start }}</td>
                                        <td>{{ $lecture->end }}</td>
                                        <td>{{ $lecture->status }}</td>
                                        <td>
                                            <a href="{{ route('admin.exam_lectures.index', ['lectureId' => $lecture->id]) }}
                                                "
                                                class="btn btn-info btn-sm">
                                                @lang('lectures.exam_lecture')
                                            </a>
                                            <a href="{{ route('admin.exam_lectures.index', ['lectureId' => $lecture->id]) }}
                                                "
                                                class="btn btn-primary btn-sm">
                                                @lang('lectures.question_home_work')
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
