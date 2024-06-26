@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('stages.stages')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.stages.index') }}">@lang('stages.stages')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.stages.update', $stage->id) }}">
                    @csrf
                    @method('put')

                    @include('admin.partials._errors')

                    {{-- name --}}
                    <div class="form-group">
                        <label>@lang('stages.name') <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $stage->name) }}"
                            required>
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
