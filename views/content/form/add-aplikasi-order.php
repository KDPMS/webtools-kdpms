<div id="snackbar">Periksa kembali dan mohon lengkapi form !!</div>
<div class="row">
	<div class="col-lg-12">
	<?php include '../component/header-back.php'; ?>
	<?php include '../component/info-detail-cnasabah.php'; ?>
		<div class="card" style="margin-top: 1%;">
			<div class="card-body">
			 <h4>FORM ORDER CALON NASABAH</h4><hr><br>
				<div class="col-12 grid-margin">
					<div class="card">
						<div class="card-body">
							<form class="form-sample" id="form-simpan-order">
                <input type="hidden" name="id_calon_debitur" id="postid_calon">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Account Officer (marketing)</label>
                      <div class="col-sm-9">
                        <div id="opt-ao"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Kantor</label>
                      <div class="col-sm-9">
                        <div id="opt-kantor"></div>
                        <input type="hidden" name="kantor" id="v_kantor">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Plafond</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="plafond" onkeydown="return numbersonly(this, event)" onkeyup="javascript:tandaPemisahTitik(this)" placeholder="Masukan plafond"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Tenor</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="tenor" >
                          <option value="6">6 Bulan</option>
                          <option value="12">12 Bulan</option>
                          <option value="18">18 Bulan</option>
                          <option value="24">24 Bulan</option>
                          <option value="30">30 Bulan</option>
                          <option value="36">36 Bulan</option>
                          <option value="40">40 Bulan</option>
                          <option value="48">48 Bulan</option>
                          <option value="60">60 Bulan</option>
                          <option value="72">72 Bulan</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Jenis Pinjaman</label>
                      <div class="col-sm-9">
                        <div id="opt-jenis-pinjaman"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Tujuan Penggunaan</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" name="tujuan_penggunaan"  placeholder="Masukan Tujuan Penggunaan" ></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Cara Pembayaran</label>
                      <div class="col-sm-9">
                       <select class="form-control" name="cara_pembayaran" >
                          <option value="TRANSFER">TRANSFER</option>
                          <option value="LAINNYA">LAINNYA</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div> 
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Jenis Jaminan</label>
                      <div class="col-sm-9">
                        <div id="opt-jenis_jaminan"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Keterangan Jaminan</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" name="ket_jaminan" placeholder="Masukan Keterangan Jaminan" ></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Upload File Lampiran</label>
                      <div class="col-sm-9">
                        <input type="file" class="form-control" name="lampiran[]" multiple/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Sumber Aplikasi</label>
                      <div class="col-sm-9">
                        <div id="opt-sumber-aplikasi"></div>
                      </div>
                    </div>
                  </div>
                   <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">keterangan</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="keterangan" placeholder="Masukan Keterangan"  />
                      </div>
                    </div>
                  </div>
                </div><br>
              <button type="submit" class="btn btn-primary btn-fw" style="width: 100%;" id="simpan-order">Simpan</button>
              </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
