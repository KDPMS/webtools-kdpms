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
					<form action="<?php echo base_url('kpi/dashboard_kpi_ao'); ?>" method="post">
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
						<button class="btn-primary" id="btnFilter" type="submit">Filter</button>
					</form>
				</div>
				<div class="col-md-4 text-lg-right text-md-center text-sm-center text-center">
					User :
					<b><?php echo ucfirst($this->session->userdata('username')); ?></b><br>
					Kantor :
					<b>
						<?php echo namaKantor($this->session->userdata('kantor')); ?>
					</b>
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
				<div id="lendingNull">

				</div>&nbsp;
				<div id="nsNull">

				</div>&nbsp;
				<!-- <div id="bzNull">

				</div>&nbsp; -->
			</div>
		</div>
	</span>
	<!-- end handle data jika null -->
	
	<div class="row justify-content-center">
		<?php if ($dataKpiLendingAO /**|| $dataKpiBZ_AO*/|| $dataKpiNS_AO) { ?>

			<!-- Lending -->
			<?php if ($dataKpiLendingAO != null) { ?>
				<span class="rounded-circle spedo" data-popover="popover" data-content="<b>Lending : <?= ubahJuta($dataKpiLendingAO[0]->jml_value); ?> <br>  Lending : <?= ambil2Angka($dataKpiLendingAO[0]->lending) . '%'; ?> <br> Status : <?= getStatusLendingAO($dataKpiLendingAO[0]->jml_value); ?></b>" data-html="true" data-placement="top" data-trigger="hover">
					<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_lending">
						<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="lending" data-type="radial-gauge" data-width="300" data-height="300" data-units="<?= $dataKpiLendingAO[0]->unit; ?>" data-title="<?= $dataKpiLendingAO[0]->title; ?>" data-value="<?= $dataKpiLendingAO[0]->jml_value; ?>" data-min-value="0" data-max-value="<?= $dataKpiLendingAO[0]->jml_max_value; ?>" data-major-ticks="<?= $dataKpiLendingAO[0]->mayor_ticks; ?>" data-minor-ticks="<?= $dataKpiLendingAO[0]->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?= $dataKpiLendingAO[0]->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-animation-duration="1500"></canvas>
					</a>
				</span>
			<?php
				} else {
					echo '<span id="nullLending" data=""></span>';
				} ?>
			<!-- /Lending -->

			<!-- Non Starter -->
			<?php if ($dataKpiNS_AO != null) { ?>
			<span class="rounded-circle spedo" data-popover="popover" data-content="<b>Non Starter : <?= ambil2Angka($dataKpiNS_AO[0]->jml_value) . " %"; ?> <br> Status : <?= getStatusNSAO($dataKpiNS_AO[0]->jml_value); ?> <br> Jumlah Pinjaman FID NS : <?= rupiah($dataKpiNS_AO[0]->jml_pinjaman_fid_ns); ?> <br> Jumlah Pinjaman NS : <?= rupiah($dataKpiNS_AO[0]->jml_pinjaman_ns); ?> </b>" data-html="true" data-placement="top" data-trigger="hover">
				<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_ns">
					<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="bz" data-type="radial-gauge" data-width="300" data-height="300" data-units="<?= $dataKpiNS_AO[0]->unit; ?>" data-title="<?= $dataKpiNS_AO[0]->title; ?>" data-value="<?= $dataKpiNS_AO[0]->jml_value; ?>" data-min-value="0" data-max-value="<?= $dataKpiNS_AO[0]->jml_max_value; ?>" data-major-ticks="<?= $dataKpiNS_AO[0]->mayor_ticks; ?>" data-minor-ticks="<?= $dataKpiNS_AO[0]->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?= $dataKpiNS_AO[0]->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-animation-duration="1500"></canvas>
				</a>
			</span>
			<?php
				} else {
					echo '<span id="nullNS" data=""></span>';
				} ?>
			<!-- /Non Starter -->

			<!-- Bucket Zero -->
			<!-- <?#php #if ($dataKpiBZ_AO != null) { ?>
				<span class="rounded-circle spedo" data-popover="popover" data-content="<b>BZ : <?= ambil2Angka($dataKpiBZ_AO[0]->jml_value) . " %"; ?> <br> Status : <?= getStatusBZAO($dataKpiBZ_AO[0]->jml_value); ?> <br> Jumlah tagihan : <?= rupiah($dataKpiBZ_AO[0]->jml_tagihan); ?> <br> Jumlah Bayar : <?= rupiah($dataKpiBZ_AO[0]->jml_bayar); ?> </b>" data-html="true" data-placement="top" data-trigger="hover">
					<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_bz">
						<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="bz" data-type="radial-gauge" data-width="300" data-height="300" data-units="<?= $dataKpiBZ_AO[0]->unit; ?>" data-title="<?= $dataKpiBZ_AO[0]->title; ?>" data-value="<?= $dataKpiBZ_AO[0]->jml_value; ?>" data-min-value="0" data-max-value="<?= $dataKpiBZ_AO[0]->jml_max_value; ?>" data-major-ticks="<?= $dataKpiBZ_AO[0]->mayor_ticks; ?>" data-minor-ticks="<?= $dataKpiBZ_AO[0]->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?= $dataKpiBZ_AO[0]->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-animation-duration="1500"></canvas>
					</a>
				</span>
			<?#php
				#} #else {
					#echo '<span id="nullBZ" data=""></span>';
				#} ?> -->
			<!-- /Bucket Zero -->

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

	<!-- Modal Lending -->
	<div class="modal fade" id="modal_lending" tabindex="5" role="dialog" aria-labelledby="" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-header bg-light">
					<h5 class="modal-title" id="exampleModalLongTitle">Detail Lending
						<p><?= "Bulan : &nbsp" . ubahBulan($bulan) . "&nbsp" . $tahun; ?></p>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table id="dt_tables_lending" class="table table-bordered table-hover display compact nowrap" style="width:100%">
							<thead class="bg-light">
								<tr>
									<th>Nasabah ID</th>
									<th>Nama Nasabah</th>
									<th>Jumlah Lending</th>
									<th>Mitra Bisnis</th>
									<th>Alamat</th>
									<th>Tanggal Realisasi</th>
									<th>Jangka Waktu</th>
									<th>Tanggal Jatuh Tempo</th>
									<th>Baki Debet</th>
									<th>Jumlah Pinjaman</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($dataKpiLendingAOdetail as $resDetail) { ?>
									<tr>
										<td><?= $resDetail->nasabah_id; ?></td>
										<td><?= $resDetail->nama_nasabah; ?></td>
										<td><?= rupiah($resDetail->jml_lending); ?></td>
										<?php if($resDetail->deskripsi_group5 != NULL) { ?>
											<td><?= $resDetail->deskripsi_group5; ?></td>
										<?php }else { ?>
											<td> - </td>
										<?php } ?>
										<td><?= $resDetail->alamat; ?></td>
										<td><?= $resDetail->tgl_realisasi; ?></td>
										<td><?= $resDetail->jkw . " Bulan"; ?></td>
										<td><?= $resDetail->tgl_jatuh_tempo; ?></td>
										<td><?= rupiah($resDetail->baki_debet); ?></td>
										<td><?= rupiah($resDetail->jml_pinjaman); ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer bg-light">
					<h6 class="mr-auto">TOTAL :  <?= ubahJuta($dataKpiLendingAO[0]->jml_value); ?> - <?= $dataKpiMap . " MAP"; ?></h6>
					
					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						Close
					</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /Modal Lending -->

	<!-- Modal Bucket Zero -->
	<!-- <div class="modal fade" id="modal_bz" tabindex="4" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-light">
					<h5 class="modal-title" id="exampleModalLongTitle">Detail Bucket Zero
						<p><?= "Bulan : &nbsp" . ubahBulan($bulan) . "&nbsp" . $tahun; ?></p>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table id="dt_tables_bz" class="table table-bordered table-hover display compact nowrap" style="width:100%">
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
									<th>FT Pokok</th>
									<th>FT Bunga</th>
									<th>FT Hari</th>
									<th>Kolektibilitas</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($dataKpiBZ_AOdetail as $resDetail) { ?>
									<tr>
										<td><?= $resDetail->nasabah_id; ?></td>
										<td><?= $resDetail->nama_nasabah; ?></td>
										<td><?= $resDetail->alamat; ?></td>
										<td><?= $resDetail->tgl_realisasi; ?></td>
										<td><?= $resDetail->jkw . " Bulan"; ?></td>
										<td><?= $resDetail->tgl_jatuh_tempo; ?></td>
										<td><?= rupiah($resDetail->baki_debet); ?></td>
										<td><?= rupiah($resDetail->jml_pinjaman); ?></td>
										<td><?= rupiah($resDetail->jml_lending); ?></td>
										<td><?= rupiah($resDetail->jml_tagihan_turun); ?></td>
										<td><?= rupiah($resDetail->jml_tagihan_bayar); ?></td>
										<td><?= rupiah($resDetail->jml_tunggakan); ?></td>
										<td><?= rupiah($resDetail->jml_denda); ?></td>
										<td><?= $resDetail->ft_pokok; ?></td>
										<td><?= $resDetail->ft_bunga; ?></td>
										<td><?= $resDetail->ft_hari; ?></td>
										<td><?= $resDetail->kolektibilitas . " - " . getKolektibilitas($resDetail->kolektibilitas); ?></td>
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
	</div> -->
	<!-- /Modal Bucket Zero -->

	<!-- Modal Non Starter -->
	<div class="modal fade" id="modal_ns" tabindex="6" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-light">
					<h5 class="modal-title" id="exampleModalLongTitle">Detail FID - Non Starter
						<p><?= "Bulan : &nbsp" . ubahBulan($bulan) . "&nbsp" . $tahun; ?></p>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table id="dt_tables_ns" class="table table-bordered table-hover display compact nowrap" style="width:100%">
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
								</tr>
							</thead>
							<tbody>
								<?php foreach ($dataKpiNS_AOdetail as $resDetail) { ?>
									<tr>
										<td><?= $resDetail->nasabah_id; ?></td>
										<td><?= $resDetail->nama_nasabah; ?></td>
										<td><?= $resDetail->alamat; ?></td>
										<td><?= $resDetail->tgl_realisasi; ?></td>
										<td><?= $resDetail->jkw . " Bulan"; ?></td>
										<td><?= $resDetail->tgl_jatuh_tempo; ?></td>
										<td><?= rupiah($resDetail->baki_debet); ?></td>
										<td><?= rupiah($resDetail->jml_pinjaman); ?></td>
										<td><?= rupiah($resDetail->jml_lending); ?></td>
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
	<!-- /Modal Non Starter -->

</div>
<!-- content-wrapper ends -->

<script type="text/javascript">
	$(document).ready(function() {

		//datatable
		function cchart(id_modal, id_table) {
			return $(id_modal).on('shown.bs.modal', function() {
				if (!$.fn.DataTable.isDataTable(id_table)) {
					var tbtb = $(id_table).DataTable({
						// responsive: false,
						language: {
							decimal:        "",
							emptyTable:     "Tidak Ada Data",
							info:           "Menampilkan _START_ sampai _END_ dari total _TOTAL_ baris",
							infoEmpty:      "Menampilkan 0 sampai 0 dari total 0 baris",
							infoFiltered:   "(Filter dari total _MAX_ baris)",
							infoPostFix:    "",
							thousands:      ",",
							lengthMenu:     "Tampilkan _MENU_ baris",
							loadingRecords: "Memuat...",
							processing:     "Proses...",
							search:         "Cari:",
							zeroRecords:    "Tidak ada data yang sesuai",
							paginate: {
								first:      "Pertama",
								last:       "Terakhir",
								next:       "Selanjutnya",
								previous:   "Sebelumnya"
							},
							aria: {
								sortAscending:  ": Aktifkan Berdasarkan paling Awal",
								sortDescending: ": Aktifkan Berdasarkan paling Akhir"
							}
						},
						autoWidth : true,
						pagingType: "simple_numbers",
						lengthMenu: [ [5, 10, 25, 50, 100, -1], [5,10,25,50,100, "Semua"] ],
						responsive: {
							details: {
								renderer: function ( api, rowIdx, columns ) {
									var data = $.map( columns, function ( col, i ) {
										return col.hidden ?
											'<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
												'<td>'+col.title+' : '+'</td> '+
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
						columnDefs: [ {
							className: 'control',
							orderable: true,
							targets:   0
						} ],
						// fixedColumns: {
						// 	leftColumns: 2
						// },
						order: [
							[0, "desc"]
						],
						dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
							"<'row'<'col-sm-12't>>" +
							"<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
						// scrollY: 320,
						// scrollX: true,
						// scrollCollapse: true,
						// scroller: true,
					});
				} else {
					tbtb.columns.adjust();
					// var tbtb = $.fn.dataTable.fnTables(true);

					// $(tbtb).each(function () {
					// 	$(this).dataTable().fnDestroy();
					// });
				}

				tbtb.columns.adjust();
			});
		}


		new cchart('#modal_lending', '#dt_tables_lending');
		// new cchart('#modal_bz', '#dt_tables_bz');
		new cchart('#modal_ns', '#dt_tables_ns');
		//tutup datatable

		//alert data tidak ada
		var isiLending = "<div class='alert alert-danger alert-dismissible fade out show' role='alert'>Data <b>Lending</b> Tidak Ada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden=true'>&times;</span></button></div>";
		$('#nullLending').attr('data', isiLending);
		var nullLending = $('#nullLending').attr('data');
		$('#lendingNull').html(nullLending);

		// var isiBZ = "<div class='alert alert-danger alert-dismissible fade out show' role='alert'>Data <b>Bucket 0</b> Tidak Ada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden=true'>&times;</span></button></div>";
		// $('#nullBZ').attr('data', isiBZ);
		// var nullBZ = $('#nullBZ').attr('data');
		// $('#bzNull').html(nullBZ);

		var isiNS = "<div class='alert alert-danger alert-dismissible fade out show' role='alert'>Data <b>Non Starter</b> Tidak Ada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden=true'>&times;</span></button></div>";
		$('#nullNS').attr('data', isiNS);
		var nullNS = $('#nullNS').attr('data');
		$('#nsNull').html(nullNS);
		//tutup alert data tidak ada

	});
</script>
