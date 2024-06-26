<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="{{ auth()->user()->image_path }}" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ auth()->user()->name }}</p>
            <p class="app-sidebar__user-designation">{{ auth()->user()->roles->first()->name }}</p>
        </div>
    </div>

    <ul class="app-menu">

        <li><a class="app-menu__item {{ request()->is('*home*') ? 'active' : '' }}" href="{{ route('admin.home') }}"><i
                    class="app-menu__icon fa fa-home"></i> <span class="app-menu__label">@lang('site.home')</span></a>
        </li>

        {{-- places --}}
        @if (auth()->user()->hasPermission('read_places'))
            <li><a class="app-menu__item {{ request()->is('*places*') ? 'active' : '' }}"
                    href="{{ route('admin.places.index') }}"><i class="app-menu__icon fa fa-map"></i> <span
                        class="app-menu__label">@lang('places.places')</span></a></li>
        @endif


        {{-- stages --}}
        @if (auth()->user()->hasPermission('read_stages'))
            <li><a class="app-menu__item {{ request()->is('*stages*') ? 'active' : '' }}"
                    href="{{ route('admin.stages.index') }}"><i class="app-menu__icon fa fa-list"></i> <span
                        class="app-menu__label">@lang('stages.stages')</span></a></li>
        @endif

        {{-- questions --}}
        {{-- @if (auth()->user()->hasPermission('read_questions')) --}}
        <li><a class="app-menu__item {{ request()->is('*questions*') ? 'active' : '' }}"
                href="{{ route('admin.questions.index') }}"><i class="app-menu__icon fa fa-question"></i>
                <span class="app-menu__label">@lang('questions.questions')</span></a></li>
        {{-- @endif --}}

        {{-- teachers --}}
        <li><a class="app-menu__item {{ request()->is('*teachers*') ? 'active' : '' }}"
                href="{{ route('admin.teachers.index') }}"><i class="app-menu__icon fa fa-users"></i>
                <span class="app-menu__label">@lang('teachers.teachers')</span></a></li>

        {{-- users --}}
        @if (auth()->user()->hasPermission('read_users'))
            <li><a class="app-menu__item {{ request()->is('*users*') ? 'active' : '' }}"
                    href="{{ route('admin.users.index') }}"><i class="app-menu__icon fa fa-user"></i> <span
                        class="app-menu__label">@lang('users.users')</span></a></li>
        @endif

        {{-- courses --}}
        @if (auth()->user()->hasPermission('read_courses'))
            <li><a class="app-menu__item {{ request()->is('*courses*') ? 'active' : '' }}"
                    href="{{ route('admin.courses.index') }}"><i class="app-menu__icon fa fa-book"></i> <span
                        class="app-menu__label">@lang('courses.courses')</span></a></li>
        @endif

        {{-- QR --}}
        @if (auth()->user()->hasPermission('read_QR'))
            <li><a class="app-menu__item {{ request()->is('*QR*') ? 'active' : '' }}"
                    href="{{ route('admin.QR.index') }}"><i class="app-menu__icon fa fa-qrcode"></i> <span
                        class="app-menu__label">@lang('qR.QRs')</span></a></li>
        @endif



        {{-- profile --}}
        <li class="treeview {{ request()->is('*profile*') || request()->is('*password*') ? 'is-expanded' : '' }}">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon fa fa-user-circle"></i><span
                    class="app-menu__label">@lang('users.profile')</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{ route('admin.profile.edit') }}"><i
                            class="icon fa fa-circle-o"></i>@lang('users.edit_profile')</a></li>
                <li><a class="treeview-item" href="{{ route('admin.profile.password.edit') }}"><i
                            class="icon fa fa-circle-o"></i>@lang('users.change_password')</a></li>
            </ul>
        </li>


    </ul>
</aside>
