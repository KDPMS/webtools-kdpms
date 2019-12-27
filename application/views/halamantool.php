<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0">

  <?php $this->load->view('include/style-css.php') ?>
  <?php $this->load->view('include/style-js.php') ?>
</head>

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
    <div class="container-fluid page-body-wrapper">
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
          <center>
            <div id="pilihan" style="margin-top: 15%;">
              <a href="<?php echo base_url('home') ?>" style="color: #fff; text-decoration: none; font-size: 15pt;">
                <button class="btn btn-info " style="box-shadow: 1px 1px 10px gray; width: 300px; height: 150px;">
                  Web Bisnis
                </button></a>

                
              <!-- DI ARAHKAN SETIAP USER NYA KALAU AO KEHALAMAN AO, SESUAI AKSES NYA AJA GIMANA -->
              <?php
                $jabatan = $this->session->userdata('jabatan');
                if($jabatan == 'ketua' || $jabatan == 'manager') {
              ?>
                <a href="<?php echo base_url('kpi/dashboard_kpi'); ?>"
                  style="color: #fff; text-decoration: none; font-size: 15pt;"><button class="btn btn-primary "
                  style="box-shadow: 1px 1px 10px gray; width: 300px; height: 150px;">Dashboard Kpi</button></a>
                <?php
                  }elseif($jabatan == 'marketing') {
                ?>
                <a href="<?php echo base_url('kpi/dashboard_kpi_ao'); ?>"
                  style="color: #fff; text-decoration: none; font-size: 15pt;"><button class="btn btn-primary "
                  style="box-shadow: 1px 1px 10px gray; width: 300px; height: 150px;">Dashboard Kpi</button></a>
                <?php
                  }elseif($jabatan == 'kolektor') {
                ?>
                <a href="<?php echo base_url('kpi/dashboard_kpi_col'); ?>"
                  style="color: #fff; text-decoration: none; font-size: 15pt;"><button class="btn btn-primary "
                  style="box-shadow: 1px 1px 10px gray; width: 300px; height: 150px;">Dashboard Kpi</button></a>
                <?php
                  }else{
                ?>
                <a onclick="return alert('Anda tidak memiliki akses!')"
                  style="color: #fff; text-decoration: none; font-size: 15pt;"><button class="btn btn-primary "
                  style="box-shadow: 1px 1px 10px gray; width: 300px; height: 150px;">Dashboard Kpi</button></a>
                <?php } ?>

              <!-- <a onclick="return alert('Fitur masih dalam pengembangan')"
                style="color: #fff; text-decoration: none; font-size: 15pt;"><button class="btn btn-primary "
                  style="box-shadow: 1px 1px 10px gray; width: 300px; height: 150px;">Dashboard Kpi</button></a> -->
              <!-- YANG INI DASHBOARD KPI PER KANTOR, NNTI SESSUAI IN AJA GIMANA ALUR NYA -->
              <!-- --------------------- -->
            </div>
          </center>
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
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
</body>

</html>