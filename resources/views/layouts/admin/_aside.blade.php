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

        <li><a class="app-menu__item {{ request()->is('*home*') ? 'active' : '' }}" href="{{ route('admin.home') }}"><i class="app-menu__icon fa fa-home"></i> <span class="app-menu__label">@lang('site.home')</span></a></li>

        {{--stages--}}
        @if (auth()->user()->hasPermission('read_stages'))
            <li><a class="app-menu__item {{ request()->is('*stages*') ? 'active' : '' }}" href="{{ route('admin.stages.index') }}"><i class="app-menu__icon fa fa-list"></i> <span class="app-menu__label">@lang('stages.stages')</span></a></li>
        @endif


        {{--users--}}
        @if (auth()->user()->hasPermission('read_users'))
            <li><a class="app-menu__item {{ request()->is('*users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}"><i class="app-menu__icon fa fa-user"></i> <span class="app-menu__label">@lang('users.users')</span></a></li>
        @endif

        {{--places--}}
        @if (auth()->user()->hasPermission('read_places'))
            <li><a class="app-menu__item {{ request()->is('*places*') ? 'active' : '' }}" href="{{ route('admin.places.index') }}"><i class="app-menu__icon fa fa-list"></i> <span class="app-menu__label">@lang('places.places')</span></a></li>
        @endif
        {{--apartments--}}
        @if (auth()->user()->hasPermission('read_apartments'))


            <li class="treeview {{ request()->is('*apartments*') ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-building-o"></i><span class="app-menu__label">@lang('apartments.apartments')</span><i class="treeview-indicator fa fa-angle-right"></i></a>

                <ul class="treeview-menu">

                    <li><a class="treeview-item" href="{{ route('admin.apartments.index') }}"><i class="icon fa fa-globe">
                            </i>   @lang('site.all')    @lang('apartments.apartments')</a></li>

                    <li><a class="treeview-item" href="{{ route('admin.apartments.index',['approved_state' =>1]) }}"><i class="icon fa fa-check">
                            </i>   @lang('apartments.approved')    @lang('apartments.apartments')</a></li>

                    <li><a class="treeview-item" href="{{ route('admin.apartments.index',['approved_state' =>2]) }}"><i class="icon fa fa-times">
                            </i>   @lang('apartments.unapproved')    @lang('apartments.apartments')</a></li>

                    <li><a class="treeview-item" href="{{ route('admin.apartments.index',['approved_state' =>3]) }}"><i class="icon fa fa-clock-o">
                            </i>   @lang('apartments.waiting')    @lang('apartments.apartments')</a></li>

                    <li><a class="treeview-item" href="{{ route('admin.apartments.index',['state' =>1]) }}"><i class="icon fa fa-check">
                            </i>   @lang('apartments.available')    @lang('apartments.apartments')</a></li>

                    <li><a class="treeview-item" href="{{ route('admin.apartments.index',['state' =>2]) }}"><i class="icon fa fa-times">
                            </i>   @lang('apartments.unavailable')    @lang('apartments.apartments')</a></li>
                </ul>
            </li>
        @endif

        {{--posts--}}
        @if (auth()->user()->hasPermission('read_posts'))
            <li><a class="app-menu__item {{ request()->is('*posts*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}"><i class="app-menu__icon fa fa-list"></i> <span class="app-menu__label">@lang('posts.posts')</span></a></li>
        @endif

        {{--banners--}}
        @if (auth()->user()->hasPermission('read_banners'))
            <li><a class="app-menu__item {{ request()->is('*banners*') ? 'active' : '' }}" href="{{ route('admin.banners.index') }}"><i class="app-menu__icon fa fa-list"></i> <span class="app-menu__label">@lang('banners.banners')</span></a></li>
        @endif


        {{--settings--}}
        @if (auth()->user()->hasPermission('read_settings'))
            <li class="treeview {{ request()->is('*settings*') ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cogs"></i><span class="app-menu__label">@lang('settings.settings')</span><i class="treeview-indicator fa fa-angle-right"></i></a>

                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="{{ route('admin.settings.general') }}"><i class="icon fa fa-circle-o"></i>@lang('settings.general')</a></li>
                </ul>
            </li>
        @endif

        {{--profile--}}
        <li class="treeview {{ request()->is('*profile*') || request()->is('*password*')  ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-circle"></i><span class="app-menu__label">@lang('users.profile')</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{ route('admin.profile.edit') }}"><i class="icon fa fa-circle-o"></i>@lang('users.edit_profile')</a></li>
                <li><a class="treeview-item" href="{{ route('admin.profile.password.edit') }}"><i class="icon fa fa-circle-o"></i>@lang('users.change_password')</a></li>
            </ul>
        </li>


        {{-- --}}{{--categories--}}{{--
       @if (auth()->user()->hasPermission('read_categories'))
           <li><a class="app-menu__item {{ request()->is('*categories*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}"><i class="app-menu__icon fa fa-list"></i> <span class="app-menu__label">@lang('categories.categories')</span></a></li>
       @endif

       --}}{{--brands--}}{{--
       @if (auth()->user()->hasPermission('read_brands'))
           <li><a class="app-menu__item {{ request()->is('*brands*') ? 'active' : '' }}" href="{{ route('admin.brands.index') }}"><i class="app-menu__icon fa fa-user-plus"></i> <span class="app-menu__label">@lang('brands.brands')</span></a></li>
       @endif

       --}}{{--coupons--}}{{--
       @if (auth()->user()->hasPermission('read_coupons'))
           <li><a class="app-menu__item {{ request()->is('*coupons*') ? 'active' : '' }}" href="{{ route('admin.coupons.index') }}"><i class="app-menu__icon fa fa-user-plus"></i> <span class="app-menu__label">@lang('coupons.coupons')</span></a></li>
       @endif--}}

    </ul>
</aside>
