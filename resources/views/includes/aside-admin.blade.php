<aside class="app-aside app-aside-expand-md app-aside-light">
    <div class="aside-content">
        {{-- <header class="aside-header d-block d-md-none">
            <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside"><span
                    class="user-avatar user-avatar-lg"><img src="images/avatars/profile.jpg" alt=""></span>
                <span class="account-icon"><span class="fa fa-caret-down fa-lg"></span></span> <span
                    class="account-summary"><span class="account-name">{{ Auth::user()->first_name ?? '' }}
                        {{ Auth::user()->last_name ?? '' }}</span>
            </button>
            <div id="dropdown-aside" class="dropdown-aside collapse">
                <div class="pb-3">
                    <a class="dropdown-item" href="user-profile.html">
                        <span class="dropdown-icon oi oi-person"></span>
                        {{ __('Profile') }} </a>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <span class="dropdown-icon oi oi-account-logout"></span>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </header> --}}
        <div class="aside-menu overflow-hidden">
            <nav id="stacked-menu" class="stacked-menu">
                <ul class="menu">
                    <li class="menu-item {{ (request()->is('admin/dashboard')) ? 'has-active' : '' }}">
                        <a href="{{ url('admin/dashboard') }}" class="menu-link">
                            <span class="menu-icon fas fa-home"></span>
                            <span class="menu-text">{{ __('Dashboard') }}</span>
                        </a>
                    </li>
                    <li class="menu-item {{ (request()->is('admin/students') || request()->is('admin/student/*')) ? 'has-active' : '' }}">
                        <a href="{{ url('admin/students') }}" class="menu-link">
                            <span class="menu-icon fas fa-users"></span>
                            <span class="menu-text">{{ __('Students') }}</span>
                        </a>
                    </li>
                    <li class="menu-item {{ (request()->is('admin/teachers') || request()->is('admin/teacher/*')) ? 'has-active' : '' }}">
                        <a href="{{ url('admin/teachers') }}" class="menu-link">
                            <span class="menu-icon fas fa-chalkboard-teacher"></span>
                            <span class="menu-text">{{ __('Teachers') }}</span>
                        </a>
                    </li>
                    <li class="menu-item {{ (request()->is('admin/payment')) ? 'has-active' : '' }}">
                        <a href="{{ url('admin/payment') }}" class="menu-link">
                            <span class="menu-icon fas fa-credit-card"></span>
                            <span class="menu-text">{{ __('Payments') }}</span>
                        </a>
                    </li>
                </ul>
            </nav>
				</div>
				<footer class="aside-footer border-top p-2">
					<span class="text-center d-block">v.1.0.1</span>
				</footer>
    </div>
</aside>
