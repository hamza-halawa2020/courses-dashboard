@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('questions.question_details')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.questions.index') }}">@lang('questions.questions')</a></li>
        <li class="breadcrumb-item">@lang('questions.question_details')</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-warning"><i
                                class="fa fa-edit"></i> @lang('site.edit')</a>
                        <form method="post" action="{{ route('admin.questions.destroy', $question->id) }}"
                            style="display: inline-block;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>
                                @lang('site.delete')</button>
                        </form>
                    </div>
                </div><!-- end of row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>@lang('questions.question')</th>
                                    <td>{{ $question->question }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('questions.stage_withal')</th>
                                    <td>{{ $question->stage->name }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('site.created_at')</th>
                                    <td>{{ $question->created_at }}</td>
                                </tr>
                            </table>
                        </div><!-- end of table responsive -->
                    </div><!-- end of col -->
                </div><!-- end of row -->

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
                                    @foreach ($question->answers as $answer)
                                        <tr>
                                            <td>{{ $answer->answer }}</td>
                                            <td>{{ $answer->is_right ? __('questions.true') : __('questions.false') }}</td>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!-- end of table responsive -->
                    </div><!-- end of col -->
                </div><!-- end of row -->

            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->
@endsection
