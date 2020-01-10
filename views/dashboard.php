<style type="text/css">
#graforder{
	background:#ffaf00;
	padding:7%;
	font-size:15pt;
}
#graforder:hover{
	background:none !important;
	border:1px solid #ffaf00;
	color:black;
	transition:0.3s;
	cursor:pointer;
}

#grafkredit{
	background:#e65251;
	width:90%;
	padding:7%;
}
#grafkredit:hover{
	background:none !important;
	border:1px solid #e65251;
	color:black;
	transition:0.3s;
	cursor:pointer;
}

#grafao{
	background:#6c757d;
	width:70%;
	padding:7%;
}
#grafao:hover{
	background:none !important;
	border:1px solid #6c757d;
	color:black;
	transition:0.3s;
	cursor:pointer;
}

#grafca{
	background:#8862e0;
	width:50%;
	padding:7%;
}
#grafca:hover{
	background:none !important;
	border:1px solid #8862e0;
	color:black;
	transition:0.3s;
	cursor:pointer;
}

#grafapproval{
	background:#00ce68;
	width:30%;
	padding:7%;
}
#grafapproval:hover{
	background:none !important;
	border:1px solid #00ce68;
	color:black;
	transition:0.3s;
	cursor:pointer;
}
[tooltip] {
  position: relative; /* opinion 1 */
}

