@extends('layouts.app')
@section('content')
	<div class="wrapper">
			<div class="page">
					<div class="page-inner">
							<header class="page-title-bar">
									<div class="d-flex flex-column flex-md-row">
											<p class="lead">
													<span class="font-weight-bold">Hi, {{ Auth::user()->first_name ?? '' }}.</span> <span
															class="d-block text-muted">Here’s what’s happening with your business today.</span>
											</p>
									</div>
							</header>
							<div class="page-section">
									<div class="section-block">
										<div class="metric-row">
											<div class="col-lg-9">
												<div class="metric-row metric-flush">
													<div class="col">
														<a href="client" class="metric metric-bordered align-items-center">
															<h2 class="metric-label"> {{ __('No. of Clients') }} </h2>
															<p class="metric-value h3">
																<sub><i class="oi oi-people"></i></sub> <span class="value">{{ $rows['total_number_of_clients'] }}</span>
															</p>
														</a>
													</div>
													<div class="col metric metric-bordered align-items-center">
															<h2 class="metric-label"> Projects </h2>
															<p class="metric-value h3">
																<sub><i class="oi oi-fork"></i></sub> <span class="value">0</span>
															</p>
													</div>
													<div class="col metric metric-bordered align-items-center">
															<h2 class="metric-label"> {{ __('Unread Message') }} </h2>
															<p class="metric-value h3">
																<sub><i class="fa fa-tasks"></i></sub> <span class="value">{{ $rows['total_number_of_unread_message'] }}</span>
															</p>
													</div>
												</div>
											</div>
											<div class="col-lg-3 metric metric-bordered">
													<div class="metric-badge">
														<span class="badge badge-lg badge-success">
															<span class="oi oi-media-record pulse mr-1"></span>
															ONGOING TASKS
														</span>
													</div>
													<p class="metric-value h3">
														<sub><i class="oi oi-timer"></i></sub> <span class="value">8</span>
													</p>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12 col-lg-12 col-xl-4">
											<div class="card card-fluid">
												<div class="card-body">
													<h3 class="card-title mb-4"> Completion Tasks </h3>
													<div class="chartjs" style="height: 292px">
														<canvas id="completion-tasks"></canvas>
													</div>
												</div>
											</div>
										</div>
										<div class="col-12 col-lg-6 col-xl-4">
												<div class="card card-fluid">
														<div class="card-body">
																<h3 class="card-title"> Tasks Performance </h3>
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
										</div>
										<div class="col-12 col-lg-6 col-xl-4">
											<div class="card card-fluid">
													<div class="card-body pb-0">
														<h3 class="card-title"> {{ __('Overdue Task List') }} </h3><!-- legend -->
														<ul class="list-inline small">
															<li class="list-inline-item">
																<i class="fa fa-fw fa-circle text-light"></i> Tasks </li>
															<li class="list-inline-item">
																<i class="fa fa-fw fa-circle text-purple"></i> Completed </li>
															<li class="list-inline-item">
																<i class="fa fa-fw fa-circle text-teal"></i> Active </li>
															<li class="list-inline-item">
																<i class="fa fa-fw fa-circle text-red"></i> Overdue </li>
														</ul>
													</div>
													<div class="list-group list-group-flush">
														<div class="list-group-item">
															<div class="list-group-item-figure">
																<a class="user-avatar" data-tooltip="tooltip"
																	title="Martha Myers"><img src="images/avatars/uifaces16.jpg" alt=""></a>
															</div>
															<div class="list-group-item-body">
																	<div class="progress progress-animated bg-transparent rounded-0"
																			data-tooltip="tooltip" data-html="true"
																			title='&lt;div class="text-left small"&gt;&lt;i class="fa fa-fw fa-circle text-purple"&gt;&lt;/i&gt; 2065&lt;br&gt;&lt;i class="fa fa-fw fa-circle text-teal"&gt;&lt;/i&gt; 231&lt;br&gt;&lt;i class="fa fa-fw fa-circle text-red"&gt;&lt;/i&gt; 54&lt;/div&gt;'>
																			<div class="progress-bar bg-purple" role="progressbar"
																					aria-valuenow="73.46140163642832" aria-valuemin="0" aria-valuemax="100"
																					style="width: 73.46140163642832%">
																					<span class="sr-only">73.46140163642832% Complete</span>
																			</div>
																			<div class="progress-bar bg-teal" role="progressbar"
																					aria-valuenow="8.217716115261473" aria-valuemin="0" aria-valuemax="100"
																					style="width: 8.217716115261473%">
																					<span class="sr-only">8.217716115261473% Complete</span>
																			</div>
																			<div class="progress-bar bg-red" role="progressbar"
																					aria-valuenow="1.92102454642476" aria-valuemin="0" aria-valuemax="100"
																					style="width: 1.92102454642476%">
																					<span class="sr-only">1.92102454642476% Complete</span>
																			</div>
																	</div>
															</div>
														</div>
													</div>
											</div>
										</div>
									</div>
							</div>
					</div>
			</div>
	</div>
	<footer class="app-footer">
		<div class="copyright">2020 © copyright MOSAIQUE PVT LTD</div>
	</footer>
	<script src="{{ secure_asset('vendor/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
	<script src="{{ secure_asset('vendor/chart.js/Chart.min.js') }}"></script>
	<script>
					let data = {
					labels: ['21 Mar', '22 Mar', '23 Mar', '24 Mar', '25 Mar', '26 Mar', '27 Mar'],
					datasets: [{
						backgroundColor: Looper.getColors('brand').indigo,
						borderColor: Looper.getColors('brand').indigo,
						data: [155, 65, 465, 265, 225, 325, 80]
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