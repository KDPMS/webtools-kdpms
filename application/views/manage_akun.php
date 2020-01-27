<!DOCTYPE html>
<html lang="en">

<head>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0">
<?php $this->load->view('include/style-css.php') ?>
<?php $this->load->view('include/style-js.php') ?>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php $this->load->view('include/navbar_akun.php') ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <!-- partial -->
      <div class="main-panel" style="width: 100%;">
        <input type="hidden" id="user_id" value="<?php echo $this->uri->segment(3); ?>">
				<div id="myProgress" style="position:fixed;z-index:5;">
				<div id="myBar"></div>
				</div>
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12" id="wadah">
            <div class="col-12 grid-margin">
              <div class="alert alert-danger alert-dismissible fade show" id="alert-salah" style="display: none;" role="alert">
                <strong>Ada yang salah tuh</strong>, <pesansalah></pesansalah>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="alert alert-success alert-dismissible fade show" id="alert-benar" style="display: none;" role="alert">
                <strong>Selamat !</strong>, perubahan berhasil di simpan ...
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="card">
                <div class="card-body">
                  <a href="javascript:void(0)" class="Buttoggle" from="offering"><i class="mdi mdi-dots-horizontal" style="float:right;"></i></a>
                  <h4 style="color: black;"> 
                    <a href="<?php echo base_url('Home') ?>" id="backcn"><i class="mdi mdi-keyboard-backspace"></i></a>&nbsp;&nbsp;&nbsp;Sunting Profile</h4><hr><br>
                  <div class="row">
                  <div class="col-md-6">
                    <div class="card" style="width: 10rem;">
                      <img src="<?php echo $this->session->userdata('foto'); ?>" class="card-img-top rounded-circle" alt="..." style="height:10rem;border:3px solid #c52937;">
                      <div class="card-body">
                        <form id="uploadFoto">
                          <input type="hidden" name="user_id" value="<?php echo $this->uri->segment(3); ?>">
                          <input type="file" name="foto" id="foto"></input><br><br>
                          <button type="submit" class="btn btn-primary" id="btn-uploadFoto">Ganti Foto</button>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                  <form id="form-ganti-pass">
                  <div id="conOffering">
                  <input type="hidden" name="user_id" value="<?php echo $this->uri->segment(3); ?>">
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Password Lama</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" name="password_lama" style="margin-left: -5%; width: 105%;" id="password_lama" placeholder="Masukan Password Lama">
                      </div>
                    </div>
                  </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Password Baru</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" name="password_baru" style="margin-left: -5%; width: 105%;" id="password_baru" placeholder="Masukan Password Baru" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Konfirmasi Password Baru</label>
                      <div class="col-sm-8">
                        <input class="form-control" type="password" name="Konfirmasi_password_baru" id="Konfirmasi_password_baru" style="margin-left: -5%; width: 105%;" placeholder="Konfirmasi Password Baru" />
                      </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-fw" style="width: 100%;" id="btn-ganti-pass">Simpan Perubahan</button>&nbsp;
                  </form>
                  </div>
                  </div>
                        <br>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
</body>
</html>
<script type="text/javascript">
$(document).ready(function () {

  var user_id = $('#user_id').val()
  var loading = '<i class="mdi mdi-18px mdi-spin mdi-loading"></i>'
  var url  = '<?php echo base_url() ?>'

  $('#btn-ganti-pass').attr('disabled','true')
  $('#password_lama').change(function () {
    let password = $(this).val()
    $.ajax({
      type:'GET',
      url:url+'User/CheckPassword/'+user_id+'/'+password,
      dataType:'JSON',
      beforeSend:function () {
        $('#btn-ganti-pass').attr('disabled','true').html(loading+'sedang cek password lama')
      },
      success:function (res) {
        if (res.count == 1) {
          $('#password_lama').css({'border':'1px solid green'})
          $('#btn-ganti-pass').removeAttr('disabled').html('Simpan perubahan')
          $('#alert-salah').hide()
        }else{
          $('#password_lama').css({'border':'1px solid red'})
          $('#alert-salah').show()
          $('pesansalah').html('Password lama tidak cocok !!')
          $('#btn-ganti-pass').attr('disabled','true').html('Simpan Perubahan')
        }
      }
    })
  })

  $('#btn-ganti-pass').click(function () {
    var _passBaru = $('#password_baru').val()
    var _konPass = $('#Konfirmasi_password_baru').val()

    if (_passBaru == '' && _konPass == '') {
      $('#password_baru').css({'border':'1px solid red'})
      $('#Konfirmasi_password_baru').css({'border':'1px solid red'})
      $('#alert-salah').show()
      $('pesansalah').html('Password Tidak Boleh kosong !!')
    }else{
      if (_passBaru == _konPass){
        $('#password_baru').css({'border':'1px solid green'})
        $('#Konfirmasi_password_baru').css({'border':'1px solid green'})
        $('#alert-salah').hide()
        changePassword()
      }else{
        $('#password_baru').css({'border':'1px solid red'})
        $('#Konfirmasi_password_baru').css({'border':'1px solid red'})
        $('#alert-salah').show()
        $('pesansalah').html('Password Tidak sama !!')
      }
    }
  })

  'use strict'
  function changePassword() {
    var data = $('#form-ganti-pass').serialize()
    $.ajax({
      type:'POST',
      url:url+'User/updatePassword',
      dataType:'JSON',
      data:data,
      beforeSend:function () {
        load()
        $('#btn-ganti-pass').attr('disabled','true').html(loading+'loading . . .')
      },
      success:function (res) {
        console.log(res)
        if (res.msg == 'success'){
          $('#btn-ganti-pass').attr('disabled','true').html('Simpan Perubahan')
          $('#alert-benar').show()
          $('#password_lama').val('').removeAttr('style')
          $('#password_baru').val('').removeAttr('style')
          $('#Konfirmasi_password_baru').val('').removeAttr('style')
        }
      }
    })
  }

  $('#uploadFoto').submit(function(e){
    e.preventDefault()
    var data = new FormData(this);
    console.log(data)
    var foto = $('#foto').val()
    if (foto != '') {
      $.ajax({
        type:'POST',
        url:url+'User/uploadFoto',
        data:data,
        processData:false,
        contentType:false,
        cache:false,
        async:true,
        dataType:'JSON',
        beforeSend:function () {
          console.log('mengirim')
          load()
          $('#btn-uploadFoto').prop('disabled',true)
          $('#btn-uploadFoto').html(loading+' Uploading . . .')
        },
        success:function (res) {
          console.log(res)
          if (res.msg == 'success'){
            $('#alert-benar').show()
            $('#btn-uploadFoto').prop('disabled',false)
            $('#btn-uploadFoto').html('Ganti Foto')
            location.reload();
          }
        },
        error:function (xhr, status, error) {
          console.log(xhr.responseText)
          if (xhr.status == 500) {
            swal({
                title:error,
                text:'Server bermasalah, periksa koneksi internet anda.',
                icon: "error"
            });
          }
        }
      })
    }else{
      $('#foto').css({'border':'1px solid red'})
      $('#alert-salah').show()
      $('pesansalah').html('Pilih foto')
    }
  })


  'use strict'
  function load(){
    var elem = document.getElementById("myBar");
    var width = 1;
    var id = setInterval(frame, 10);
    function frame() {
        if (width >= 100) {
            clearInterval(id);
        } else {
            width++;
            elem.style.width = width + '%';
        }
    }
  }

})
</script>