<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php $this->load->view('include/style-css.php') ?>
	<?php $this->load->view('include/style-js-fitur.php') ?>

	<!-- Bootstrap 4.3.1 CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.css">
	<!-- /Bootstrap 4.3.1 CSS -->
</head>
<style type="text/css">
	#graforder {
		background: #ffaf00;
		padding: 7%;
		font-size: 15pt;
	}

	#graforder:hover {
		background: none !important;
		border: 1px solid #ffaf00;
		color: black;
		transition: 0.3s;
		cursor: pointer;
	}

	#grafkredit {
		background: #e65251;
		width: 90%;
		padding: 7%;
	}

	#grafkredit:hover {
		background: none !important;
		border: 1px solid #e65251;
		color: black;
		transition: 0.3s;
		cursor: pointer;
	}

	#grafao {
		background: #6c757d;
		width: 70%;
		padding: 7%;
	}

	#grafao:hover {
		background: none !important;
		border: 1px solid #6c757d;
		color: black;
		transition: 0.3s;
		cursor: pointer;
	}

	#grafca {
		background: #8862e0;
		width: 50%;
		padding: 7%;
	}

	#grafca:hover {
		background: none !important;
		border: 1px solid #8862e0;
		color: black;
		transition: 0.3s;
		cursor: pointer;
	}

	#grafapproval {
		background: #00ce68;
		width: 30%;
		padding: 7%;
	}

	#grafapproval:hover {
		background: none !important;
		border: 1px solid #00ce68;
		color: black;
		transition: 0.3s;
		cursor: pointer;
	}

	[tooltip] {
		position: relative;
		/* opinion 1 */
	}

	/* Applies to all tooltips */
	[tooltip]::before,
	[tooltip]::after {
		text-transform: none;
		/* opinion 2 */
		font-size: .9em;
		/* opinion 3 */
		line-height: 1;
		user-select: none;
		pointer-events: none;
		position: absolute;
		display: none;
		opacity: 0;
	}

	[tooltip]::before {
		content: '';
		border: 5px solid transparent;
		/* opinion 4 */
		z-index: 1001;
		/* absurdity 1 */
	}

	[tooltip]::after {
		content: attr(tooltip);
		/* magic! */

		/* most of the rest of this is opinion */
		font-family: Helvetica, sans-serif;
		text-align: center;

		/* 
    Let the content set the size of the tooltips 
    but this will also keep them from being obnoxious
    */
		min-width: 3em;
		max-width: 21em;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
		padding: 1ch 1.5ch;
		border-radius: .3ch;
		box-shadow: 0 1em 2em -.5em rgba(0, 0, 0, 0.35);
		background: #333;
		color: #fff;
		z-index: 1000;
		/* absurdity 2 */
	}

	/* Make the tooltips respond to hover */
	[tooltip]:hover::before,
	[tooltip]:hover::after {
		display: block;
	}

	/* don't show empty tooltips */
	[tooltip='']::before,
	[tooltip='']::after {
		display: none !important;
	}

	/* FLOW: UP */
	[tooltip]:not([flow])::before,
	[tooltip][flow^="up"]::before {
		bottom: 100%;
		border-bottom-width: 0;
		border-top-color: #333;
	}

	[tooltip]:not([flow])::after,
	[tooltip][flow^="up"]::after {
		bottom: calc(100% + 5px);
	}

	[tooltip]:not([flow])::before,
	[tooltip]:not([flow])::after,
	[tooltip][flow^="up"]::before,
	[tooltip][flow^="up"]::after {
		left: 50%;
		transform: translate(-50%, -.5em);
	}

	/* FLOW: DOWN */
	[tooltip][flow^="down"]::before {
		top: 100%;
		border-top-width: 0;
		border-bottom-color: #333;
	}

	[tooltip][flow^="down"]::after {
		top: calc(100% + 5px);
	}

	[tooltip][flow^="down"]::before,
	[tooltip][flow^="down"]::after {
		left: 50%;
		transform: translate(-50%, .5em);
	}

	/* FLOW: LEFT */
	[tooltip][flow^="left"]::before {
		top: 50%;
		border-right-width: 0;
		border-left-color: #333;
		left: calc(0em - 5px);
		transform: translate(-.5em, -50%);
	}

	[tooltip][flow^="left"]::after {
		top: 50%;
		right: calc(100% + 5px);
		transform: translate(-.5em, -50%);
	}

	/* FLOW: RIGHT */
	[tooltip][flow^="right"]::before {
		top: 50%;
		border-left-width: 0;
		border-right-color: #333;
		right: calc(0em - 5px);
		transform: translate(.5em, -50%);
	}

	[tooltip][flow^="right"]::after {
		top: 50%;
		left: calc(100% + 5px);
		transform: translate(.5em, -50%);
	}

	/* KEYFRAMES */
	@keyframes tooltips-vert {
		to {
			opacity: .9;
			transform: translate(-50%, 0);
		}
	}

	@keyframes tooltips-horz {
		to {
			opacity: .9;
			transform: translate(0, -50%);
		}
	}

	/* FX All The Things */
	[tooltip]:not([flow]):hover::before,
	[tooltip]:not([flow]):hover::after,
	[tooltip][flow^="up"]:hover::before,
	[tooltip][flow^="up"]:hover::after,
	[tooltip][flow^="down"]:hover::before,
	[tooltip][flow^="down"]:hover::after {
		animation: tooltips-vert 300ms ease-out forwards;
	}

	[tooltip][flow^="left"]:hover::before,
	[tooltip][flow^="left"]:hover::after,
	[tooltip][flow^="right"]:hover::before,
	[tooltip][flow^="right"]:hover::after {
		animation: tooltips-horz 300ms ease-out forwards;
	}

	.myChart {
		height: 100%;
		width: 100%;
	}

	.col-centered {
		float: none;
		/* reset the text-align */
		text-align: left;
		/* inline-block space fix */
		margin-right: -4px;
		text-align: center;
	}
