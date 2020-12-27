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
                    <li class="menu-item {{ (request()->is('client-dashboard')) ? 'has-active' : '' }}">
                        <a href="{{ url('client-dashboard') }}" class="menu-link">
                            <span class="menu-icon fas fa-home"></span>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </li>

                    @if(Auth::user()->user_type=='organization')
                    <li class="menu-item {{ (request()->is('client') || request()->is('folder/c/*') || request()->is('folder/f/*') || request()->is('task/*')) ? 'has-active' : '' }}">
                        <a href="{{ url('client') }}" class="menu-link">
                            <span class="menu-icon fas fa-users"></span>
                            <span class="menu-text">{{ __('Client List') }}</span>
                        </a>
                    </li>
                    @endif

                    <li class="menu-item {{ (request()->is('schedule')) ? 'has-active' : '' }}">
                        <a href="{{ url('schedule') }}" class="menu-link">
                            <span class="menu-icon fas fa-calendar-alt"></span>
                            <span class="menu-text">{{ __('Schedule') }}</span>
                        </a>
                    </li>
                    <li class="menu-item {{ (request()->is('organization-template') || request()->is('organization-template-task/*')) ? 'has-active' : '' }}">
                        <a href="{{ url('organization-template') }}" class="menu-link">
                            <span class="menu-icon fas fa-tasks"></span>
                            <span class="menu-text">{{ __('Task Template') }}</span>
                        </a>
                    </li>

                    <li class="menu-item {{ (request()->is('organization-users')) ? 'has-active' : '' }}">
                        <a href="{{ url('organization-users') }}" class="menu-link">
                            <span class="menu-icon fas fa-user-tie"></span>
                            <span class="menu-text">{{ __('Users') }}</span>
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
