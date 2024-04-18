@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('qRvalues.qRvalues')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.qRvalues.index') }}">@lang('qRvalues.qRvalues')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.qRvalues.store') }}">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    {{--tittle--}}
                    <div class="form-group">
                        <label>@lang('qRvalues.tittle')<span class="text-danger">*</span></label>
                        <input type="text" name="tittle" class="form-control"
                               value="{{ old('tittle') }}" required autofocus>
                    </div>
                    {{--value--}}
                    <div class="form-group">
                        <label>@lang('qRvalues.value')<span class="text-danger">*</span></label>
                        <input type="number" name="value" class="form-control" min="0"
                               value="{{ old('value') }}" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')
                        </button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection


