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

                    <div class="form-group">
                        <label>@lang('questions.answer')<span class="text-danger">*</span></label>
                        <input type="text" name="answer" class="form-control" value="{{ old('answer') }}" required
                            autofocus>
                    </div>
                    <div class="form-group">
                        <label>@lang('questions.stage_withal')<span class="text-danger">*</span></label>
                        <select class="form-select" name="stage_id" id="floatingSelect"
                            aria-label="Floating label select example">
                            <option selected disabled>@lang('questions.choose the stage withal')</option>
                            @foreach ($stages as $stage)
                                <option value="{{ $stage->id }}">{{ $stage->id }}</option>
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
