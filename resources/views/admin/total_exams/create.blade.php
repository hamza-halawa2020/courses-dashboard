@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('exams.total_exams')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('exams.total_exams')</li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <form method="post" action="{{ route('admin.total_exams.store') }}">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    {{-- question --}}
                    <div class="form-group">
                        <label>@lang('exams.question')<span class="text-danger">*</span></label>
                        <input type="text" name="question" class="form-control" value="{{ old('question') }}" required
                            autofocus>
                    </div>
                    <div class="form-group">
                        <label>@lang('lectures.start')<span class="text-danger">*</span></label>
                        <input type="datetime-local" name="start_at" class="form-control" value="{{ old('start_at') }}"
                            required autofocus>
                    </div>



                    <div class="form-group">
                        <label>@lang('lectures.end')<span class="text-danger">*</span></label>
                        <input type="datetime-local" name="end_at" class="form-control" value="{{ old('end_at') }}"
                            required autofocus>
                    </div>

                    {{-- hidden teacher ID --}}
                    <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">

                    {{-- answers --}}
                    <div class="form-group" id="answers-container">
                        <label>@lang('exams.answer')<span class="text-danger">*</span></label>
                        <div class="answer-group mb-3">
                            <input type="text" name="answers[0][text]" class="form-control"
                                placeholder="@lang('exams.answer')" required>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="answers[0][is_right]" value="1">
                                <label class="form-check-label">@lang('exams.true')</label>
                            </div>
                        </div>
                    </div>

                    {{-- Add more button --}}
                    <div class="form-group">
                        <button type="button" class="btn btn-success" id="add-answer">
                            <i class="fa fa-plus"></i> @lang('questions.add_answer')
                        </button>
                    </div>

                    {{-- Submit button --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addAnswerButton = document.getElementById('add-answer');
            const answersContainer = document.getElementById('answers-container');

            addAnswerButton.addEventListener('click', function() {
                const answerGroup = document.createElement('div');
                answerGroup.classList.add('answer-group', 'mb-3');

                const answerInput = document.createElement('input');
                answerInput.setAttribute('type', 'text');
                answerInput.setAttribute('name', `answers[${answerCount}][text]`);
                answerInput.setAttribute('class', 'form-control');
                answerInput.setAttribute('placeholder', '@lang('questions.answer')');
                answerInput.setAttribute('required', true);

                const checkboxDiv = document.createElement('div');
                checkboxDiv.classList.add('form-check');

                const checkboxInput = document.createElement('input');
                checkboxInput.setAttribute('type', 'checkbox');
                checkboxInput.setAttribute('name', `answers[${answerCount}][is_right]`);
                checkboxInput.setAttribute('class', 'form-check-input');
                checkboxInput.setAttribute('value', '1');

                const checkboxLabel = document.createElement('label');
                checkboxLabel.setAttribute('class', 'form-check-label');
                checkboxLabel.innerText = "@lang('questions.true')";

                checkboxDiv.appendChild(checkboxInput);
                checkboxDiv.appendChild(checkboxLabel);

                answerGroup.appendChild(answerInput);
                answerGroup.appendChild(checkboxDiv);

                answersContainer.appendChild(answerGroup);
                answerCount++;

            });
        });
    </script>
@endpush
