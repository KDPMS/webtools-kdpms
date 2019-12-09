<!DOCTYPE html>
<html lang="en">

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<?php $this->load->view('include/style-css.php') ?>
		<?php $this->load->view('include/style-js-fitur.php') ?>
		<!-- Bootstrap 4.3.1 CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/sc-2.0.1/datatables.min.css"/>		<!-- /Bootstrap 4.3.1 CSS -->
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

		table.dataTable.table-striped.DTFC_Cloned tbody tr:nth-of-type(odd) {
			background-color: #F3F3F3;
		}

		table.dataTable.table-striped.DTFC_Cloned tbody tr:nth-of-type(even) {
			background-color: white;
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
		<!-- Canvas Gauge CDN -->
		<script src="//cdn.rawgit.com/Mikhus/canvas-gauges/gh-pages/download/2.1.5/all/gauge.min.js"></script>
		<div class="container-scroller">
			<!-- partial:partials/_navbar.html -->
			<?php $this->load->view('include/navbarkpi.php') ?>
			<!-- partial -->
			<div class=" page-body-wrapper">
				<div class="main-panel" style="width: 100%;">
					<div class="content-wrapper">
						<input type="hidden" id="tamplate" value="">
						<input type="hidden" id="session_kantor" value="<?php echo $this->session->userdata('kantor'); ?>">
						<input type="hidden" id="session_jabatan" value="<?php echo $this->session->userdata('jabatan'); ?>">
						<input type="hidden" id="session_id_user" value="<?php echo $this->session->userdata('id'); ?>">
						<input type="hidden" id="NowDate" value="<?php echo date('Y-m-d'); ?>">
						<input type="hidden" id="load_page" value="false">
						
						<div class="mt-4">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3 text-lg-left text-md-center text-sm-center text-center">
										Bulan : <b><?php echo ubahBulan($bulan); ?></b><br>
										Tahun : <b><?php echo $tahun; ?></b><br>
										Pilihan Kantor :
										<b>
											<?php echo namaKantor($kantor); ?>
										</b>
									</div>
									<div class="col-md-6 text-lg-center text-md-center text-sm-center text-center">
										<br><br>
										<form action="<?php echo site_url('kpi/dashboard_kpi'); ?>" method="post">
											Filter Data :
											<select name="bulan" id="bulan">
												<?php 
													for ($i=1; $i<=12; $i++ ){
														if ($i < 10){
															$i = '0'.$i;
														}
												?>
												<option value="<?php echo $i; ?>" <?php if($bulan == $i){ echo('selected'); } ?>> <?php echo ubahBulan($i); ?></option>
												<?php } ?>
											</select>
											<select name="tahun" id="tahun">
												<?php 
													for ($thn = 2019; $thn <= date('Y'); $thn++){
												?>
												<option value="<?= $thn; ?>" <?php if($tahun == $thn){ echo('selected'); } ?>><?= $thn; ?></option>
												<?php } ?>
											</select>
											
											<select name="kantor" id="kantor">
												<option value="01" <?php if($kantor == '01'){ echo('selected'); } ?>>Pusat</option>
												<option value="02" <?php if($kantor == '02'){ echo('selected'); } ?>>Cabang Cilodong</option>
											</select>
											<button type="submit"class="btn-primary">Filter</button>
										</form>
									</div>
									<div class="col-md-3 text-lg-right text-md-center text-sm-center text-center">
										<br>
										User :
										<b><?php echo $this->session->userdata('username'); ?></b><br>
										Kantor : 
										<b><?php echo namaKantor($this->session->userdata('kantor')); ?></b>
									</div>
								</div>
							</div>
						</div>
						<hr>
						
						<!-- loading -->
						<center>
							<div id="loader" style="position: absolute; left: 50%;">
								<div class="text-center" style="position: relative; left: -50%; z-index:1000;">
									<div class="spinner-border text-facebook" role="status" style="width: 2rem; height: 2rem;">
										<span class="sr-only">Loading...</span>
									</div><br>
									<b>LOADING...</b>
								</div>
							</div>
						</center>
						<!-- end loading -->

						<!-- handle data jika null -->
						<span class="spedo">
							<div class="col-md-12">
								<div class="row justify-content-center">
									<div id="lendingNull">
		
									</div>&nbsp;
									<div id="nplNull">

									</div>&nbsp;
									<div id="crNull">

									</div>&nbsp;
									<div id="bzNull">

									</div>&nbsp;
								</div>
							</div>
						</span>
						<!-- end handle data jika null -->
	
						<div class="row justify-content-center">
						<?php if($dataKpiLending || $dataKpiNpl || $dataKpiCR || $dataKpiBZ){ ?>
							
							<!-- Lending -->
							<?php if($dataKpiLending != null){ ?>
							<span class="rounded-circle spedo" data-popover="popover"
								data-content='<b> Lending : <?= ubahJuta($dataKpiLending[0]->jml_value); ?> <br> Lending : <?= ambil2Angka($dataKpiLending[0]->lending) .' %'; ?> <br> Status : Bagus </b>'
								data-html='true' data-placement='top' data-trigger='hover'>
								<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_lending">
									<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="lending" data-type="radial-gauge" data-width="300"
										data-height="300" data-units="<?php echo $dataKpiLending[0]->unit; ?>" data-title="<?= $dataKpiLending[0]->title; ?>"
										data-value="<?php echo $dataKpiLending[0]->jml_value; ?>" data-min-value="0"
										data-max-value="<?php echo $dataKpiLending[0]->jml_max_value; ?>"
										data-major-ticks="<?php echo $dataKpiLending[0]->mayor_ticks; ?>"
										data-minor-ticks="<?php echo $dataKpiLending[0]->minor_ticks; ?>" data-stroke-ticks="true"
										data-highlights='<?php echo $dataKpiLending[0]->data_spedo; ?>' data-color-plate="#010101"
										data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff"
										data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)"
										data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true"
										data-animation-rule="bounce" data-animation-duration="1500">
									</canvas>
								</a>
							</span>
							<?php 
								}else{
									echo '<span id="nullLending" data=""></span>';
							}?>
							<!-- /Lending -->

							<!-- NPL -->
							<?php if($dataKpiNpl != null){ ?>
							<span class="rounded-circle spedo" data-popover="popover"
								data-content='<b>NPL : <?= ambil2Angka($dataKpiNpl[0]->jml_value) . " %"; ?> <br> Status : Bagus <br> Baki debet NPL : <?php echo rupiah($dataKpiNpl[0]->jml_bd_npl); ?> <br> Baki debet : <?php echo rupiah($dataKpiNpl[0]->jml_bd); ?></br>'
								data-html='true' data-placement='top' data-trigger='hover'>
								<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_npl">
									<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="nplkantor" data-type="radial-gauge" data-width="300"
										data-height="300" data-units="<?php echo $dataKpiNpl[0]->unit; ?>" data-title="<?= $dataKpiNpl[0]->title; ?>"
										data-value="<?php echo $dataKpiNpl[0]->jml_value; ?>" data-min-value="0"
										data-max-value="<?php echo $dataKpiNpl[0]->jml_max_value; ?>"
										data-major-ticks="<?php echo $dataKpiNpl[0]->mayor_ticks; ?>"
										data-minor-ticks="<?php echo $dataKpiNpl[0]->minor_ticks; ?>" data-stroke-ticks="true"
										data-highlights='<?php echo $dataKpiNpl[0]->data_spedo; ?>' data-color-plate="#010101"
										data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff"
										data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)"
										data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true"
										data-animation-rule="bounce" data-animation-duration="1500">
									</canvas>
								</a>
							</span>
							<?php 
								}else{
									echo '<span id="nullNpl" data=""></span>';
							}?>
							<!-- /NPL -->

							<!-- Collection Ratio -->
							<?php if($dataKpiCR != null){ ?>
							<span class="rounded-circle spedo" data-popover="popover"
								data-content='<b>CR : <?= ambil2Angka($dataKpiCR[0]->jml_value) . " %"; ?> <br> Status : Bagus <br> Jumlah tagihan : <?= rupiah($dataKpiCR[0]->jml_tagihan); ?> <br> Jumlah bayar : <?= rupiah($dataKpiCR[0]->jml_bayar); ?></b>'
								data-html='true' data-placement='top' data-trigger='hover'>
								<a href="" data-toggle="modal" data-target="#modal_cr">
									<canvas class="mt-2 mb-2 mx-2" id="cr" data-type="radial-gauge" data-width="300" data-height="300"
										data-units="<?php echo $dataKpiCR[0]->unit; ?>" data-title="<?= $dataKpiCR[0]->title; ?>"
										data-value="<?php echo $dataKpiCR[0]->jml_value; ?>" data-min-value="0"
										data-max-value="<?php echo $dataKpiCR[0]->jml_max_value; ?>"
										data-major-ticks="<?php echo $dataKpiCR[0]->mayor_ticks; ?>"
										data-minor-ticks="<?php echo $dataKpiCR[0]->minor_ticks; ?>" data-stroke-ticks="true"
										data-highlights='<?php echo $dataKpiCR[0]->data_spedo; ?>' data-color-plate="#010101"
										data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff"
										data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)"
										data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true"
										data-animation-rule="bounce" data-animation-duration="1500">
									</canvas>
								</a>
							</span>
							<?php 
								}else{
									echo '<span id="nullCr" data=""></span>';
							}?>
							<!-- /Collection Ratio -->

							<!-- Bucket Zero -->
							<?php if($dataKpiBZ != null){ ?>
								<span class="rounded-circle spedo" data-popover="popover" data-content='<b>BZ : <?= ambil2Angka($dataKpiBZ[0]->jml_value) . " %"; ?> <br> Status : Tercapai <br> Jumlah tagihan : <?= rupiah($dataKpiBZ[0]->jml_tagihan); ?> <br> Jumlah bayar : <?= rupiah($dataKpiBZ[0]->jml_bayar); ?></b>' data-html='true' data-placement='top' data-trigger='hover'>
									<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_bz">
										<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="bz" data-type="radial-gauge" data-width="300"
											data-height="300" data-units="<?php echo $dataKpiBZ[0]->unit; ?>" data-title="<?= $dataKpiBZ[0]->title; ?>"
											data-value="<?php echo $dataKpiBZ[0]->jml_value; ?>" data-min-value="0"
											data-max-value="<?php echo $dataKpiBZ[0]->jml_max_value; ?>"
											data-major-ticks="<?php echo $dataKpiBZ[0]->mayor_ticks; ?>"
											data-minor-ticks="<?php echo $dataKpiBZ[0]->minor_ticks; ?>" data-stroke-ticks="true"
											data-highlights='<?php echo $dataKpiBZ[0]->data_spedo; ?>' data-color-plate="#010101"
											data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff"
											data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)"
											data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true"
											data-animation-rule="bounce" data-animation-duration="1500">
										</canvas>
									</a>
								</span>
							<?php 
								}else{
									echo '<span id="nullBz" data=""></span>';
							}?>
							<!-- /Bucket Zero -->

						<?php }else{?>
							<span class="spedo">
								<div class="row align-content-center align-items-center justify-content-center text-center">
									<h2 class="text-danger">
										<b><i class="mdi mdi-alert"></i> 204</b> <br>
										<hr>
										Data Dengan Filter : <br>
										<b><?= ubahBulan($bulan).' - '.$tahun; ?></b> <br>
										Tidak Ditemukan
									</h2>
								</div>
							</span>
						<?php }; ?>
						</div>
						

						<!-- Modal Lending -->
						<div class="modal fade" id="modal_lending" tabindex="1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
							aria-hidden="true">
							<div class="modal-dialog modal-xl modal-dialog-scrollable" role="dialog">
								<div class="modal-content">
									<div class="modal-header bg-light">
										<h5 class="modal-title" id="exampleModalLongTitle">Data Lending Per AO 
											<p>Bulan : <?php echo ubahBulan($bulan) . "&nbsp" . $tahun ?></p>
										</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="row justify-content-center">
											<?php foreach ($datakpilendingAO as $res) { ?>
											<span class="rounded-circle" data-popover="popover"
												data-content='<b> Lending : <?= ubahJuta($res->jml_value); ?> <br> Lending : <?= ambil2Angka($res->lending) .'%'; ?> <br> Status : Bagus </b>' data-html='true' data-placement='top'
												data-trigger='hover'>
												<a class="rounded-circle" href="#detail_lending_ao" data-toggle="modal"
													data-target="#detail_lending_ao<?php echo $res->kode_group2; ?>" data-backdrop="false">
													<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="bz" data-type="radial-gauge" data-width="300"
														data-height="300" data-units="<?php echo $res->unit; ?>"
														data-title="<?php echo $res->deskripsi_group2; ?>" data-value="<?php echo $res->jml_value; ?>"
														data-min-value="0" data-max-value="<?php echo $res->jml_max_value; ?>"
														data-major-ticks="<?php echo $res->mayor_ticks; ?>"
														data-minor-ticks="<?php echo $res->minor_ticks; ?>" data-stroke-ticks="true"
														data-highlights='<?php echo $res->data_spedo; ?>' data-color-plate="#010101"
														data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff"
														data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)"
														data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true"
														data-animate-on-init="true" data-animation-rule="bounce" data-animation-duration="1500">
													</canvas>
												</a>
											</span>
											<?php } ?>
										</div>
									</div>
									<div class="modal-footer bg-light">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						<!-- /Modal Lending -->

						<!-- Modal NPL -->
						<div class="modal fade" id="modal_npl" tabindex="2" role="dialog" aria-labelledby="myExtraLargeModalLabel"
							aria-hidden="true">
							<div class="modal-dialog modal-xl modal-dialog-scrollable">
								<div class="modal-content">
									<div class="modal-header bg-light">
										<h5 class="modal-title" id="exampleModalLongTitle">Data NPL per Collector
											<p>Bulan : <?php echo ubahBulan($bulan) . "&nbsp" . $tahun ?></p>
										</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="row justify-content-center">
										<?php foreach ($dataKpiNplKol as $res) { ?>
											
											<span class="rounded-circle" data-popover="popover"
												data-content='<b> NPL : <?= ambil2Angka($res->jml_value) . " %"; ?> <br> Status : Bagus <br> Baki debet NPL : <?= rupiah($res->jml_bd_npl); ?> <br> Baki debet : <?= rupiah($res->jml_bd); ?></b>' data-html='true' data-placement='top'
												data-trigger='hover'>
												<a class="rounded-circle" href="#detail_npl_kol<?php echo $res->kode_group3; ?>" data-toggle="modal"
													data-target="#detail_npl_kol<?php echo $res->kode_group3; ?>" data-backdrop="false">
													<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="bz" data-type="radial-gauge" data-width="300"
														data-height="300" data-units="<?php echo $res->unit; ?>"
														data-title="<?php echo $res->deskripsi_group3; ?>" data-value="<?php echo $res->jml_value; ?>"
														data-min-value="0" data-max-value="<?php echo $res->jml_max_value; ?>"
														data-major-ticks="<?php echo $res->mayor_ticks; ?>"
														data-minor-ticks="<?php echo $res->minor_ticks; ?>" data-stroke-ticks="true"
														data-highlights='<?php echo $res->data_spedo; ?>' data-color-plate="#010101"
														data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff"
														data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)"
														data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true"
														data-animate-on-init="true" data-animation-rule="bounce" data-aimation-duration="500">
													</canvas>
												</a>
											</span>
											
											<input type="hidden" id="kode_group3" value="<?php echo $res->kode_group3; ?>" selected>
										<?php } ?>
										</div>
									</div>
									<div class="modal-footer bg-light">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						<!-- /Modal NPL -->

						<!-- Modal Collection Ratio -->
						<div class="modal fade" id="modal_cr" tabindex="3" role="dialog" aria-labelledby="myExtraLargeModalLabel"
							aria-hidden="true">
							<div class="modal-dialog modal-xl modal-dialog-scrollable">
								<div class="modal-content">
									<div class="modal-header bg-light">
										<h5 class="modal-title" id="exampleModalLongTitle">Detail Collection Ratio
											<p>Bulan : <?php echo ubahBulan($bulan) . "&nbsp" . $tahun ?></p>
										</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="row justify-content-center">
										<?php foreach ($dataKpiCRKol as $res) { ?>
											<span class="rounded-circle" data-popover="popover"
												data-content='<b>CR : <?= ambil2Angka($res->jml_value) . " %"; ?> <br> Status : Bagus <br> Jumlah tagihan : <?= rupiah($res->jml_tagihan); ?> <br> Jumlah bayar : <?= rupiah($res->jml_bayar); ?></b>' data-html='true' data-placement='top'
												data-trigger='hover'>
												<a class="rounded-circle" href="#detail_cr_kolektor<?php echo $res->kode_group3; ?>" data-toggle="modal"
													data-target="#detail_cr_kolektor<?php echo $res->kode_group3; ?>" data-backdrop="false">
													<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="bz" data-type="radial-gauge" data-width="300"
														data-height="300" data-units="<?php echo $res->unit; ?>"
														data-title="<?php echo $res->deskripsi_group3; ?>" data-value="<?php echo $res->jml_value; ?>"
														data-min-value="0" data-max-value="<?php echo $res->jml_max_value; ?>"
														data-major-ticks="<?php echo $res->mayor_ticks; ?>"
														data-minor-ticks="<?php echo $res->minor_ticks; ?>" data-stroke-ticks="true"
														data-highlights='<?php echo $res->data_spedo; ?>' data-color-plate="#010101"
														data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff"
														data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)"
														data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true"
														data-animate-on-init="true" data-animation-rule="bounce" data-aimation-duration="500">
													</canvas>
												</a>
											</span>
										<?php } ?>
										</div>
									</div>
									<div class="modal-footer bg-light">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						<!-- /Modal Collection Ratio -->

						<!-- Modal Bucket Zero -->
						<div class="modal fade" id="modal_bz" tabindex="4" role="dialog" aria-labelledby="myExtraLargeModalLabel"
							aria-hidden="true">
							<div class="modal-dialog modal-xl modal-dialog-scrollable">
								<div class="modal-content">
									<div class="modal-header bg-light">
										<h5 class="modal-title" id="exampleModalLongTitle">Detail Bucket Zero
											<p>Bulan : <?php echo ubahBulan($bulan) . "&nbsp" . $tahun ?></p>
										</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="row justify-content-center">
										<?php foreach ($dataKpiBZKol as $res) { ?>
											<span class="rounded-circle" data-popover="popover"
												data-content='<b>BZ : <?= ambil2Angka($res->jml_value) . " %"; ?> <br> Status : Tercapai <br> Jumlah tagihan : <?= rupiah($res->jml_tagihan); ?> <br> Jumlah bayar : <?= rupiah($res->jml_bayar); ?></b>' data-html='true' data-placement='top'
												data-trigger='hover'>
												<a class="rounded-circle" href="#detail_bz_kol" data-toggle="modal"
													data-target="#detail_bz_kol<?php echo $res->kode_group3; ?>" data-backdrop="false">
													<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="bz" data-type="radial-gauge" data-width="300"
														data-height="300" data-units="<?php echo $res->unit; ?>"
														data-title="<?php echo $res->deskripsi_group3; ?>" data-value="<?php echo $res->jml_value; ?>"
														data-min-value="0" data-max-value="<?php echo $res->jml_max_value; ?>"
														data-major-ticks="<?php echo $res->mayor_ticks; ?>"
														data-minor-ticks="<?php echo $res->minor_ticks; ?>" data-stroke-ticks="true"
														data-highlights='<?php echo $res->data_spedo; ?>' data-color-plate="#010101"
														data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff"
														data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)"
														data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true"
														data-animate-on-init="true" data-animation-rule="bounce" data-aimation-duration="500">
													</canvas>
												</a>
											</span>
										<?php } ?>
										</div>
									</div>
									<div class="modal-footer bg-light">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						<!-- /Modal Bucket Zero -->

						<!-- Modal Detail Lending -->
						<?php foreach ($datakpilendingAO as $res) { ?>
							<?php 

								$this->db->query("SELECT '$date' INTO @pv_per_tgl");
								$this->db->query("SELECT '$res->kode_group2' INTO @pv_kode_ao");
								$dataDetail = $this->db->query("SELECT * FROM kms_kpi.v_kpi_ao_lending WHERE kode_kantor = '$res->kode_kantor'")->result();
							?>
							<div class="modal modal2 modal_detail_lending fade" id="detail_lending_ao<?php echo $res->kode_group2; ?>" tabindex="5" role="dialog" aria-labelledby="" aria-hidden="true">
								<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
									<div class="modal-content">
										<div class="modal-header bg-light">
											<h5 class="modal-title" id="exampleModalLongTitle">Data Nasabah Lending
												<p><?php echo $res->deskripsi_group2; ?>, <?php echo ubahBulan($bulan) . "&nbsp" . $tahun; ?></p>
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<table id="dt_tables_lending<?php echo $res->kode_group2; ?>" class="table table-bordered table-striped table-hover">
												<thead class="bg-light">
													<tr>
														<th>Nasabah ID</th>
														<th>Nama Nasabah</th>
														<th>Alamat</th>
														<th>Tanggal Realisasi</th>
														<th>JKW</th>
														<th>Tanggal Jatuh Tempo</th>
														<th>Baki Debet</th>
														<th>Jumlah Pinjaman</th>
														<th>Jumlah Lending</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($dataDetail as $resDetail) { ?>
													<tr>
														<td><?php echo $resDetail->nasabah_id; ?></td>
														<td><?php echo $resDetail->nama_nasabah; ?></td>
														<td><?php echo $resDetail->alamat; ?></td>
														<td><?php echo $resDetail->tgl_realisasi; ?></td>
														<td><?php echo $resDetail->jkw; ?></td>
														<td><?php echo $resDetail->tgl_jatuh_tempo; ?></td>
														<td><?php echo rupiah($resDetail->baki_debet); ?></td>
														<td><?php echo rupiah($resDetail->jml_pinjaman); ?></td>
														<td><?php echo rupiah($resDetail->jml_lending); ?></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
										<div class="modal-footer bg-light">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
						<!-- /Modal Detail Lending -->

						<!-- Modal Detail NPL -->
						<?php foreach ($dataKpiNplKol as $res) { ?>
							<?php 
							
								$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
								$this->db->query("SELECT '$res->kode_group3' INTO @pv_kode_kolektor");
								$dataDetail = $this->db->query("SELECT * FROM kms_kpi.v_kpi_kolektor_npl WHERE kode_kantor = '$res->kode_kantor'")->result();
							?>
							<div class="modal fade" id="detail_npl_kol<?php echo $res->kode_group3; ?>" tabindex="2" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-xl modal-dialog-scrollable">
									<div class="modal-content">
										<div class="modal-header bg-light">
											<h5 class="modal-title" id="exampleModalLongTitle">Detail NPL
												<p><?php echo $res->deskripsi_group3; ?>,&nbsp; <?php echo $date; ?></p>	
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="table-responsive">
												<table id="dt_tables_npl<?php echo $res->kode_group3; ?>" class="dt_tables table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
													<thead class="bg-light">
														<tr>
															<th>Nasabah ID</th>
															<th>Nama Nasabah</th>
															<th>Alamat</th>
															<th>Tanggal Realisasi</th>
															<th>JKW</th>
															<th>Tanggal Jatuh Tempo</th>
															<th>Baki Debet</th>
															<th>Jumlah Pinjaman</th>
															<th>Jumlah Lending</th>
															<th>Jumlah Tagihan Turun</th>
															<th>Jumlah Tagihan Bayar</th>
															<th>Jumlah Tunggakan</th>
															<th>Jumlah Denda</th>
															<th>Jumlah SP Assign</th>
															<th>Jumlah SP Return</th>
															<th>FT Pokok</th>
															<th>FT Bunga</th>
															<th>FT Hari Awal</th>
															<th>FT Hari</th>
															<th>Kolektibilitas</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($dataDetail as $resDetail) { ?>
														<tr>
															<td><?= $resDetail->nasabah_id; ?></td>
															<td><?= $resDetail->nama_nasabah; ?></td>
															<td><?= $resDetail->alamat; ?></td>
															<td><?= $resDetail->tgl_realisasi; ?></td>
															<td><?= $resDetail->jkw; ?></td>
															<td><?= $resDetail->tgl_jatuh_tempo; ?></td>
															<td><?= rupiah($resDetail->baki_debet); ?></td>
															<td><?= rupiah($resDetail->jml_pinjaman); ?></td>
															<td><?= rupiah($resDetail->jml_lending); ?></td>
															<td><?= rupiah($resDetail->jml_tagihan_turun); ?></td>
															<td><?= rupiah($resDetail->jml_tagihan_bayar); ?></td>
															<td><?= rupiah($resDetail->jml_tunggakan); ?></td>
															<td><?= rupiah($resDetail->jml_denda); ?></td>
															<td><?= $resDetail->jml_sp_assign; ?></td>
															<td><?= $resDetail->jml_sp_return; ?></td>
															<td><?= $resDetail->ft_pokok; ?></td>
															<td><?= $resDetail->ft_bunga; ?></td>
															<td><?= $resDetail->ft_hari_awal; ?></td>
															<td><?= $resDetail->ft_hari; ?></td>
															<td><?= $resDetail->kolektibilitas; ?></td>
														</tr>
														<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
										<div class="modal-footer bg-light">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
						<!-- Modal Detail NPL -->

						<!-- Modal Detail CR -->
						<?php foreach ($dataKpiCRKol as $res) { ?>
							<?php 
							
								$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
								$this->db->query("SELECT '$res->kode_group3' INTO @pv_kode_kolektor");
								$dataDetail = $this->db->query("SELECT * FROM kms_kpi.v_kpi_kolektor_cr WHERE kode_kantor = '$res->kode_kantor'")->result();
							?>
							<div class="modal fade" id="detail_cr_kolektor<?php echo $res->kode_group3; ?>" tabindex="5" role="dialog" aria-labelledby="" aria-hidden="true">
								<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
									<div class="modal-content">
										<div class="modal-header bg-light">
											<h5 class="modal-title" id="exampleModalLongTitle">Detail CR
												<p><?php echo $res->deskripsi_group3; ?>,&nbsp; <?php echo $date; ?></p>	
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="table-responsive">
												<table id="dt_tables_cr<?php echo $res->kode_group3; ?>" class="dt_tables table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
													<thead class="bg-light">
														<tr>
															<th>Nasabah ID</th>
															<th>Nama Nasabah</th>
															<th>Alamat</th>
															<th>Tanggal Realisasi</th>
															<th>JKW</th>
															<th>Tanggal Jatuh Tempo</th>
															<th>Baki Debet</th>
															<th>Jumlah Pinjaman</th>
															<th>Jumlah Lending</th>
															<th>Jumlah Tagihan Turun</th>
															<th>Jumlah Tagihan Bayar</th>
															<th>Jumlah Tunggakan</th>
															<th>Jumlah Denda</th>
															<th>Jumlah SP Assign</th>
															<th>Jumlah SP Return</th>
															<th>FT Pokok</th>
															<th>FT Bunga</th>
															<th>FT Hari Awal</th>
															<th>FT Hari</th>
															<th>Kolektibilitas</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach($dataDetail as $resDetail) { ?>
															<tr>
																<td><?= $resDetail->nasabah_id; ?></td>
																<td><?= $resDetail->nama_nasabah; ?></td>
																<td><?= $resDetail->alamat; ?></td>
																<td><?= $resDetail->tgl_realisasi; ?></td>
																<td><?= $resDetail->jkw; ?></td>
																<td><?= $resDetail->tgl_jatuh_tempo; ?></td>
																<td><?= rupiah($resDetail->baki_debet); ?></td>
																<td><?= rupiah($resDetail->jml_pinjaman); ?></td>
																<td><?= rupiah($resDetail->jml_lending); ?></td>
																<td><?= rupiah($resDetail->jml_tagihan_turun); ?></td>
																<td><?= rupiah($resDetail->jml_tagihan_bayar); ?></td>
																<td><?= rupiah($resDetail->jml_tunggakan); ?></td>
																<td><?= rupiah($resDetail->jml_denda); ?></td>
																<td><?= $resDetail->jml_sp_assign; ?></td>
																<td><?= $resDetail->jml_sp_return; ?></td>
																<td><?= $resDetail->ft_pokok; ?></td>
																<td><?= $resDetail->ft_bunga; ?></td>
																<td><?= $resDetail->ft_hari_awal; ?></td>
																<td><?= $resDetail->ft_hari; ?></td>
																<td><?= $resDetail->kolektibilitas; ?></td>
															</tr>
														<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
										<div class="modal-footer bg-light">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
						<!-- /Modal Detail CR -->

						<!-- Modal Detail Bucket  Zero -->
						<?php foreach ($dataKpiBZKol as $res) { ?>
							<?php 
							
								$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
								$this->db->query("SELECT '$res->kode_group3' INTO @pv_kode_kolektor");
								$dataDetail = $this->db->query("SELECT * FROM kms_kpi.v_kpi_kolektor_bucket_zero WHERE kode_kantor = '$res->kode_kantor'")->result();
							?>
							<div class="modal fade" id="detail_bz_kol<?php echo $res->kode_group3; ?>" tabindex="5" role="dialog" aria-labelledby="" aria-hidden="true">
								<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
									<div class="modal-content">
										<div class="modal-header bg-light">
											<h5 class="modal-title" id="exampleModalLongTitle">Detail Bucket Zero 
												<p><?php echo $res->deskripsi_group3; ?>,&nbsp; <?php echo $date; ?></p>	
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="table-responsive">
												<table id="dt_tables_bz<?php echo $res->kode_group3; ?>" class="dt_tables table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
													<thead class="bg-light">
														<tr>
															<th>Nasabah ID</th>
															<th>Nama Nasabah</th>
															<th>Alamat</th>
															<th>Tanggal Realisasi</th>
															<th>JKW</th>
															<th>Tanggal Jatuh Tempo</th>
															<th>Baki Debet</th>
															<th>Jumlah Pinjaman</th>
															<th>Jumlah Lending</th>
															<th>Jumlah Tagihan Turun</th>
															<th>Jumlah Tagihan Bayar</th>
															<th>Jumlah Tunggakan</th>
															<th>Jumlah Denda</th>
															<th>Jumlah SP Assign</th>
															<th>Jumlah SP Return</th>
															<th>FT Pokok</th>
															<th>FT Bunga</th>
															<th>FT Hari Awal</th>
															<th>FT Hari</th>
															<th>Kolektibilitas</th>
														</tr>
													</thead>
													<tbody>
													<?php foreach($dataDetail as $resDetail) { ?>
														<tr>
															<td><?= $resDetail->nasabah_id; ?></td>
															<td><?= $resDetail->nama_nasabah; ?></td>
															<td><?= $resDetail->alamat; ?></td>
															<td><?= $resDetail->tgl_realisasi; ?></td>
															<td><?= $resDetail->jkw; ?></td>
															<td><?= $resDetail->tgl_jatuh_tempo; ?></td>
															<td><?= rupiah($resDetail->baki_debet); ?></td>
															<td><?= rupiah($resDetail->jml_pinjaman); ?></td>
															<td><?= rupiah($resDetail->jml_lending); ?></td>
															<td><?= rupiah($resDetail->jml_tagihan_turun); ?></td>
															<td><?= rupiah($resDetail->jml_tagihan_bayar); ?></td>
															<td><?= rupiah($resDetail->jml_tunggakan); ?></td>
															<td><?= rupiah($resDetail->jml_denda); ?></td>
															<td><?= $resDetail->jml_sp_assign; ?></td>
															<td><?= $resDetail->jml_sp_return; ?></td>
															<td><?= $resDetail->ft_pokok; ?></td>
															<td><?= $resDetail->ft_bunga; ?></td>
															<td><?= $resDetail->ft_hari_awal; ?></td>
															<td><?= $resDetail->ft_hari; ?></td>
															<td><?= $resDetail->kolektibilitas; ?></td>
														</tr>
													<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
										<div class="modal-footer bg-light">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
						<!-- /Modal Detail Bucket  Zero -->
					</div>
					<!-- content-wrapper ends -->
					<!-- partial:partials/_footer.html -->
					<footer class="footer">
						<div class="container-fluid clearfix">
							<span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
								<a href="https://kdpms.id/" target="_blank">Koperasi dana pinjaman mandiri sejahtera</a>. All
								rights reserved.</span>
							<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">KDPMS BISNIS V.1.0.6
							</span>
						</div>
					</footer>
					<!-- <script type="text/javascript" src="<?= base_url('lib/js/formatRupiah.js'); ?>"></script>
					<script type="text/javascript" src="<?= base_url('lib/js/changedate.js'); ?>"></script>
					<script type="text/javascript" src="<?= base_url('lib/js/url.js'); ?>"></script> -->
					<!-- Highcharts CDN -->
					<!-- <script src="https://code.highcharts.com/highcharts.js"></script>
					<script src="https://code.highcharts.com/highcharts-more.js"></script> -->



					<!-- Bootstrap 4.3.1 JS -->
					<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
					<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
					<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
					<!-- /Bootstrap 4.3.1 JS -->
					<!-- Popover -->
					
					<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
					<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
					<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/sc-2.0.1/datatables.min.js"></script>
					<script>
						$(document).ready(function() {
							//popover
							detectmob();

							function detectmob() {
								if (window.innerWidth <= 800 && window.innerHeight <= 600) {
									$('[data-popover="popover"]').popover("hide");
								} else {
									$('[data-popover="popover"]').popover();
								}
							}
							//tutup popover
							
							//datatable
							function cchart(id_modal,id_table){
								return $(id_modal).on('shown.bs.modal', function () {
									if ( ! $.fn.DataTable.isDataTable(id_table) ) {
										var tbtb = $(id_table).DataTable( {
											responsive: false,
											fixedColumns: {
												leftColumns: 2
											},
											order: [
												[ 0, "desc" ]
											],
											dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
												"<'row'<'col-sm-12't>>" +
												"<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
											scrollY: 320,
											scrollX: true,
											scrollCollapse: true,
											scroller:true,
										} );
									}else{
										// var tbtb = $.fn.dataTable.fnTables(true);

										// $(tbtb).each(function () {
										// 	$(this).dataTable().fnDestroy();
										// });
									}

									tbtb.columns.adjust();
								});
							}

							<?php foreach ($datakpilendingAO as $res) { ?>
								new cchart('#detail_lending_ao<?php echo $res->kode_group2; ?>','#dt_tables_lending<?php echo $res->kode_group2; ?>');
							<?php } ?>

							<?php foreach ($dataKpiNplKol as $res) { ?>
							new cchart('#detail_npl_kol<?php echo $res->kode_group3; ?>','#dt_tables_npl<?php echo $res->kode_group3; ?>');
							<?php } ?>

							<?php foreach ($dataKpiCRKol as $res) { ?>
								new cchart('#detail_cr_kolektor<?php echo $res->kode_group3; ?>','#dt_tables_cr<?php echo $res->kode_group3; ?>');
							<?php } ?>

							<?php foreach ($dataKpiBZKol as $res) { ?>
								new cchart('#detail_bz_kol<?php echo $res->kode_group3; ?>','#dt_tables_bz<?php echo $res->kode_group3; ?>');
							<?php } ?>
							//tutup datatable


							//loader
							$('#loader').fadeOut('slow');
							$('span.spedo').fadeIn('slow');

							$('form').submit(function(){
								$('#loader').fadeIn('slow');
								$('span.spedo').fadeOut('slow');
							});
							//tutup loader

							//alert data tidak ada
							var isiLending = "<div class='alert alert-danger alert-dismissible fade out show' role='alert'>Data <b>Lending</b> Tidak Ada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden=true'>&times;</span></button></div>";
							$('#nullLending').attr('data', isiLending);
							var nullLending = $('#nullLending').attr('data');
							$('#lendingNull').html(nullLending);

							var isiNpl = "<div class='alert alert-danger alert-dismissible fade out show' role='alert'>Data <b>NPL</b> Tidak Ada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden=true'>&times;</span></button></div>";
							$('#nullNpl').attr('data', isiNpl);
							var nullNpl = $('#nullNpl').attr('data');
							$('#nplNull').html(nullNpl);

							var isiCr = "<div class='alert alert-danger alert-dismissible fade out show' role='alert'>Data <b>CR</b> Tidak Ada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden=true'>&times;</span></button></div>";
							$('#nullCr').attr('data', isiCr);
							var nullCr = $('#nullCr').attr('data');
							$('#crNull').html(nullCr);

							var isiBz = "<div class='alert alert-danger alert-dismissible fade out show' role='alert'>Data <b>Bucket 0</b> Tidak Ada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden=true'>&times;</span></button></div>";
							$('#nullBz').attr('data', isiBz);
							var nullBz = $('#nullBz').attr('data');
							$('#bzNull').html(nullBz);
							//tutup alert data tidak ada
							
						});
					</script>
					<!-- partial -->
				</div>
				<!-- main-panel ends -->
			</div>
			<!-- page-body-wrapper ends -->
		</div>
		<!-- container-scroller -->
	</body>

</html>
