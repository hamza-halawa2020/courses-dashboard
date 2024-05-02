@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('questions.questions')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.questions.index') }}">@lang('questions.questions')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <form method="post" action="{{ route('admin.questions.store') }}">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    {{-- question --}}
                    <div class="form-group">
                        <label>@lang('questions.question')<span class="text-danger">*</span></label>
                        <input type="text" name="question" class="form-control" value="{{ old('question') }}" required
                            autofocus>
                    </div>

                    {{-- answers --}}
                    <div class="form-group" id="answers-container">
                        <label>@lang('questions.answer')<span class="text-danger">*</span></label>
                        <div class="answer-group mb-3">
                            <input type="text" name="answers[]" class="form-control" placeholder="@lang('questions.answer')"
                                required>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_right[]" value="1">
                                <label class="form-check-label">
                                    @lang('questions.true')
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Add more button --}}
                    <div class="form-group">
                        <button type="button" class="btn btn-success" id="add-answer">
                            <i class="fa fa-plus"></i> @lang('questions.add_answer')
                        </button>
                    </div>

                    {{-- stage --}}
                    <div class="form-group">
                        <label>@lang('questions.stage_withal')<span class="text-danger">*</span></label>
                        <select class="form-select" name="stage_id" id="floatingSelect"
                            aria-label="Floating label select example">
                            <option selected disabled>@lang('questions.choose the stage withal')</option>
                            @foreach ($stages as $stage)
                                <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->
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
                answerInput.setAttribute('name', 'answers[]');
                answerInput.setAttribute('class', 'form-control');
                answerInput.setAttribute('placeholder', '@lang('questions.answer')');
                answerInput.setAttribute('required', true);

                const checkboxDiv = document.createElement('div');
                checkboxDiv.classList.add('form-check');

                const checkboxInput = document.createElement('input');
                checkboxInput.setAttribute('type', 'checkbox');
                checkboxInput.setAttribute('name', 'is_right[]');
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
            });
        });
    </script>
@endpush
{{-- @section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addAnswerButton = document.getElementById('add-answer');
            const answersContainer = document.getElementById('answers-container');

            addAnswerButton.addEventListener('click', function() {
                const answerGroup = document.createElement('div');
                answerGroup.classList.add('answer-group', 'mb-3');

                answerGroup.innerHTML = `
                    <input type="text" name="answers[]" class="form-control mb-2" placeholder="Answer" required>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_right[]" value="1">
                        <label class="form-check-label">@lang('questions.true')</label>
                    </div>
                `;

                answersContainer.appendChild(answerGroup);
            });
        });
    </script>
@endsection --}}
