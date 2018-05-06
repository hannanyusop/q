<!doctype html>
<html lang="en">

<?php include_once ('include/logged-header.php'); ?>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<?= include('include/nav-bar.php'); ?>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
        <?= include('include/left-side-bar.php'); ?>
		<!-- END LEFT SIDEBAR -->

		<!-- MAIN CONTENT -->
		<div id="main-content">
			<div class="container-fluid">
				<h1 class="sr-only">Dashboard</h1>
				<!-- WEBSITE ANALYTICS -->
				<div class="dashboard-section">
					<div class="section-heading clearfix">
						<h2 class="section-title"><i class="fa fa-pie-chart"></i>Dahsboard</h2>
						<a href="statistik-keseluruhan.php" class="right">Lihat Statistik sepenuhanya</a>
					</div>
					<div class="panel-content">
						<div class="row">
							<div class="col-md-3 col-sm-6">
								<div class="number-chart">
									<div class="number">
                                        <span>
                                            <?php echo mysqli_num_rows(mysqli_query($db,"SELECT id FROM statistics WHERE DATE_FORMAT(datetime, '%Y-%m-%d') = '".date('Y-m-d')."' ")); ?>
                                        </span>
                                        <span>HARI INI</span>
                                    </div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="number-chart">
									<div class="number">
                                        <span>
                                            <span>
                                            <?php echo mysqli_num_rows(mysqli_query($db,"SELECT id FROM statistics WHERE DATE_FORMAT(datetime, '%Y-%m-%d') = '".strtotime('-1 day', strtotime(date('Y-m-d')))."' ")); ?>
                                        </span>
                                        </span>
                                        <span>SEMALAM</span>
                                    </div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="number-chart">
									<div class="number">
                                        <span>
                                        <?php echo mysqli_num_rows(mysqli_query($db,"SELECT id FROM statistics WHERE DATE_FORMAT(datetime, '%Y-%m') = '".date('Y-m')."' ")); ?>
                                        </span>
                                        <span>BULAN INI</span>
                                    </div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="number-chart">
									<div class="number">
                                        <span>
                                            <?php echo mysqli_num_rows(mysqli_query($db,"SELECT id FROM statistics")); ?>
                                        </span>
                                        <span>JUMLAH</span></div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<!-- TRAFFIC SOURCES -->
							<div class="panel-content">
								<h2 class="heading"><i class="fa fa-square"></i> Traffic Sources</h2>
								<div id="demo-pie-chart" class="ct-chart"></div>
							</div>
							<!-- END TRAFFIC SOURCES -->
						</div>
						<div class="col-md-4">
							<!-- REFERRALS -->
							<div class="panel-content">
								<h2 class="heading"><i class="fa fa-square"></i> Referrals</h2>
								<ul class="list-unstyled list-referrals">
									<li>
										<p><span class="value">3,454</span><span class="text-muted">visits from Facebook</span></p>
										<div class="progress progress-xs progress-transparent custom-color-blue">
											<div class="progress-bar" data-transitiongoal="87"></div>
										</div>
									</li>
									<li>
										<p><span class="value">2,102</span><span class="text-muted">visits from Twitter</span></p>
										<div class="progress progress-xs progress-transparent custom-color-purple">
											<div class="progress-bar" data-transitiongoal="34"></div>
										</div>
									</li>
									<li>
										<p><span class="value">2,874</span><span class="text-muted">visits from Affiliates</span></p>
										<div class="progress progress-xs progress-transparent custom-color-green">
											<div class="progress-bar" data-transitiongoal="67"></div>
										</div>
									</li>
									<li>
										<p><span class="value">2,623</span><span class="text-muted">visits from Search</span></p>
										<div class="progress progress-xs progress-transparent custom-color-yellow">
											<div class="progress-bar" data-transitiongoal="54"></div>
										</div>
									</li>
								</ul>
							</div>
							<!-- END REFERRALS -->
						</div>
						<div class="col-md-4">
							<div class="panel-content">
								<!-- BROWSERS -->
								<h2 class="heading"><i class="fa fa-square"></i> Browsers</h2>
								<div class="table-responsive">
									<table class="table no-margin">
										<thead>
											<tr>
												<th>Browsers</th>
												<th>Sessions</th>
												<th>% Sessions</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Chrome</td>
												<td>1,756</td>
												<td>23%</td>
											</tr>
											<tr>
												<td>Firefox</td>
												<td>1,379</td>
												<td>14%</td>
											</tr>
											<tr>
												<td>Safari</td>
												<td>1,100</td>
												<td>17%</td>
											</tr>
											<tr>
												<td>Edge</td>
												<td>982</td>
												<td>25%</td>
											</tr>
											<tr>
												<td>Opera</td>
												<td>967</td>
												<td>19%</td>
											</tr>
											<tr>
												<td>IE</td>
												<td>896</td>
												<td>12%</td>
											</tr>
											<tr>
												<td>Android Browser</td>
												<td>752</td>
												<td>27%</td>
											</tr>
										</tbody>
									</table>
								</div>
								<!-- END BROWSERS -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END MAIN CONTENT -->
		<div class="clearfix"></div>
		<?= include('include/footer.php'); ?>
	</div>
	<!-- END WRAPPER -->

	<!-- Javascript -->
	<script>
	$(function() {

		// sparkline charts
		var sparklineNumberChart = function() {

			var params = {
				width: '140px',
				height: '30px',
				lineWidth: '2',
				lineColor: '#20B2AA',
				fillColor: false,
				spotRadius: '2',
				spotColor: false,
				minSpotColor: false,
				maxSpotColor: false,
				disableInteraction: false
			};

			$('#number-chart1').sparkline('html', params);
			$('#number-chart2').sparkline('html', params);
			$('#number-chart3').sparkline('html', params);
			$('#number-chart4').sparkline('html', params);
		};

		sparklineNumberChart();


		// traffic sources
		var dataPie = {
			series: [45, 25, 30]
		};

		var labels = ['Direct', 'Organic', 'Referral'];
		var sum = function(a, b) {
			return a + b;
		};

		new Chartist.Pie('#demo-pie-chart', dataPie, {
			height: "270px",
			labelInterpolationFnc: function(value, idx) {
				var percentage = Math.round(value / dataPie.series.reduce(sum) * 100) + '%';
				return labels[idx] + ' (' + percentage + ')';
			}
		});


		// progress bars
		$('.progress .progress-bar').progressbar({
			display_text: 'none'
		});

		// line chart
		var data = {
			labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
			series: [
				[200, 380, 350, 480, 410, 450, 550],
			]
		};

		var options = {
			height: "200px",
			showPoint: true,
			showArea: true,
			axisX: {
				showGrid: false
			},
			lineSmooth: false,
			chartPadding: {
				top: 0,
				right: 0,
				bottom: 30,
				left: 30
			},
			plugins: [
				Chartist.plugins.tooltip({
					appendToBody: true
				}),
				Chartist.plugins.ctAxisTitle({
					axisX: {
						axisTitle: 'Day',
						axisClass: 'ct-axis-title',
						offset: {
							x: 0,
							y: 50
						},
						textAnchor: 'middle'
					},
					axisY: {
						axisTitle: 'Reach',
						axisClass: 'ct-axis-title',
						offset: {
							x: 0,
							y: -10
						},
					}
				})
			]
		};

		new Chartist.Line('#demo-line-chart', data, options);


		// sales performance chart
		var sparklineSalesPerformance = function() {

			var lastWeekData = [142, 164, 298, 384, 232, 269, 211];
			var currentWeekData = [352, 267, 373, 222, 533, 111, 60];

			$('#chart-sales-performance').sparkline(lastWeekData, {
				fillColor: 'rgba(90, 90, 90, 0.1)',
				lineColor: '#5A5A5A',
				width: '' + $('#chart-sales-performance').innerWidth() + '',
				height: '100px',
				lineWidth: '2',
				spotColor: false,
				minSpotColor: false,
				maxSpotColor: false,
				chartRangeMin: 0,
				chartRangeMax: 1000
			});

			$('#chart-sales-performance').sparkline(currentWeekData, {
				composite: true,
				fillColor: 'rgba(60, 137, 218, 0.1)',
				lineColor: '#3C89DA',
				lineWidth: '2',
				spotColor: false,
				minSpotColor: false,
				maxSpotColor: false,
				chartRangeMin: 0,
				chartRangeMax: 1000
			});
		}

		sparklineSalesPerformance();

		var sparkResize;
		$(window).on('resize', function() {
			clearTimeout(sparkResize);
			sparkResize = setTimeout(sparklineSalesPerformance, 200);
		});


		// top products
		var dataStackedBar = {
			labels: ['Q1', 'Q2', 'Q3'],
			series: [
				[800000, 1200000, 1400000],
				[200000, 400000, 500000],
				[100000, 200000, 400000]
			]
		};

		new Chartist.Bar('#chart-top-products', dataStackedBar, {
			height: "250px",
			stackBars: true,
			axisX: {
				showGrid: false
			},
			axisY: {
				labelInterpolationFnc: function(value) {
					return (value / 1000) + 'k';
				}
			},
			plugins: [
				Chartist.plugins.tooltip({
					appendToBody: true
				}),
				Chartist.plugins.legend({
					legendNames: ['Phone', 'Laptop', 'PC']
				})
			]
		}).on('draw', function(data) {
			if (data.type === 'bar') {
				data.element.attr({
					style: 'stroke-width: 30px'
				});
			}
		});


		// notification popup
		toastr.options.closeButton = true;
		toastr.options.positionClass = 'toast-bottom-right';
		toastr.options.showDuration = 1000;
		toastr['info']('Hello, welcome to DiffDash, a unique admin dashboard.');

	});
	</script>
</body>

</html>
