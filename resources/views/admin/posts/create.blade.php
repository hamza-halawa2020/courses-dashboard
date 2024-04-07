@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('posts.posts')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">@lang('posts.posts')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.posts.store') }}  " enctype="multipart/form-data" >
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')
                    <div class="row">
                        <div class="col-md-3"></div><!-- end of col -->
                        <div class="col-md-6">
                            {{--body--}}
                            <div class="form-group">
                                <label>@lang('posts.body')<span class="text-danger">*</span></label>
                                <textarea type="text" name="body" class="form-control"
                                          aria-label="With textarea" required autofocus> {{old('body')}} </textarea>
                            </div>

                            {{--phone--}}
                            <div class="form-group">
                                <label>@lang('posts.phone')<span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                            </div>
                        </div><!-- end of col -->
                        <div class="col-md-3"></div><!-- end of col -->

                    </div><!-- end of row -->

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection


