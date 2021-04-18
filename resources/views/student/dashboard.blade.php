@extends('layouts.app')
@section('content')
	<div class="wrapper">
		<div class="page">
			<div class="page-inner">
				<header class="page-title-bar">
					<div class="d-flex flex-column flex-md-row">
						<p class="lead">
							<span class="font-weight-bold">{{ __('Hi') }}, {{ Auth::user()->first_name ?? '' }}.</span> <span
								class="d-block text-muted">{{ __('Here’s what’s happening with your account today.') }}</span>
						</p>
					</div>
				</header>
				<div class="page-section">
					<div class="section-block">
						<div class="metric-row">
							<div class="col-lg-9">
								<div class="metric-row metric-flush">
									<div class="col">
										<a href="#" class="metric metric-bordered align-items-center">
											<h2 class="metric-label"> {{ __('Total Remaining Points') }} </h2>
											<p class="metric-value h3">
												<sub><i class="oi oi-fork"></i></sub> <span
													class="value">{{ $rows['total_remaining_points'] ?? '' }}</span>
											</p>
										</a>
									</div>
									<div class="col">
										<a href="#" class="metric metric-bordered align-items-center">
											<h2 class="metric-label"> {{ __('Total Class Taken') }} </h2>
											<p class="metric-value h3">
												<sub><i class="oi oi-fork"></i></sub> <span
													class="value">{{ $rows['total_remaining_points'] ?? '' }}</span>
											</p>
										</a>
									</div>
									<div class="col">
										<a href="#" class="metric metric-bordered align-items-center">
											<h2 class="metric-label"> {{ __('Current Subscription') }} </h2>
											<p class="metric-value h3" style="margin-bottom:5px;">
												<sub><i class="fa fa-tasks"></i></sub> <span
													class="value">{{ $rows['current_subscription'] ?? '' }}</span>
											</p>
											
											@if(isset($rows['has_upgrade_request']->id) && !empty($rows['has_upgrade_request']->id))
												<span class="small">{{ __('Pending Upgrade Request') }}</span>
											@else
												@if($rows['service_id'] == 1)
													<span class="btn btn-primary" data-toggle="modal" data-target="#planUpgradeModal">
														{{ __('Upgrade') }}
													</span>
												@endif
											@endif
										</a>
									</div>
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
	<script src="{{ secure_asset('vendor/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
	<script src="{{ secure_asset('vendor/chart.js/Chart.min.js') }}"></script>
	<script>
			let data = {
				labels: {!! $rows['new_customer_registration']['date'] !!},
				datasets: [{
					backgroundColor: Looper.getColors('brand').indigo,
					borderColor: Looper.getColors('brand').indigo,
					data: {!! $rows['new_customer_registration']['count'] ?? '' !!}
				}]
			};
			let canvas = $('#completion-tasks')[0].getContext('2d');
			let chart = new Chart(canvas, {
					type: 'bar',
					data: data,
					options: {
							responsive: true,
							legend: {
									display: false
							},
							title: {
									display: false
							},
							scales: {
									xAxes: [{
											gridLines: {
													display: true,
													drawBorder: false,
													drawOnChartArea: false
											},
											ticks: {
													maxRotation: 0,
													maxTicksLimit: 3
											}
									}],
									yAxes: [{
											gridLines: {
													display: true,
													drawBorder: false
											},
											ticks: {
													beginAtZero: true,
													stepSize: 100
											}
									}]
							}
					}
			});
	</script>
@endsection
