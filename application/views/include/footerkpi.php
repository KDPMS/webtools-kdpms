<!-- partial:partials/_footer.html -->
                    <footer class="footer">
						<div class="container-fluid clearfix">
							<span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
								<a href="https://kdpms.id/" target="_blank">Koperasi dana pinjaman mandiri sejahtera</a>. All
								rights reserved.</span>
							<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">KDPMS KPI V.0.1.6
							</span>
						</div>
					</footer>
					
					<script src="<?= base_url('lib/vendors/js/gauge.min.js') ?>"></script>

					<!-- Bootstrap 4.3.1 JS -->
					<script src="<?= base_url('lib/vendors/js/jquery-3.3.1.min.js') ?>"></script>
					
					<script src="<?= base_url('lib/vendors/js/popper.min.js') ?>"></script>
					<script src="<?= base_url('lib/vendors/js/bootstrap.min.js') ?>"></script>
					
					<script src="<?php echo base_url('lib/vendors/js/vendor.bundle.base.js') ?>"></script>
					<script src="<?php echo base_url('lib/vendors/js/vendor.bundle.addons.js') ?>"></script>
					<!-- plugins:js -->
					<script src="<?php echo base_url('lib/vendors/js/vendor.bundle.base.js') ?>"></script>
					<script src="<?php echo base_url('lib/vendors/js/vendor.bundle.addons.js') ?>"></script>
					<!-- endinject -->
	
					<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script> -->
					<script type="text/javascript" src="<?= base_url('lib/vendors/js/pdfmake.min.js') ?>"></script>
					<script type="text/javascript" src="<?= base_url('lib/vendors/js/vfs_fonts.js') ?>"></script>
					<script type="text/javascript" src="<?= base_url('lib/vendors/js/datatables.min.js') ?>"></script>
					<script>
						$(document).ready(function() {
							
							//popover
							detectmob();

							function detectmob() {
								if (window.innerWidth <= 800 && window.innerHeight <= 600) {
									$('[data-popover="popover"]').popover("hide");
								} else {
									$('[data-popover="popover"]').popover();
								}
							}
							//tutup popover
							
							//loader
							$('#loader').fadeOut('slow');
							$('span.spedo').fadeIn('slow');

							$('form').submit(function(){
								$('#loader').fadeIn('slow');
								$('span.spedo').fadeOut('slow');
							});
							//tutup loader

							//btn-filter-load
							$('#btnFilter').on('click', function(){
								$(this).html('Filter <div class="spinner-border spinner-border-sm text-white" role="status"><span class="sr-only"></span></div>');
							});
							//tutup btn-filter-load
							
						});
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
