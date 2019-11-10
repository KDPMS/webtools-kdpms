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
                <div class="col-md-6 text-lg-left text-md-center text-sm-center text-center">
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
                <div class="col-md-6 text-lg-right text-md-center text-sm-center text-center">
                  <p>Kantor : Pusat</p>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row justify-content-center">
            <!-- Lending -->
            <span class="rounded-circle" data-popover="popover"
              data-content='<center><b>Lending : 30% <br> Status : Tidak Tercapai</b></center>' data-html='true'
              data-placement='top' data-trigger='hover'>
              <a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_lending">
                <canvas class="mt-2 mb-2 mx-2 rounded-circle" id="lending" data-type="radial-gauge" data-width="300"
                  data-height="300" data-units="<?php echo $dataKpiLending[0]->unit; ?>" data-title="Lending" data-value="<?php echo $dataKpiLending[0]->jml_value; ?>" data-min-value="0"
                  data-max-value="<?php echo $dataKpiLending[0]->jml_max_value; ?>" 
                  data-major-ticks="<?php echo $dataKpiLending[0]->mayor_ticks; ?>" 
                  data-minor-ticks="<?php echo $dataKpiLending[0]->minor_ticks; ?>"
                  data-stroke-ticks="true" data-highlights='<?php echo $dataKpiLending[0]->data_spedo; ?>' 
                  data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000"
                  data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee"
                  data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)"
                  data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce"
                  data-aimation-duration="500">
                </canvas>
              </a>
            </span>
            <!-- /Lending -->

            <!-- NPL -->
            <span class="rounded-circle" data-popover="popover" id="popovernpl" data-content='<b>NPL : <?php echo $dataKpiNpl[0]->jml_value; ?> <br><br> Baki debet NPL : <?php echo $dataKpiNpl[0]->jml_bd_npl ?> </b><br><br><b> Total Baki debet : <?php echo $dataKpiNpl[0]->jml_bd ?> </b>' data-html='true'
              data-placement='top' data-trigger='hover'>
              <a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_npl">
                <canvas class="mt-2 mb-2 mx-2 rounded-circle" id="nplkantor" data-type="radial-gauge" data-width="300"
                  data-height="300" data-units="<?php echo $dataKpiNpl[0]->unit; ?>" data-title="NPL"
                  data-value="<?php echo $dataKpiNpl[0]->jml_value; ?>" 
									data-min-value="0"
                  data-max-value="<?php echo $dataKpiNpl[0]->jml_max_value; ?>"
                  data-major-ticks="<?php echo $dataKpiNpl[0]->mayor_ticks; ?>"
                  data-minor-ticks="<?php echo $dataKpiNpl[0]->minor_ticks; ?>" 
									data-stroke-ticks="true"
                  data-highlights='<?php echo $dataKpiNpl[0]->data_spedo; ?>' 
									data-color-plate="#010101" 
									data-color-major-ticks="#000000" 
									data-color-minor-ticks="#000000"
                  data-color-title="#fff" data-color-units="#ccc" 
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
            <!-- /NPL -->

            <!-- Collection Ratio -->
            <span class="rounded-circle" data-popover="popover"
              data-content='<center><b>NPL : 1 <br> Status : Bagus</b></center>' data-html='true' data-placement='top'
              data-trigger='hover'>
              <a href="" data-toggle="modal" data-target="#modal_cr">
                <canvas class="mt-2 mb-2 mx-2" id="cr" data-type="radial-gauge" data-width="300" data-height="300"
                  data-units="<?php echo $dataKpiCR[0]->unit; ?>" data-title="CR" 
                  data-value="<?php echo $dataKpiCR[0]->jml_value; ?>" 
                  data-min-value="0" 
                  data-max-value="<?php echo $dataKpiCR[0]->jml_max_value; ?>"
                  data-major-ticks="<?php echo $dataKpiCR[0]->mayor_ticks; ?>" 
                  data-minor-ticks="<?php echo $dataKpiCR[0]->minor_ticks; ?>" 
                  data-stroke-ticks="true"
                  data-highlights='<?php echo $dataKpiCR[0]->data_spedo; ?>' 
                  data-color-plate="#010101" 
                  data-color-major-ticks="#000000" 
                  data-color-minor-ticks="#000000"
                  data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee"
                  data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)"
                  data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce"
                  data-aimation-duration="500">
                </canvas>
              </a>
            </span>
            <!-- /Collection Ratio -->

            <!-- Bucket Zero -->
            <span class="rounded-circle" data-popover="popover"
              data-content='<center><b>BZ : 50% <br> Status : Tercapai</b></center>' data-html='true'
              data-placement='top' data-trigger='hover'>
              <a class="rounded-circle" href="" data-toggle="modal" data-target="#modal_bz">
                <canvas class="mt-2 mb-2 mx-2 rounded-circle" id="bz" data-type="radial-gauge" data-width="300"
                  data-height="300" 
                  data-units="<?php echo $dataKpiBZ[0]->unit; ?>" 
                  data-title="BZ" 
                  data-value="<?php echo $dataKpiBZ[0]->jml_value; ?>" 
                  data-min-value="0"
                  data-max-value="<?php echo $dataKpiBZ[0]->jml_max_value; ?>" 
                  data-major-ticks="<?php echo $dataKpiBZ[0]->mayor_ticks; ?>" 
                  data-minor-ticks="<?php echo $dataKpiBZ[0]->minor_ticks; ?>"
                  data-stroke-ticks="true" data-highlights='<?php echo $dataKpiBZ[0]->data_spedo; ?>' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000"
                  data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee"
                  data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)"
                  data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce"
                  data-aimation-duration="500">
                </canvas>
              </a>
            </span>
            <!-- /Bucket Zero -->
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
                    <span class="rounded-circle" data-popover="popover"
                      data-content='<center><b>Lending : 30% <br> Status : Tidak Tercapai</b></center>' data-html='true'
                      data-placement='top' data-trigger='hover'>
                      <a class="rounded-circle" href="#detail_lending_ao" data-toggle="modal"
                        data-target="#detail_lending_ao" data-backdrop="false">
                        <canvas class="mt-2 mb-2 mx-2 rounded-circle" id="lending" data-type="radial-gauge"
                          data-width="300" data-height="300" data-units="%" data-title="AO 1" data-value="30"
                          data-min-value="0" data-max-value="100" data-major-ticks="0,10,20,30,40,50,60,70,80,90,100"
                          data-minor-ticks="5" data-stroke-ticks="true" data-highlights='[
													{ "from": 0, "to": 25, "color": "#ef4b4b" },
													{ "from": 25, "to": 50, "color": "yellow" },
													{ "from": 50, "to": 75, "color": "green" },
													{ "from": 75, "to": 100, "color": "#0066d6" }
												]' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000"
                          data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee"
                          data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)"
                          data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce"
                          data-aimation-duration="500">
                        </canvas>
                      </a>
                    </span>
                    <span class="rounded-circle" data-popover="popover"
                      data-content='<center><b>Lending : 50% <br> Status : Tidak Tercapai</b></center>' data-html='true'
                      data-placement='top' data-trigger='hover'>
                      <a class="rounded-circle" href="#detail_lending_ao" data-toggle="modal"
                        data-target="#detail_lending_ao" data-backdrop="false">
                        <canvas class="mt-2 mb-2 mx-2 rounded-circle" id="lending" data-type="radial-gauge"
                          data-width="300" data-height="300" data-units="%" data-title="AO 2" data-value="50"
                          data-min-value="0" data-max-value="100" data-major-ticks="0,10,20,30,40,50,60,70,80,90,100"
                          data-minor-ticks="5" data-stroke-ticks="true" data-highlights='[
													{ "from": 0, "to": 25, "color": "#ef4b4b" },
													{ "from": 25, "to": 50, "color": "yellow" },
													{ "from": 50, "to": 75, "color": "green" },
													{ "from": 75, "to": 100, "color": "#0066d6" }
												]' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000"
                          data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee"
                          data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)"
                          data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce"
                          data-aimation-duration="500">
                        </canvas>
                      </a>
                    </span>
                    <span class="rounded-circle" data-popover="popover"
                      data-content='<center><b>Lending : 40% <br> Status : Tidak Tercapai</b></center>' data-html='true'
                      data-placement='top' data-trigger='hover'>
                      <a class="rounded-circle" href="#detail_lending_ao" data-toggle="modal"
                        data-target="#detail_lending_ao" data-backdrop="false">
                        <canvas class="mt-2 mb-2 mx-2 rounded-circle" id="lending" data-type="radial-gauge"
                          data-width="300" data-height="300" data-units="%" data-title="AO 3" data-value="40"
                          data-min-value="0" data-max-value="100" data-major-ticks="0,10,20,30,40,50,60,70,80,90,100"
                          data-minor-ticks="5" data-stroke-ticks="true" data-highlights='[
													{ "from": 0, "to": 25, "color": "#ef4b4b" },
													{ "from": 25, "to": 50, "color": "yellow" },
													{ "from": 50, "to": 75, "color": "green" },
													{ "from": 75, "to": 100, "color": "#0066d6" }
												]' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000"
                          data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee"
                          data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)"
                          data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce"
                          data-aimation-duration="500">
                        </canvas>
                      </a>
                    </span>
                    <span class="rounded-circle" data-popover="popover"
                      data-content='<center><b>Lending : 70% <br> Status : Tidak Tercapai</b></center>' data-html='true'
                      data-placement='top' data-trigger='hover'>
                      <a class="rounded-circle" href="#detail_lending_ao" data-toggle="modal"
                        data-target="#detail_lending_ao" data-backdrop="false">
                        <canvas class="mt-2 mb-2 mx-2 rounded-circle" id="lending" data-type="radial-gauge"
                          data-width="300" data-height="300" data-units="%" data-title="AO 4" data-value="70"
                          data-min-value="0" data-max-value="100" data-major-ticks="0,10,20,30,40,50,60,70,80,90,100"
                          data-minor-ticks="5" data-stroke-ticks="true" data-highlights='[
													{ "from": 0, "to": 25, "color": "#ef4b4b" },
													{ "from": 25, "to": 50, "color": "yellow" },
													{ "from": 50, "to": 75, "color": "green" },
													{ "from": 75, "to": 100, "color": "#0066d6" }
												]' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000"
                          data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee"
                          data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)"
                          data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce"
                          data-aimation-duration="500">
                        </canvas>
                      </a>
                    </span>
                    <span class="rounded-circle" data-popover="popover"
                      data-content='<center><b>Lending : 100% <br> Status : Tidak Tercapai</b></center>'
                      data-html='true' data-placement='top' data-trigger='hover'>
                      <a class="rounded-circle" href="#detail_lending_ao" data-toggle="modal"
                        data-target="#detail_lending_ao" data-backdrop="false">
                        <canvas class="mt-2 mb-2 mx-2 rounded-circle" id="lending" data-type="radial-gauge"
                          data-width="300" data-height="300" data-units="%" data-title="AO 5" data-value="100"
                          data-min-value="0" data-max-value="100" data-major-ticks="0,10,20,30,40,50,60,70,80,90,100"
                          data-minor-ticks="5" data-stroke-ticks="true" data-highlights='[
													{ "from": 0, "to": 25, "color": "#ef4b4b" },
													{ "from": 25, "to": 50, "color": "yellow" },
													{ "from": 50, "to": 75, "color": "green" },
													{ "from": 75, "to": 100, "color": "#0066d6" }
												]' data-color-plate="#010101" data-color-major-ticks="#000000" data-color-minor-ticks="#000000"
                          data-color-title="#fff" data-color-units="#ccc" data-color-numbers="#eee"
                          data-color-needle="rgba(240, 128, 128, 1)" data-color-needle-end="rgba(255, 160, 122, .9)"
                          data-value-box="true" data-animate-on-init="true" data-animation-rule="bounce"
                          data-aimation-duration="500">
                        </canvas>
                      </a>
                    </span>
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
                  <h5 class="modal-title" id="exampleModalLongTitle">Detail NPL</h5>
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

                </div>
                <div class="modal-footer bg-light">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <!-- /Modal Bucket Zero -->

          <!-- Modal Detail Per AO -->
          <div class="modal fade" id="detail_lending_ao" tabindex="5" role="dialog" aria-labelledby=""
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header bg-light">
                  <h5 class="modal-title" id="exampleModalLongTitle">Data Nasabah</h5>
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
                        <td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detail_nasabah"
                            data-backdrop="false">Detail</button></td>
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
          <!-- Modal Detail Per AO -->

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
              <a href="https://dpmsejahtera.com" target="_blank">Koperasi dana pinjaman mandiri sejahtera</a>. All
              rights reserved.</span>
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