@extends('layouts.admin.app')


@section('content')
    <div>
        <h2> @php

            /*use SimpleSoftwareIO\QrCode\Facades\QrCode;
                  QrCode::size(250)->generate('www.google.com');*/
        @endphp </h2>
        <h2>




            {{ $currentChapter == null ? 'المحضرات' : $currentChapter->tittle }}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('lectures.lectures')</li>
        <li class="breadcrumb-item">{{ $currentChapter == null ? 'المحضرات' : $currentChapter->tittle }}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        @if (auth()->user()->hasPermission('create_lectures'))
                            <a href="{{ route('admin.lectures.create', ['chapter_id' => $currentChapter == null ? null : $currentChapter->id]) }}"
                                class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a>
                        @endif

                        @if (auth()->user()->hasPermission('delete_lectures'))
                            <form method="post" action="{{ route('admin.lectures.bulk_delete') }}"
                                style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="record_ids" id="record-ids">
                                <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i
                                        class="fa fa-trash"></i> @lang('site.bulk_delete')</button>
                            </form><!-- end of form -->
                        @endif

                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" id="data-table-search" class="form-control" autofocus
                                lectureholder="@lang('site.search')">
                        </div>
                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table datatable" id="lectures-table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="animated-checkbox">
                                                <label class="m-0">
                                                    <input type="checkbox" id="record__select-all">
                                                    <span class="label-text"></span>
                                                </label>
                                            </div>
                                        </th>
                                        <th>@lang('lectures.tittle')</th>
                                        <th>@lang('lectures.price')</th>
                                        <th>@lang('lectures.status')</th>

                                        {{-- <th>@lang('lectures.apartments_count')</th>
                                     <th>@lang('lectures.related_apartments')</th> --}}
                                        <th>@lang('lectures.start')</th>
                                        <th>@lang('lectures.end'    )</th>
                                        @if (auth()->user()->hasPermission('update_lectures') || auth()->user()->hasPermission('delete_lectures'))
                                            <th>@lang('site.action')</th>
                                        @endif
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>

                        </div><!-- end of table responsive -->

                    </div><!-- end of col -->

                </div><!-- end of row -->

            </div><!-- end of tile -->

        </div><!-- end of col -->


        {{-- edit lecture status --}}

        <div class="modal fade" id="editLecStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            تعديل حالة المحاضرة
                        </h5>

                    </div>
                    <div class="modal-body">

                        <form method="post" action="{{ route('admin.lectures.update', 1) }}">
                            @csrf
                            @method('put')

                            @include('admin.partials._errors')

                            <input type="hidden" name="meth" value="lectureStatus">
                            <input type="hidden" name="lectureIDStatus" id="lectureIDStatus" value="">

                            {{-- tittle --}}
                            <div class="form-group">
                                <label>حالة {{ '/' }}<span class="text-danger"></span></label>
                                <label id="lectureTittleStatus"> <span class="text-danger"></span></label>
                                <input type="hidden" name="statusLecValue" id="statusLecValue" value="">
                                <input type="text" name="status" class="form-control" value="" id="lecStatus"
                                    disabled>

                            </div>
                            {{-- Button --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i
                                        class="fa fa-plus"></i>@lang('site.change')</button>
                            </div>

                        </form><!-- end of form -->



                    </div>
                </div>
            </div>
        </div>

    </div><!-- end of row -->
@endsection

@push('scripts')
    <script>
        let chapter = '{{ request()->chapter_id }}';
        let lecturesTable = $('#lectures-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.lectures.data') }}',
                data: function(d) {
                    d.chapter_id = chapter;
                }
            },
            columns: [{
                    data: 'record_select',
                    name: 'record_select',
                    searchable: false,
                    sortable: false,
                    width: '1%'
                },
                {
                    data: 'tittle',
                    name: 'tittle'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                /*{data: 'apartments_count', name: 'apartments_count',searchable: false},
                {data: 'related_apartments', name: 'related_apartments',searchable: false,sortable:false},*/
                {
                    data: 'status',
                    name: 'status',
                    sortable: false,
                    searchable: false
                },
                {
                    data: 'start',
                    name: 'start',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'end',
                    name: 'end',
                    searchable: false,
                    sortable: false,
                },
                {
                    data: 'actions',
                    name: 'actions',
                    searchable: false,
                    sortable: false,
                    width: '30%'
                }
            ],
            order: [
                [1, 'desc']
            ],
            drawCallback: function(settings) {
                $('.record__select').prop('checked', false);
                $('#record__select-all').prop('checked', false);
                $('#record-ids').val();
                $('#bulk-delete').attr('disabled', true);
            }
        });

        $('#data-table-search').keyup(function() {
            lecturesTable.search(this.value).draw();
        })

        $('#place').on('change', function() {
            place = this.value;
            apartmentsTable.ajax.reload();
        })

        $(document).ready(function() { //same as: $(function() {

            // alert("hi 1");
        });


        //edit status
        $(document).on('click', '.editLectureStatus', function() {
            var id = $(this).data('id');

            $.ajax({
                url: '{{ url('admin/lectures', '') }}' + '/' + id + '/' + 'find',

                method: 'GET',
                success: function(response) {
                    //console.log('clicked')
                    $('#editLecStatus').modal('show');
                    $('#lectureTittleStatus').html(response.tittle);
                    $('#lectureIDStatus').val(response.id);
                    $('#statusLecValue').val(response.status);
                    if (response.status == 1) {
                        $('#lecStatus').val('نشطة');

                    } else {
                        $('#lecStatus').val('غير نشطة');
                    }
                },
                error: function(response) {
                    console.log(response);

                }

            });

        });
    </script>
@endpush
