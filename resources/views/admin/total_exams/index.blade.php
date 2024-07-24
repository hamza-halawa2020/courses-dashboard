@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('questions.total_exam')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('questions.total_exam')</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <a href="{{ route('admin.total_exams.create', $teacherId) }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> @lang('site.create')
                        </a>

                        <form method="post" action="{{ route('admin.total_exams.bulk_delete') }}"
                            style="display: inline-block;">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="record_ids" id="record-ids">
                            <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true">
                                <i class="fa fa-trash"></i>@lang('site.bulk_delete')
                            </button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table datatable" id="total_exams-table" style="width: 100%;">
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
                                        <th>@lang('questions.total_exam')</th>
                                        <th>@lang('lectures.start')</th>
                                        <th>@lang('lectures.end')</th>
                                        <th>@lang('site.details')</th>
                                        <th>@lang('site.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($totalExam as $total)
                                        <tr>
                                            <td>
                                                <div class="animated-checkbox">
                                                    <label class="m-0">
                                                        <input type="checkbox" name="record_ids[]"
                                                            value="{{ $total->id }}">
                                                        <span class="label-text"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ $total->question }}</td>
                                            <td>{{ $total->start_at }}</td>
                                            <td>{{ $total->end_at }}</td>
                                            <td>{{ $total->details }}</td>
                                            <td>
                                                <a href="{{ route('admin.total_exams.show', $total->id) }}"
                                                    class="btn btn-sm btn-primary"><i
                                                        class="fa fa-eye"></i>@lang('site.show')</a>
                                                <a href="{{ route('admin.total_exams.edit', $total->id) }}"
                                                    class="btn btn-sm btn-warning"><i
                                                        class="fa fa-edit"></i>@lang('site.edit')</a>
                                                <form action="{{ route('admin.total_exams.destroy', $total->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this exam?')">
                                                        @lang('site.delete')
                                                    </button>
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
