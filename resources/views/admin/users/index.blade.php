@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('users.users')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('users.users')</li>
    </ul>

    <div class="row" id="booody" >

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        @if (auth()->user()->hasPermission('read_users'))
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> @lang('site.create')</a>
                        @endif

                        @if (auth()->user()->hasPermission('delete_users'))
                            <form method="post" action="{{ route('admin.users.bulk_delete') }}"
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
                                   placeholder="@lang('site.search')">
                        </div>
                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table datatable" id="users-table" style="width: 100%;">
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
                                    <th>@lang('users.name')</th>
                                    <th>@lang('users.phone')</th>
                                    <th>@lang('users.balance')</th>
                                    <th>@lang('users.stage_withal')</th>
                                    <th>@lang('users.gender')</th>
                                    <th>@lang('users.parent_name')</th>
                                    <th>@lang('users.parent_phone')</th>
                                    <th>@lang('users.status')</th>
                                    {{--<th>@lang('site.created_at')</th>--}}
                                    <th>@lang('site.action')</th>
                                </tr>
                                </thead>
                            </table>

                        </div><!-- end of table responsive -->

                    </div><!-- end of col -->

                </div><!-- end of row -->

            </div><!-- end of tile -->

        </div><!-- end of col -->


        <div class="modal fade" id="editStatus" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                            id="exampleModalLabel">
                            تعديل حالة الطالب
                        </h5>

                    </div>
                    <div class="modal-body">

                        {{--<form method="post" action="#">
                        @csrf
                        @method('put')
                            <div class="form-group">
                                <input type="hidden" name="id" value="" id="id" >
                                <label>@lang('users.status')<span class="text-danger">*</span></label>
                                <input type="text" name="status" class="form-control" value="" id="userStatus" disabled >
                            </div>

                            <div class="form-group">
                                <button type="submit" id="statusButton" class="btn btn-primary"><i class="fa fa-edit"></i>@lang('site.change')</button>
                            </div>
                        </form><!-- end of form -->

--}}

                        <form method="post" action="{{ route('admin.users.update',1) }}">
                            @csrf
                            @method('put')

                            @include('admin.partials._errors')

                            {{--name--}}
                            <div class="form-group">

                                <label>@lang('stages.name') <span class="text-danger">*</span></label>
                                <input type="hidden" name="userIds" id="userIds" value="">
                                <input type="hidden" name="statusValue" id="statusValue" value="">
                                <input type="text" name="status" class="form-control" value="'5'" id="userStatus" disabled >

                            </div>

                            {{--Button--}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.change')</button>
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

        let usersTable = $('#users-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.users.data') }}',
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
                {data: 'balance', name: 'balance'},

                {data: 'stage', name: 'stage', searchable: false, sortable: false},
                {data: 'gender', name: 'gender'},
                {data: 'parent_name', name: 'parent_name'},
                {data: 'parent_phone', name: 'parent_phone'},
                {data: 'status', name: 'status'},
                //{data: 'created_at', name: 'created_at', searchable: false},
                {data: 'edit', name: 'edit', searchable: false, sortable: false, width: '10%'},
            ],
            order: [[2, 'desc']],
            drawCallback: function (settings) {
                $('.record__select').prop('checked', false);
                $('#record__select-all').prop('checked', false);
                $('#record-ids').val();
                $('#bulk-delete').attr('disabled', true);
            }
        });

        $('#data-table-search').keyup(function () {
            usersTable.search(this.value).draw();
        });
        //edit button
        $(document).on('click','.editUser',function () {
            var id = $(this).data('id');

            $.ajax({
                url:'{{ url('admin/users','')}}' + '/' + id +'/'+ 'status',

                method:'GET',
                success:function(response){
                    $('#editStatus').modal('show');
                    //$('#userStatus').val(response.status);
                    $('#userIds').val(response.id);
                    $('#statusValue').val(response.status);
                    if (response.status==1){
                        $('#userStatus').val('نشط');

                    }else {
                        $('#userStatus').val('غير نشط');
                    }
                },
                error:function(response){
                    console.log(response);

                }

            });

        });

        /*$(document).on('click','#statusButton',function () {

            //var id = $(this).data('id');

            $.ajax({
                url:'{{ url('admin/users/sss')}}',
                method:'POST',
                success:function(response){
                    console.log(1111);
                },
                error:function(response){
                    console.log(response);

                }

            });

        });*/



    </script>

@endpush
