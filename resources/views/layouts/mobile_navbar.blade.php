<!-- Start Mobile Bottom Nav -->
<section class='bottom-nav'>
    <div class='container'>
        <nav class='nav'>
            <a class='nav-link' href='/'>
                <i class='fas fa-home'></i>
            </a>

            <a class='nav-link {{ request()->route()->getName() == 'groups.search' ? 'active' : '' }}' href='{{ route('groups.search') }}'>
                <i class='fas fa-search'></i>
            </a>
            {{-- <a class='nav-link {{ request()->route()->getName() == 'groups.create' ? 'active' : '' }}' href='{{ route('groups.create') }}'>
                <i class='fas fa-plus'></i>
            </a> --}}
            <a class='nav-link {{ request()->route()->getName() == 'messenger.index' ? 'active' : '' }}' href='{{ route('messenger.index') }}'>
                <i class='fab fa-facebook-messenger'></i>
            </a>
            <a class='nav-link position-relative {{ request()->route()->getName() == 'notifications' ? 'active' : '' }}'
                href='{{ route('notifications') }}'>
                <i class='fas fa-bell'></i>
                <span class="notification-count {{ count(auth()->user()->unreadNotifications) <= 0 ? 'd-none' : '' }}">
                    {{ count(auth()->user()->unreadNotifications) }}
                </span>
            </a>
            <a class='nav-link position-relative {{ request()->route()->getName() == 'groupsJoinRequests' ? 'active' : '' }}' href='{{ route('groupsJoinRequests') }}'>
                <i class='fas fa-user-check'></i>
                <span
                    class="notification-count {{ getUserGroupRequestsJoin() <= 0 ? 'd-none' : '' }}">{{ getUserGroupRequestsJoin() }}</span>
            </a>
        </nav>
    </div>
</section>
<!-- End Mobile Bottom Nav -->
