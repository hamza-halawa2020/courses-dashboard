@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('teachers.teachers')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.teachers.index') }}">@lang('teachers.teachers')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.teachers.update', $teacher) }}">
                    @csrf
                    @method('put')

                    @include('admin.partials._errors')

                    {{-- teacher --}}
                    <div class="form-group">
                        <label>@lang('teachers.teacher') <span class="text-danger">*</span></label>
                        <input type="text" name="teacher" class="form-control"
                            value="{{ old('teacher', $teacher->teacher) }}" required>
                    </div>

                    {{-- answers --}}
                    <div class="form-group" id="answers-container">
                        <label>@lang('teachers.answer')<span class="text-danger">*</span></label>
                        @foreach ($answer as $answer)
                            <div class="answer-group mb-3">
                                <input type="text" name="answers[]" class="form-control" placeholder="@lang('teachers.answer')"
                                    value="{{ old('answers[]', $answer->answer) }}" required>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_right[]"
                                        value="{{ $answer->id }}" @if ($answer->is_right) checked @endif>
                                    <label class="form-check-label">
                                        @lang('teachers.true')
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    {{-- stage --}}
                    <div class="form-group">
                        <label>@lang('teachers.stage_withal')<span class="text-danger">*</span></label>
                        <select class="form-select" name="stage_id" id="floatingSelect"
                            aria-label="Floating label select example">
                            <option selected disabled>@lang('teachers.choose the stage withal')</option>
                            @foreach ($stages as $stage)
                                <option value="{{ $stage->id }}" @if (old('stage_id', $teacher->stage_id) == $stage->id) selected @endif>
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


@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Teacher</h1>
        <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $teacher->name }}"
                    required>
            </div>
            <div class="form-group">
                <label for="details">Details</label>
                <textarea name="details" id="details" class="form-control" required>{{ $teacher->details }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
