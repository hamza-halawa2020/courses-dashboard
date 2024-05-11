@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('qR.QRs')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.QR.index') }}">@lang('qR.QRs')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.QR.store') }}">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    {{-- number --}}
                    <div class="form-group">
                        <label>@lang('qR.number')<span class="text-danger">*</span></label>
                        <input type="number" name="number" class="form-control" value="{{ old('number') }}" required
                            autofocus>
                    </div>

                    {{-- qRvalues --}}
                    <div class="form-group">
                        <label>@lang('qR.qRvalue')<span class="text-danger">*</span></label>
                        <select name="qRvalue_id" class="form-control" required>
                            <option value="">@lang('qR.select_qRvalue')</option>
                            @foreach ($qRvalues as $qRvalue)
                                <option value="{{ $qRvalue->id }}">{{ $qRvalue->title }}</option>
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
