@extends('layouts.admin')
@section('content')
	<div class="wrapper">
		<div class="page">
			<div class="page-inner">
				<header class="page-title-bar">
					<div class="d-flex flex-column flex-md-row">
						<p class="lead">
							<span class="font-weight-bold">Hi, {{ Auth::user()->first_name ?? '' }}.</span>
							<span class="d-block text-muted">Here’s what’s happening with your business today.</span>
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
											<h2 class="metric-label"> {{ __('Total Number of Students') }} </h2>
											<p class="metric-value h3">
												<sub><i class="oi oi-people"></i></sub>
												<span class="value">{{ $rows['total_number_of_user'] }}</span>
											</p>
										</a>
									</div>
									<div class="col">
										<a href="#" class="metric metric-bordered align-items-center">
											<h2 class="metric-label"> {{ __('Total Number of Booking') }} </h2>
											<p class="metric-value h3">
												<sub><i class="oi oi-fork"></i></sub>
												<span class="value">{{ $rows['total_number_of_booking'] }}</span>
											</p>
										</a>
									</div>
									<div class="col">
										<a href="#" class="metric metric-bordered align-items-center">
											<h2 class="metric-label"> {{ __('Total Number of Active Subscription') }} </h2>
											<p class="metric-value h3">
												<sub><i class="fa fa-tasks"></i></sub>
												<span class="value">{{ $rows['total_number_of_active_customers'] }}</span>
											</p>
										</a>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<a href="user-tasks.html" class="metric metric-bordered">
									<div class="metric-badge">
										<span class="badge badge-lg badge-success">
											<span class="oi oi-media-record pulse mr-1"></span> COMPLETED Class
										</span>
									</div>
									<p class="metric-value h3">
										<sub><i class="oi oi-timer"></i></sub>
										<span class="value">{{ $rows['total_number_of_completed_class'] }}</span>
									</p>
								</a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-lg-12 col-xl-7">
								<div class="card card-fluid">
										<div class="card-body">
												<h3 class="card-title mb-4"> {{ __('New Registration Students') }} </h3>
												<div class="chartjs" style="height: 292px">
														<canvas id="completion-tasks"></canvas>
												</div>
										</div>
								</div>
						</div>
						{{-- <div class="col-12 col-lg-6 col-xl-4">
								<div class="card card-fluid">
										<div class="card-body">
												<h3 class="card-title"> Teacher Performance </h3>
												<div class="text-center pt-3">
														<div class="chart-inline-group" style="height:214px">
																<div class="easypiechart" data-toggle="easypiechart" data-percent="60"
																		data-size="214" data-bar-color="#346CB0" data-track-color="false"
																		data-scale-color="false" data-rotate="225"></div>
																<div class="easypiechart" data-toggle="easypiechart" data-percent="50"
																		data-size="174" data-bar-color="#00A28A" data-track-color="false"
																		data-scale-color="false" data-rotate="225"></div>
																<div class="easypiechart" data-toggle="easypiechart" data-percent="75"
																		data-size="134" data-bar-color="#5F4B8B" data-track-color="false"
																		data-scale-color="false" data-rotate="225"></div>
														</div>
												</div>
										</div>
										<select name="" id="" disabled="disabled"></select>
										<div class="card-footer">
												<div class="card-footer-item">
														<i class="fa fa-fw fa-circle text-indigo"></i> 100% <div class="text-muted small">
																Assigned </div>
												</div>
												<div class="card-footer-item">
														<i class="fa fa-fw fa-circle text-purple"></i> 75% <div class="text-muted small">
																Completed </div>
												</div>
												<div class="card-footer-item">
														<i class="fa fa-fw fa-circle text-teal"></i> 60% <div class="text-muted small">
																Active </div>
												</div>
										</div>
								</div>
						</div> --}}
						<div class="col-12 col-lg-6 col-xl-5">
							<div class="card card-fluid">
								<div class="card-body pb-0">
									<h3 class="card-title"> Teacher Leaderboards </h3>
									<ul class="list-inline small">
										{{-- <li class="list-inline-item">
											<i class="fa fa-fw fa-circle text-light"></i> Teachers
										</li> --}}
										<li class="list-inline-item">
											<i class="fa fa-fw fa-circle text-purple"></i> Completed
										</li>
										<li class="list-inline-item">
											<i class="fa fa-fw fa-circle text-teal"></i> Cancel By Student
										</li>
										<li class="list-inline-item">
											<i class="fa fa-fw fa-circle text-red"></i> Cancel By Teacher
										</li>
									</ul>
								</div>
								<div class="list-group list-group-flush">
									@if(isset($rows['teacher_leaderboard']) && is_array($rows['teacher_leaderboard']))
										@foreach($rows['teacher_leaderboard'] as $row)
										<div class="list-group-item">
											<div class="list-group-item-figure">
												<a href="{{ route('teachers_edit', ['id' => $row['id']]) }}" class="user-avatar" data-tooltip="tooltip" title="{{ $row['name'] }}">
													<img src="{{ $row['avatar'] }}" alt="" />
												</a>
											</div>
											<div class="list-group-item-body">
												<div class="progress progress-animated bg-transparent rounded-0">
													@if(isset($row['booking_status_percent']) && is_array($row['booking_status_percent']))
														@foreach($row['booking_status_percent'] as $statusID => $status)
														<div class="progress-bar bg-{{ $rows['bookingStatusColor'][$statusID] }}" role="progressbar"
															aria-valuenow="{{ $status }}" aria-valuemin="0" aria-valuemax="100"
															style="width: {{ $status }}%">
															<span class="sr-only">{{ $status }}% Complete</span>
														</div>
														@endforeach
													@endif
												</div>
											</div>
										</div>
										@endforeach
									@endif
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="card-deck-xl">
							<div class="card card-fluid pb-3">
									<div class="card-header"> Active Projects </div>
									<div class="lits-group list-group-flush">
											<div class="list-group-item">
													<div class="list-group-item-figure">
															<div class="has-badge">
																	<a href="page-project.html" class="tile tile-md bg-purple">LT</a> <a
																			href="#team" class="user-avatar user-avatar-xs"><img
																					src="images/avatars/team4.jpg" alt=""></a>
															</div>
													</div>
													<div class="list-group-item-body">
															<h5 class="card-title">
																	<a href="page-project.html">Looper Admin Theme</a>
															</h5>
															<p class="card-subtitle text-muted mb-1"> Progress in 74% - Last update 1d </p>
															<div class="progress progress-xs bg-transparent">
																	<div class="progress-bar bg-purple" role="progressbar" aria-valuenow="2181"
																			aria-valuemin="0" aria-valuemax="100" style="width: 74%">
																			<span class="sr-only">74% Complete</span>
																	</div>
															</div>
													</div>
											</div>
											<div class="list-group-item">
													<div class="list-group-item-figure">
															<div class="has-badge">
																	<a href="page-project.html" class="tile tile-md bg-indigo">SP</a> <a
																			href="#team" class="user-avatar user-avatar-xs"><img
																					src="images/avatars/team1.jpg" alt=""></a>
															</div>
													</div>
													<div class="list-group-item-body">
															<h5 class="card-title">
																	<a href="page-project.html">Smart Paper</a>
															</h5>
															<p class="card-subtitle text-muted mb-1"> Progress in 22% - Last update 2h </p>
															<div class="progress progress-xs bg-transparent">
																	<div class="progress-bar bg-indigo" role="progressbar" aria-valuenow="867"
																			aria-valuemin="0" aria-valuemax="100" style="width: 22%">
																			<span class="sr-only">22% Complete</span>
																	</div>
															</div>
													</div>
											</div>
											<div class="list-group-item">
													<div class="list-group-item-figure">
															<div class="has-badge">
																	<a href="page-project.html" class="tile tile-md bg-yellow">OS</a> <a
																			href="#team" class="user-avatar user-avatar-xs"><img
																					src="images/avatars/team2.png" alt=""></a>
															</div>
													</div>
													<div class="list-group-item-body">
															<h5 class="card-title">
																	<a href="page-project.html">Online Store</a>
															</h5>
															<p class="card-subtitle text-muted mb-1"> Progress in 99% - Last update 2d </p>
															<div class="progress progress-xs bg-transparent">
																	<div class="progress-bar bg-yellow" role="progressbar" aria-valuenow="6683"
																			aria-valuemin="0" aria-valuemax="100" style="width: 99%">
																			<span class="sr-only">99% Complete</span>
																	</div>
															</div>
													</div>
											</div>
											<div class="list-group-item">
													<div class="list-group-item-figure">
															<div class="has-badge">
																	<a href="page-project.html" class="tile tile-md bg-blue">BA</a> <a href="#team"
																			class="user-avatar user-avatar-xs"><img src="images/avatars/bootstrap.svg"
																					alt=""></a>
															</div>
													</div>
													<div class="list-group-item-body">
															<h5 class="card-title">
																	<a href="page-project.html">Booking App</a>
															</h5>
															<p class="card-subtitle text-muted mb-1"> Progress in 35% - Last update 4h </p>
															<div class="progress progress-xs bg-transparent">
																	<div class="progress-bar bg-blue" role="progressbar" aria-valuenow="112"
																			aria-valuemin="0" aria-valuemax="100" style="width: 35%">
																			<span class="sr-only">35% Complete</span>
																	</div>
															</div>
													</div>
											</div>
											<div class="list-group-item">
													<div class="list-group-item-figure">
															<div class="has-badge">
																	<a href="page-project.html" class="tile tile-md bg-teal">SB</a> <a href="#team"
																			class="user-avatar user-avatar-xs"><img src="images/avatars/sketch.svg"
																					alt=""></a>
															</div>
													</div>
													<div class="list-group-item-body">
															<h5 class="card-title">
																	<a href="page-project.html">SVG Icon Bundle</a>
															</h5>
															<p class="card-subtitle text-muted mb-1"> Progress in 32% - Last update 1d </p>
															<div class="progress progress-xs bg-transparent">
																	<div class="progress-bar bg-teal" role="progressbar" aria-valuenow="461"
																			aria-valuemin="0" aria-valuemax="100" style="width: 32%">
																			<span class="sr-only">32% Complete</span>
																	</div>
															</div>
													</div>
											</div>
											<div class="list-group-item">
													<div class="list-group-item-figure">
															<div class="has-badge">
																	<a href="page-project.html" class="tile tile-md bg-pink">SP</a> <a href="#team"
																			class="user-avatar user-avatar-xs"><img src="images/avatars/team4.jpg"
																					alt=""></a>
															</div>
													</div>
													<div class="list-group-item-body">
															<h5 class="card-title">
																	<a href="page-project.html">Syrena Project</a>
															</h5>
															<p class="card-subtitle text-muted mb-1"> Progress in 93% - Last update 8h </p>
															<div class="progress progress-xs bg-transparent">
																	<div class="progress-bar bg-pink" role="progressbar" aria-valuenow="3981"
																			aria-valuemin="0" aria-valuemax="100" style="width: 93%">
																			<span class="sr-only">93% Complete</span>
																	</div>
															</div>
													</div>
											</div>
									</div>
							</div>
							<div class="card card-fluid">
									<div class="card-header"> Active Tasks: To-Dos </div>
									<div class="card-body">
											<div class="todo-list">
													<div class="todo-header"> Looper Admin Theme (1/3) </div><!-- /.todo-header -->
													<div class="todo">
															<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="todo1"> <label
																			class="custom-control-label" for="todo1">Eat corn on the cob</label>
															</div>
													</div>
													<div class="todo">
															<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="todo2" checked> <label
																			class="custom-control-label" for="todo2">Mix up a pitcher of sangria</label>
															</div>
													</div>
													<div class="todo">
															<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="todo3"> <label
																			class="custom-control-label" for="todo3">Have a barbecue</label>
															</div>
													</div>
													<div class="todo">
															<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="todo4"> <label
																			class="custom-control-label" for="todo4">Ride a roller coaster — <span
																					class="text-red small">Overdue in 3 days</span></label>
															</div>
													</div>
													<div class="todo-header"> Smart Paper (0/2) </div><!-- /.todo-header -->
													<div class="todo">
															<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="todo5"> <label
																			class="custom-control-label" for="todo5">Bring a blanket and lie on the
																			grass at an outdoor concert</label>
															</div>
													</div>
													<div class="todo">
															<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="todo6"> <label
																			class="custom-control-label" for="todo6">Collect seashells at the
																			beach</label>
															</div>
													</div>
													<div class="todo">
															<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="todo7"> <label
																			class="custom-control-label" for="todo7">Swim in a lake</label>
															</div>
													</div>
													<div class="todo">
															<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="todo8"> <label
																			class="custom-control-label" for="todo8">Get enough sleep!</label>
															</div>
													</div>
											</div>
									</div>
									<select name="" id="" disabled="disabled"></select>
									<div class="card-footer">
											<a href="#" class="card-footer-item">View all <i class="fa fa-fw fa-angle-right"></i></a>
									</div>
							</div>
					</div> --}}
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
		labels: {!! $rows['new_customer_registration']['date'] ?? '' !!},
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
