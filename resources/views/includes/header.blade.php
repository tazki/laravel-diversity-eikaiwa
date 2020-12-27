<header class="app-header app-header-dark">
    <div class="top-bar">
        <div class="top-bar-brand">
            <button class="hamburger hamburger-squeeze mr-2" type="button" data-toggle="aside-menu"
                aria-label="toggle aside menu">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
            <a href="{{ url('dashboard') }}">
							<img class="header-logo" src="{{ secure_asset('images/matome/matomeru_logo_b.png') }}" alt="Logo">
            </a>
        </div>
        <div class="top-bar-list">
			<h5 class="mb-0 ml-3 d-none d-lg-block">{{ \App\Organization::find(Auth::user()->organization_id)->company_name ?? '' }}</h5>
            <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
                <button class="hamburger hamburger-squeeze" type="button" data-toggle="aside"
                    aria-label="toggle menu"><span class="hamburger-box"><span
                    class="hamburger-inner"></span></span>
                </button>
            </div>
            <div class="top-bar-item top-bar-item-full">
							<img class="header-logo d-block d-md-none" src="{{ secure_asset('images/matome/matomeru_logo_b.png') }}" alt="Logo">
            </div>
            <div class="top-bar-item top-bar-item-right px-0 d-flex">
								<ul class="header-nav nav">
									<li class="nav-item dropdown header-nav-dropdown has-notified">
										<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-bell"></span></a> <!-- .dropdown-menu -->
										<div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
											<div class="dropdown-arrow"></div>
											<h6 class="dropdown-header stop-propagation">
												<span>Notifications <span class="badge">(1)</span></span>
											</h6>
											<div class="dropdown-scroll perfect-scrollbar">
												<a href="#" class="dropdown-item unread">
													<div class="user-avatar">
														{{-- <img src="assets/images/avatars/uifaces15.jpg" alt=""> --}}
													</div>
													<div class="dropdown-item-body">
														<p class="text"> Reminder for task 1 </p><span class="date">Just now</span>
													</div>
												</a>
											</div>
										</div>
									</li>
								</ul>
                <div class="dropdown d-flex">
                    <button class="btn-account" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <span class="user-avatar user-avatar-md">
                            {!! (Auth::user()->avatar) ? '<img src="'.userFile(Auth::user()->avatar).'" alt="">' : '<span class="d-block fa fa-user-circle"></span>' !!}
                        </span>
                        <span class="account-summary pr-lg-4 d-none d-lg-block">
                            <span class="account-name">{{ Auth::user()->first_name ?? '' }}
                                {{ Auth::user()->last_name ?? '' }}</span>
                        </span>
                    </button>
                    <div class="dropdown-menu">
                        <div class="dropdown-arrow d-lg-none" x-arrow=""></div>
                        <div class="dropdown-arrow ml-3 d-none d-lg-block"></div>
                        <h6 class="dropdown-header d-none d-md-block d-lg-none">
                            {{ Auth::user()->first_name ?? '' }} {{ Auth::user()->last_name ?? '' }}
                        </h6>
                        <a class="dropdown-item" href="{{ url('organization-profile') }}">
                            <span class="dropdown-icon oi oi-person"></span>
                            {{ __('Profile') }}
                        </a>
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
            </div>
        </div>
    </div>
</header>
