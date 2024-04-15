@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('lectures.lectures')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.lectures.index') }}">@lang('lectures.lectures')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.lectures.store') }}">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')
                    <input type="hidden" name="chapter_id" value="{{$currentChapter->id}}">
                    <div class="row">

                        <div class="col-md-6">

                            {{--tittle--}}
                            <div class="form-group">
                                <label>@lang('lectures.tittle')<span class="text-danger">*</span></label>
                                <input type="text" name="tittle" class="form-control" value="{{ old('tittle') }}"
                                       required autofocus>
                            </div>
                            {{--des--}}
                            <div class="form-group">
                                <label>@lang('lectures.des')</span></label>
                                <textarea type="text" name="des" class="form-control"
                                          aria-label="With textarea"> {{old('des')}}</textarea>
                            </div>
                            {{--notes--}}
                            <div class="form-group">
                                <label>@lang('lectures.notes')</span></label>
                                <textarea type="text" name="notes" class="form-control"
                                          aria-label="With textarea"> {{old('notes')}}</textarea>
                            </div>

                            {{--start--}}
                            <div class="form-group">
                                <label>@lang('lectures.start')<span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="start" class="form-control">
                            </div>
                            {{--end--}}
                            <div class="form-group">
                                <label>@lang('lectures.end')<span class="text-danger">*</span></label>
                                <input type="datetime-local" name="end" class="form-control">
                            </div>

                            {{--button--}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i
                                        class="fa fa-plus"></i>@lang('site.create')</button>
                            </div>
                        </div><!-- end of col -->

                        <div class="col-md-6">

                            {{--video_url--}}
                            <div class="form-group">
                                <label>@lang('lectures.video_url')<span class="text-danger">*</span></label>
                                <textarea type="text" name="video_url" class="form-control"
                                          aria-label="With textarea"> {{old('video_url')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>@lang('lectures.price')<span class="text-danger">*</span></label>
                                <input type="number" name="price" class="form-control" min="0"
                                       value="{{ old('price') }}" required>
                            </div>


                        </div><!-- end of col -->

                    </div>


                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection


