@extends('layouts.teacher')
@section('content')
	<div class="wrapper">
		<div class="page">
			<div class="page-inner">
				<header class="page-title-bar">
						<div class="d-flex flex-column flex-md-row">
								<p class="lead">
										<span class="font-weight-bold">Hi, {{ Auth::user()->first_name ?? '' }}.</span> <span
												class="d-block text-muted">Here’s what’s happening with your account today.</span>
								</p>
						</div>
				</header>
				<div class="page-section">
						<div class="section-block">
								<div class="metric-row">
										<div class="col-lg-9">
												<div class="metric-row metric-flush">
														<div class="col">
																<a class="metric metric-bordered align-items-center">
																		<h2 class="metric-label"> {{ __('Total Class of the Month') }} </h2>
																		<p class="metric-value h3">
																				<sub><i class="oi oi-fork"></i></sub> <span
																						class="value">{{ $rows['total_class_of_the_month'] ?? '' }}</span>
																		</p>
																</a>
														</div>
														<div class="col">
																<a class="metric metric-bordered align-items-center">
																		<h2 class="metric-label"> {{ __('Total Class') }} </h2>
																		<p class="metric-value h3">
																				<sub><i class="oi oi-fork"></i></sub> <span
																						class="value">{{ $rows['total_class'] ?? '' }}</span>
																		</p>
																</a>
														</div>
														{{-- <div class="col">
																<a href="user-tasks.html" class="metric metric-bordered align-items-center">
																		<h2 class="metric-label"> {{ __('Current Subscription') }} </h2>
																		<p class="metric-value h3">
																				<sub><i class="fa fa-tasks"></i></sub> <span
																						class="value">{{ $rows['total_number_of_active_customers'] ?? '' }}</span>
																		</p>
																</a>
														</div> --}}
												</div>
										</div>
										{{-- <div class="col-lg-3">
												<a href="user-tasks.html" class="metric metric-bordered">
														<div class="metric-badge">
																<span class="badge badge-lg badge-success"><span
																				class="oi oi-media-record pulse mr-1"></span> ONGOING Class</span>
														</div>
														<p class="metric-value h3">
																<sub><i class="oi oi-timer"></i></sub> <span class="value">8</span>
														</p>
												</a>
										</div> --}}
								</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="app-footer">
		<div class="copyright">2021 ©  copyright DIVERSITY EIKAIWA</div>
	</footer>
@endsection
