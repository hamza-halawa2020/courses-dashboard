@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('qR.QRs')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item">@lang('site.home')</li>
        <li class="breadcrumb-item">@lang('qR.QRs')</li>

    </ul>

    <div class="row">

        <div class="col-md-12 ">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        @if (auth()->user()->hasPermission('create_places'))
                            <a href="{{ route('admin.QR.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                                @lang('site.create')</a>
                        @endif
                        @if (auth()->user()->hasPermission('create_places'))
                            <a href="{{ route('admin.qRvalues.index') }}" class="btn btn-info"><i class="fa fa-cog"></i>
                                @lang('site.manage_qRValues')</a>
                        @endif

                    </div>

                </div><!-- end of row -->
                <div class="row">
                    @foreach ($qRvalues as $qRvalue)
                        <div class="col-md-4 mt-4">

                            <div class="card">

                                <div class="card-body">

                                    <div class="d-flex justify-content-between mb-1">
                                        <h4 class="mb-3 "><span class="fa fa-qrcode mx-1"></span> {{ $qRvalue->tittle }}
                                        </h4>
                                        <a href="{{ route('admin.QR.show', $qRvalue->id) }}">@lang('site.show_all')</a>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">

                                        <h5 class="mb-1">{{ ' ' }}{{ 'العدد' }} {{ ' ' }}
                                            {{ $qRvalue->qRs->count() }}</h5>
                                        {{-- <a href="{{ route('admin.QR.show',$qRvalue->id) }}"><span
                                                class="fa fa-print mx-1"></span></a> --}}
                                    </div>


                                </div>

                            </div>

                        </div><!-- end of col -->
                    @endforeach

                </div>



            </div><!-- end of tile -->


        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection

@push('scripts')
    <script></script>
@endpush
