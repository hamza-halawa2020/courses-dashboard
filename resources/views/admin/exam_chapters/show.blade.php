@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>{{ $examChapter->question }}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.exam_chapters.index') }}">@lang('exams.examChapters')</a></li>
        <li class="breadcrumb-item">{{ $examChapter->question }}</li>

    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <a href="{{ route('admin.exam_chapters.edit', $examChapter->id) }}" class="btn btn-warning"><i
                                class="fa fa-edit"></i> @lang('site.edit')</a>
                        <form method="post" action="{{ route('admin.exam_chapters.destroy', $examChapter->id) }}"
                            style="display: inline-block;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>
                                @lang('site.delete')</button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>@lang('exams.question')</th>
                                    <td>{{ $examChapter->question }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('site.created_at')</th>
                                    <td>{{ $examChapter->created_at }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <h3>@lang('exams.answers')</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>@lang('exams.answers')</th>
                                        <th>@lang('exams.is_right')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($examChapter->answerChapter as $answer)
                                        <tr>
                                            <td>{{ $answer->answer }}</td>
                                            <td>{{ $answer->is_right ? __('exams.true') : __('exams.false') }}
                                            </td>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
