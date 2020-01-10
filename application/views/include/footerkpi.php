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
					
					<script src="//cdn.rawgit.com/Mikhus/canvas-gauges/gh-pages/download/2.1.5/all/gauge.min.js"></script>

					<!-- Bootstrap 4.3.1 JS -->
					<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
					<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
					<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js"></script>
					
					<script src="<?php echo base_url('lib/vendors/js/vendor.bundle.base.js') ?>"></script>
					<script src="<?php echo base_url('lib/vendors/js/vendor.bundle.addons.js') ?>"></script>
					<!-- /Bootstrap 4.3.1 JS -->
					<!-- Popover -->
					
					<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
					<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
					<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/sc-2.0.1/datatables.min.js"></script>
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
