@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('users.users')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">@lang('users.users')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.users.store') }}">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    <div class="row">

                        <div class="col-md-6">
                            {{-- name --}}
                            <div class="form-group">
                                <label>@lang('users.student_name')<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                    required autofocus>
                            </div>
                            {{-- phone --}}
                            <div class="form-group">
                                <label>@lang('users.phone')<span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>@lang('users.student_gender')<span class="text-danger">*</span></label>
                                <select name="gender" class="form-control" required>
                                    <option value="">@lang('users.select_gender')</option>
                                    <option value="male">@lang('users.male')</option>
                                    <option value="female">@lang('users.female')</option>
                                </select>
                            </div>

                            {{-- email --}}
                            <div class="form-group">
                                <label>@lang('users.email')</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                            </div>
                            {{-- password --}}
                            <div class="form-group">
                                <label>@lang('users.password')<span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" value="{{ old('password') }}"
                                    required>
                            </div>

                            {{-- password_confirmation --}}
                            <div class="form-group">
                                <label>@lang('users.password_confirmation')<span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    value="{{ old('password_confirmation') }}" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i
                                        class="fa fa-plus"></i>@lang('site.create')</button>
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- stage --}}
                            <div class="form-group">
                                <label>@lang('stages.stage_withal')<span class="text-danger">*</span></label>
                                <select name="stage_id" class="form-control" required>
                                    <option value="">@lang('users.select_stage')</option>
                                    @foreach ($stages as $stage)
                                        <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- place --}}
                            <div class="form-group">
                                <label>@lang('places.place')<span class="text-danger">*</span></label>
                                <select name="place_id" class="form-control" required>
                                    <option value="">@lang('users.select_place')</option>
                                    @foreach ($places as $place)
                                        <option value="{{ $place->id }}">{{ $place->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- parent name --}}
                            <div class="form-group">
                                <label>@lang('users.parent_name')<span class="text-danger">*</span></label>
                                <input type="text" name="parent_name" class="form-control"
                                    value="{{ old('parent_name') }}">
                            </div>
                            {{-- parent phone --}}
                            <div class="form-group">
                                <label>@lang('users.parent_phone')<span class="text-danger">*</span></label>
                                <input type="tel" name="parent_phone" class="form-control"
                                    value="{{ old('parent_phone') }}">
                            </div>

                            {{-- balance --}}
                            <div class="form-group">
                                <label>@lang('users.balance')</label>
                                <input type="number" name="balance" class="form-control" value="{{ old('balance', 0) }}"
                                    required>
                            </div>

                        </div>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection
