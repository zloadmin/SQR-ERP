<li class="side-nav-item">
    <a class="side-nav-link {{ Route::currentRouteName() == 'clients-panel' ? 'active' : ''}}" href="{{ route('clients-panel') }}">
        <i class="dripicons-meter"></i>
        <span>Dashboard <span class="sr-only">(current)</span></span>
    </a>
</li>
{{--<li class="side-nav-item">--}}
    {{--<a class="side-nav-link {{ Route::currentRouteName() == 'cashiers-for-client' || Route::currentRouteName() == 'create-cashier-for-client' || Route::currentRouteName() == 'edit-cashier-for-client' ? 'active' : ''}}" href="{{ route('cashiers-for-client') }}">--}}
        {{--<i class="mdi mdi-cash-register"></i>--}}
        {{--<span>Cashiers</span>--}}
    {{--</a>--}}
{{--</li>--}}
<li class="side-nav-item">
    <a class="side-nav-link {{ Route::currentRouteName() == 'end-users-for-client' || Route::currentRouteName() == 'edit-end-user-for-client' ? 'active' : ''}}" href="{{ route('end-users-for-client') }}">
        <i class="dripicons-user-group"></i>
        <span>Users</span>
    </a>
</li>
<li class="side-nav-item">
    <a class="side-nav-link {{ Route::currentRouteName() == 'notifications-for-client' || Route::currentRouteName() == 'create-notification-for-client' ? 'active' : ''}}" href="{{ route('notifications-for-client') }}">
        <i class="mdi mdi-notification-clear-all"></i>
        <span>Notifications</span>
    </a>
</li>
<li class="side-nav-item">
    <a class="side-nav-link {{ Route::currentRouteName() == 'points-log-for-client' ? 'active' : ''}}" href="{{ route('points-log-for-client') }}">
        <i class="mdi mdi-coin"></i>
        <span>Transactions</span>
    </a>
</li>