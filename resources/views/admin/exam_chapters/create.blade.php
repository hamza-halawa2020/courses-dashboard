@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('teachers.teachers')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.teachers.index') }}">@lang('teachers.teachers')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>


    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                <div class="card-body">
                    <form action="{{ route('admin.teachers.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">@lang('teachers.name'):</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="details">@lang('teachers.details'):</label>
                            <input type="text" name="details" id="details" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">@lang('site.create')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