/* Applies to all tooltips */
[tooltip]::before,
[tooltip]::after {
  text-transform: none; /* opinion 2 */
  font-size: .9em; /* opinion 3 */
  line-height: 1;
  user-select: none;
  pointer-events: none;
  position: absolute;
  display: none;
  opacity: 0;
}
[tooltip]::before {
  content: '';
  border: 5px solid transparent; /* opinion 4 */
  z-index: 1001; /* absurdity 1 */
}
[tooltip]::after {
  content: attr(tooltip); /* magic! */
  
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
  z-index: 1000; /* absurdity 2 */
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

</style>
<p>Data Keseluruhan : <kt></kt> - <tg></tg></p>
<hr>
<div class="row">
	<div class="col-md-3">
			<div class="stretch-card" style="height:95%">
			  <div class="card card-statistics" style="margin-top: -3%;">
			    <div class="card-body" style="text-align:center;">
			    	<div class="clearfix" style="margin-top: -7%;">
		          <div class="float-left">
		            <i class="mdi mdi-chart-line text-danger icon-lg" style="font-size:25pt;"></i>
		          </div>
		          <div class="float-right"><br>
		            <b><h5 class="mb-0 text-right">Funnel Data</h5></b>
		          </div>
		        </div><hr><br>
			    	<center style="color:white;">
			    	<div id="graforder" tooltip="" flow="right">
			    		
			    	</div>
			    	<div id="grafkredit" tooltip="" flow="right">
			    		
			    	</div>
			    	<div id="grafao" tooltip="" flow="right">
			    		
			    	</div>
			    	<div id="grafca" tooltip="" flow="right">
			    		
			    	</div>
			    	<div id="grafapproval" tooltip="" flow="right">
			    		
			    	</div>
			    	</center>
			    </div>
			    <!-- <br>
			  	<p style="margin-left:5%;">
			  		<label class="badge badge-warning"> Order</label>
			  		<label class="badge badge-danger"> Kredit Chechking</label>
			  		<label class="badge badge-dark"> Memo Ao</label>
			  		<label class="badge badge-info"> Memo Ca</label>
			  		<label class="badge badge-success"> Approval</label>
			  	</p><br> -->
			  </div>
			</div>
	</div>
	<div class="col-sm-9">
		<div class="row">
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-8 grid-margin stretch-card">
			  <div class="card card-statistics" style="margin-top: -3%;">
			    <div class="card-body">
			      <div class="clearfix" style="margin-top: -7%;">
			        <div class="float-left">
			          <i class="mdi mdi-shopping text-warning icon-lg" style="font-size:25pt;"></i>
			        </div>
			        <div class="float-right"><br>
			          <b><h5 class="mb-0 text-right">ORDER</h5></b><br>
			        </div>
			      </div>
			        <div class="row">
			          <div class="col-md-6 col-xs-6 text-left" >
			            <p style="font-size:8.6pt">TOTAL</p>
			            <h5 id="total_order"></h5>
			          </div>
			          <div class="col-md-6 col-xs-6 text-center" style="text-align: right; border-left: 1px solid #e5e5e5;">
			            <p style="font-size:8.6pt">DI PROSES</p>
			            <h5 id="total_s_order"></h5>
			          	<!-- <p class="text-muted mt-3 mb-0" id="total_pengajuan_v" style="font-size:8pt"></p> -->
			          </div>
			          <!-- <div class="col-md-4" style="text-align: right; border-left: 1px solid #e5e5e5;">
			            <p style="font-size:8.6pt">MENUNGGU</p>
			            <h5 id="total_p_order"></h5>
			          	<p class="text-muted mt-3 mb-0" id="total_pengajuan_vb" style="font-size:8pt"></p>
			          </div> -->
			        </div>
			        <p class="text-muted mt-3 mb-0" style="font-size:8.6pt;margin-top:1%;">
			        	<i class="mdi mdi-database mr-1" aria-hidden="true"></i>Total Pengajuan :&nbsp;&nbsp; <b style="font-size:11pt;" id="total_pengajuan" ></b>
			      	</p>
			    </div>
			  </div>
			</div>
		  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-8 grid-margin stretch-card">
		    <div class="card card-statistics" style="margin-top: -3%;">
		      <div class="card-body">
		        <div class="clearfix" style="margin-top: -7%;">
		          <div class="float-left">
		            <i class="mdi mdi-credit-card text-danger icon-lg" style="font-size:25pt;"></i>
		          </div>
		          <div class="float-right"><br>
		            <b><h5 class="mb-0 text-right">KREDIT CHECKING</h5></b><br>
		          </div>
		        </div>
		      <div class="row">
		            <div class="col-md-4 text-left" >
		              <p style="font-size:8.6pt">TOTAL</p>
		              <h5 id="total_kredit_checking"></h5>
		            </div>
		            <div class="col-md-4" style="text-align: right; border-left: 1px solid #e5e5e5;">
		              <p style="font-size:8.6pt">PROSES<p>
		              <h5 id="total_kredit_on_p"></h5>
		            </div>
		            <div class="col-md-4" style="text-align: right; border-left: 1px solid #e5e5e5;">
		              <p style="font-size:8.6pt">SELESAI<p>
		              <h5 id="total_kredit_done"></h5>
		            </div>
		          </div>
		      </div>
		    </div>
		  </div>
		  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-8 grid-margin stretch-card">
		    <div class="card card-statistics" style="margin-top: -3%;">
		      <div class="card-body">
		        <div class="clearfix" style="margin-top: -7%;">
		          <div class="float-left">
		            <i class="mdi mdi-account-check text-gray icon-lg" style="font-size:25pt;"></i>
		          </div>
		          <div class="float-right"><br>
		           <b><h5 class="mb-0 text-right">MEMO AO</h5></b><br>
		          </div>
		        </div>
		      <div class="row">
		            <div class="col-md-6 text-left" >
		              <p style="font-size:8.6pt">MASUK</p>
		              <h5 id="total_memo_ao"></h5>
		            </div>
		            <div class="col-md-6" style="text-align: right; border-left: 1px solid #e5e5e5;">
		              <p style="font-size:8.6pt">KELUAR</p>
		              <h5 id="total_memo_ao_out"></h5>
		            </div>
		          </div>
		      </div>
		    </div>
		  </div>
		  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 grid-margin stretch-card">
		    <div class="card card-statistics" style="margin-top: -2%;">
		      <div class="card-body">
		        <div class="clearfix" style="margin-top: -7%;">
		          <div class="float-left">
		            <i class="mdi mdi-format-list-checks text-info icon-lg" style="font-size:25pt;"></i>
		          </div>
		          <div class="float-right"><br>
		            <b><h5 class="mb-0 text-right">MEMO CA</h5></b><br>
		          </div>
		        </div>
		      <div class="row">
		            <div class="col-md-6 text-left" >
		              <p style="font-size:8.6pt">MASUK</p>
		              <h5 id="total_memo_ca"></h5>
		            </div>
		            <div class="col-md-6" style="text-align: right; border-left: 1px solid #e5e5e5;">
		              <p style="font-size:8.6pt">KELUAR</p>
		              <h5 id="total_memo_ca_out"></h5>
		            </div>
		          </div>
		      </div>
		    </div>
		  </div>
		  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 grid-margin stretch-card">
		    <div class="card card-statistics" style="margin-top: -2%;">
		      <div class="card-body">
		        <div class="clearfix" style="margin-top: -7%;">
		          <div class="float-left">
		            <i class="mdi mdi-briefcase-check  text-success icon-lg" style="font-size:25pt;"></i>
		          </div>
		          <div class="float-right"><br>
		            <b><h5 class="mb-0 text-right">APPROVAL</h5></b><br>
		          </div>
		        </div>
		        <div class="row">
		          <div class="col-md-4 text-left" >
		            <p style="font-size:8.6pt">MASUK</p>
		            <h5 id="in_approval"></h5>
		          </div>
		          <div class="col-md-4" style="text-align: center; border-left: 1px solid #e5e5e5;">
		            <p style="font-size:8.6pt">DI SETUJUI</p>
		            <h5 id="app_approval"></h5>
		          </div>
		          <div class="col-md-4" style="text-align: right; border-left: 1px solid #e5e5e5;">
		            <p style="font-size:8.6pt">DI TOLAK</p>
		            <h5 id="reject_approval"></h5>
		          </div>
		        </div>
		        <p class="text-muted mt-3 mb-0">
		        	<i class="mdi mdi-database mr-1" aria-hidden="true"></i>Total di setujui:&nbsp;&nbsp; <b style="font-size:11pt;" id="total_approve"></b>
		      	</p>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</div>
<script type="text/javascript" src="lib/js/formatRupiah.js"></script>
<script type="text/javascript" src="lib/js/changedate.js"></script>
<script type="text/javascript" src="lib/js/url.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		var loading = '<i class="mdi mdi-18px mdi-spin mdi-loading"></i>'
		var session_id_user = $('#session_id_user').val();
		var session_kantor = $('#session_kantor').val();
		var NowDate = $('#NowDate').val();
		$('#load_page').val('false');

		if (session_kantor == 01) {
			kantor = 'Kantor pusat'
		}else if (session_kantor == 02) {
			kantor = 'Cabang Cilodong'
		}

		$('kt').html(kantor)
		$('tg').html(changeDate(NowDate))

		TotalOrder(session_kantor)
		'use strict'
		function TotalOrder(session_kantor) {
			$.ajax({
				type:'get',
				url:url+'Home/getTotalOrder/'+session_kantor,
				dataType:'json',
				beforeSend:function(){
					$('#total_order').html(loading)
					$('#graforder').html(loading)
				},
				success:function(res) {
					$('#total_order').html(FormatRupiah(res.total_order))
					$('#graforder').html(FormatRupiah(res.total_order))
					$('#graforder').attr('tooltip','Order masuk : '+FormatRupiah(res.total_order))
				}
			})
		}
		TotalPengajuan(session_kantor)

		'use strict'
		function TotalPengajuan(session_kantor) {
			$.ajax({
				type:'get',
				url:url+'Home/getTotalPengajuan/'+session_kantor,
				dataType:'json',
				beforeSend:function(){
					$('#total_pengajuan').html(loading)
				},
				success:function(res) {
					$.each(res,function (k,v) {
						$('#total_pengajuan').html('Rp. '+FormatRupiah(v.total_pengajuan))
					})
				}
			})
		}

		TotalOrderSukses(session_kantor)

		'use strict'
		function TotalOrderSukses(session_kantor) {
			$.ajax({
				type:'get',
				url:url+'Home/getTotalOrderSukses/'+session_kantor,
				dataType:'json',
				beforeSend:function(){
					$('#total_s_order').html(loading)
				},
				success:function(res) {
					$('#total_s_order').html(FormatRupiah(res.total_order))
				}
			})
		}

		/*TotalPengajuanVerifikasi()

		'use strict'
		function TotalPengajuanVerifikasi() {
			$.ajax({
				type:'get',
				url:url+'Home/getTotalPengajuanVerifikasi',
				dataType:'json',
				beforeSend:function(){
									$.each(res,.html(loading)
	,			}
				success:function(res) {
					$.each(res,function (k,v) {
						$('#total_pengajuan_v').html('Rp. '+FormatRupiah(v.total_pengajuan))
					})
				}
			})
		}*/

		/*TotalOrderPending()

		'use strict'
		function TotalOrderPending() {
			$.ajax({
				type:'get',
				url:url+'Home/getTotalOrderPending',
				dataType:'json',
				beforeSend:function(){
									$('#total_p_order').html(loading)
	,			}
				success:function(res) {
					$('#total_p_order').html(FormatRupiah(res.total_order))
				}
			})
		}*/

		/*TotalPengajuanBVerifikasi()

		'use strict'
		function TotalPengajuanBVerifikasi() {
			$.ajax({
				type:'get',
				url:url+'Home/getTotalPengajuanBVerifikasi',
				dataType:'json',
				beforeSend:function(){
									$.each(res,.html(loading)
	,			}
				success:function(res) {
					$.each(res,function (k,v) {
						$('#total_pengajuan_vb').html('Rp. '+FormatRupiah(v.total_pengajuan))
					})
				}
			})
		}*/

		getTotalKredit(session_kantor)

		'use strict'
		function getTotalKredit(session_kantor) {
			$.ajax({
				type:'get',
				url:url+'Home/getTotalKredit/'+session_kantor,
				dataType:'json',
				beforeSend:function(){
					$('#total_kredit_checking').html(loading)
					$('#grafkredit').html(loading)
				},
				success:function(res) {
					$('#total_kredit_checking').html(FormatRupiah(res.total_kredit))
					$('#grafkredit').html(FormatRupiah(res.total_kredit))
					$('#grafkredit').attr('tooltip','Kredit Chechking : '+FormatRupiah(res.total_kredit))
				}
			})
		}

		getTotalKreditOnProg(session_kantor)

		'use strict'
		function getTotalKreditOnProg(session_kantor) {
			$.ajax({
				type:'get',
				url:url+'Home/getTotalKreditOnProg/'+session_kantor,
				dataType:'json',
				beforeSend:function(){
					$('#total_kredit_on_p').html(loading)
				},
				success:function(res) {
					$('#total_kredit_on_p').html(FormatRupiah(res.total_kredit))
				}
			})
		}

		getTotalKreditDone(session_kantor)

		'use strict'
		function getTotalKreditDone(session_kantor) {
			$.ajax({
				type:'get',
				url:url+'Home/getTotalKreditDone/'+session_kantor,
				dataType:'json',
				beforeSend:function(){
					$('#total_kredit_done').html(loading)
				},
				success:function(res) {
					$('#total_kredit_done').html(FormatRupiah(res.total_kredit))
				}
			})
		}

		getTotalMemoAo(session_kantor)

		'use strict'
		function getTotalMemoAo(session_kantor) {
			$.ajax({
				type:'get',
				url:url+'Home/getTotalMemoAo/'+session_kantor,
				dataType:'json',
				beforeSend:function(){
					$('#total_memo_ao').html(loading)
					$('#grafao').html(loading)
				},
				success:function(res) {
					$('#total_memo_ao').html(FormatRupiah(res.total_memo_ao))
					$('#grafao').html(FormatRupiah(res.total_memo_ao))
					$('#grafao').attr('tooltip','Memo ao : '+FormatRupiah(res.total_memo_ao))
				}
			})
		}

		getTotalMemoAoOut(session_kantor)

		'use strict'
		function getTotalMemoAoOut(session_kantor) {
			$.ajax({
				type:'get',
				url:url+'Home/getTotalMemoAoOut/'+session_kantor,
				dataType:'json',
				beforeSend:function(){
					$('#total_memo_ao_out').html(loading)
				},
				success:function(res) {
					$('#total_memo_ao_out').html(FormatRupiah(res.total_memo_ao))
				}
			})
		}

		getTotalMemoCa(session_kantor)

		'use strict'
		function getTotalMemoCa(session_kantor) {
			$.ajax({
				type:'get',
				url:url+'Home/getTotalMemoCa/'+session_kantor,
				dataType:'json',
				beforeSend:function(){
					$('#total_memo_ca').html(loading)
					$('#grafca').html(loading)
				},
				success:function(res) {
					$('#total_memo_ca').html(FormatRupiah(res.total_memo_ca))
					$('#grafca').html(FormatRupiah(res.total_memo_ca))
					$('#grafca').attr('tooltip','Memo Ca : '+FormatRupiah(res.total_memo_ca))
				}
			})
		}

		getTotalMemoCaOut(session_kantor)

		'use strict'
		function getTotalMemoCaOut(session_kantor) {
			$.ajax({
				type:'get',
				url:url+'Home/getTotalMemoCaOut/'+session_kantor,
				dataType:'json',
				beforeSend:function(){
					$('#total_memo_ca_out').html(loading)
				},
				success:function(res) {
					$('#total_memo_ca_out').html(FormatRupiah(res.total_memo_ca))
				}
			})
		}

		getInApproval(session_kantor)

		'use strict'
		function getInApproval(session_kantor) {
			$.ajax({
				type:'get',
				url:url+'Home/getInApproval/'+session_kantor,
				dataType:'json',
				beforeSend:function(){
					$('#in_approval').html(loading)
					$('#grafapproval').html(loading)
				},
				success:function(res) {
					$('#in_approval').html(FormatRupiah(res.total_memo_ca))
					$('#grafapproval').html(FormatRupiah(res.total_memo_ca))
					$('#grafapproval').attr('tooltip','Approval : '+FormatRupiah(res.total_memo_ca))
				}
			})
		}

		getTotalAppove(session_kantor)

		'use strict'
		function getTotalAppove(session_kantor) {
			$.ajax({
				type:'get',
				url:url+'Home/getTotalAppove/'+session_kantor,
				dataType:'json',
				beforeSend:function(){
					$('#app_approval').html(loading)
				},
				success:function(res) {
					$('#app_approval').html(FormatRupiah(res.total_memo_app))
				}
			})
		}

		getTotalReject(session_kantor)

		'use strict'
		function getTotalReject(session_kantor) {
			$.ajax({
				type:'get',
				url:url+'Home/getTotalReject/'+session_kantor,
				dataType:'json',
				beforeSend:function(){
					$('#reject_approval').html(loading)
				},
				success:function(res) {
					$('#reject_approval').html(FormatRupiah(res.total_memo_reject))
				}
			})
		}

		getTotalDisetujui(session_kantor)

		'use strict'
		function getTotalDisetujui(session_kantor) {
			$.ajax({
				type:'get',
				url:url+'Home/getTotalDisetujui/'+session_kantor,
				dataType:'json',
				beforeSend:function(){
					$('#total_approve').html(loading)
				},
				success:function(res) {
					$.each(res,function (k,v) {
						$('#total_approve').html('Rp. '+FormatRupiah(v.total_approval))
					})
				}
			})
		}
	})
</script>
