<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link {{ $segment == null ? 'active' : '' }}" href="{{ route('admin.dashboard.index') }}">
                    <i class="icon-home"></i> {{ __('dashboard.home') }}
                </a>
            </li>

            @if(auth('admin')->user()->can('admin.users.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'users' ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="icon-people"></i> {{ __('dashboard.users') }}
                </a>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin.groups.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'groups' ? 'active' : '' }}" href="{{ route('admin.groups.index') }}">
                    <i class="icon-layers"></i> {{ __('dashboard.groups') }}
                </a>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin.posts.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'posts' ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
                    <i class="icon-pencil"></i> {{ __('dashboard.posts') }}
                </a>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin.countries.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'countries' ? 'active' : '' }}" href="{{ route('admin.countries.index') }}">
                    <i class="icon-flag"></i> {{ __('dashboard.countries') }}
                </a>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin.states.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'states' ? 'active' : '' }}" href="{{ route('admin.states.index') }}">
                    <i class="icon-compass"></i> {{ __('dashboard.states') }}
                </a>
            </li>
            @endif

            @if (auth('admin')->user()->can('admin.infos.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'infos' ? 'active' : '' }}" href="{{ route('admin.infos.index') }}">
                    <i class="icon-info"></i> {{ __('dashboard.infos') }}
                </a>
            </li>
            @endif

            @if (auth('admin')->user()->can('admin.settings.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'settings' ? 'active' : '' }}"
                    href="{{ route('admin.settings.index') }}">
                    <i class="icon-settings"></i> {{ __('dashboard.settings') }}
                </a>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin.contactus.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'contactus' ? 'active' : '' }}"
                    href="{{ route('admin.contactus.index') }}">
                    <i class="icon-emotsmile"></i> {{ __('dashboard.contactus') }}
                </a>
            </li>
            @endif


            @if(auth('admin')->user()->can('admin.admins.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'admins' ? 'active' : '' }}" href="{{ route('admin.admins.index') }}">
                    <i class="icon-diamond"></i> {{ __('dashboard.admins') }}
                </a>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin.admins.view'))
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'roles' ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                    <i class="icon-diamond"></i> {{ __('dashboard.roles') }}
                </a>
            </li>
            @endif


        </ul>
    </nav>
</div>

{{--   <li class="{{ $segment == null ? 'active' : '' }}"><a href="{{ route('dashboard') }}"> <i
        class="icon-home"></i>Home </a></li>

<li class="{{ in_array($segment, ['categories']) ? 'active' : '' }}">
    <a href="{{ route('dashboard.categories') }}">
        <i class="fa fa-list fa-lg"></i>
        <span class="px-2">Categories</span>
    </a>
</li>
--}}
