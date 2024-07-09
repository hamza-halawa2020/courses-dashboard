@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('questions.question_home_works') {{ $questionHomeWrok->question }}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.question_home_works.update', $questionHomeWrok) }}">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    {{-- question --}}
                    <div class="form-group">
                        <label>@lang('questions.question') <span class="text-danger">*</span></label>
                        <input type="text" name="question" class="form-control"
                            value="{{ old('question', $questionHomeWrok->question) }}" required>
                    </div>

                    {{-- answers --}}
                    <div class="form-group" id="answers-container">
                        <label>@lang('questions.answer')<span class="text-danger">*</span></label>
                        @foreach ($answerHomeWork as $answer)
                            <div class="answer-group mb-3">
                                <input type="text" name="answers[]" class="form-control" placeholder="@lang('questions.answer')"
                                    value="{{ old('answers[]', $answer->answer) }}" required>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_right[]"
                                        value="{{ $answer->id }}" @if ($answer->is_right) checked @endif>
                                    <label class="form-check-label">
                                        @lang('questions.true')
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    {{-- Button --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.update')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div>
@endsection
