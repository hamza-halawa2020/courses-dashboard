@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{--@lang('chapters.chapters')--}} {{request()->course_id}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('chapters.chapters')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        @if (auth()->user()->hasPermission('create_chapters'))
                            <a href="{{ route('admin.chapters.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a>
                        @endif

                        @if (auth()->user()->hasPermission('delete_chapters'))
                            <form method="post" action="{{ route('admin.chapters.bulk_delete') }}" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="record_ids" id="record-ids">
                                <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i class="fa fa-trash"></i> @lang('site.bulk_delete')</button>
                            </form><!-- end of form -->
                        @endif

                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" id="data-table-search" class="form-control" autofocus chapterholder="@lang('site.search')">
                        </div>
                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table datatable" id="chapters-table" style="width: 100%;">
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
                                    <th>@lang('chapters.tittle')</th>
                                  {{--  <th>@lang('users.stage_withal')</th>--}}
                                   {{-- <th>@lang('chapters.apartments_count')</th>
                                    <th>@lang('chapters.related_apartments')</th>--}}
                                    <th>@lang('site.created_at')</th>
                                    @if(auth()->user()->hasPermission('update_chapters')||auth()->user()->hasPermission('delete_chapters'))
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

    </div><!-- end of row -->

@endsection

@push('scripts')

    <script>
        let course = '{{request()->course_id}}';
        let chaptersTable = $('#chapters-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            /*"language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },*/
            ajax: {
                url: '{{ route('admin.chapters.data') }}',
                data: function (d) {
                    d.course_id = course;
                }
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'tittle', name: 'tittle'},
                //{data: 'stage', name: 'stage', searchable: false, sortable: false},
                /*{data: 'apartments_count', name: 'apartments_count',searchable: false},
                {data: 'related_apartments', name: 'related_apartments',searchable: false,sortable:false},*/
                {data: 'created_at', name: 'created_at', searchable: false},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
            ],
            order: [[1, 'desc']],
            drawCallback: function (settings) {
                $('.record__select').prop('checked', false);
                $('#record__select-all').prop('checked', false);
                $('#record-ids').val();
                $('#bulk-delete').attr('disabled', true);
            }
        });

        $('#data-table-search').keyup(function () {
            chaptersTable.search(this.value).draw();
        })

        $('#place').on('change', function () {
            place = this.value;
            apartmentsTable.ajax.reload();
        })
    </script>

@endpush
