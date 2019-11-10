<!DOCTYPE html>
<html lang="en">

<head>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0">

<?php $this->load->view('include/style-css.php') ?>

</head>
<style type="text/css">
@media screen and (max-width: 960px) {
  *{
    padding:0;
    margin:0;
    bottom:0;
  }
  .auto-form-wrapper{
      margin-left:-5%;
      margin-right:-15%;
  }
}
</style>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
              <?php if ($this->session->userdata('id')) { ?> 
              <div class="text-danger animated shake" style="background:#fff;height:10%;width:100%;border-radius:2px 2px;margin-bottom:2%;padding: 2%;">
              <p>Hallo <?php echo $this->session->userdata('username') ?>, kamu masih mempunyai sesi, <a href="<?php echo base_url('Tools'); ?>"> Kembali</a> , <a href="<?php echo base_url('Login/Logout'); ?>" style="color:red;"> Akhiri sesi!</a></p>
              </div>
              <?php }?>
              <h3>Silahkan Login</h3><br>
              <form method="POST" action="<?php echo base_url('/Login/aksi_login') ?>">
                <div class="form-group">
                  <label class="label">Username</label>
                  <div class="input-group">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Password</label>
                  <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="*********" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <?php if ($this->session->flashdata('errLog')) { ?>
                	<div class="row purchace-popup animated shake">
			            <div class="col-12">
			              <span class="d-block d-md-flex align-items-center">
			                <p style="color:red;">Anda tidak mempunyai Akses atau username dan password salah!!</p>
			                <i class="mdi mdi-close popup-dismiss d-none d-md-block" style="float: right;cursor: pointer;"></i>
			              </span>
			            </div>
			          	</div>
                <?php } ?>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block" id="kliklogin" onclick="Login()">Login</button>
                </div>
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Web Tools KDPMS</span>
                  <a href="javascript:void(0)" class="text-black text-small" target="_blank">V.1.0.8</a>
                </div>
              </form>
            </div><br>
            <p class="footer-text text-center">copyright © 2018 Koperasi Dana Pinjaman Mandiri Sejahtera. All rights reserved</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
</body>
</html>
<script type="text/javascript">
function Login() {
  var username = document.getElementById("username").value
  var password = document.getElementById("password").value
  if (username != '' && password != ''){
    document.getElementById("kliklogin").innerHTML = '<i class="mdi mdi-18px mdi-spin mdi-loading"></i> Sedang Login . . . '
  }
}
</script>