<style type="text/css">
.menu:hover{
	background:#00becc;
	border-radius:100%;
	transition:0.1s;
}
</style>
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
    <a class="navbar-brand" style="padding:18px;" href="javascript:void(0)">
      <h3 style="color:#f0134d;font-family:'Play';">KPI KDPMS</h3>
    </a>
    <a class="navbar-brand brand-logo-mini">
      <img src="<?php echo base_url('assets/images/logo1.png'); ?>" alt="logo" />
    </a>
  </div>
  <input type="hidden" id="session_jabatan" value="<?php echo $this->session->userdata('jabatan'); ?>">
  <div class="navbar-menu-wrapper d-flex align-items-center">
    <span class="profile-text" style="font-weight:bold;color:#ffff32;"><?php if ($this->session->userdata('kantor') == '01'){echo "Kantor Pusat";}elseif($this->session->userdata('kantor') == '02'){echo "Cabang Cilodong";}else{echo "Anda belum login";} ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item dropdown d-none d-xl-inline-block">
        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <span class="profile-text">Hello, <?php echo $this->session->userdata('username'); ?> !</span>
          <img class="img-xs rounded-circle" src="<?php echo $this->session->userdata('foto'); ?>" alt="Profile image">
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
          <a class="dropdown-item p-0">
            <div class="d-flex border-bottom">
              <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
              </div>
              <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                <i class="mdi mdi-account-outline mr-0 text-gray"></i>
              </div>
              <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
              </div>
            </div>
          </a>
          <a href="<?php echo base_url('User/Account/'.$this->session->userdata('id')) ?>" class="dropdown-item mt-2">
            Manage Accounts
          </a>
          <!-- <a href="javascript:void(0)" onClick="alert('Fitur Belum ada')" class="dropdown-item">
            Check Inbox
          </a> -->
          <a class="dropdown-item" href="<?php echo base_url('Login/Logout'); ?>">
            Logout
          </a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
<!-- <script type="text/javascript" src="<#?=base_url('lib/js/changedate.js')?>"></script>
<script>
  var url  = '<#?php echo base_url() ?>'
	var myFunction = function() {
	  $('#tamplate').val('views/content/data/data-caa.php')
		$('#app').load('views/content/data/data-caa.php')
	};
	var myImg = url+'assets/images/logo1.png'
  var session_jabatan = document.getElementById('session_jabatan').value

	function notifDekstopKomite() {
	  setTimeout(function () {
	    var options = {
	      title: 'PEMBERITAHUAN(Persetujuan) ',
	      options: {
	        body: 'Data baru masuk untuk di setujui',
	        icon: myImg,
	        lang: 'en-US',
	        onClick: myFunction
	      }
	    };
	    console.log(options);
	    $("#a").easyNotify(options);
	  },1000)
	}

	if (session_jabatan == 'manager') {
		setInterval(() => {
			getPushnotif('getPushnotif')
		},5000)
	}else if (session_jabatan == 'ketua') {
		setInterval(() => {
			getPushnotif('getPushnotifKetua')
		},5000)
	}

	'use strict'
	function getPushnotif(controller) {
		$.ajax({
			type:'get',
			url:url+'Home/'+controller,
			dataType:'json',
			success:function(res) {
				//console.log(res)
				if (res.total_push > 0) {
					notifDekstopKomite()
					if (session_jabatan == 'manager'){
						UpdatePushNotif('UpdatePushNotif')
					}else if (session_jabatan == 'ketua'){
						UpdatePushNotif('UpdatePushNotifKetua')
					}
				}
			}
		})
	}
	'use strict'
	function UpdatePushNotif(controller) {
		$.ajax({
			type:'get',
			url:url+'Home/'+controller,
			dataType:'json',
			success:function(res) {
				console.log('status push'+res.msg)
			}
		})
	}
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript">
$(document).ready(function() {

  var url  = '<#?php echo base_url() ?>'
	var loading = '<i class="mdi mdi-18px mdi-spin mdi-loading"></i>'
  var session_jabatan = $('#session_jabatan').val()

	var paramsID1 = $('#paramsID1')
	var paramsID2 = $('#paramsID2')
	var paramsID3 = $('#paramsID3')

  if (session_jabatan == 'manager'){
    $('#box_notiv').show();
    setInterval(()=>{
      getCountNotif()
    },5000)
  }else if (session_jabatan == 'ketua'){
    $('#box_notiv').show();
    setInterval(()=>{
      getCountNotifKetua()
    },5000)
  }else{
    $('#box_notiv').hide();
  }

	'use strict'
	function getCountNotif() {
		$.ajax({
			type:'get',
			url:url+'Home/getTotalWaiting',
			dataType:'json',
			success:function(res) {
				$('#count-notif').html(FormatRupiah(res.total_memo_app)).addClass('count')
        $('#messageDropdown').attr('title',FormatRupiah(res.total_memo_app)+' data yang harus di approve ')
			}
		})
	}

  'use strict'
  function getCountNotifKetua() {
    $.ajax({
      type:'get',
      url:url+'Home/getTotalWaitingAppKetua',
      dataType:'json',
      success:function(res) {
        $('#count-notif').html(FormatRupiah(res.total_memo_app)).addClass('count')
        $('#messageDropdown').attr('title',FormatRupiah(res.total_memo_app)+' data yang harus di approve')
      }
    })
  }


	$('#messageDropdown').click(()=>{
		if (session_jabatan == 'manager') {
      dataWaitingApprove()
    }else if (session_jabatan == 'ketua'){
      dataWaitingApproveKetua()
    }
	})

	$('#viewallmsg').click(function () {
  		$('#tamplate').val('views/content/data/data-caa.php')
      $('#app').load('views/content/data/data-caa.php');
	})

	$('#w_msg').on('click','#klikmsg',function(){
		var id_order = $(this).attr('data')
		var id_calon_debitur = $(this).attr('dataIdc')
		load()
		setTimeout(() => {
			paramsID1.val(id_order)
			paramsID2.val(id_calon_debitur)
			$('#tamplate').val('views/content/data/detail-caa.php')
			$('#app').load('views/content/data/detail-caa.php')
		},1000)
	})

	'use strict'
	function dataWaitingApprove() {
		$.ajax({
			type:'get',
			url:url+'Home/dataWaitingApprove',
			dataType:'json',
			beforeSend:function () {
				$('#w_msg').html('&nbsp;&nbsp;&nbsp;'+loading+'Sedang mengambil pesan . . .')
			},
			success:function(res) {
				var html = ''
				$.each(res,function (k,v) {
				if (v.subject.length < 40) {
					var subject = v.subject;
				}else{
					var str = v.subject;
					var subject = str.substring(0,40)+' . . .';
				}

					html += '<div class="dropdown-divider"></div>'+
	          '<a class="dropdown-item preview-item" style="cursor:pointer;" id="klikmsg" data="'+v.id_order+'" dataIdc="'+v.id_calon_debitur+'">'+
	            '<div class="preview-item-content flex-grow">'+
	              '<h6 class="preview-subject ellipsis font-weight-medium text-dark">'+
	              ''+v.pengirim.toUpperCase()+''+
	              '</h6>'+
	              '<p class="font-weight-light small-text">'+
	                ''+subject+''+
	              '</p>'+
                '<span class="small-text" style="color:#a9aeb3;">'+changeDate(v.tgl_buat)+'</span>'+
	            '</div>'+
	          '</a>'
				})
				$('#w_msg').html(html)
			}
		})
	}

  'use strict'
  function dataWaitingApproveKetua() {
    $.ajax({
      type:'get',
      url:url+'Home/dataWaitingAppKetua',
      dataType:'json',
      beforeSend:function () {
        $('#w_msg').html('&nbsp;&nbsp;&nbsp;'+loading+'Sedang mengambil pesan . . .')
      },
      success:function(res) {
        var html = ''
        $.each(res,function (k,v) {
        if (v.notes.length < 40) {
          var notes = v.notes;
        }else{
          var str = v.notes;
          var notes = str.substring(0,40)+' . . .';
        }

          html += '<div class="dropdown-divider"></div>'+
            '<a class="dropdown-item preview-item" style="cursor:pointer;" id="klikmsg" data="'+v.id_order+'" dataIdc="'+v.id_calon_debitur+'">'+
              '<div class="preview-item-content flex-grow">'+
                '<h6 class="preview-subject ellipsis font-weight-medium text-dark">'+
                ''+v.pengirim.toUpperCase()+''+
                '</h6>'+
                '<p class="font-weight-light small-text">'+
                  ''+notes+''+
                '</p>'+
                '<span class="small-text" style="color:#a9aeb3;">'+changeDate(v.tgl_app)+'</span>'+
              '</div>'+
            '</a>'
        })
        $('#w_msg').html(html)
      }
    })
  }

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
</script> -->