<script type="text/javascript" src="lib/js/url.js"></script>
<script type="text/javascript" src="lib/js/FormatPointInput.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	var loading = '<i class="mdi mdi-18px mdi-spin mdi-loading"></i>'
	var id_calon_debitur = $('#paramsID1').val()
	var kantor_user = parseInt($('#session_kantor').val())

	$('#load_page').val('false');
	$('#title-header').html('Tambah Aplikasi Order')
	$('#postid_calon').val(id_calon_debitur)

	$('#backcn').click(function () {
		$('#load_page').val('false');
		load()
		$('#tamplate').val('views/content/data/data-aplikasi-order.php');
		$('#app').load('views/content/data/data-aplikasi-order.php');
	})

	$('.Buttoggle').click(function () {
		$('#conCnasabah').toggle('slow')
	})

	$('#data_pasangan').hide()
	$('#data_penjamin').hide()

	$('#tab_data_calon').click(function (argument) {
		$(this).addClass('link-active')
		$('#tab_data_pasangan').removeClass('link-active')
		$('#tab_data_penjamin').removeClass('link-active')
		$('#conCnasabah').show()
		$('#data_c_nasabah').show()
		$('#data_pasangan').hide()
		$('#data_penjamin').hide()
	})

	$('#tab_data_pasangan').click(function (argument) {
		$(this).addClass('link-active')
		$('#tab_data_calon').removeClass('link-active')
		$('#tab_data_penjamin').removeClass('link-active')
		$('#conCnasabah').show()
		$('#data_pasangan').show()
		$('#data_penjamin').hide()
		$('#data_c_nasabah').hide()
	})

	$('#tab_data_penjamin').click(function (argument) {
		$(this).addClass('link-active')
		$('#tab_data_calon').removeClass('link-active')
		$('#tab_data_pasangan').removeClass('link-active')
		$('#conCnasabah').show()
		$('#data_penjamin').show()
		$('#data_pasangan').hide()
		$('#data_c_nasabah').hide()
	})

	showDetail(id_calon_debitur)
	showDetailPasangan(id_calon_debitur)
	showDetailPenjamin(id_calon_debitur)
	function showDetail(id_calon_debitur) {
		$.ajax({
			type:'GET',
			url:url+'Home/get_detail_calon_nasabah/'+id_calon_debitur,
			dataType:'JSON',
			beforeSend:function () {
				$('input[type=text]').val('Sedang mengambil . . .')
			},
			beforeSend:function(){
				$('#noktp').html(loading)
				$('#nama_lengkap').html(loading)
				$('#nibk').html(loading)
				$('#alamat').html(loading)
			},
			success:function (data) {
				$.each(data,function (key,val) {
					$('#noktp').html('<p>'+val.no_ktp+'</p>')
					$('#nibk').html('<p>'+val.nama_gadis_ibu_kandung+'</p>')
					$('#nama_lengkap').html('<p>'+val.nama_lengkap+'</p>')
					$('#alamat').html('<p>'+val.alamat+', RT.'+val.rt+' RW.'+val.rw+', KELURAHAN.'+val.Kelurahan+', KECAMATAN.'+val.Kecamatan+', '+val.Kotakab+', PROVINSI '+val.propinsi+'</p>')
				})
			},
			error:function (xhr, status, error) {
				console.log(xhr.responseText)
	        	if (xhr.status == 500) {
	        		swal({
				        title:error,
				        text:'Server bermasalah, periksa koneksi internet anda.',
				        icon: "error",
				        type: "error"
				    });
	        	}
				}
		})
	}

	function showDetailPasangan(id_calon_debitur) {
		$.ajax({
			type:'GET',
			url:url+'Home/get_detail_pasangan/'+id_calon_debitur,
			dataType:'JSON',
			success:function (data) {
				if (data.msg == 'Data tidak ditemukan') {
					$('#data_pasangan').html('<v class="text-danger"><i class="mdi mdi-account-alert"></i> Tidak memiliki data pasangan</v>')
				}else{
					$.each(data,function (key,val) {
						$('#noktp_pasangan').html('<p>'+val.no_ktp+'</p>')
						$('#nama_lengkap_pasangan').html('<p>'+val.nama_lengkap+'</p>')
						$('#nibk_pasangan').html('<p>'+val.nama_gadis_ibu_kandung+'</p>')
						$('#alamat_pasangan').html('<p>'+val.alamat+', RT '+val.rt+' RW '+val.rw+', KELURAHAN '+val.Kelurahan+', KECAMATAN '+val.Kecamatan+', '+val.Kotakab+', PROVINSI '+val.propinsi+'</p>')
					})
				}
			},
			error:function (xhr, status, error) {
				console.log(xhr.responseText)
	        	if (xhr.status == 500) {
	        		swal({
				        title:error,
				        text:'Server bermasalah, periksa koneksi internet anda.',
				        icon: "error",
				        type: "error"
				    });
	        }
			}
		})
	}

	function showDetailPenjamin(id_calon_debitur) {
		$.ajax({
			type:'GET',
			url:url+'Home/get_detail_penjamin/'+id_calon_debitur,
			dataType:'JSON',
			success:function (data) {
				if (data.msg == 'Data tidak ditemukan') {
					$('#data_penjamin').html('<v class="text-danger"><i class="mdi mdi-account-alert"></i> Tidak memiliki data penjamin</v>')
				}else{
					$.each(data,function (key,val) {
						$('#noktp_penjamin').html('<p>'+val.no_ktp+'</p>')
						$('#nama_lengkap_penjamin').html('<p>'+val.nama_lengkap+'</p>')
						$('#nibk_penjamin').html('<p>'+val.nama_gadis_ibu_kandung+'</p>')
						$('#alamat_penjamin').html('<p>'+val.alamat+', RT '+val.rt+' RW '+val.rw+', KELURAHAN '+val.Kelurahan+', KECAMATAN '+val.Kecamatan+', '+val.Kotakab+', PROVINSI '+val.propinsi+'</p>')
					})
				}
			},
			error:function (xhr, status, error) {
				console.log(xhr.responseText)
					if (xhr.status == 500) {
						swal({
					      title:error,
					      text:'Server bermasalah, periksa koneksi internet anda.',
					      icon: "error",
					      type: "error"
					  });
					}
			}
		})
	}


	$('#form-simpan-order').submit(function (e) {
		e.preventDefault();
		var data = new FormData(this);
		var ao = true
		var plafond = true
		var tenor = true
		var jenis_pinjaman = true
		var tujuan_penggunaan = true
		var cara_pembayaran = true
		var jenis_jaminan = true
		var ket_jaminan = true
		var lampiran = true
		var sumber_aplikasi = true
		var keterangan = true

		ao = checkSelect('select[name=ao]')
		plafond = checkEmpty('input[name=plafond]')
		tenor = checkSelect('select[name=tenor]')
		jenis_pinjaman = checkEmpty('textarea[name=jenis_pinjaman]')
		tujuan_penggunaan = checkEmpty('textarea[name=tujuan_penggunaan]')
		cara_pembayaran = checkSelect('select[name=cara_pembayaran]')
		jenis_jaminan = checkSelect('select[name=jenis_jaminan]')
		ket_jaminan = checkEmpty('textarea[name=ket_jaminan]')
		lampiran = checkEmpty('input[name=lampiran]')
		sumber_aplikasi = checkSelect('select[name=sumber_aplikasi]')
		keterangan = checkEmpty('input[name=keterangan]')

		if (ao && plafond && tenor && jenis_pinjaman && tujuan_penggunaan && cara_pembayaran && jenis_jaminan && ket_jaminan && lampiran && sumber_aplikasi && keterangan) {
			add_data_order(data)
		}else{
			console.log('not valid form')
		}
		//add_data_order(data)
	})

	function add_data_order(data) {
		$.ajax({
			type:'POST',
			url:url+'Home/add_data_order',
			data:data,
			processData:false,
			contentType:false,
			cache:false,
			async:true,
			dataType:'JSON',
			beforeSend:function () {
				load()
				$('#load_page').val('true');
				$('button[type=reset]').prop('disabled',true)
				$('#simpan-order').prop('disabled',true)
				$('#simpan-order').html(loading+' Sedang mengirim data . . . ')
			},
			success:function (res) {
				$('#load_page').val('false');
				$('#simpan-order').prop('disabled',false)
				$('#simpan-order').html('Simpan')
				if (res.msg == 'success') {
					$('#simpan-order').prop('disabled',false)
					$('#simpan-order').html('Simpan')
					$('#tamplate').val('views/content/data/data-aplikasi-order.php')
					$('#app').load('views/content/data/data-aplikasi-order.php')
					swal({
				        title: "Sukses!",
				        text: "data berhasil ditambahkan!",
				        icon: "success"
				    });
				}else if (res.msg == 'gagal upload'){
					$('#simpan-order').prop('disabled',false)
					$('#simpan-order').html('Simpan')
					swal({
				        title: "Gagal upload!",
				        text: "Silahkan upload file lampiran",
				        button:false,
				        timer:1500,
				        icon: "error"
				    });
				}
			},
			error:function (xhr, status, error) {
				$('#simpan-order').prop('disabled',false)
				$('#simpan-order').html('Simpan')
				console.log(xhr.responseText)
				if (xhr.status == 500) {
					swal({
					    title:error,
					    text:'Server bermasalah, periksa koneksi internet anda.',
					    icon: "error",
					    type: "error"
					});
            	}
			}
		})
	}

	getJaminan()
	'use strict'
	function getJaminan () {
		$.ajax({
			type:'GET',
			url:url+'Home/data_jaminan',
			dataType:'JSON',
			beforeSend:function () {
				$('#opt-jenis_jaminan').html(loading)
			},
			success:function(data){
			var html = ''
			if (data.amount == 0) {
					html += '<option value="null" selected>Data Jaminan tidak ada</option>'
			}else{
				$.each(data, function(index, value ) {
					html += '<option value="'+value.kode_jenis_jaminan+'">'+'['+value.kode_jenis_jaminan+'] '+value.nama_jenis_jaminan+'</option>'
				//console.log(html)
				})
			}
			$('#opt-jenis_jaminan').html('<select class="form-control" name="jenis_jaminan"><option value="null">Pilih</Option>'+html+'</select>')
			}
		})
	}

	getKantor(kantor_user)
	'use strict'
	function getKantor(kantor_user) {
		$.ajax({
			type:'GET',
			url:url+'Home/kantor',
			dataType:'JSON',
			beforeSend:function () {
				$('#opt-kantor').html(loading)
			},
			success:function(data){
			var html = ''
				$.each(data, function(index, value ) {
					if (value.KODE_KANTOR == kantor_user) {
						html += '<option selected>'+value.nama_area_kerja+'</option>'
						$('#v_kantor').val(value.KODE_KANTOR)
					}else{
						html += '<option>'+value.nama_area_kerja+'</option>'
					}
				//console.log(html)
				})
				$('#opt-kantor').html('<select class="form-control" disabled="true"><option value="null">Pilih</Option>'+html+'</select>')
			}
		})
	}

	getAo()
	'use strict'
	function getAo() {
		$.ajax({
			type:'GET',
			url:url+'Home/ao',
			dataType:'JSON',
			beforeSend:function () {
				$('#opt-ao').html(loading)
			},
			success:function(data){
				var html = ''
				$.each(data, function(index, value ) {
					html += '<option value="'+value.kode_group2+'">'+value.deskripsi_group2+'</option>'
				})
				$('#opt-ao').html('<select class="form-control" name="ao"><option value="null">Pilih</Option>'+html+'</select>')
			}
		})
	}

	sumberAplikasi()
	'use strict'
	function sumberAplikasi() {
		$.ajax({
			type:'GET',
			url:url+'Home/sumberAplikasi',
			dataType:'JSON',
			beforeSend:function () {
				$('#opt-sumber-aplikasi').html(loading)
			},
			success:function(data){
			var html = ''
				$.each(data, function(index, value ) {
					html += '<option value="'+value.KODE_GROUP4+'">'+value.deskripsi_group4+'</option>'
				})
				$('#opt-sumber-aplikasi').html('<select class="form-control" name="sumber_aplikasi"><option value="null">Pilih</Option>'+html+'</select>')
			}
		})
	}

	jenisPinjaman()
	'use strict'
	function jenisPinjaman() {
		$.ajax({
			type:'GET',
			url:url+'Home/jenisPinjaman',
			dataType:'JSON',
			beforeSend:function () {
				$('#opt-jenis-pinjaman').html(loading)
			},
			success:function(data){
			var html = ''
				$.each(data, function(index, value ) {
					html += '<option value="'+value.kode_jenis_pinjaman+'">'+value.nama_jenis_pinjaman+'</option>'
				})
				$('#opt-jenis-pinjaman').html('<select class="form-control" name="jenis_pinjaman"><option value="null">Pilih</Option>'+html+'</select>')
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

	'use strict'
	function checkEmpty(obj) {
		$(obj).css("border","")
		if($(obj).val() == "") {
			$(obj).css("border","#FF0000 1px solid")
			toastNotvalid()
			return false;
		}
		return true;
	}

	'use strict'
	function checkSelect(obj) {
		$(obj).css("border","")
		if($(obj).val() == "null") {
			$(obj).css("border","#FF0000 1px solid")
			toastNotvalid()
		return false;
		}
		return true;
	}

	'use strict'
	function toastNotvalid() {
	    var x = document.getElementById("snackbar")
	    x.className = "show"
	    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000)
	}

})
</script>
