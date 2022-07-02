<li class="dropdown notification-list  nav-item dropdown ">

{{--    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--        Dropdown--}}
{{--    </a>--}}
    <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button"
       aria-haspopup="false" aria-expanded="false">
        <span class="account-user-avatar">
            <img src="/images/avatar-1.jpg" alt="user-image" class="rounded-circle">
        </span>
        <span>
            <span class="account-user-name">{{ auth()->user()->name }}</span>
            <span class="account-position">{{  auth()->user()->role_name  }}</span>
        </span>
    </a>


    <div class=" dropdown-menu dropdown-menu-right topbar-dropdown-menu profile-dropdown">
        <!-- item-->
        <div class=" dropdown-header noti-title">
            <h6 class="text-overflow m-0">Welcome !</h6>
        </div>
    @if(auth()->user()->hasRoleSettings())
        <!-- item-->
            <a href="{{ route('settings') }}" class="dropdown-item notify-item">
                <i class="mdi mdi-account-settings mr-1"></i>
                <span>Settings</span>
            </a>
    @endif
    <!-- item-->
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="dropdown-item notify-item">
            <i class="mdi mdi-logout mr-1"></i>
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</li>
