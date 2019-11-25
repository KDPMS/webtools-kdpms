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
  <!-- Canvas Gauge CDN -->
  <script src="//cdn.rawgit.com/Mikhus/canvas-gauges/gh-pages/download/2.1.5/all/gauge.min.js"></script>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php $this->load->view('include/navbarkpi.php') ?>
    <!-- partial -->
    <div class=" page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php $this->load->view('include/sidebar.php') ?>
      <!-- partial -->
      <div class="main-panel" style="width: 100%;">
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
									<div class="col-md-6 text-lg-left text-md-center text-sm-center text-center">
										<form action="<?php echo site_url('kpi/dashboard_kpi'); ?>" method="post">
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
												<button type="submit"class="btn-primary">Filter</button>
											</p>
									</div>
									<div class="col-md-6 text-lg-right text-md-center text-sm-center text-center">
											<p>
												<b>Kantor :
												<select name="kantor" id="kantor">
													<option value="01" <?php if($kantor == '01'){ echo('selected'); } ?>>Pusat</option>
													<option value="02" <?php if($kantor == '02'){ echo('selected'); } ?>>Cabang Cilodong</option>
												</select>
											<button type="submit"class="btn-primary">Filter</button>
										  </p>
										</form>
									</div>
								</div>
							</div>
						</div>
          <hr>
          <div class="row justify-content-center">
          <?php if($dataKpiLending && $dataKpiNpl && $dataKpiCR && $dataKpiBZ != null){ ?>
            <!-- Lending -->
            <?php if($dataKpiLending != null){ ?>
            <span class="rounded-circle" data-popover="popover"
              data-content='<center><b>Lending : <?php echo number_format($dataKpiLending[0]->lending, 2) .' %'; ?> <br>Persentase : <?= number_format($dataKpiLending[0]->jml_value / $dataKpiLending[0]->jml_max_value * 100, 2) .' %' ; ?> <!--Status : Tidak Tercapai--></></center>' data-html='true'
              data-placement='top' data-trigger='hover'>
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
                  data-animation-rule="bounce" data-aimation-duration="500">
                </canvas>
              </a>
            </span>
            <?php }else{echo "";}?>
            <!-- /Lending -->

            <!-- NPL -->
            <?php if($dataKpiNpl != null){ ?>
            <span class="rounded-circle" data-popover="popover" id="popovernpl"
              data-content='<b>NPL : <?php echo $dataKpiNpl[0]->jml_value; ?> <br><br> Baki debet NPL : <?php echo $dataKpiNpl[0]->jml_bd_npl ?> </b><br><br><b> Total Baki debet : <?php echo $dataKpiNpl[0]->jml_bd ?> </b>'
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
            <?php }else{echo "";}?>
            <!-- /NPL -->

            <!-- Collection Ratio -->
            <?php if($dataKpiCR != null){ ?>
            <span class="rounded-circle" data-popover="popover"
              data-content='<center><b>NPL : 1 <br> Status : Bagus</b></center>' data-html='true' data-placement='top'
              data-trigger='hover'>
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
                  data-animation-rule="bounce" data-aimation-duration="500">
                </canvas>
              </a>
            </span>
            <?php }else{echo "";}?>
            <!-- /Collection Ratio -->

            <!-- Bucket Zero -->
            <?php if($dataKpiBZ != null){ ?>
            <span class="rounded-circle" data-popover="popover"
              data-content='<center><b>BZ : 50% <br> Status : Tercapai</b></center>' data-html='true'
              data-placement='top' data-trigger='hover'>
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
                  data-animation-rule="bounce" data-aimation-duration="500">
                </canvas>
              </a>
            </span>
            <?php }else{echo "";}?>
            <!-- /Bucket Zero -->
          <?php }else{?>
            <div class="row align-content-center align-items-center justify-content-center text-center">
              <h2 class="text-danger">
                <b><i class="mdi mdi-alert"></i> 204</b> <br>
                <hr>
                Data Dengan Filter : <br>
                <b><?= ubahBulan($bulan).'-'.$tahun; ?></b> <br>
                Tidak Ditemukan
              </h2>
            </div>
          <?php }; ?>
          </div>
          

          <!-- Modal Lending -->
          <div class="modal fade" id="modal_lending" tabindex="1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable" role="dialog">
              <div class="modal-content">
                <div class="modal-header bg-light">
                  <h5 class="modal-title" id="exampleModalLongTitle">Data Lending Per AO</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row justify-content-center">
                    <?php foreach ($datakpilendingAO as $res) { ?>
                    <span class="rounded-circle" data-popover="popover"
                      data-content='<center><b>Lending : <?= number_format($res->lending, 2).' %'; ?></b><br><br><b>Persentase : <?= number_format($res->jml_value / $res->jml_max_value * 100, 2) .'%'; ?></b></center>' data-html='true' data-placement='top'
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
                          data-animate-on-init="true" data-animation-rule="bounce" data-aimation-duration="500">
                        </canvas>
                      </a>
                    </span>
                    <!-- Modal Detail Per AO -->
                    <?php 

                      $date = "$tahun-$bulan-".date('d'); //NANTI DI SESUAIKAN SESSUAI DENGAN FILTER TANGGAL NYA
                      $this->db->query("SELECT '$date' INTO @pv_per_tgl");
                      $this->db->query("SELECT '$res->kode_group2' INTO @pv_kode_ao");
                      $dataDetail = $this->db->query("SELECT * FROM kms_kpi.v_kpi_ao_lending")->result();
                    ?>
                    <div class="modal fade" id="detail_lending_ao<?php echo $res->kode_group2; ?>" tabindex="5"
                      role="dialog" aria-labelledby="" aria-hidden="true">
                      <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-light">
                            <h5 class="modal-title" id="exampleModalLongTitle">Data Nasabah Lending
                              <p><?php echo $res->deskripsi_group2; ?>, <?php echo $date; ?></p>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <table class="table table-bordered table-hover">
                              <thead class="bg-light">
                                <tr>
                                  <th>Nasabah id</th>
                                  <th>Nama Nasabah</th>
                                  <th>Alamat</th>
                                  <th>Tanggal jatuh tempo</th>
                                  <th>Baki debet</th>
                                  <th>Jumlah pinjaman</th>
                                  <th>Jumlah lending</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($dataDetail as $resDetail) { ?>
                                <tr>
                                  <td><?php echo $resDetail->nasabah_id; ?></td>
                                  <td><?php echo $resDetail->nama_nasabah; ?></td>
                                  <td><?php echo $resDetail->alamat; ?></td>
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
                    <!-- Modal Detail Per AO -->
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
                  <h5 class="modal-title" id="exampleModalLongTitle">Data NPL per Collector</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row justify-content-center">
                  <?php foreach ($dataKpiNplKol as $res) { ?>
                    <span class="rounded-circle" data-popover="popover"
                      data-content='<b>NPL : <?= $res->jml_value; ?></b><br><br><b>Baki debet NPL : <?= $res->jml_bd_npl; ?></b><br><br><b>Total Baki debet : <?= $res->jml_bd; ?></b>' data-html='true' data-placement='top'
                      data-trigger='hover'>
                      <a class="rounded-circle" href="#detail_npl_kol" data-toggle="modal"
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
                  <h5 class="modal-title" id="exampleModalLongTitle">Detail Collection Ratio</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row justify-content-center">
                  <?php foreach ($dataKpiCRKol as $res) { ?>
                    <span class="rounded-circle" data-popover="popover"
                      data-content='<b>CR : <?= $res->jml_value; ?></b><br><br><b>Jumlah Tagihan : <?= $res->jml_tagihan; ?></b><br><br><b>Jumlah Bayar : <?= $res->jml_bayar; ?></b>' data-html='true' data-placement='top'
                      data-trigger='hover'>
                      <a class="rounded-circle" href="#detail_npl_kolektor" data-toggle="modal"
                        data-target="#detail_npl_kolektor" data-backdrop="false">
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
                  <h5 class="modal-title" id="exampleModalLongTitle">Detail Bucket Zero</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row justify-content-center">
                  <?php foreach ($dataKpiBZKol as $res) { ?>
                    <span class="rounded-circle" data-popover="popover"
                      data-content='<b>BZ : <?= $res->jml_value; ?></b><br><br><b>Jumlah Tagihan : <?= $res->jml_tagihan; ?></b><br><br><b>Jumlah Bayar : <?= $res->jml_bayar; ?></b>' data-html='true' data-placement='top'
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

          <!-- Modal Detail Nasabah -->
          <div class="modal fade" id="detail_npl_kolektor" tabindex="5" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header bg-light">
                  <h5 class="modal-title" id="exampleModalLongTitle">Detail Data NPL</h5>
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
              <a href="https://kdpms.id/" target="_blank">Koperasi dana pinjaman mandiri sejahtera</a>. All
              rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">KDPMS BISNIS V.1.0.6
            </span>
          </div>
        </footer>
        <script type="text/javascript" src="<?= base_url('lib/js/formatRupiah.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('lib/js/changedate.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('lib/js/url.js'); ?>"></script>

        <!-- Highcharts CDN -->
        <!-- <script src="https://code.highcharts.com/highcharts.js"></script>
				<script src="https://code.highcharts.com/highcharts-more.js"></script> -->



        <!-- Bootstrap 4.3.1 JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
          integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
          integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <!-- /Bootstrap 4.3.1 JS -->
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

        

        // $(document).ready(function() {
        //   $('#popovernpl').attr('data-content', '<center><b>NPL : ' + res[0].jml_value +
        //     ' <br> Status : Bagus Bagus Bagus Bagus</b></center>');
        //   var gaugeElement = document.getElementById('nplkantor');
        //   getNpl();

        //   function getNpl() {
        //     $.ajax({
        //       type: 'GET',
        //       url: url + 'IndikatorKpi/npl',
        //       dataType: 'JSON',
        //       beforeSend: function() {
        //         console.log('get')
        //       },
        //       success: function(res) {
        //         console.log(res[0].jml_value);
        //         $('#popovernpl').attr('data-content', '<center><b>NPL : ' + res[0].jml_value +
        //           ' <br> Status : Bagus Bagus Bagus Bagus</b></center>');
        //         gaugeElement.setAttribute('data-major-ticks', res[0].mayor_ticks);
        //         gaugeElement.setAttribute('data-minor-ticks', res[0].minor_ticks);
        //         gaugeElement.setAttribute('data-value', '40');
        //         gaugeElement.setAttribute('data-max-value', res[0].jml_max_value);
        //       }
        //     })
        //   }
        // });
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