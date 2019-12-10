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
	<div class="mt-5">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4 text-lg-left text-md-center text-sm-center text-center">
					Bulan : <b><?php echo ubahBulan($bulan); ?></b><br>
					Tahun : <b><?php echo $tahun; ?></b>
				</div>
				<div class="col-md-4 text-lg-center text-md-center text-sm-center text-center">
					<br>
					<form action="<?php echo base_url('kpi/dashboard_kpi_col'); ?>" method="post">
						Filter Data :
						<select name="bulan" id="bulan">
							<?php
							for ($i = 1; $i <= 12; $i++) {
								if ($i < 10) {
									$i = '0' . $i;
								}
								?>
								<option value="<?php echo $i; ?>" <?php if ($bulan == $i) {
																			echo ('selected');
																		} ?>> <?php echo ubahBulan($i); ?></option>
							<?php } ?>
						</select>
						<select name="tahun" id="tahun">
							<?php
							for ($thn = 2019; $thn <= date('Y'); $thn++) {
								?>
								<option value="<?= $thn; ?>" <?php if ($tahun == $thn) {
																		echo ('selected');
																	} ?>><?= $thn; ?></option>
							<?php } ?>
						</select>
						<button class="btn-primary" type="submit">
							Filter
						</button>
					</form>
				</div>
				<div class="col-md-4 text-lg-right text-md-center text-sm-center text-center">
					User :
					<b><?php echo ucfirst($this->session->userdata('username')); ?></b><br>
					Kantor :
					<b><?php echo namaKantor($this->session->userdata('kantor')); ?></b>
				</div>
			</div>
		</div>
	</div>
	<hr />

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
				<div id="bzNull">

				</div>&nbsp;
				<div id="crNull">

				</div>&nbsp;
				<div id="nplNull">

				</div>&nbsp;
				<div id="sprNull">

				</div>&nbsp;
			</div>
		</div>
	</span>
	<!-- end handle data jika null -->

	<div class="row justify-content-center">
		<?php if ($dataKpiBZKol || $dataKpiCRKol || $dataKpiNplKol) { ?>

			<!-- Bucket Zero -->
			<?php if ($dataKpiBZKol != null) { ?>
				<span class="rounded-circle spedo" data-popover="popover" data-content="<b>Bucket Zero : <?php echo number_format($dataKpiBZKol[0]->jml_value, 2); ?> % <br> Status : Tercapai <br> Jumlah Tagihan : <?= rupiah($dataKpiBZKol[0]->jml_tagihan); ?> <br> Jumlah Bayar : <?= rupiah($dataKpiBZKol[0]->jml_bayar); ?> </b>" data-html="true" data-placement="top" data-trigger="hover">
					<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_bz">
						<canvas class="mt-2 mb-2 mx-2 rounded-circle" data-type="radial-gauge" data-width="300" data-height="300" data-units="<?= $dataKpiBZKol[0]->unit; ?>" data-title="<?= $dataKpiBZKol[0]->title; ?>" data-value="<?= $dataKpiBZKol[0]->jml_value; ?>" data-min-value="0" data-max-value="<?= $dataKpiBZKol[0]->jml_max_value; ?>" data-major-ticks="<?= $dataKpiBZKol[0]->mayor_ticks; ?>" data-minor-ticks="<?= $dataKpiBZKol[0]->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?= $dataKpiBZKol[0]->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-animation-duration="1500"></canvas>
					</a>
				</span>
			<?php
				} else {
					echo '<span id="nullBZ" data=""></span>';
				} ?>
			<!-- /Bucket Zero -->

			<!-- Collection Ratio -->
			<?php if ($dataKpiCRKol != null) { ?>
				<span class="rounded-circle spedo" data-popover="popover" data-content="<b>Collection Ratio : <?php echo number_format($dataKpiCRKol[0]->jml_value, 2); ?> % <br> Status : Tidak Tercapai <br> Jumlah Tagihan : <?= rupiah($dataKpiCRKol[0]->jml_tagihan); ?> <br> Jumlah Bayar : <?= rupiah($dataKpiCRKol[0]->jml_bayar); ?></b>" data-html="true" data-placement="top" data-trigger="hover">
					<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_cr">
						<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="map" data-type="radial-gauge" data-width="300" data-height="300" data-units="%" data-title="<?= $dataKpiCRKol[0]->title; ?>" data-value="<?= $dataKpiCRKol[0]->jml_value; ?>" data-min-value="0" data-max-value="<?= $dataKpiCRKol[0]->jml_max_value; ?>" data-major-ticks="<?= $dataKpiCRKol[0]->mayor_ticks; ?>" data-minor-ticks="<?= $dataKpiCRKol[0]->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?= $dataKpiCRKol[0]->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-animation-duration="1500"></canvas>
					</a>
				</span>
			<?php
				} else {
					echo '<span id="nullCR" data=""></span>';
				} ?>
			<!-- /Collection Ratio -->

			<!-- NPL -->
			<?php if ($dataKpiNplKol != null) { ?>
				<span class="rounded-circle spedo" data-popover="popover" data-content="<b>NPL : <?php echo number_format($dataKpiNplKol[0]->jml_value, 2); ?> % <br> Status : Bagus <br> Baki Debet NPL : <?= rupiah($dataKpiNplKol[0]->jml_bd_npl); ?> <br> Tot Baki Debet : <?= rupiah($dataKpiNplKol[0]->jml_bd); ?></b>" data-html="true" data-placement="top" data-trigger="hover">
					<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_npl">
						<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="npl" data-type="radial-gauge" data-width="300" data-height="300" data-units="%" data-title="<?= $dataKpiNplKol[0]->title; ?>" data-value="<?= $dataKpiNplKol[0]->jml_value; ?>" data-min-value="0" data-max-value="<?= $dataKpiNplKol[0]->jml_max_value; ?>" data-major-ticks="<?= $dataKpiNplKol[0]->mayor_ticks; ?>" data-minor-ticks="<?= $dataKpiNplKol[0]->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?= $dataKpiNplKol[0]->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-animation-duration="1500"></canvas>
					</a>
				</span>
			<?php
				} else {
					echo '<span id="nullNPL" data=""></span>';
				} ?>
			<!-- /NPL -->

			<!-- SP Return -->
			<span class="rounded-circle spedo" data-popover="popover" data-content="<b>SP Return : 70% <br> Status : Cukup Tercapai</b>" data-html="true" data-placement="top" data-trigger="hover">
				<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_spr">
					<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="mb" data-type="radial-gauge" data-width="300" data-height="300" data-units="%" data-title="SP Return" data-value="70" data-min-value="0" data-max-value="100" data-major-ticks="0,10,20,30,40,50,60,70,80,90,100" data-minor-ticks="5" data-stroke-ticks="true" data-highlights='[
														{ "from": 0, "to": 25, "color": "#ef4b4b" },
														{ "from": 25, "to": 50, "color": "yellow" },
														{ "from": 50, "to": 75, "color": "green" },
														{ "from": 75, "to": 100, "color": "#0066d6" }
													]' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-animation-duration="1500"></canvas>
				</a>
			</span>
			<!-- /SP Return -->
		<?php } else { ?>
			<span class="spedo">
				<div class="row align-content-center align-items-center justify-content-center text-center">
					<h2 class="text-danger">
						<b><i class="mdi mdi-alert"></i> 204</b> <br>
						<hr>
						Data Dengan Filter : <br>
						<b><?= ubahBulan($bulan) . ' - ' . $tahun; ?></b> <br>
						Tidak Ditemukan
					</h2>
				</div>
			</span>
		<?php }; ?>
	</div>

	<!-- Modal Bucket Zero -->
	<div class="modal fade" id="modal_bz" tabindex="2" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-light">
					<h5 class="modal-title" id="exampleModalLongTitle">Detail Bucket Zero
						<p><?= "Date : &nbsp" . ubahDate($date); ?></p>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table id="dt_tables_bz" class="table table-striped table-bordered table-hover">
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
							<?php foreach ($dataKpiBZKoldetail as $resDetail) { ?>
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
						<p><?= "Date : &nbsp" . ubahDate($date); ?></<p>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table id="dt_tables_cr" class="table table-striped table-bordered table-hover">
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
							<?php foreach ($dataKpiCRKoldetail as $resDetail) { ?>
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
						<p><?= "Date : &nbsp" . ubahDate($date); ?></p>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table id="dt_tables_npl" class="table table-striped table-bordered table-hover">
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
							<?php foreach ($dataKpiNplKoldetail as $resDetail) { ?>
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
	<div class="modal fade" id="modal_spr" tabindex="5" role="dialog" aria-labelledby="" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-header bg-light">
					<h5 class="modal-title" id="exampleModalLongTitle">Detail SP Return
						<p><?= "Date : &nbsp" . ubahDate($date); ?></p>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table id="dt_tables_spr" class="table table-striped table-bordered table-hover">
						<thead class="bg-light">
							<tr>
								<th>Nasabah ID</th>
								<th>Nama Nasabah</th>
								<th>Alamat</th>
								<th>Tanggal Realisasi</th>
								<th>Jangka Waktu</th>
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
							<?php foreach ($dataKpiSpReturnKoldetail as $resDetail) { ?>
								<tr>
									<td><?= $resDetail->nasabah_id; ?></td>
									<td><?= $resDetail->nama_nasabah; ?></td>
									<td><?= $resDetail->alamat; ?></td>
									<td><?= $resDetail->tgl_realisasi; ?></td>
									<td><?= $resDetail->jkw; ?> Bulan</td>
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

<script type="text/javascript">
	$(document).ready(function() {

		//datatable
		function cchart(id_modal, id_table) {
			return $(id_modal).on('shown.bs.modal', function() {
				if (!$.fn.DataTable.isDataTable(id_table)) {
					var tbtb = $(id_table).DataTable({
						responsive: false,
						fixedColumns: {
							leftColumns: 2
						},
						order: [
							[0, "desc"]
						],
						dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
						scrollY: 320,
						scrollX: true,
						scrollCollapse: true,
						scroller: true,
					});
				} else {
					// var tbtb = $.fn.dataTable.fnTables(true);

					// $(tbtb).each(function () {
					// 	$(this).dataTable().fnDestroy();
					// });
				}

				tbtb.columns.adjust();
			});
		}

		new cchart('#modal_bz', '#dt_tables_bz');
		new cchart('#modal_cr', '#dt_tables_cr');
		new cchart('#modal_npl', '#dt_tables_npl');
		new cchart('#modal_spr', '#dt_tables_spr');
		//tutup datatable


		//alert data tidak ada
		var isiBZ = "<div class='alert alert-danger alert-dismissible fade out show' role='alert'>Data <b>BZ</b> Tidak Ada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden=true'>&times;</span></button></div>";
		$('#nullBZ').attr('data', isiBZ);
		var nullBZ = $('#nullBZ').attr('data');
		$('#bzNull').html(nullBZ);

		var isiCR = "<div class='alert alert-danger alert-dismissible fade out show' role='alert'>Data <b>CR</b> Tidak Ada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden=true'>&times;</span></button></div>";
		$('#nullCR').attr('data', isiCR);
		var nullCR = $('#nullCR').attr('data');
		$('#crNull').html(nullCR);

		var isiNPL = "<div class='alert alert-danger alert-dismissible fade out show' role='alert'>Data <b>NPL</b> Tidak Ada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden=true'>&times;</span></button></div>";
		$('#nullNPL').attr('data', isiNPL);
		var nullNPL = $('#nullNPL').attr('data');
		$('#nplNull').html(nullNPL);

		// var isiBz = "<div class='alert alert-danger alert-dismissible fade out show' role='alert'>Data <b>Bucket 0</b> Tidak Ada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden=true'>&times;</span></button></div>";
		// $('#nullBz').attr('data', isiBz);
		// var nullBz = $('#nullBz').attr('data');
		// $('#bzNull').html(nullBz);
		//tutup alert data tidak ada
	});
</script>