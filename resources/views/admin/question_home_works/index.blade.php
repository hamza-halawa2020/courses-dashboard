@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('lectures.question_home_work')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('lectures.question_home_work')</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <a href="{{ route('admin.question_home_works.create', $lectureId) }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> @lang('site.create')
                        </a>

                        <form method="post" action="{{ route('admin.question_home_works.bulk_delete') }}"
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
                            <table class="table datatable" id="question_home_works-table" style="width: 100%;">
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
                                        <th>@lang('questions.question')</th>
                                        <th>@lang('questions.details')</th>
                                        <th>@lang('site.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questionHomeWrok as $questionHomeWrok)
                                        <tr>
                                            <td>
                                                <div class="animated-checkbox">
                                                    <label class="m-0">
                                                        <input type="checkbox" name="record_ids[]"
                                                            value="{{ $questionHomeWrok->id }}">
                                                        <span class="label-text"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ $questionHomeWrok->question }}</td>
                                            <td>{{ $questionHomeWrok->details }}</td>
                                            <td>
                                                <a href="{{ route('admin.question_home_works.show', $questionHomeWrok->id) }}"
                                                    class="btn btn-sm btn-primary"><i
                                                        class="fa fa-eye"></i>@lang('site.show')</a>
                                                <a href="{{ route('admin.question_home_works.edit', $questionHomeWrok->id) }}"
                                                    class="btn btn-sm btn-warning"><i
                                                        class="fa fa-edit"></i>@lang('site.edit')</a>
                                                <form
                                                    action="{{ route('admin.question_home_works.destroy', $questionHomeWrok->id) }}"
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
