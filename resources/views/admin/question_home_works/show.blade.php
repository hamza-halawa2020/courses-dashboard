@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>{{ $questionHomeWrok->question }}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a
                href="{{ route('admin.question_home_works.index', $questionHomeWrok->lecture_id) }}">@lang('questions.questions_lectures')</a>
        </li>
        <li class="breadcrumb-item">@lang('site.show')</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">

                <div class="form-group">
                    <a href="{{ route('admin.question_home_works.edit', $questionHomeWrok->id) }}"
                        class="btn btn-warning"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>@lang('questions.question')</th>
                                    <td>{{ $questionHomeWrok->question }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('site.created_at')</th>
                                    <td>{{ $questionHomeWrok->created_at }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <h3>@lang('questions.answers')</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>@lang('questions.answers')</th>
                                        <th>@lang('questions.is_right')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questionHomeWrok->answerHomeWork as $answer)
                                        <tr>
                                            <td>{{ $answer->answer }}</td>
                                            <td>{{ $answer->is_right ? __('questions.true') : __('questions.false') }}</td>
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
