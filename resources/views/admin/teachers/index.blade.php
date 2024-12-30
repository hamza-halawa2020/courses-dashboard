@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('teachers.teachers')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('teachers.teachers')</li>

    </ul>
    <div class="row">
        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                            @lang('site.create')</a>

                        <form method="post" action="{{ route('admin.teachers.bulk_delete') }}"
                            style="display: inline-block;">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="record_ids" id="record-ids">
                            <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i
                                    class="fa fa-trash"></i>
                                @lang('site.bulk_delete')</button>
                        </form>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="table-responsive">
                            <table class="table datatable" id="questions-table" style="width: 100%;">

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
                                        <th>@lang('teachers.name')</th>
                                        <th>@lang('teachers.details')</th>
                                        <th>@lang('site.action')</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachers as $teacher)
                                        <tr>
                                            <td>{{ $teacher->id }}</td>
                                            <td>
                                                <a href="{{ route('admin.teachers.show', $teacher->id) }}">
                                                    {{ $teacher->name }}
                                                </a>
                                            </td>
                                            <td>{{ $teacher->details }}</td>
                                            <td>

                                                <a href="{{ route('admin.total_exams.index', ['teacherId' => $teacher->id]) }}
                                                "
                                                    class="btn btn-primary btn-sm">
                                                    @lang('questions.total_exam')
                                                </a>


                                                <a href="{{ route('admin.teachers.show', $teacher->id) }}"
                                                    class="btn btn-sm btn-primary">@lang('courses.courses')</a>
                                                <a href="{{ route('admin.teachers.edit', $teacher->id) }}"
                                                    class="btn btn-sm btn-warning">@lang('site.edit')</a>
                                                <form action="{{ route('admin.teachers.destroy', $teacher->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this teacher?')">@lang('site.delete')</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