</style>

<body>
	<script type='text/javascript'>
		function loadCSS(e, t, n) {
			"use strict";
			var i = window.document.createElement("link");
			var o = t || window.document.getElementsByTagName("script")[0];
			i.rel = "stylesheet";
			i.href = e;
			i.media = "only x";
			o.parentNode.insertBefore(i, o);
			setTimeout(function() {
				i.media = n || "all"
			})
		}
		loadCSS("https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css");
	</script>
	<div class="container-scroller">
		<!-- partial:partials/_navbar.html -->
		<?php $this->load->view('include/navbarfitur.php') ?>
		<!-- partial -->
		<div class=" page-body-wrapper">
			<!-- partial:partials/_sidebar.html -->
			<?php $this->load->view('include/sidebar.php') ?>
			<!-- partial -->
			<div class="main-panel" style="width: 100%;">
				<div id="myProgress" style="position:fixed;z-index:5;">
					<div id="myBar"></div>
				</div>
				<div class="content-wrapper">
					<input type="hidden" id="tamplate" value="">

					<input type="hidden" id="paramsID1" value="">
					<input type="hidden" id="paramsID2" value="">
					<input type="hidden" id="paramsID3" value="">
					<input type="hidden" id="session_kantor" value="<?php echo $this->session->userdata('kantor'); ?>">
					<input type="hidden" id="session_jabatan" value="<?php echo $this->session->userdata('jabatan'); ?>">
					<input type="hidden" id="session_id_user" value="<?php echo $this->session->userdata('id'); ?>">
					<input type="hidden" id="NowDate" value="<?php echo date('Y-m-d'); ?>">
					<input type="hidden" id="load_page" value="false">
					<div class="clearfix mt-5">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-4 text-lg-left text-md-center text-sm-center text-center">
									<p>
										Nama User | AO
									</p>
								</div>
								<div class="col-md-4 text-lg-center text-md-center text-sm-center text-center">
									<p>
										Filter Data :
										<select name="bulan" id="bulan">
											<option value="" selected disabled>Pilih Bulan</option>
											<option value="">Bulan 1</option>
											<option value="">Bulan 2</option>
											<option value="">Bulan 3</option>
											<option value="">Bulan 4</option>
										</select>
										<select name="tahun" id="tahun">
											<option value="" selected disabled>Pilih Tahun</option>
											<option value="">Tahun 1</option>
											<option value="">Tahun 2</option>
											<option value="">Tahun 3</option>
											<option value="">Tahun 4</option>
										</select>
										<button class="btn-primary">Filter</button>
									</p>
								</div>
								<div class="col-md-4 text-lg-right text-md-center text-sm-center text-center">
									<p>Kantor : Pusat</p>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="row justify-content-center">
						<!-- Lending -->
						<span class="rounded-circle" data-popover="popover" data-content='<center><b>Lending : 30% <br> Status : Tidak Tercapai</b></center>' data-html='true' data-placement='top' data-trigger='hover'>
							<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_lending">
								<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="lending" 
								data-type="radial-gauge" 
								data-width="300" 
								data-height="300" 
								data-units="JT" 
								data-title="Lending" 
								data-value="100" 
								data-min-value="0"
								data-max-value="100" 
								data-major-ticks="0,10,20,30,40,50,60,70,80,90,100" 
								data-minor-ticks="5" 
								data-stroke-ticks="true" 
								data-highlights='[
													{ "from": 0, "to": 25, "color": "#ef4b4b" },
													{ "from": 25, "to": 50, "color": "yellow" },
													{ "from": 50, "to": 75, "color": "green" },
													{ "from": 75, "to": 100, "color": "#0066d6" }
												]' 
								data-color-plate="#010101" 
								data-color-major-ticks="#000000" 
								data-color-minor-ticks="#000000" 
								data-color-title="#fff" 
								data-color-units="#ccc"
								data-color-numbers="#eee"
								data-color-needle="rgba(240, 128, 128, 1)" 
								data-color-needle-end="rgba(255, 160, 122, .9)"
								data-value-box="true" 
								data-animate-on-init="true" 
								data-animation-rule="bounce" 
								data-animation-duration="1500">
								</canvas>
							</a>
						</span>
						<!-- /Lending -->

						<!-- Map -->
						<span class="rounded-circle" data-popover="popover" data-content='<center><b>Map : 1% <br> Status : Tidak Tercapai</b></center>' data-html='true' data-placement='top' data-trigger='hover'>
							<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_map">
								<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="map" data-type="radial-gauge" data-width="300" data-height="300" data-units="%" data-title="Map" data-value="1" data-min-value="0" data-max-value="100" data-major-ticks="0,10,20,30,40,50,60,70,80,90,100" data-minor-ticks="5" data-stroke-ticks="true" data-highlights='[
													{ "from": 0, "to": 25, "color": "#ef4b4b" },
													{ "from": 25, "to": 50, "color": "yellow" },
													{ "from": 50, "to": 75, "color": "green" },
													{ "from": 75, "to": 100, "color": "#0066d6" }
												]' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="linear" data-aimation-duration="500">
								</canvas>
							</a>
						</span>
						<!-- /Map -->

						<!-- Bucket Zero -->
						<span class="rounded-circle" data-popover="popover" data-content='<center><b>Map : 50% <br> Status : Cukup Tercapai</b></center>' data-html='true' data-placement='top' data-trigger='hover'>
							<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_bz">
								<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="bz" data-type="radial-gauge" data-width="300" data-height="300" data-units="%" data-title="BZ" data-value="50" data-min-value="0" data-max-value="100" data-major-ticks="0,10,20,30,40,50,60,70,80,90,100" data-minor-ticks="5" data-stroke-ticks="true" data-highlights='[
													{ "from": 0, "to": 25, "color": "#ef4b4b" },
													{ "from": 25, "to": 50, "color": "yellow" },
													{ "from": 50, "to": 75, "color": "green" },
													{ "from": 75, "to": 100, "color": "#0066d6" }
												]' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="linear" data-aimation-duration="500">
								</canvas>
							</a>
						</span>
						<!-- /Bucket Zero -->

						<!-- MB -->
						<span class="rounded-circle" data-popover="popover" data-content='<center><b>Map : 70% <br> Status : Cukup Tercapai</b></center>' data-html='true' data-placement='top' data-trigger='hover'>
							<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_mb">
								<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="mb" data-type="radial-gauge" data-width="300" data-height="300" data-units="%" data-title="MB" data-value="70" data-min-value="0" data-max-value="100" data-major-ticks="0,10,20,30,40,50,60,70,80,90,100" data-minor-ticks="5" data-stroke-ticks="true" data-highlights='[
													{ "from": 0, "to": 25, "color": "#ef4b4b" },
													{ "from": 25, "to": 50, "color": "yellow" },
													{ "from": 50, "to": 75, "color": "green" },
													{ "from": 75, "to": 100, "color": "#0066d6" }
												]' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="linear" data-aimation-duration="500">
								</canvas>
							</a>
						</span>
						<!-- /MB -->
					</div>

					<!-- Modal map -->
					<div class="modal fade" id="modal_map" tabindex="2" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-xl modal-dialog-scrollable">
							<div class="modal-content">
								<div class="modal-header bg-light">
									<h5 class="modal-title" id="exampleModalLongTitle">Detail Map</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">

								</div>
								<div class="modal-footer bg-light">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /Modal map -->

					<!-- Modal Bucket Zero -->
					<div class="modal fade" id="modal_bz" tabindex="4" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-xl modal-dialog-scrollable">
							<div class="modal-content">
								<div class="modal-header bg-light">
									<h5 class="modal-title" id="exampleModalLongTitle">Detail Bucket Zero</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">

								</div>
								<div class="modal-footer bg-light">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /Modal Bucket Zero -->

					<!-- Modal Mitra Bisnis -->
					<div class="modal fade" id="modal_mb" tabindex="3" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-xl modal-dialog-scrollable">
							<div class="modal-content">
								<div class="modal-header bg-light">
									<h5 class="modal-title" id="exampleModalLongTitle">Detail Mitra Bisnis</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">

								</div>
								<div class="modal-footer bg-light">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /Modal Mitra Bisnis -->

					<!-- Modal Detail Lending -->
					<div class="modal fade" id="modal_lending" tabindex="5" role="dialog" aria-labelledby="" aria-hidden="true">
						<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
							<div class="modal-content">
								<div class="modal-header bg-light">
									<h5 class="modal-title" id="exampleModalLongTitle">Detail Lending</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<table class="table table-bordered table-hover">
										<thead class="bg-light">
											<tr>
												<th>First</th>
												<th>Last</th>
												<th>Handle</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Mark</td>
												<td>Otto</td>
												<td>@mdo</td>
												<td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detail_nasabah" data-backdrop="false">Detail</button></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="modal-footer bg-light">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<!-- Modal Detail Lending -->

					<!-- Modal Detail Nasabah -->
					<div class="modal fade" id="detail_nasabah" tabindex="5" role="dialog" aria-labelledby="" aria-hidden="true">
						<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
							<div class="modal-content">
								<div class="modal-header bg-light">
									<h5 class="modal-title" id="exampleModalLongTitle">Detail Data Nasabah</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">

								</div>
								<div class="modal-footer bg-light">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /Modal Detail Nasabah -->
				</div>
				<!-- content-wrapper ends -->
				<!-- partial:partials/_footer.html -->
				<footer class="footer">
					<div class="container-fluid clearfix">
						<span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
							<a href="https://dpmsejahtera.com" target="_blank">Koperasi dana pinjaman mandiri sejahtera</a>. All rights reserved.</span>
						<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">KDPMS BISNIS V.1.0.6
						</span>
					</div>
				</footer>
				<script type="text/javascript" src="lib/js/formatRupiah.js"></script>
				<script type="text/javascript" src="lib/js/changedate.js"></script>
				<script type="text/javascript" src="lib/js/url.js"></script>

				<!-- Highcharts CDN -->
				<!-- <script src="https://code.highcharts.com/highcharts.js"></script>
				<script src="https://code.highcharts.com/highcharts-more.js"></script> -->

				<!-- Canvas Gauge CDN -->
				<script src="//cdn.rawgit.com/Mikhus/canvas-gauges/gh-pages/download/2.1.5/all/gauge.min.js"></script>

				<!-- Bootstrap 4.3.1 JS -->
				<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
				<!-- /Bootstrap 4.3.1 JS -->

				<!-- Gauge HighCharts -->
				<!-- <script>
					function chart(id, value, target) {
						return Highcharts.chart(id, {
								chart: {
									type: 'gauge',
									plotBackgroundColor: null,
									plotBackgroundImage: null,
									plotBorderWidth: 0,
									plotShadow: false
								},

								title: {
									text: ''
								},
								credits: {
									enabled: false
								},
								exporting: {
									enabled: false
								},
								pane: {
									startAngle: -140,
									endAngle: 140,
									background: [{
										backgroundColor: {
											linearGradient: {
												x1: 0,
												y1: 0,
												x2: 0,
												y2: 1
											},
											stops: [
												[0, '#FFF'],
												[1, '#333']
											]
										},
										borderWidth: 0,
										outerRadius: '100%'
									}, {
										backgroundColor: {
											linearGradient: {
												x1: 0,
												y1: 0,
												x2: 0,
												y2: 1
											},
											stops: [
												[0, '#333'],
												[1, '#FFF']
											]
										},
										borderWidth: 1,
										outerRadius: '107%'
									}, {
										// default background
									}, {
										backgroundColor: '#DDD',
										borderWidth: 0,
										outerRadius: '105%',
										innerRadius: '103%'
									}]
								},

								// the value axis
								yAxis: {
									min: 0,
									max: target,

									minorTickInterval: 'auto',
									minorTickWidth: 1,
									minorTickLength: 5,
									minorTickPosition: 'inside',
									minorTickColor: '#666',

									tickPixelInterval: 30,
									tickWidth: 2,
									tickPosition: 'inside',
									tickLength: 10,
									tickColor: '#666',
									labels: {
										step: 2,
										rotation: 'auto'
									},
									title: {
										text: '%'
									},
									plotBands: [{
										from: 0,
										to: 30,
										color: '#DF5353' // green
									}, {
										from: 30,
										to: 50,
										color: '#DDDF0D' // yellow
									}, {
										from: 50,
										to: 70,
										color: '#55BF3B' // red
									}, {
										from: 70,
										to: 100,
										color: '#3e64ff' // red
									}, {
										from: 100,
										to: 9999,
										color: '#3e64ff' // red
									}]
								},

								plotOptions: {
									gauge: {
										dial: {
											radius: '95%',
											backgroundColor: 'black',
											borderColor: 'black',
											borderWidth: 1,
											baseWidth: 3,
											topWidth: 0,
											baseLength: '0%', // of radius
											rearLength: '10%'
										}
									}
								},

								series: [{
									name: '',
									data: [value],
									tooltip: {
										valueSuffix: ' %'
									}
								}]

							},
							// Add some life
							function(chart) {
								if (!chart.renderer.forExport) {
									setInterval(function() {
										var point = chart.series[0].points[0],
											newVal,
											inc = Math.round((Math.random() - 0.5) * 20);

										newVal = point.y + inc;
										if (newVal < 0 || newVal > 100) {
											newVal = point.y - inc;
										}

										point.update(newVal);

									}, 3000);
								}
							});
					}

					new chart('lending', 20, 100);
					new chart('map', 50, 100);
					new chart('collection_ratio', 60, 100);
					new chart('bucket_zero', 40, 100);

					new chart('ao1', 40, 100);
					new chart('ao2', 40, 100);
					new chart('ao3', 40, 100);
					new chart('ao4', 40, 100);
				</script> -->

				<!-- Popover -->
				<script>
					detectmob();

					function detectmob() {
						if (window.innerWidth <= 800 && window.innerHeight <= 600) {
							$('[data-popover="popover"]').popover("hide");
						} else {
							$('[data-popover="popover"]').popover();
						}
					}
				</script>

				<!-- Gauge JS Version -->
				<!-- <script>
					function hchart(id, value, target, title) {
						return new RadialGauge({
							renderTo: document.getElementById(id),
							units: '%',
							title: title,
							value: value,
							minValue: 0,
							maxValue: target,
							majorTicks: [
								'0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100'
							],
							minorTicks: 5,
							strokeTicks: false,
							highlights: [{
									from: 0,
									to: target / 4,
									color: '#ef4b4b'
								},
								{
									from: target / 4,
									to: target / 3,
									color: 'yellow'
								},
								{
									from: target / 3,
									to: target / 2,
									color: 'green'
								},
								{
									from: target / 2,
									to: target / 1,
									color: '#0066d6'
								}
							],
							colorPlate: '#222',
							colorMajorTicks: '#000000',
							colorMinorTicks: '#000000',
							colorTitle: '#fff',
							colorUnits: '#ccc',
							colorNumbers: '#eee',
							colorNeedle: 'rgba(240, 128, 128, 1)',
							colorNeedleEnd: 'rgba(255, 160, 122, .9)',
							valueBox: true,
							animateOnInit: true,
							animationRule: 'linear',
							animationDuration: 500
						});
					}

					var lending = hchart('lending', 30, 100, 'Lending').draw();
					var map = hchart('map', 50, 100, 'map').draw();
					var cr = hchart('cr', 70, 100, 'Collection Ratio').draw();
					var bz = hchart('bz', 80, 100, 'Bucket Zero').draw();

					var ao1 = hchart('radial-one', 80, 100, 'AO 1').draw();
					var ao2 = hchart('ao2', 80, 100, 'AO 2').draw();
					var ao3 = hchart('ao3', 80, 100, 'AO 3').draw();
					var ao4 = hchart('ao4', 80, 100, 'AO 4').draw();
				</script> -->

				<!-- partial -->
			</div>
			<!-- main-panel ends -->
		</div>
		<!-- page-body-wrapper ends -->
	</div>
	<!-- container-scroller -->
</body>

</html>
