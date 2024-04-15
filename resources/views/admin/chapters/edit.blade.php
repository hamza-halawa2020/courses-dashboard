@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('chapters.chapters')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.chapters.index') }}">@lang('chapters.chapters')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.chapters.update', $chapter->id) }}">
                    @csrf
                    @method('put')

                    @include('admin.partials._errors')
                    <div class="col-md-6">
                        {{--tittle--}}
                        <div class="form-group">
                            <label>@lang('chapters.tittle') <span class="text-danger">*</span></label>
                            <input type="text" name="tittle" class="form-control" value="{{ old('tittle', $chapter->tittle) }}" required>
                        </div>
                    </div><!-- end of col -->


                    <div class="col-md-6">

                        <div class="form-group">
                            <label>@lang('chapters.price')<span class="text-danger">*</span></label>
                            <input type="hidden" name="course_id"  value="{{$chapter->course_id}}">
                            <input type="number" name="price" class="form-control" min="0"
                                   value="{{ old('price',$chapter->price)}}" required>
                        </div>


                        {{--Button--}}
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.update')</button>
                        </div>



                    </div><!-- end of col -->






                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

