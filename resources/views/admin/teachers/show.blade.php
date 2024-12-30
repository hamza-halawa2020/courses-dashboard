@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('teachers.teacher')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('teachers.teachers')</li>
        <li class="breadcrumb-item">@lang('teachers.teacher') {{ $teacher->name }}</li>

    </ul>

    <div class="tile shadow">



        <div>
            <form action="{{ route('admin.export', $teacher->id) }}" method="GET" class="mb-4">
                <h5 class="mb-3">@lang('users.filterWithPurshingDate')</h5>
                <div class="row">
                    <div class="col-md-4">
                        <label for="start_date">@lang('users.start_date')</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="end_date">@lang('users.end_date')</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                    </div>
                    <div class="col-md-4 align-self-end">
                        <button type="submit" class="btn btn-success w-100">@lang('users.export')</button>
                    </div>
                </div>
            </form>
        </div>
        <hr>
        <hr>
        <div>
            <form action="{{ route('admin.question-export', $teacher->id) }}" method="GET" class="mb-4">
                <h5 class="mb-3">@lang('users.questionsAnswerdInQuestion')</h5>
                <div class="row">
                    <div class="col-md-4">
                        <label for="start_date">@lang('users.start_date')</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="end_date">@lang('users.end_date')</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                    </div>
                    <div class="col-md-4 align-self-end">
                        <button type="submit" class="btn btn-success w-100">@lang('users.export')</button>
                    </div>
                </div>
            </form>
        </div>


        <div class="row">
            <div class="col-md-12 mb-4">
                <h1>@lang('teachers.teacher'): {{ $teacher->name }}</h1>
                <p class="h5">{{ $teacher->details }}</p>
            </div>

            <div class="col-md-12 mb-4">
                <a href="{{ route('admin.courses.index') }}" class="btn btn-primary">
                    @lang('courses.courses')
                </a>
            </div>

            <div class="col-md-12">
                @if ($teacher->courses->isEmpty())
                    <div class="alert alert-info text-center h3">@lang('teachers.No_courses_available_for_this_teacher')</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>@lang('courses.title')</th>
                                    <th>@lang('stages.stage_withal')</th>
                                    <th>@lang('site.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teacher->courses as $course)
                                    <tr>
                                        <td>
                                            <a
                                                href="{{ route('admin.courses.show', $course->id) }}">{{ $course->title }}</a>
                                        </td>
                                        <td>{{ $course->stage->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.courses.show', $course->id) }}"
                                                class="btn btn-info btn-sm">
                                                @lang('chapters.chapters')
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>



    <div class="tile shadow">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h1>@lang('users.teacher_details') : {{ $teacher->name }}</h1>
            </div>

            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>@lang('#')</th>
                                <th>@lang('users.lectures_name')</th>
                                <th>@lang('users.student_name')</th>
                                <th>@lang('users.lectures_cost')</th>
                                <th>@lang('users.purchaseDate')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach ($teacher->courses as $course)
                                @foreach ($course->chapters as $chapter)
                                    @foreach ($chapter->lectures as $lecture)
                                        @foreach ($lecture->userCanAccess as $user)
                                            <tr>
                                                <td>{{ $i++ }}</td>

                                                <td>
                                                    <a href="{{ url('admin/chapters/' . $chapter->id) }}">

                                                        {{ $lecture->title ?? '-' }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/users/' . $user->user->id) }}">
                                                        {{ $user->user->name }}
                                                    </a>

                                                </td>
                                                <td>{{ $lecture->price ?? '-' }}</td>
                                                <td>{{ $user->created_at }}</td>

                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
