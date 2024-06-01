@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('exams.exams_lectures')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('exams.exams_lectures')</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <a href="{{ route('admin.exam_lectures.create', $lectureId) }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> @lang('site.create')
                        </a>

                        <form method="post" action="{{ route('admin.exam_lectures.bulk_delete') }}"
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
                            <table class="table datatable" id="exam_lectures-table" style="width: 100%;">
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
                                        <th>@lang('exam_lectures.question')</th>
                                        <th>@lang('exam_lectures.details')</th>
                                        <th>@lang('site.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questionHomeWrok as $examlecture)
                                        <tr>
                                            <td>
                                                <div class="animated-checkbox">
                                                    <label class="m-0">
                                                        <input type="checkbox" name="record_ids[]"
                                                            value="{{ $examlecture->id }}">
                                                        <span class="label-text"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ $examlecture->question }}</td>
                                            <td>{{ $examlecture->details }}</td>
                                            <td>
                                                <a href="{{ route('admin.exam_lectures.show', $examlecture->id) }}"
                                                    class="btn btn-sm btn-primary"><i
                                                        class="fa fa-eye"></i>@lang('site.show')</a>
                                                <a href="{{ route('admin.exam_lectures.edit', $examlecture->id) }}"
                                                    class="btn btn-sm btn-warning"><i
                                                        class="fa fa-edit"></i>@lang('site.edit')</a>
                                                <form action="{{ route('admin.exam_lectures.destroy', $examlecture->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this exam lecture?')">
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
