<aside class="app-aside app-aside-expand-md app-aside-light">
    <div class="aside-content">
        <div class="aside-menu overflow-hidden">
            <nav id="stacked-menu" class="stacked-menu">
                <ul class="menu">
                    <li class="menu-item {{ (request()->is('t/dashboard')) ? 'has-active' : '' }}">
                        <a href="{{ route('teacher_dashboard') }}" class="menu-link">
                            <span class="menu-icon fas fa-home"></span>
                            <span class="menu-text">{{ __('Dashboard') }}</span>
                        </a>
                    </li>
                    <li class="menu-item {{ (request()->is('t/schedule') || request()->is('t/schedule/*')) ? 'has-active' : '' }}">
                        <a href="{{ route('teacher_schedule') }}" class="menu-link">
                            <span class="menu-icon fas fa-chalkboard-teacher"></span>
                            <span class="menu-text">{{ __('Schedule') }}</span>
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
