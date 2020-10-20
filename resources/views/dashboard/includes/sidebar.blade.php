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

            @if(auth('admin')->user()->can('admin.properties.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'properties' ? 'active' : '' }}" href="{{ route('admin.properties.index') }}">
                    <i class="icon-compass"></i> {{ __('dashboard.properties') }}
                </a>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin.categories.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'categories' ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                    <i class="icon-layers"></i> {{ __('dashboard.categories') }}
                </a>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin.types.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'types' ? 'active' : '' }}" href="{{ route('admin.types.index') }}">
                    <i class="icon-pencil"></i> {{ __('dashboard.types') }}
                </a>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin.periods.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'periods' ? 'active' : '' }}" href="{{ route('admin.periods.index') }}">
                    <i class="icon-flag"></i> {{ __('dashboard.periods') }}
                </a>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin.furnishings.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'furnishings' ? 'active' : '' }}" href="{{ route('admin.furnishings.index') }}">
                    <i class="icon-compass"></i> {{ __('dashboard.furnishings') }}
                </a>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin.amenities.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'amenities' ? 'active' : '' }}" href="{{ route('admin.amenities.index') }}">
                    <i class="icon-compass"></i> {{ __('dashboard.amenities') }}
                </a>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin.completings.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'completings' ? 'active' : '' }}" href="{{ route('admin.completings.index') }}">
                    <i class="icon-compass"></i> {{ __('dashboard.completings') }}
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
