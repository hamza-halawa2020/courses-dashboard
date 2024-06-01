@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>{{ $examlecture->question }}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a
                href="{{ route('admin.exam_lectures.index', $examlecture->lecture_id) }}">@lang('exams.exams_lectures')</a></li>
        <li class="breadcrumb-item">@lang('site.show')</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">

                <div class="form-group">
                    <a href="{{ route('admin.exam_lectures.edit', $examlecture->id) }}" class="btn btn-warning"><i
                            class="fa fa-edit"></i> @lang('site.edit')</a>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>@lang('exams.question')</th>
                                    <td>{{ $examlecture->question }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('site.created_at')</th>
                                    <td>{{ $examlecture->created_at }}</td>
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
                                    @foreach ($examlecture->answerlecture as $answer)
                                        <tr>
                                            <td>{{ $answer->answer }}</td>
                                            <td>{{ $answer->is_right ? __('exams.true') : __('exams.false') }}</td>
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
