@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('site.home')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item">@lang('site.home')</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.QR.index') }}">@lang('qR.QRs')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <input type="button" onclick="printInvoice();" value="Print" class="form-control">
                <div class="row mb-2"></div><!-- end of row -->

                <div class="row" id="printDiv">
                    @foreach ($qRs as $qr)
                        <div class="col-md-2 mt-4 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <strong>ID:</strong> {{ $qr->id }}<br>
                                    <strong>CODE:</strong> {{ $qr->code }}<br>
                                    <p class="card-text">
                                        <strong>Created At:</strong> {{ $qr->created_at }}
                                    </p>
                                    <img class="img" width="100" height="100" src="{{ asset($qr->image) }}"
                                        alt="QR Image">

                                    <!-- Delete Button -->
                                    <div class="mt-2">
                                        <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $qr->id }}">
                                            Delete
                                        </button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-btn').click(function() {
                var button = $(this);
                var qrId = button.data('id');
                if (confirm('Are you sure you want to delete this QR code?')) {
                    $.ajax({
                        url: '{{ route('admin.QR.destroy', ':id') }}'.replace(':id', qrId),
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // Remove the deleted QR code from the page
                            button.closest('.col-md-2').remove();
                            alert('QR code deleted successfully.');
                        },
                        error: function(xhr) {
                            alert('An error occurred while deleting the QR code.');
                        }
                    });
                }
            });
        });

        function printInvoice() {
            var printDiv = "#printDiv";
            $("*").addClass("no-print");
            $(printDiv + " *").removeClass("no-print");
            $(printDiv).removeClass("no-print");

            var parent = $(printDiv).parent();
            while ($(parent).length) {
                $(parent).removeClass("no-print");
                parent = $(parent).parent();
            }
            window.print();
        }
    </script>
@endpush
