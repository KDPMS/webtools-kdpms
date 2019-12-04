<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

		<?php $this->
		load->view('include/style-css.php') ?>
		<?php $this->
		load->view('include/style-js-fitur.php') ?>

		<!-- Bootstrap 4.3.1 CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/rg-1.1.1/sc-2.0.1/datatables.min.css"/>
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
			font-size: 0.9em;
			/* opinion 3 */
			line-height: 1;
			user-select: none;
			pointer-events: none;
			position: absolute;
			display: none;
			opacity: 0;
		}

		[tooltip]::before {
			content: "";
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
			border-radius: 0.3ch;
			box-shadow: 0 1em 2em -0.5em rgba(0, 0, 0, 0.35);
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
		[tooltip=""]::before,
		[tooltip=""]::after {
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
			transform: translate(-50%, -0.5em);
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
			transform: translate(-50%, 0.5em);
		}

		/* FLOW: LEFT */
		[tooltip][flow^="left"]::before {
			top: 50%;
			border-right-width: 0;
			border-left-color: #333;
			left: calc(0em - 5px);
			transform: translate(-0.5em, -50%);
		}

		[tooltip][flow^="left"]::after {
			top: 50%;
			right: calc(100% + 5px);
			transform: translate(-0.5em, -50%);
		}

		/* FLOW: RIGHT */
		[tooltip][flow^="right"]::before {
			top: 50%;
			border-left-width: 0;
			border-right-color: #333;
			right: calc(0em - 5px);
			transform: translate(0.5em, -50%);
		}

		[tooltip][flow^="right"]::after {
			top: 50%;
			left: calc(100% + 5px);
			transform: translate(0.5em, -50%);
		}

		/* KEYFRAMES */
		@keyframes tooltips-vert {
			to {
				opacity: 0.9;
				transform: translate(-50%, 0);
			}
		}

		@keyframes tooltips-horz {
			to {
				opacity: 0.9;
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

		#loader {
			border: 16px solid #f3f3f3;
			border-radius: 50%;
			border-top: 16px solid #3498db;
			width: 120px;
			height: 120px;
			-webkit-animation: spin 2s linear infinite; /* Safari */
			animation: spin 2s linear infinite;
		}

		/* Safari */
		@-webkit-keyframes spin {
			0% { -webkit-transform: rotate(0deg); }
			100% { -webkit-transform: rotate(360deg); }
		}

		@keyframes spin {
			0% { transform: rotate(0deg); }
			100% { transform: rotate(360deg); }
		}
	</style>

	<body>
		<script type="text/javascript">
			function loadCSS(e, t, n) {
				"use strict";
				var i = window.document.createElement("link");
				var o = t || window.document.getElementsByTagName("script")[0];
				i.rel = "stylesheet";
				i.href = e;
				i.media = "only x";
				o.parentNode.insertBefore(i, o);
				setTimeout(function() {
					i.media = n || "all";
				});
			}
			loadCSS("https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css");
		</script>
		<div class="container-scroller">
			<!-- partial:partials/_navbar.html -->
			<?php $this->
			load->view('include/navbarfitur.php') ?>
			<!-- partial -->
			<div class=" page-body-wrapper">
				<!-- partial:partials/_sidebar.html -->
				<?php $this->
				load->view('include/sidebar.php') ?>
				<!-- partial -->
				<div class="main-panel" style="width: 100%;">
					<!-- <div id="myProgress" style="position:fixed;z-index:5;">
						<div id="myBar"></div>
					</div> -->
					<div class="content-wrapper">
						<input type="hidden" id="tamplate" value="" />
						<input type="hidden" id="paramsID1" value="" />
						<input type="hidden" id="paramsID2" value="" />
						<input type="hidden" id="paramsID3" value="" />
						<input type="hidden" id="session_kantor" value="<?php echo $this->session->userdata('kantor'); ?>" />
						<input type="hidden" id="session_jabatan" value="<?php echo $this->session->userdata('jabatan'); ?>" />
						<input type="hidden" id="session_id_user" value="<?php echo $this->session->userdata('id'); ?>" />
						<input type="hidden" id="NowDate" value="<?php echo date('Y-m-d'); ?>" />
						<input type="hidden" id="load_page" value="false" />
						<div class="clearfix mt-5">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 text-lg-left text-md-center text-sm-center text-center">
										<p>
											<b>
												<?php echo $this->session->userdata('username'); ?> |
												<?php echo $this->session->userdata('jabatan'); ?>
											</b>
										</p>
									</div>
									<div class="col-md-4 text-lg-center text-md-center text-sm-center text-center">
										<form action="<?php echo site_url('kpi/dashboard_kpi_col'); ?>" method="post">
											<p>
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
												<button class="btn-primary" type="submit">Filter</button>
											</p>
										</form>
									</div>
									<div class="col-md-4 text-lg-right text-md-center text-sm-center text-center">
										<p>
											<b>
												Kantor :
												<?php 
													if ($this->session->userdata('kantor') == '01'){
														echo "Pusat";
													}elseif($this->session->userdata('kantor') == '02'){
														echo "Cabang Cilodong";
													}else{
														echo "Anda Harus Login Kembali <a href= ".base_url("login").">Login Kembali</a>";
													}
												?>
											</b>
										</p>
									</div>
								</div>
							</div>
						</div>
						<hr />
						<center><div id="loader"></div></center>
						<div class="row justify-content-center">
							
							<!-- Bucket Zero -->
							<?php if($dataKpiBZKol != null){ ?>
							<span class="rounded-circle spedo" data-popover="popover" data-content="<center><b>Bucket Zero : <?php echo number_format($dataKpiBZKol[0]->jml_value, 2); ?> % <br> Status : Tercapai <br> Jumlah Tagihan : <?= rupiah($dataKpiBZKol[0]->jml_tagihan); ?> <br> Jumlah Bayar : <?= rupiah($dataKpiBZKol[0]->jml_bayar); ?> </b></center>" data-html="true" data-placement="top" data-trigger="hover">
								<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_bz">
									<canvas
										class="mt-2 mb-2 mx-2 rounded-circle"
										data-type="radial-gauge"
										data-width="300"
										data-height="300"
										data-units="<?= $dataKpiBZKol[0]->unit; ?>"
										data-title="<?= $dataKpiBZKol[0]->title; ?>"
										data-value="<?= $dataKpiBZKol[0]->jml_value; ?>"
										data-min-value="0"
										data-max-value="<?= $dataKpiBZKol[0]->jml_max_value; ?>"
										data-major-ticks="<?= $dataKpiBZKol[0]->mayor_ticks; ?>"
										data-minor-ticks="<?= $dataKpiBZKol[0]->minor_ticks; ?>"
										data-stroke-ticks="true"
										data-highlights='<?= $dataKpiBZKol[0]->data_spedo; ?>'
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
										data-animation-duration="1500"
									></canvas>
								</a>
							</span>
							<?php }else{echo "";}?>
							<!-- /Bucket Zero -->

							<!-- Collection Ratio -->
							<?php if($dataKpiCRKol != null){ ?>
							<span class="rounded-circle spedo" data-popover="popover" data-content="<center><b>Collection Ratio : <?php echo number_format($dataKpiCRKol[0]->jml_value, 2); ?> % <br> Status : Tidak Tercapai <br> Jumlah Tagihan : <?= rupiah($dataKpiCRKol[0]->jml_tagihan); ?> <br> Jumlah Bayar : <?= rupiah($dataKpiCRKol[0]->jml_bayar); ?></b></center>" data-html="true" data-placement="top" data-trigger="hover">
								<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_cr">
									<canvas
										class="mt-2 mb-2 mx-2 rounded-circle"
										id="map"
										data-type="radial-gauge"
										data-width="300"
										data-height="300"
										data-units="%"
										data-title="<?= $dataKpiCRKol[0]->title; ?>"
										data-value="<?= $dataKpiCRKol[0]->jml_value; ?>"
										data-min-value="0"
										data-max-value="<?= $dataKpiCRKol[0]->jml_max_value; ?>"
										data-major-ticks="<?= $dataKpiCRKol[0]->mayor_ticks; ?>"
										data-minor-ticks="<?= $dataKpiCRKol[0]->minor_ticks; ?>"
										data-stroke-ticks="true"
										data-highlights='<?= $dataKpiCRKol[0]->data_spedo; ?>'
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
										data-animation-duration="1500"
									></canvas>
								</a>
							</span>
							<?php }else{echo "";}?>
							<!-- /Collection Ratio -->

							<!-- NPL -->
							<?php if($dataKpiNplKol != null){ ?>
							<span class="rounded-circle spedo" data-popover="popover" data-content="<b>NPL : <?php echo number_format($dataKpiNplKol[0]->jml_value, 2); ?> % <br> Status : Bagus <br> Baki Debet NPL : <?= rupiah($dataKpiNplKol[0]->jml_bd_npl); ?> <br> Tot Baki Debet : <?= rupiah($dataKpiNplKol[0]->jml_bd); ?></b>" data-html="true" data-placement="top" data-trigger="hover">
								<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_npl">
									<canvas
										class="mt-2 mb-2 mx-2 rounded-circle"
										id="npl"
										data-type="radial-gauge"
										data-width="300"
										data-height="300"
										data-units="%"
										data-title="<?= $dataKpiNplKol[0]->title; ?>"
										data-value="<?= $dataKpiNplKol[0]->jml_value; ?>"
										data-min-value="0"
										data-max-value="<?= $dataKpiNplKol[0]->jml_max_value; ?>"
										data-major-ticks="<?= $dataKpiNplKol[0]->mayor_ticks; ?>"
										data-minor-ticks="<?= $dataKpiNplKol[0]->minor_ticks; ?>"
										data-stroke-ticks="true"
										data-highlights='<?= $dataKpiNplKol[0]->data_spedo; ?>'
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
										data-animation-duration="1500"
									></canvas>
								</a>
							</span>
							<?php }else{echo "";}?>
							<!-- /NPL -->

							<!-- SP Return -->
							<span class="rounded-circle spedo" data-popover="popover" data-content="<center><b>SP Return : 70% <br> Status : Cukup Tercapai</b></center>" data-html="true" data-placement="top" data-trigger="hover">
								<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_spr">
									<canvas
										class="mt-2 mb-2 mx-2 rounded-circle"
										id="mb"
										data-type="radial-gauge"
										data-width="300"
										data-height="300"
										data-units="%"
										data-title="SP Return"
										data-value="70"
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
										data-animation-duration="1500"
									></canvas>
								</a>
							</span>
							<!-- /SP Return -->
						</div>

						<!-- Modal Bucket Zero -->
						<div class="modal fade" id="modal_bz" tabindex="2" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-xl modal-dialog-scrollable">
								<div class="modal-content">
									<div class="modal-header bg-light">
										<h5 class="modal-title" id="exampleModalLongTitle">Detail Bucket Zero
											<p><?= "Date : &nbsp" . ubahDate($date);?></p>
										</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<table id="dt_tables_bz" class="table table-bordered table-hover">
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
											<?php foreach($dataKpiBZKoldetail as $resDetail) { ?>
												<tr>
													<td><?= $resDetail->nasabah_id; ?></td>
													<td><?= $resDetail->nama_nasabah; ?></td>
													<td><?= $resDetail->alamat; ?></td>
													<td><?= $resDetail->tgl_realisasi; ?></td>
													<td><?= $resDetail->jkw; ?></td>
													<td><?= $resDetail->tgl_jatuh_tempo; ?></td>
													<td><?= $resDetail->baki_debet; ?></td>
													<td><?= $resDetail->jml_pinjaman; ?></td>
													<td><?= $resDetail->jml_lending; ?></td>
													<td><?= $resDetail->jml_tagihan_turun; ?></td>
													<td><?= $resDetail->jml_tagihan_bayar; ?></td>
													<td><?= $resDetail->jml_tunggakan; ?></td>
													<td><?= $resDetail->jml_denda; ?></td>
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
									<div class="modal-footer bg-light">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">
											Close
										</button>
									</div>
								</div>
							</div>
						</div>
						<!-- /Modal Bucket Zero -->

						<!-- Modal Collection Ratio -->
						<div class="modal fade" id="modal_cr" tabindex="4" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-xl modal-dialog-scrollable">
								<div class="modal-content">
									<div class="modal-header bg-light">
										<h5 class="modal-title" id="exampleModalLongTitle">Detail Collection Ratio
											<p><?= "Date : &nbsp" . ubahDate($date);?></<p>
										</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<table id="dt_tables_cr" class="table table-bordered table-hover">
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
											<?php foreach($dataKpiCRKoldetail as $resDetail) { ?>
												<tr>
													<td><?= $resDetail->nasabah_id; ?></td>
													<td><?= $resDetail->nama_nasabah; ?></td>
													<td><?= $resDetail->alamat; ?></td>
													<td><?= $resDetail->tgl_realisasi; ?></td>
													<td><?= $resDetail->jkw; ?></td>
													<td><?= $resDetail->tgl_jatuh_tempo; ?></td>
													<td><?= $resDetail->baki_debet; ?></td>
													<td><?= $resDetail->jml_pinjaman; ?></td>
													<td><?= $resDetail->jml_lending; ?></td>
													<td><?= $resDetail->jml_tagihan_turun; ?></td>
													<td><?= $resDetail->jml_tagihan_bayar; ?></td>
													<td><?= $resDetail->jml_tunggakan; ?></td>
													<td><?= $resDetail->jml_denda; ?></td>
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
									<div class="modal-footer bg-light">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">
											Close
										</button>
									</div>
								</div>
							</div>
						</div>
						<!-- /Modal Collection Ratio -->

						<!-- Modal NPL -->
						<div class="modal fade" id="modal_npl" tabindex="3" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-xl modal-dialog-scrollable">
								<div class="modal-content">
									<div class="modal-header bg-light">
										<h5 class="modal-title" id="exampleModalLongTitle">Detail NPL
											<p><?= "Date : &nbsp" . ubahDate($date);?></p>
										</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<table id="dt_tables_npl" class="table table-bordered table-hover">
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
											<?php foreach($dataKpiNplKoldetail as $resDetail) { ?>
												<tr>
													<td><?= $resDetail->nasabah_id; ?></td>
													<td><?= $resDetail->nama_nasabah; ?></td>
													<td><?= $resDetail->alamat; ?></td>
													<td><?= $resDetail->tgl_realisasi; ?></td>
													<td><?= $resDetail->jkw; ?></td>
													<td><?= $resDetail->tgl_jatuh_tempo; ?></td>
													<td><?= $resDetail->baki_debet; ?></td>
													<td><?= $resDetail->jml_pinjaman; ?></td>
													<td><?= $resDetail->jml_lending; ?></td>
													<td><?= $resDetail->jml_tagihan_turun; ?></td>
													<td><?= $resDetail->jml_tagihan_bayar; ?></td>
													<td><?= $resDetail->jml_tunggakan; ?></td>
													<td><?= $resDetail->jml_denda; ?></td>
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
									<div class="modal-footer bg-light">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">
											Close
										</button>
									</div>
								</div>
							</div>
						</div>
						<!-- /Modal NPL -->

						<!-- Modal SP Return -->
						<div class="modal fade" id="modal_spr" tabindex="5" role="dialog" aria-labelledby="" aria-hidden="true" >
							<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
								<div class="modal-content">
									<div class="modal-header bg-light">
										<h5 class="modal-title" id="exampleModalLongTitle">Detail SP Return
											<p><?= "Date : &nbsp" . ubahDate($date);?></p>
										</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<table id="dt_tables_spr" class="table table-bordered table-hover">
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
													<th>FT Hari</th>
													<th>Kolektibilitas</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach($dataKpiSpReturnKoldetail as $resDetail) { ?>
												<tr>
													<td><?= $resDetail->nasabah_id; ?></td>
													<td><?= $resDetail->nama_nasabah; ?></td>
													<td><?= $resDetail->alamat; ?></td>
													<td><?= $resDetail->tgl_realisasi; ?></td>
													<td><?= $resDetail->jkw; ?></td>
													<td><?= $resDetail->tgl_jatuh_tempo; ?></td>
													<td><?= $resDetail->baki_debet; ?></td>
													<td><?= $resDetail->jml_pinjaman; ?></td>
													<td><?= $resDetail->jml_lending; ?></td>
													<td><?= $resDetail->jml_tagihan_turun; ?></td>
													<td><?= $resDetail->jml_tagihan_bayar; ?></td>
													<td><?= $resDetail->jml_tunggakan; ?></td>
													<td><?= $resDetail->jml_denda; ?></td>
													<td><?= $resDetail->jml_sp_assign; ?></td>
													<td><?= $resDetail->jml_sp_return; ?></td>
													<td><?= $resDetail->ft_pokok; ?></td>
													<td><?= $resDetail->ft_bunga; ?></td>
													<td><?= $resDetail->ft_hari; ?></td>
													<td><?= $resDetail->kolektibilitas; ?></td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
									<div class="modal-footer bg-light">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">
											Close
										</button>
									</div>
								</div>
							</div>
						</div>
						<!-- /Modal SP Return -->

					</div>
					<!-- content-wrapper ends -->
					<!-- partial:partials/_footer.html -->
					<footer class="footer">
						<div class="container-fluid clearfix">
							<span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
								Copyright © 2018
								<a href="https://dpmsejahtera.com" target="_blank">
									Koperasi dana pinjaman mandiri sejahtera
								</a>
								. All rights reserved.
							</span>
							<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
								KDPMS BISNIS V.1.0.6
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
					<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
					<!-- /Bootstrap 4.3.1 JS -->

					<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
					<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
					<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/kt-2.5.1/r-2.2.3/rg-1.1.1/sc-2.0.1/datatables.min.js"></script>
					<script type="text/javascript">
						$(document).ready(function() {
							function cchart(id_modal,id_table){
								return $(id_modal).on('shown.bs.modal', function () {
									if ( ! $.fn.DataTable.isDataTable(id_table) ) {
										var tbtb = $(id_table).DataTable( {
											responsive: {
												details: {
													renderer: function ( api, rowIdx, columns ) {
														var data = $.map( columns, function ( col, i ) {
															return col.hidden ?
																'<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
																	'<td><b>'+col.title+'</b></td> '+
																	'<td>'+col.data+'</td>'+
																'</tr>' :
																'';
														} ).join('');
									
														return data ?
															$('<table/>').append( data ) :
															false;
													}
												}
											},
											order: [
												[ 0, "desc" ]
											],
											dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
												"<'row'<'col-sm-12't>>" +
												"<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
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

							new cchart('#modal_bz','#dt_tables_bz');
							new cchart('#modal_cr','#dt_tables_cr');
							new cchart('#modal_npl','#dt_tables_npl');
							new cchart('#modal_spr','#dt_tables_spr');

							//loader
							$('#loader').hide('slow', 'linear');
							$('span.spedo').show();

							$('form').submit(function(){
								$('#loader').show();
								$('span.spedo').hide('slow', 'linear');
							});
							//loader
						} );
					</script>

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

					<!-- partial -->
				</div>
				<!-- main-panel ends -->
			</div>
			<!-- page-body-wrapper ends -->
		</div>
		<!-- container-scroller -->
	</body>
</html>
