@extends('layouts.admin.app')

@section('content')
    <div>
        <h2>@lang('users.user')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">@lang('users.users')</a></li>
        <li class="breadcrumb-item active">@lang('users.user') {{ $user->name }}</li>
    </ul>

    <div class="tile shadow">
        <div class="mb-4">
            <h4 class="mb-3">@lang('users.user_details')</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>@lang('users.name')</th>
                        <th>@lang('users.email')</th>
                        <th>@lang('users.phone')</th>
                        <th>@lang('users.gender')</th>
                        <th>@lang('users.place')</th>
                        <th>@lang('users.stage_withal')</th>
                        <th>@lang('users.parent_name')</th>
                        <th>@lang('users.parent_phone')</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email ?? 'لا يوجد ايميل' }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->place->name }}</td>
                        <td>{{ $user->stage->name }}</td>
                        <td>{{ $user->parent_name }}</td>
                        <td>{{ $user->parent_phone }}</td>
                    </tr>
                </tbody>
            </table>
        </div>



        <div class="mb-4">
            <h4 class="mb-3">

                @foreach ($user->balances as $balance)
                    @lang('users.balances'): {{ $balance->total }}
                @endforeach
            </h4>

            <h4 class="mb-3">
                @foreach ($user->points as $point)
                    @lang('users.points_amount'): {{ $point->total }}
                @endforeach
            </h4>

            <table class="table table-striped ">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>@lang('users.adminAddedBalances')</th>
                        <th>@lang('users.buyCourseBalance')</th>
                        <th>@lang('users.qrAddedBalance')</th>
                        <th>@lang('users.converPoinToBalance')</th>
                    </tr>
                </thead>
                <tbody>
                    @php $rowCount = max(count($user->adminAddedBalances), count($user->buyCourseBalance), count($user->qrAddedBalance),count($user->converPoinToBalance)); @endphp

                    @for ($i = 0; $i < $rowCount; $i++)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                {{ $user->adminAddedBalances[$i]->balanceDetails->amount ?? '-' }}
                            </td>
                            <td>
                                {{ $user->buyCourseBalance[$i]->balanceDetails->amount ?? '-' }}
                            </td>
                            <td>
                                @if (isset($user->qrAddedBalance[$i]))
                                    @lang('users.value'): {{ $user->qrAddedBalance[$i]->balanceDetails->amount }}
                                    <img src="{{ asset($user->qrAddedBalance[$i]->qr->image) }}" alt="QR Image"
                                        class="img-thumbnail" width="50" height="50">
                                @else
                                @endif
                            </td>
                            <td>
                                <div>
                                    @lang('users.points'): {{ $user->converPoinToBalance[$i]->amount ?? '-' }}
                                </div> @lang('users.value'):
                                {{ $user->converPoinToBalance[$i]->balanceDetails->amount ?? '-' }}
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>






        <div class="mb-4">
            <h4 class="mb-3">@lang('users.subscribed_courses')</h4>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>@lang('users.lessonName')</th>
                        <th>@lang('users.purchaseDate')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->userCanAccess as $index => $course)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>
                                <a href="{{ url('admin/chapters/' . $course->lecture->chapter_id) }}">
                                    {{ $course->lecture->title ?? '-' }}
                                </a>
                            </td>
                            <td> {{ $course->created_at ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
