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

	<div class="col-md-12">
		<div class="row mt-5">
			<div class="col-12 text-xs-center text-xl-left text-lg-left text-md-left text-sm-center">
				<a href="<?= base_url('tools'); ?>" class="btn btn-secondary btn-sm mt-n3"><i class="mdi mdi-keyboard-backspace"></i>Menu Tools</a>
			</div>
		</div>

		<div class="row mt-2">
			<div class="col-md-4 text-lg-left text-md-center text-sm-center text-center">
				Bulan : <b><?php echo ubahBulan($bulan); ?></b><br>
				Tahun : <b><?php echo $tahun; ?></b>
			</div>
			<div class="col-md-4 text-lg-center text-md-center text-sm-center text-center">
				<form action="<?php echo base_url('kpi/dashboard_kpi_ao'); ?>" method="post" class="form-inline justify-content-center mt-1">
				Filter Data : &nbsp;
					<select name="bulan" id="bulan" class="custom-select custom-select-sm my-1 mr-sm-2">
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
					<select name="tahun" id="tahun" class="custom-select custom-select-sm my-1 mr-sm-2">
						<?php
						for ($thn = 2019; $thn <= date('Y'); $thn++) {
						?>
							<option value="<?= $thn; ?>" <?php if ($tahun == $thn) {
																echo ('selected');
															} ?>><?= $thn; ?></option>
						<?php } ?>
					</select>
					<button class="btn btn-sm btn-primary" id="btnFilter" type="submit">Filter</button>
				</form>
			</div>
			<div class="col-md-4 text-lg-right text-md-center text-sm-center text-center">
				User :
				<b><?php echo ucfirst($this->session->userdata('username')); ?></b>
				<br>
				Kantor :
				<b>
					<?php echo namaKantor($this->session->userdata('kantor')); ?>
				</b>
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
				<div id="crNull">

				</div>&nbsp;
				<div id="nsNull">

				</div>&nbsp;
				<div id="bzNull">

				</div>&nbsp;
			</div>
		</div>
	</span>
	<!-- end handle data jika null -->

	<div class="row justify-content-center">
		<?php if ($lending_ao || $cr_per_ao || $bz_ao || $ns_ao) { ?>

			<!-- Lending -->
			<?php 
			 
			 if ($lending_ao != null) { 
				$tampung = getDataSpedo($lending_ao[0]->data_spedo);	 
			?>
				<span class="rounded-circle spedo" data-popover="popover" data-content="<b>Lending : <?= ubahJuta($lending_ao[0]->jml_value); ?> <br> Lending (%) : <?= ambil2Angka($lending_ao[0]->lending) . ' %'; ?> <br> Status : <?= getStatus($lending_ao[0]->jml_value, $tampung[0], $tampung[3], $tampung[6], $tampung[9]); ?></b>" data-html="true" data-placement="top" data-trigger="hover">
					<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_lending">
						<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="lending" data-type="radial-gauge" data-width="300" data-height="300" data-units="<?= $lending_ao[0]->unit; ?>" data-title="<?= $lending_ao[0]->title; ?>" data-value="<?= $lending_ao[0]->jml_value; ?>" data-min-value="0" data-max-value="<?= $lending_ao[0]->jml_max_value; ?>" data-major-ticks="<?= $lending_ao[0]->mayor_ticks; ?>" data-minor-ticks="<?= $lending_ao[0]->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?= $lending_ao[0]->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-animation-duration="1500"></canvas>
					</a>
				</span>
			<?php
				} else {
					echo '<span id="nullLending" data=""></span>';
				} 
			?>
			<!-- /Lending -->

			<!-- Collection Ratio -->
			<?php 
			
			 if ($cr_per_ao != null) { 
				 $tampung = getDataSpedo($cr_per_ao[0]->data_spedo);	 
			?>
				<span class="rounded-circle spedo" data-popover="popover" data-content="<b>Collection Ratio : <?php echo number_format($cr_per_ao[0]->jml_value, 2); ?> % <br> Status : <?= getStatus($cr_per_ao[0]->jml_value, $tampung[0], $tampung[3], $tampung[6], $tampung[9]); ?> <br> Jumlah Tagihan : <?= rupiah($cr_per_ao[0]->jml_tagihan); ?> <br> Jumlah Bayar : <?= rupiah($cr_per_ao[0]->jml_bayar); ?></b>" data-html="true" data-placement="top" data-trigger="hover">
					<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_cr">
						<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="map" data-type="radial-gauge" data-width="300" data-height="300" data-units="%" data-title="<?= $cr_per_ao[0]->title; ?>" data-value="<?= $cr_per_ao[0]->jml_value; ?>" data-min-value="0" data-max-value="<?= $cr_per_ao[0]->jml_max_value; ?>" data-major-ticks="<?= $cr_per_ao[0]->mayor_ticks; ?>" data-minor-ticks="<?= $cr_per_ao[0]->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?= $cr_per_ao[0]->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-animation-duration="1500"></canvas>
					</a>
				</span>
			<?php
			} else {
				echo '<span id="nullCR" data=""></span>';
			} ?>
			<!-- /Collection Ratio -->

			<!-- Non Starter -->
			<?php 
			 
			 if ($ns_ao != null) {
				$tampung = getDataSpedo($ns_ao[0]->data_spedo);
			?>
				<span class="rounded-circle spedo" data-popover="popover" data-content="<b>Non Starter : <?= ambil2Angka($ns_ao[0]->jml_value) . " %"; ?> <br> Status : <?= getStatusNPL($ns_ao[0]->jml_value, $tampung[0], $tampung[3], $tampung[6], $tampung[9]); ?> <br> Jumlah Pinjaman FID NS : <?= rupiah($ns_ao[0]->jml_pinjaman_fid_ns); ?> <br> Total Jumlah Pinjaman NS : <?= rupiah($ns_ao[0]->jml_pinjaman_ns); ?> </b>" data-html="true" data-placement="top" data-trigger="hover">
					<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_ns">
						<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="bz" data-type="radial-gauge" data-width="300" data-height="300" data-units="<?= $ns_ao[0]->unit; ?>" data-title="<?= $ns_ao[0]->title; ?>" data-value="<?= $ns_ao[0]->jml_value; ?>" data-min-value="0" data-max-value="<?= $ns_ao[0]->jml_max_value; ?>" data-major-ticks="<?= $ns_ao[0]->mayor_ticks; ?>" data-minor-ticks="<?= $ns_ao[0]->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?= $ns_ao[0]->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-animation-duration="1500"></canvas>
					</a>
				</span>
			<?php
				} else {
					echo '<span id="nullNS" data=""></span>';
				} 
			?>
			<!-- /Non Starter -->

			<!-- Bucket Zero -->
			<?php 
			 
			 if ($bz_ao != null) { 
				$tampung = getDataSpedo($bz_ao[0]->data_spedo);	 
			?>
				<span class="rounded-circle spedo" data-popover="popover" data-content="<b>BZ : <?= ambil2Angka($bz_ao[0]->jml_value) . " %"; ?> <br> Status : <?= getStatus($bz_ao[0]->jml_value, $tampung[0], $tampung[3], $tampung[6], $tampung[9]); ?> <br> Jumlah tagihan : <?= rupiah($bz_ao[0]->jml_tagihan); ?> <br> Jumlah Bayar : <?= rupiah($bz_ao[0]->jml_bayar); ?> </b>" data-html="true" data-placement="top" data-trigger="hover">
					<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_bz">
						<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="bz" data-type="radial-gauge" data-width="300" data-height="300" data-units="<?= $bz_ao[0]->unit; ?>" data-title="<?= $bz_ao[0]->title; ?>" data-value="<?= $bz_ao[0]->jml_value; ?>" data-min-value="0" data-max-value="<?= $bz_ao[0]->jml_max_value; ?>" data-major-ticks="<?= $bz_ao[0]->mayor_ticks; ?>" data-minor-ticks="<?= $bz_ao[0]->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?= $bz_ao[0]->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-animation-duration="1500"></canvas>
					</a>
				</span>
			<?php
				} else {
					echo '<span id="nullBZ" data=""></span>';
				} 
			?>
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
						<p><?= $this->session->userdata('username'); ?>, <?= ubahBulan($bulan) . "&nbsp" . $tahun; ?></p>
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
									<th>No Rekening</th>
									<th>Nama Nasabah</th>
									<th>Mitra Bisnis</th>
									<th>Tanggal Realisasi</th>
									<th>Jangka Waktu</th>
									<th>Tanggal Jatuh Tempo</th>
									<th>Jumlah Lending</th>
									<th>Baki Debet</th>
									<th>Jumlah Pinjaman</th>
									<th>Alamat</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($lending_detail as $resDetail) { ?>
									<tr>
										<td><?= $resDetail->no_rekening; ?></td>
										<td><?= $resDetail->nama_nasabah; ?></td>
										<?php echo ($resDetail->deskripsi_group5 != NULL ? "<td>" . (($resDetail->deskripsi_group5) == "kantor" ? ucfirst("mediator") : ucfirst($resDetail->deskripsi_group5)) . "</td>" : "<td> - </td>"); ?>
										<td><?= ubahDate($resDetail->tgl_realisasi); ?></td>
										<td><?= $resDetail->jkw . " Bulan"; ?></td>
										<td><?= ubahDate($resDetail->tgl_jatuh_tempo); ?></td>
										<td><?= rupiah($resDetail->jml_lending); ?></td>
										<td><?= rupiah($resDetail->baki_debet); ?></td>
										<td><?= rupiah($resDetail->jml_pinjaman); ?></td>
										<td><?= $resDetail->alamat; ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer bg-light">
					<h6 class="mr-auto"><?= $jml_map . " MAP"; ?> - TOTAL : <?= ubahJuta($lending_ao[0]->jml_value); ?></h6>

					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						Close
					</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /Modal Lending -->

	<!-- Modal Collection Ratio -->
	<div class="modal fade" id="modal_cr" tabindex="4" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-light">
					<h5 class="modal-title" id="exampleModalLongTitle">Detail Collection Ratio
						<p><?= $this->session->userdata('username'); ?>, <?= ubahBulan($bulan) . "&nbsp" . $tahun; ?><p>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table id="dt_tables_cr" class="table table-bordered table-hover display compact nowrap" style="width:100%">
						<thead class="bg-light">
							<tr>
								<th>No Rekening</th>
								<th>Nama Nasabah</th>
								<th>Alamat</th>
								<th>Tanggal Realisasi</th>
								<th>Jangka Waktu</th>
								<th>Tanggal Jatuh Tempo</th>
								<th>Baki Debet</th>
								<th>Jumlah Pinjaman</th>
								<th>Jumlah Lending</th>
								<th>Angsuran per Bulan</th>
								<th>Total Jumlah Tunggakan</th>
								<th>Total Tagihan</th>
								<th>Sisa Tunggakan</th>
								<th>Jumlah Denda</th>
								<th>Jumlah Pembayaran</th>
								<th>FT Pokok</th>
								<th>FT Bunga</th>
								<th>FT Hari Awal</th>
								<th>FT Hari</th>
								<th>Kolektibilitas</th>
								<th>Last Payment</th>
								<!-- <th>Status</th> -->
							</tr>
						</thead>
						<tbody>
							<?php foreach ($cr_ao_detail as $resDetail) { ?>
								<tr>
									<td><?= $resDetail->no_rekening; ?></td>
									<td><?= $resDetail->nama_nasabah; ?></td>
									<td><?= $resDetail->alamat; ?></td>
									<td><?= ubahDate($resDetail->tgl_realisasi); ?></td>
									<td><?= $resDetail->jkw . " Bulan"; ?></td>
									<td><?= ubahDate($resDetail->tgl_jatuh_tempo); ?></td>
									<td><?= rupiah($resDetail->baki_debet); ?></td>
									<td><?= rupiah($resDetail->jml_pinjaman); ?></td>
									<td><?= rupiah($resDetail->jml_lending); ?></td>
									<td><?= rupiah($resDetail->jml_tagihan_turun); ?></td>
									<td><?= rupiah($resDetail->jml_tunggakan); ?></td>
									<td><?= rupiah($resDetail->total_tagihan); ?></td>
									<td><?= rupiah($resDetail->sisa_tunggakan); ?></td>
									<td><?= rupiah($resDetail->jml_denda); ?></td>
									<td><?= rupiah($resDetail->jml_tagihan_bayar); ?></td>
									<td><?= $resDetail->ft_pokok . " Bulan"; ?></td>
									<td><?= $resDetail->ft_bunga . " Bulan"; ?></td>
									<td><?= convertDayMonth($resDetail->ft_hari_awal); ?></td>
									<td><?= convertDayMonth($resDetail->ft_hari); ?></td>
									<td><?= $resDetail->kolektibilitas . " - " . getKolektibilitas($resDetail->kolektibilitas); ?></td>
									<td><?= ($resDetail->last_payment !== null) ? ubahDate($resDetail->last_payment) : " - "; ?></td>
									<!-- <td><#?= cekBayar($resDetail->last_payment); ?></td> -->
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

	<!-- Modal Bucket Zero -->
	<div class="modal fade" id="modal_bz" tabindex="4" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-light">
					<h5 class="modal-title" id="exampleModalLongTitle">Detail Bucket Zero
						<p><?= $this->session->userdata('username'); ?>, <?= ubahBulan($bulan) . "&nbsp" . $tahun; ?></p>
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
									<th>No Rekening</th>
									<th>Nama Nasabah</th>
									<th>Alamat</th>
									<th>Tanggal Realisasi</th>
									<th>Jangka Waktu</th>
									<th>Tanggal Jatuh Tempo</th>
									<th>Baki Debet</th>
									<th>Jumlah Pinjaman</th>
									<th>Jumlah Lending</th>
									<th>Angsuran Per Bulan</th>
									<th>Total Jumlah Tunggakan</th>
									<th>Jumlah Denda</th>
									<th>Jumlah Pembayaran</th>
									<th>FT Pokok</th>
									<th>FT Bunga</th>
									<th>FT Hari</th>
									<th>Kolektibilitas</th>
									<th>Last Payment</th>
									<!-- <th>Status</th> -->
								</tr>
							</thead>
							<tbody>
								<?php foreach ($bz_detail as $resDetail) { ?>
									<tr>
										<td><?= $resDetail->no_rekening; ?></td>
										<td><?= $resDetail->nama_nasabah; ?></td>
										<td><?= $resDetail->alamat; ?></td>
										<td><?= ubahDate($resDetail->tgl_realisasi); ?></td>
										<td><?= $resDetail->jkw . " Bulan"; ?></td>
										<td><?= ubahDate($resDetail->tgl_jatuh_tempo); ?></td>
										<td><?= rupiah($resDetail->baki_debet); ?></td>
										<td><?= rupiah($resDetail->jml_pinjaman); ?></td>
										<td><?= rupiah($resDetail->jml_lending); ?></td>
										<td><?= rupiah($resDetail->jml_tagihan_turun); ?></td>
										<td><?= rupiah($resDetail->jml_tunggakan); ?></td>
										<td><?= rupiah($resDetail->jml_denda); ?></td>
										<td><?= rupiah($resDetail->jml_tagihan_bayar); ?></td>
										<td><?= $resDetail->ft_pokok . " Bulan"; ?></td>
										<td><?= $resDetail->ft_bunga . " Bulan"; ?></td>
										<td><?= convertDayMonth($resDetail->ft_hari); ?></td>
										<td><?= $resDetail->kolektibilitas . " - " . getKolektibilitas($resDetail->kolektibilitas); ?></td>
										<td><?= ($resDetail->last_payment !== null) ? ubahDate($resDetail->last_payment)  : " - "; ?></td>
										<!-- <td><#?= cekBayar($resDetail->last_payment); ?></td> -->
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
	<!-- /Modal Bucket Zero -->

	<!-- Modal Non Starter -->
	<div class="modal fade" id="modal_ns" tabindex="6" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-light">
					<h5 class="modal-title" id="exampleModalLongTitle">Detail FID - Non Starter
						<p><?= $this->session->userdata('username'); ?>, <?= ubahBulan($bulan) . "&nbsp" . $tahun; ?></p>
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
									<th>No Rekening</th>
									<th>Nama Nasabah</th>
									<th>Tanggal Realisasi</th>
									<th>Jangka Waktu</th>
									<th>Tanggal Jatuh Tempo</th>
									<th>Baki Debet</th>
									<th>Jumlah Pinjaman</th>
									<th>Jumlah Lending</th>
									<th>FT Hari</th>
									<th>Total Tagihan</th>
									<th>Jumlah Pembayaran</th>
									<th>Alamat</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($ns_detail as $resDetail) { ?>
									<tr>
										<td><?= $resDetail->no_rekening; ?></td>
										<td><?= $resDetail->nama_nasabah; ?></td>
										<td><?= ubahDate($resDetail->tgl_realisasi); ?></td>
										<td><?= $resDetail->jkw . " Bulan"; ?></td>
										<td><?= ubahDate($resDetail->tgl_jatuh_tempo); ?></td>
										<td><?= rupiah($resDetail->baki_debet); ?></td>
										<td><?= rupiah($resDetail->jml_pinjaman); ?></td>
										<td><?= rupiah($resDetail->jml_lending); ?></td>
										<td><?= convertDayMonth($resDetail->ft_hari); ?></td>
										<td><?= rupiah($resDetail->total_tagihan); ?></td>
										<td><?= rupiah($resDetail->jml_tagihan_bayar); ?></td>
										<td><?= $resDetail->alamat; ?></td>
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

<?php require_once('include/footerkpi.php'); ?>

<script type="text/javascript">
	$(document).ready(function() {

		//datatable
		function cchart(id_modal, id_table) {
			return $(id_modal).on('shown.bs.modal', function() {
				if (!$.fn.DataTable.isDataTable(id_table)) {
					var tbtb = $(id_table).DataTable({
						// responsive: false,
						language: {
							decimal: "",
							emptyTable: "Tidak Ada Data",
							info: "Menampilkan _START_ sampai _END_ dari total _TOTAL_ baris",
							infoEmpty: "Menampilkan 0 sampai 0 dari total 0 baris",
							infoFiltered: "(Filter dari total _MAX_ baris)",
							infoPostFix: "",
							thousands: ",",
							lengthMenu: "Tampilkan _MENU_ baris",
							loadingRecords: "Memuat...",
							processing: "Proses...",
							search: "Cari:",
							zeroRecords: "Tidak ada data yang sesuai",
							paginate: {
								first: "Pertama",
								last: "Terakhir",
								next: "Selanjutnya",
								previous: "Sebelumnya"
							},
							aria: {
								sortAscending: ": Aktifkan Berdasarkan paling Awal",
								sortDescending: ": Aktifkan Berdasarkan paling Akhir"
							}
						},
						autoWidth: true,
						pagingType: "simple_numbers",
						lengthMenu: [
							[7, 10, 25, 50, 100],
							[7, 10, 25, 50, 100]
						],
						responsive: {
							details: {
								renderer: function(api, rowIdx, columns) {
									var data = $.map(columns, function(col, i) {
										return col.hidden ?
											'<tr data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '">' +
											'<td>' + col.title + ' : ' + '</td> ' +
											'<td>' + col.data + '</td>' +
											'</tr>' :
											'';
									}).join('');

									return data ?
										$('<table/>').append(data) :
										false;
								}
							}
						},
						columnDefs: [{
							className: 'control',
							orderable: true,
							targets: 0
						}],
						// fixedColumns: {
						// 	leftColumns: 2
						// },
						dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
							"<'row'<'col-sm-12't>>" +
							"<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
						// scrollY: 320,
						// scrollX: true,
						// scrollCollapse: true,
						// scroller: true,
					});
				} else {
					// var tbtb = $.fn.dataTable.fnTables(true);

					// $(tbtb).each(function () {
					// 	$(this).dataTable().fnDestroy();
					// });
				}

				//tbtb.columns.adjust().responsive.recalc();
			});
		}

		function cchart2(id_modal, id_table,colgrp) {
			return $(id_modal).on('shown.bs.modal', function() {
				if (!$.fn.DataTable.isDataTable(id_table)) {
					var tbtb = $(id_table).DataTable({
						// responsive: false,
						language: {
							decimal: "",
							emptyTable: "Tidak Ada Data",
							info: "Menampilkan _START_ sampai _END_ dari total _TOTAL_ baris",
							infoEmpty: "Menampilkan 0 sampai 0 dari total 0 baris",
							infoFiltered: "(Filter dari total _MAX_ baris)",
							infoPostFix: "",
							thousands: ",",
							lengthMenu: "Tampilkan _MENU_ baris",
							loadingRecords: "Memuat...",
							processing: "Proses...",
							search: "Cari:",
							zeroRecords: "Tidak ada data yang sesuai",
							paginate: {
								first: "Pertama",
								last: "Terakhir",
								next: "Selanjutnya",
								previous: "Sebelumnya"
							},
							aria: {
								sortAscending: ": Aktifkan Berdasarkan paling Awal",
								sortDescending: ": Aktifkan Berdasarkan paling Akhir"
							}
						},
						rowGroup: {
							dataSrc: colgrp
						},
						autoWidth: true,
						pagingType: "simple_numbers",
						lengthMenu: [
							[5, 10, 25, 50, 100, -1],
							[5, 10, 25, 50, 100, "Semua"]
						],
						responsive: {
							details: {
								renderer: function(api, rowIdx, columns) {
									var data = $.map(columns, function(col, i) {
										return col.hidden ?
											'<tr data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '">' +
											'<td>' + col.title + ' : ' + '</td> ' +
											'<td>' + col.data + '</td>' +
											'</tr>' :
											'';
									}).join('');

									return data ?
										$('<table/>').append(data) :
										false;
								}
							}
						},
						columnDefs: [{
							className: 'control',
							orderable: true,
							targets: 0
						}],
						// fixedColumns: {
						// 	leftColumns: 2
						// },
						order: [
							[colgrp, "desc"]
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
					// var tbtb = $.fn.dataTable.fnTables(true);

					// $(tbtb).each(function () {
					// 	$(this).dataTable().fnDestroy();
					// });
				}

				//tbtb.columns.adjust().responsive.recalc();
			});
		}


		new cchart('#modal_lending', '#dt_tables_lending');
		new cchart2('#modal_bz', '#dt_tables_bz',16);
		new cchart2('#modal_cr', '#dt_tables_cr',19);
		new cchart('#modal_ns', '#dt_tables_ns');
		//tutup datatable

		//alert data tidak ada
		var isiLending = "<div class='alert alert-danger alert-dismissible fade out show' role='alert'>Data <b>Lending</b> Tidak Ada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden=true'>&times;</span></button></div>";
		$('#nullLending').attr('data', isiLending);
		var nullLending = $('#nullLending').attr('data');
		$('#lendingNull').html(nullLending);

		var isiBZ = "<div class='alert alert-danger alert-dismissible fade out show' role='alert'>Data <b>Bucket 0</b> Tidak Ada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden=true'>&times;</span></button></div>";
		$('#nullBZ').attr('data', isiBZ);
		var nullBZ = $('#nullBZ').attr('data');
		$('#bzNull').html(nullBZ);

		var isiNS = "<div class='alert alert-danger alert-dismissible fade out show' role='alert'>Data <b>Non Starter</b> Tidak Ada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden=true'>&times;</span></button></div>";
		$('#nullNS').attr('data', isiNS);
		var nullNS = $('#nullNS').attr('data');
		$('#nsNull').html(nullNS);

		var isiCR = "<div class='alert alert-danger alert-dismissible fade out show' role='alert'>Data <b>CR</b> Tidak Ada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden=true'>&times;</span></button></div>";
		$('#nullCR').attr('data', isiCR);
		var nullCR = $('#nullCR').attr('data');
		$('#crNull').html(nullCR);
		//tutup alert data tidak ada

	});
</script>
