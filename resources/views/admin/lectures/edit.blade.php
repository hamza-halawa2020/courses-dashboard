@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>{{ $lecture->tittle }}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.lectures.index') }}">@lang('lectures.lectures')</a></li>
        <li class="breadcrumb-item"><a
                href="{{ route('admin.lectures.index', ['chapter_id' => $lecture->chapter->id]) }}">{{ $lecture->tittle }}</a>
        </li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.lectures.update', $lecture->id) }}">
                    @csrf
                    @method('put')

                    @include('admin.partials._errors')

                    <input type="hidden" name="chapter_id" value="{{ $lecture->chapter->id }}">
                    <div class="row">

                        <div class="col-md-6">

                            {{-- tittle --}}
                            <div class="form-group">
                                <label>@lang('lectures.tittle')<span class="text-danger">*</span></label>
                                <input type="text" name="tittle" class="form-control"
                                    value="{{ old('tittle', $lecture->tittle) }}" required autofocus>
                            </div>
                            {{-- des --}}
                            <div class="form-group">
                                <label>@lang('lectures.des')</span></label>
                                <textarea type="text" name="des" class="form-control" aria-label="With textarea"> {{ old('des', $lecture->des) }}</textarea>
                            </div>
                            {{-- notes --}}
                            <div class="form-group">
                                <label>@lang('lectures.notes')</span></label>
                                <textarea type="text" name="notes" class="form-control" aria-label="With textarea"> {{ old('notes', $lecture->notes) }}</textarea>
                            </div>
                            {{-- start --}}
                            <div class="form-group">
                                <label>@lang('lectures.start')<span class="text-danger">*</span></label>
                                <input type="datetime-local" name="start" class="form-control"
                                    value="{{ $lecture->start }}">
                            </div>
                            {{-- end --}}
                            <div class="form-group">
                                <label>@lang('lectures.end')<span class="text-danger">*</span></label>
                                <input type="datetime-local" name="end" class="form-control"
                                    value="{{ $lecture->end }}">
                            </div>


                            {{-- button --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i
                                        class="fa fa-edit"></i>@lang('site.update')</button>
                            </div>
                        </div><!-- end of col -->

                        <div class="col-md-6">

                            {{-- video_url --}}
                            <div class="form-group">
                                <label>@lang('lectures.video_url')<span class="text-danger">*</span></label>
                                <textarea type="text" name="video_url" class="form-control" aria-label="With textarea"> {{ old('video_url', $lecture->video_url) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>@lang('lectures.price')<span class="text-danger">*</span></label>
                                <input type="number" name="price" class="form-control" min="0"
                                    value="{{ old('price', $lecture->price) }}" required>
                            </div>


                        </div><!-- end of col -->

                    </div>








                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->
        @php
            $start = $lecture->start;
        @endphp

    </div><!-- end of row -->
@endsection
@push('scripts')
    <script>
        function toLocalISOString(date) {
            const localDate = new Date(date - date.getTimezoneOffset() *
                60000
            ); //offset in milliseconds. Credit https://stackoverflow.com/questions/10830357/javascript-toisostring-ignores-timezone-offset

            // Optionally remove second/millisecond if needed
            localDate.setSeconds(null);
            localDate.setMilliseconds(null);
            return localDate.toISOString().slice(0, -1);
        }
        consol.log(window.start);
        window.addEventListener("load", () => {
            document.getElementById("cal").value = toLocalISOString(window.start);
        });
    </script>
@endpush
