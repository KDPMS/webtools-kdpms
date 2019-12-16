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
					<form action="<?php echo base_url('kpi/dashboard_kpi'); ?>" method="post">
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

						<select name="kantor" id="kantor">
							<option value="01" <?php if ($kantor == '01') {
													echo ('selected');
												} ?>>Pusat</option>
							<option value="02" <?php if ($kantor == '02') {
													echo ('selected');
												} ?>>Cabang Cilodong</option>
						</select>
						<button type="submit" class="btn-primary">Filter</button>
					</form>
				</div>
				<div class="col-md-3 text-lg-right text-md-center text-sm-center text-center">
					<br>
					User :
					<b><?php echo ucfirst($this->session->userdata('username')); ?></b><br>
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
				<div id="nsNull">

				</div>&nbsp;
			</div>
		</div>
	</span>
	<!-- end handle data jika null -->

	<div class="row justify-content-center">
		<?php if ($dataKpiLending || $dataKpiNpl || $dataKpiCR || $dataKpiBZ || $dataKpiNS) { ?>

			<!-- Lending -->
			<?php if ($dataKpiLending != null) { ?>
				<span class="rounded-circle spedo" data-popover="popover" data-content='<b> Lending : <?= ubahJuta($dataKpiLending[0]->jml_value); ?> <br> Lending : <?= ambil2Angka($dataKpiLending[0]->lending) . ' %'; ?> <br> Status : <?= getStatusLendingCabang($dataKpiLending[0]->jml_value); ?> </b>' data-html='true' data-placement='top' data-trigger='hover'>
					<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_lending">
						<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="lending" data-type="radial-gauge" data-width="300" data-height="300" data-units="<?php echo $dataKpiLending[0]->unit; ?>" data-title="<?= $dataKpiLending[0]->title; ?>" data-value="<?php echo $dataKpiLending[0]->jml_value; ?>" data-min-value="0" data-max-value="<?php echo $dataKpiLending[0]->jml_max_value; ?>" data-major-ticks="<?php echo $dataKpiLending[0]->mayor_ticks; ?>" data-minor-ticks="<?php echo $dataKpiLending[0]->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?php echo $dataKpiLending[0]->data_spedo; ?>' data-color-plate="black" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-animation-duration="1500">
						</canvas>
					</a>
				</span>
			<?php
				} else {
					echo '<span id="nullLending" data=""></span>';
				} ?>
			<!-- /Lending -->

			<!-- NPL -->
			<?php if ($dataKpiNpl != null) { ?>
				<span class="rounded-circle spedo" data-popover="popover" data-content='<b>NPL : <?= ambil2Angka($dataKpiNpl[0]->jml_value) . " %"; ?> <br> Status : <?= getStatusNPLCabang($dataKpiNpl[0]->jml_value); ?> <br> Baki debet NPL : <?php echo rupiah($dataKpiNpl[0]->jml_bd_npl); ?> <br> Baki debet : <?php echo rupiah($dataKpiNpl[0]->jml_bd); ?></br>' data-html='true' data-placement='top' data-trigger='hover'>
					<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_npl">
						<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="nplkantor" data-type="radial-gauge" data-width="300" data-height="300" data-units="<?php echo $dataKpiNpl[0]->unit; ?>" data-title="<?= $dataKpiNpl[0]->title; ?>" data-value="<?php echo $dataKpiNpl[0]->jml_value; ?>" data-min-value="0" data-max-value="<?php echo $dataKpiNpl[0]->jml_max_value; ?>" data-major-ticks="<?php echo $dataKpiNpl[0]->mayor_ticks; ?>" data-minor-ticks="<?php echo $dataKpiNpl[0]->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?php echo $dataKpiNpl[0]->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-animation-duration="1500">
						</canvas>
					</a>
				</span>
			<?php
				} else {
					echo '<span id="nullNpl" data=""></span>';
				} ?>
			<!-- /NPL -->

			<!-- Collection Ratio -->
			<?php if ($dataKpiCR != null) { ?>
				<span class="rounded-circle spedo" data-popover="popover" data-content='<b>CR : <?= ambil2Angka($dataKpiCR[0]->jml_value) . " %"; ?> <br> Status : <?= getStatusCRCabang($dataKpiCR[0]->jml_value); ?> <br> Jumlah tagihan : <?= rupiah($dataKpiCR[0]->jml_tagihan); ?> <br> Jumlah bayar : <?= rupiah($dataKpiCR[0]->jml_bayar); ?></b>' data-html='true' data-placement='top' data-trigger='hover'>
					<a href="" data-toggle="modal" data-target="#modal_cr">
						<canvas class="mt-2 mb-2 mx-2" id="cr" data-type="radial-gauge" data-width="300" data-height="300" data-units="<?php echo $dataKpiCR[0]->unit; ?>" data-title="<?= $dataKpiCR[0]->title; ?>" data-value="<?php echo $dataKpiCR[0]->jml_value; ?>" data-min-value="0" data-max-value="<?php echo $dataKpiCR[0]->jml_max_value; ?>" data-major-ticks="<?php echo $dataKpiCR[0]->mayor_ticks; ?>" data-minor-ticks="<?php echo $dataKpiCR[0]->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?php echo $dataKpiCR[0]->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-animation-duration="1500">
						</canvas>
					</a>
				</span>
			<?php
				} else {
					echo '<span id="nullCr" data=""></span>';
				} ?>
			<!-- /Collection Ratio -->

			<!-- Bucket Zero -->
			<?php if ($dataKpiBZ != null) { ?>
				<span class="rounded-circle spedo" data-popover="popover" data-content='<b>BZ : <?= ambil2Angka($dataKpiBZ[0]->jml_value) . " %"; ?> <br> Status : <?= getStatusBZCabang($dataKpiBZ[0]->jml_value); ?> <br> Jumlah tagihan : <?= rupiah($dataKpiBZ[0]->jml_tagihan); ?> <br> Jumlah bayar : <?= rupiah($dataKpiBZ[0]->jml_bayar); ?></b>' data-html='true' data-placement='top' data-trigger='hover'>
					<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_bz">
						<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="bz" data-type="radial-gauge" data-width="300" data-height="300" data-units="<?php echo $dataKpiBZ[0]->unit; ?>" data-title="<?= $dataKpiBZ[0]->title; ?>" data-value="<?php echo $dataKpiBZ[0]->jml_value; ?>" data-min-value="0" data-max-value="<?php echo $dataKpiBZ[0]->jml_max_value; ?>" data-major-ticks="<?php echo $dataKpiBZ[0]->mayor_ticks; ?>" data-minor-ticks="<?php echo $dataKpiBZ[0]->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?php echo $dataKpiBZ[0]->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-animation-duration="1500">
						</canvas>
					</a>
				</span>
			<?php
				} else {
					echo '<span id="nullBz" data=""></span>';
				} ?>
			<!-- /Bucket Zero -->

			<!-- Non Starter -->
			<?php if ($dataKpiNS != null) { ?>
				<span class="rounded-circle spedo" data-popover="popover" data-content="<b>Non Starter : <?= ambil2Angka($dataKpiNS[0]->jml_value) . " %"; ?> <br> Status : <?= getStatusNSCabang($dataKpiNS[0]->jml_value); ?> <br> Jumlah Pinjaman FID NS : <?= rupiah($dataKpiNS[0]->jml_pinjaman_fid_ns); ?> <br> Jumlah Pinjaman NS : <?= rupiah($dataKpiNS[0]->jml_pinjaman_ns); ?> </b>" data-html="true" data-placement="top" data-trigger="hover">
					<a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_ns">
						<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="bz" data-type="radial-gauge" data-width="300" data-height="300" data-units="<?php echo $dataKpiNS[0]->unit; ?>" data-title="<?= $dataKpiNS[0]->title; ?>" data-value="<?php echo $dataKpiNS[0]->jml_value; ?>" data-min-value="0" data-max-value="<?php echo $dataKpiNS[0]->jml_max_value; ?>" data-major-ticks="<?php echo $dataKpiNS[0]->mayor_ticks; ?>" data-minor-ticks="<?php echo $dataKpiNS[0]->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?php echo $dataKpiNS[0]->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-animation-duration="1500">
						</canvas>
					</a>
				</span>
			<?php
				} else {
					echo '<span id="nullNS" data=""></span>';
				} ?>
			<!-- /Non Starter -->

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
	<div class="modal fade" id="modal_lending" tabindex="1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
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
							<span class="rounded-circle" data-popover="popover" data-content='<b> Lending : <?= ubahJuta($res->jml_value); ?> <br> Lending : <?= ambil2Angka($res->lending) . '%'; ?> <br> Status : <?= getStatusLendingAO($res->jml_value); ?> </b>' data-html='true' data-placement='top' data-trigger='hover'>
								<a class="rounded-circle" href="#detail_lending_ao" data-toggle="modal" data-target="#detail_lending_ao<?php echo $res->kode_group2; ?>" data-backdrop="false">
									<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="bz" data-type="radial-gauge" data-width="300" data-height="300" data-units="<?php echo $res->unit; ?>" data-title="<?php echo $res->deskripsi_group2; ?>" data-value="<?php echo $res->jml_value; ?>" data-min-value="0" data-max-value="<?php echo $res->jml_max_value; ?>" data-major-ticks="<?php echo $res->mayor_ticks; ?>" data-minor-ticks="<?php echo $res->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?php echo $res->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-animation-duration="1500">
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
	<div class="modal fade" id="modal_npl" tabindex="2" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
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

							<span class="rounded-circle" data-popover="popover" data-content='<b> NPL : <?= ambil2Angka($res->jml_value) . " %"; ?> <br> Status : <?= getStatusNPLKol($res->jml_value); ?> <br> Baki debet NPL : <?= rupiah($res->jml_bd_npl); ?> <br> Baki debet : <?= rupiah($res->jml_bd); ?></b>' data-html='true' data-placement='top' data-trigger='hover'>
								<a class="rounded-circle" href="#detail_npl_kol<?php echo $res->kode_group3; ?>" data-toggle="modal" data-target="#detail_npl_kol<?php echo $res->kode_group3; ?>" data-backdrop="false">
									<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="bz" data-type="radial-gauge" data-width="300" data-height="300" data-units="<?php echo $res->unit; ?>" data-title="<?php echo $res->deskripsi_group3; ?>" data-value="<?php echo $res->jml_value; ?>" data-min-value="0" data-max-value="<?php echo $res->jml_max_value; ?>" data-major-ticks="<?php echo $res->mayor_ticks; ?>" data-minor-ticks="<?php echo $res->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?php echo $res->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-aimation-duration="500">
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
	<div class="modal fade" id="modal_cr" tabindex="3" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
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
							<span class="rounded-circle" data-popover="popover" data-content='<b>CR : <?= ambil2Angka($res->jml_value) . " %"; ?> <br> Status : <?= getStatusCRKol($res->jml_value); ?> <br> Jumlah tagihan : <?= rupiah($res->jml_tagihan); ?> <br> Jumlah bayar : <?= rupiah($res->jml_bayar); ?></b>' data-html='true' data-placement='top' data-trigger='hover'>
								<a class="rounded-circle" href="#detail_cr_kolektor<?php echo $res->kode_group3; ?>" data-toggle="modal" data-target="#detail_cr_kolektor<?php echo $res->kode_group3; ?>" data-backdrop="false">
									<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="bz" data-type="radial-gauge" data-width="300" data-height="300" data-units="<?php echo $res->unit; ?>" data-title="<?php echo $res->deskripsi_group3; ?>" data-value="<?php echo $res->jml_value; ?>" data-min-value="0" data-max-value="<?php echo $res->jml_max_value; ?>" data-major-ticks="<?php echo $res->mayor_ticks; ?>" data-minor-ticks="<?php echo $res->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?php echo $res->data_spedo; ?>' data-color-plate="#000000" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-aimation-duration="1500">
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
	<div class="modal fade" id="modal_bz" tabindex="4" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
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
							<span class="rounded-circle" data-popover="popover" data-content='<b>BZ : <?= ambil2Angka($res->jml_value) . " %"; ?> <br> Status : <?= getStatusBZKol($res->jml_value); ?> <br> Jumlah tagihan : <?= rupiah($res->jml_tagihan); ?> <br> Jumlah bayar : <?= rupiah($res->jml_bayar); ?></b>' data-html='true' data-placement='top' data-trigger='hover'>
								<a class="rounded-circle" href="#detail_bz_kol" data-toggle="modal" data-target="#detail_bz_kol<?php echo $res->kode_group3; ?>" data-backdrop="false">
									<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="bz" data-type="radial-gauge" data-width="300" data-height="300" data-units="<?php echo $res->unit; ?>" data-title="<?php echo $res->deskripsi_group3; ?>" data-value="<?php echo $res->jml_value; ?>" data-min-value="0" data-max-value="<?php echo $res->jml_max_value; ?>" data-major-ticks="<?php echo $res->mayor_ticks; ?>" data-minor-ticks="<?php echo $res->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?php echo $res->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-aimation-duration="500">
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

	<!-- Modal NON STARTER -->
	<div class="modal fade" id="modal_ns" tabindex="4" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-light">
					<h5 class="modal-title" id="exampleModalLongTitle">Detail FID - Non Starter
						<p>Bulan : <?php echo ubahBulan($bulan) . "&nbsp" . $tahun ?></p>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row justify-content-center">
						<?php foreach ($dataKpiNS_AO as $res) { ?>
							<span class="rounded-circle spedo" data-popover="popover" data-content="<b>Non Starter : <?= ambil2Angka($res->jml_value) . " %"; ?> <br> Status : <?= getStatusNSAO($res->jml_value); ?> <br> Jumlah Pinjaman FID NS : <?= rupiah($res->jml_pinjaman_fid_ns); ?> <br> Jumlah Pinjaman NS : <?= rupiah($res->jml_pinjaman_ns); ?> </b>" data-html="true" data-placement="top" data-trigger="hover">
								<a class="rounded-circle" href="#detail_ns_ao" data-toggle="modal" data-target="#detail_ns_ao<?= $res->kode_group2; ?>" data-backdrop="false">
									<canvas class="mt-2 mb-2 mx-2 rounded-circle" id="bz" data-type="radial-gauge" data-width="300" data-height="300" data-units="<?php echo $res->unit; ?>" data-title="<?php echo $res->deskripsi_group2; ?>" data-value="<?php echo $res->jml_value; ?>" data-min-value="0" data-max-value="<?php echo $res->jml_max_value; ?>" data-major-ticks="<?php echo $res->mayor_ticks; ?>" data-minor-ticks="<?php echo $res->minor_ticks; ?>" data-stroke-ticks="true" data-highlights='<?php echo $res->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000" data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee" data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)" data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce" data-aimation-duration="500">
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
	<!-- /Modal NON STARTER -->

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
						<table id="dt_tables_lending<?php echo $res->kode_group2; ?>" cellspacing="0" class="table table-bordered table-hover display compact nowrap" style="width:100%">
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
								<?php foreach ($dataDetail as $resDetail) { ?>
									<tr>
										<td><?php echo $resDetail->nasabah_id; ?></td>
										<td><?php echo $resDetail->nama_nasabah; ?></td>
										<td><?php echo $resDetail->alamat; ?></td>
										<td><?php echo $resDetail->tgl_realisasi; ?></td>
										<td><?= $resDetail->jkw . " Bulan"; ?></td>
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
						<h6 class="mr-auto">TOTAL :  <?= ubahJuta($res->jml_value); ?></h6>
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
							<table id="dt_tables_npl<?php echo $res->kode_group3; ?>" class="table table-bordered table-hover display compact nowrap" style="width:100%">
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
											<td><?= $resDetail->jkw . " Bulan"; ?></td>
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
							<table id="dt_tables_cr<?php echo $res->kode_group3; ?>" class="table table-bordered table-hover display compact nowrap" style="width:100%">
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
											<td><?= $resDetail->jkw . " Bulan"; ?></td>
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
											<td><?= $resDetail->kolektibilitas . " - " . getKolektibilitas($resDetail->kolektibilitas); ?></td>
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
							<table id="dt_tables_bz<?php echo $res->kode_group3; ?>" class="dt_tables table table-bordered table-hover display compact nowrap" style="width:100%">
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
											<td><?= $resDetail->jkw . " Bulan"; ?></td>
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
											<td><?= $resDetail->kolektibilitas . " - " . getKolektibilitas($resDetail->kolektibilitas); ?></td>
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

	<!-- Modal Detail NON STARTER -->
	<?php foreach ($dataKpiNS_AO as $res) { ?>
		<?php

			$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
			$this->db->query("SELECT '$res->kode_group2' INTO @pv_kode_ao");
			$dataDetail = $this->db->query("SELECT * FROM kms_kpi.v_kpi_ao_fid WHERE kode_kantor = '$res->kode_kantor'")->result();
			?>
		<div class="modal fade" id="detail_ns_ao<?php echo $res->kode_group2; ?>" tabindex="5" role="dialog" aria-labelledby="" aria-hidden="true">
			<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
				<div class="modal-content">
					<div class="modal-header bg-light">
						<h5 class="modal-title" id="exampleModalLongTitle">Detail FID - Non Starter
							<p><?php echo $res->deskripsi_group2; ?>,&nbsp;<?php echo ubahBulan($bulan) . "&nbsp" . $tahun ?></p>
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="table-responsive">
							<table id="dt_tables_ns<?php echo $res->kode_group2; ?>" class="dt_tables table table-bordered table-hover display compact nowrap" style="width:100%">
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
									<?php foreach ($dataDetail as $resDetail) { ?>
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
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	<!-- /Modal Detail NON STARTER -->
</div>
<!-- content-wrapper ends -->

<script>
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

		<?php foreach ($datakpilendingAO as $res) { ?>
			new cchart('#detail_lending_ao<?php echo $res->kode_group2; ?>', '#dt_tables_lending<?php echo $res->kode_group2; ?>');
		<?php } ?>

		<?php foreach ($dataKpiNplKol as $res) { ?>
			new cchart('#detail_npl_kol<?php echo $res->kode_group3; ?>', '#dt_tables_npl<?php echo $res->kode_group3; ?>');
		<?php } ?>

		<?php foreach ($dataKpiCRKol as $res) { ?>
			new cchart('#detail_cr_kolektor<?php echo $res->kode_group3; ?>', '#dt_tables_cr<?php echo $res->kode_group3; ?>');
		<?php } ?>

		<?php foreach ($dataKpiBZKol as $res) { ?>
			new cchart('#detail_bz_kol<?php echo $res->kode_group3; ?>', '#dt_tables_bz<?php echo $res->kode_group3; ?>');
		<?php } ?>

		<?php foreach ($dataKpiNS_AO as $res) { ?>
			new cchart('#detail_ns_ao<?php echo $res->kode_group2; ?>', '#dt_tables_ns<?php echo $res->kode_group2; ?>');
		<?php } ?>
		//tutup datatable

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

		var isiNS = "<div class='alert alert-danger alert-dismissible fade out show' role='alert'>Data <b>Non Starter</b> Tidak Ada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden=true'>&times;</span></button></div>";
		$('#nullNS').attr('data', isiNS);
		var nullNS = $('#nullNS').attr('data');
		$('#nsNull').html(nullNS);
		//tutup alert data tidak ada

	});
</script>
