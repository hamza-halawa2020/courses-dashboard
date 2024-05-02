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
        @if (auth()->user()->hasPermission('read_questions'))
            <li><a class="app-menu__item {{ request()->is('*questions*') ? 'active' : '' }}"
                    href="{{ route('admin.questions.index') }}"><i class="app-menu__icon fa fa-question"></i>
                    <span class="app-menu__label">@lang('questions.questions')</span></a></li>
        @endif

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
        {{-- chapters --}}{{--
        @if (auth()->user()->hasPermission('read_chapters'))
            <li><a class="app-menu__item {{ request()->is('*chapters*') ? 'active' : '' }}" href="{{ route('admin.chapters.index') }}"><i class="app-menu__icon fa fa-user"></i> <span class="app-menu__label">@lang('chapters.chapters')</span></a></li>
        @endif
        {{-- lectures --}}

        {{--
        @if (auth()->user()->hasPermission('read_lectures'))
            <li><a class="app-menu__item {{ request()->is('*lectures*') ? 'active' : '' }}"
                    href="{{ route('admin.lectures.index') }}"><i class="app-menu__icon fa fa-user"></i> <span
                        class="app-menu__label">@lang('lectures.lectures')</span></a></li>
        @endif
        --}}


        {{-- qRvalues --}}{{--
        @if (auth()->user()->hasPermission('read_places'))
            <li><a class="app-menu__item {{ request()->is('*qRvalues*') ? 'active' : '' }}"
                   href="{{ route('admin.qRvalues.index') }}"><i class="app-menu__icon fa fa-list"></i> <span
                        class="app-menu__label">@lang('qRvalues.qRvalues')</span></a></li>
        @endif --}}
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


        {{-- --}}{{-- categories --}}{{--
       @if (auth()->user()->hasPermission('read_categories'))
           <li><a class="app-menu__item {{ request()->is('*categories*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}"><i class="app-menu__icon fa fa-list"></i> <span class="app-menu__label">@lang('categories.categories')</span></a></li>
       @endif

       --}}{{-- brands --}}{{--
       @if (auth()->user()->hasPermission('read_brands'))
           <li><a class="app-menu__item {{ request()->is('*brands*') ? 'active' : '' }}" href="{{ route('admin.brands.index') }}"><i class="app-menu__icon fa fa-user-plus"></i> <span class="app-menu__label">@lang('brands.brands')</span></a></li>
       @endif

       --}}{{-- coupons --}}{{--
       @if (auth()->user()->hasPermission('read_coupons'))
           <li><a class="app-menu__item {{ request()->is('*coupons*') ? 'active' : '' }}" href="{{ route('admin.coupons.index') }}"><i class="app-menu__icon fa fa-user-plus"></i> <span class="app-menu__label">@lang('coupons.coupons')</span></a></li>
       @endif --}}

    </ul>
</aside>
