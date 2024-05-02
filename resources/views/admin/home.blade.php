@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('site.home')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item">@lang('site.home')</li>
    </ul>

    <div class="row">

        <div class="col-md-12 mt-2">

            {{-- top statistics --}}
            <div class="row" id="top-statistics">
                {{-- <div class="col-md-4">
                    <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                        <div class="info">
                            <h4>Users </h4>
                            <p><b>5</b></p>
                        </div>
                    </div>
                </div> --}}

                {{-- places --}}
                <div class="col-md-4">

                    <div class="card">

                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-1">
                                <h5 class="mb-3 "><span class="fa fa-map-marker"></span> @lang('places.places')</h5>
                                <a href="{{ route('admin.places.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-1" id="places-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

                {{-- questions --}}
                <div class="col-md-4">

                    <div class="card">

                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-1">
                                <h5 class="mb-3 "><span class="fa fa-question"></span> @lang('questions.questions')</h5>
                                <a href="{{ route('admin.questions.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-1" id="questions-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

                {{-- stages --}}
                <div class="col-md-4">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-1">
                                <h5 class="mb-3 "><span class="fa fa-male "></span> @lang('stages.stages')</h5>
                                <a href="{{ route('admin.stages.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-1" id="stages-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->


                {{-- users --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-1">
                                <h5 class="mb-3"><span class="fa fa-users px-1"></span>@lang('users.users')</h5>
                                <a href="{{ route('admin.users.index') }}">@lang('site.show_all')</a>
                            </div>
                            <div class="loader loader-sm"></div>
                            <h2 class="mb-0" id="users-count" style="display: none"></h2>
                        </div>

                    </div>

                </div><!-- end of col -->



                {{-- courses --}}
                <div class="col-md-6 mt-4">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-1">
                                <h5 class="mb-3 "><span class="fa fa-book mx-1"></span>@lang('courses.courses')</h5>
                                <a href="{{ route('admin.courses.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-1" id="courses-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->
                {{-- QR --}}
                <div class="col-md-6 mt-4">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-1">
                                <h5 class="mb-3 "><span class="fa fa-qrcode mx-1"></span>@lang('qR.QRs')</h5>
                                <a href="{{ route('admin.QR.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-1" id="qrs-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

            </div><!-- end of row -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection

@push('scripts')
    <script>
        $(function() {

            topStatistics();

        });

        function topStatistics() {
            $.ajax({
                url: "{{ route('admin.home.top_statistics') }}",
                cache: false,
                success: function(data) {

                    $('#top-statistics .loader-sm').hide();

                    $('#top-statistics #users-count').show().text(data.users_count);
                    $('#top-statistics #stages-count').show().text(data.stages_count);
                    $('#top-statistics #places-count').show().text(data.places_count);
                    $('#top-statistics #courses-count').show().text(data.courses_count);
                    $('#top-statistics #qrs-count').show().text(data.qrs_count);


                },

            }); //end of ajax call
        }
    </script>
@endpush
