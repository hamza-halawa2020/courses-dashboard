@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('courses.courses')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('courses.courses')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        @if (auth()->user()->hasPermission('create_courses'))
                            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                                @lang('site.create')</a>
                        @endif

                        @if (auth()->user()->hasPermission('delete_courses'))
                            <form method="post" action="{{ route('admin.courses.bulk_delete') }}"
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
                                courseholder="@lang('site.search')">
                        </div>
                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table datatable" id="courses-table" style="width: 100%;">
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
                                        <th>@lang('courses.title')</th>
                                        <th>@lang('users.stage_withal')</th>
                                        <th>@lang('courses.chapters_count')</th>
                                        <th>@lang('site.created_at')</th>
                                        @if (auth()->user()->hasPermission('update_courses') || auth()->user()->hasPermission('delete_courses'))
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

        {{-- show chapter modal --}}

        <div class="modal fade" id="showChaptersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            تعديل حالة الطالب
                        </h5>

                    </div>
                    <div class="modal-body">

                        <form method="post" action="{{ route('admin.users.update', 1) }}">
                            @csrf
                            @method('put')

                            @include('admin.partials._errors')
                            <input type="hidden" name="method" value="status">
                            <input type="hidden" name="userIDStatus" id="userIDStatus" value="">


                            {{-- name --}}
                            <div class="form-group">
                                <label>@lang('users.status') <span class="text-danger"></span></label>
                                <label id="userNameStatus"> <span class="text-danger"></span></label>
                                <input type="hidden" name="statusValue" id="statusValue" value="">
                                <input type="text" name="status" class="form-control" value="" id="userStatus"
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
        let coursesTable = $('#courses-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.courses.data') }}',
            },
            columns: [{
                    data: 'record_select',
                    name: 'record_select',
                    searchable: false,
                    sortable: false,
                    width: '1%'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'stage',
                    name: 'stage',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'chapters_count',
                    name: 'chapters_count',
                    searchable: false
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    searchable: false
                },
                {
                    data: 'actions',
                    name: 'actions',
                    searchable: false,
                    sortable: false,
                    width: '40%'
                },
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
            coursesTable.search(this.value).draw();
        })
    </script>
@endpush
