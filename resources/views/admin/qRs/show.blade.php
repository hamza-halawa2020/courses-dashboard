@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('site.home')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item">@lang('site.home')</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.QR.index') }}">@lang('QR.qRs')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>

    </ul>
    <div class="row">

        <div class="col-md-12 ">

            <div class="tile shadow">
                <input type="button" onclick="printInvoice();" value="Print">
                <div class="row mb-2">

                </div><!-- end of row -->

                <div class="row" id="printDiv">

                    @foreach($qRs as $qr)

                        <div class="row-md-2 mt-4">

                            <div class="card">

                                <div class="card-body">

                                    <img class="img" width="100" height="100" src="{{ $qr->image_path }}"
                                         alt="User Image">

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

    <script>

        function printInvoice() {
            printDiv = "#printDiv"; // id of the div you want to print
            $("*").addClass("no-print");
            $(printDiv + " *").removeClass("no-print");
            $(printDiv).removeClass("no-print");

            parent = $(printDiv).parent();
            while ($(parent).length) {
                $(parent).removeClass("no-print");
                parent = $(parent).parent();
            }
            window.print();

        }
    </script>
@endpush
