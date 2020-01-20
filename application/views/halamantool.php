<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0">

  <?php $this->load->view('include/style-css.php') ?>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php $this->load->view('include/navbarkpi.php') ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial -->
      <div class="main-panel" style="width: 100%;">
        <div class="content-wrapper">
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
  <!-- plugins:js -->
  <script src="<?php echo base_url('lib/vendors/js/vendor.bundle.base.js') ?>"></script>
  <script src="<?php echo base_url('lib/vendors/js/vendor.bundle.addons.js') ?>"></script>
  <!-- endinject -->
</body>

</html>