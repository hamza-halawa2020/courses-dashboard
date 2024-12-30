@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('questions.questions')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.questions.index') }}">@lang('questions.questions')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.questions.update', $question) }}">
                    @csrf
                    @method('put')

                    @include('admin.partials._errors')

                    {{-- question --}}
                    <div class="form-group">
                        <label>@lang('questions.question') <span class="text-danger">*</span></label>
                        <input type="text" name="question" class="form-control"
                            value="{{ old('question', $question->question) }}" required>
                    </div>

                    {{-- answers --}}
                    <div class="form-group" id="answers-container">
                        <label>@lang('questions.answer')<span class="text-danger">*</span></label>
                        @foreach ($answer as $answer)
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

                    {{-- teacher --}}
                    <div class="form-group">
                        <label>@lang('users.teacher_name')<span class="text-danger">*</span></label>
                        <select class="form-select" name="teacher_id" id="floatingSelect"
                            aria-label="Floating label select example">
                            <option selected disabled>@lang('users.teacher_name')</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" @if (old('teacher_id', $question->teacher_id) == $teacher->id) selected @endif>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    {{-- stage --}}
                    <div class="form-group">
                        <label>@lang('questions.stage_withal')<span class="text-danger">*</span></label>
                        <select class="form-select" name="stage_id" id="floatingSelect"
                            aria-label="Floating label select example">
                            <option selected disabled>@lang('questions.choose the stage withal')</option>
                            @foreach ($stages as $stage)
                                <option value="{{ $stage->id }}" @if (old('stage_id', $question->stage_id) == $stage->id) selected @endif>
                                    {{ $stage->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Button --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.update')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection
