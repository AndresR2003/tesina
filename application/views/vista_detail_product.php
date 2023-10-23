			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Detalle de Producto</h4>
							<h6>Informaciòn del producto</h6>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8 col-sm-12">
							<div class="card">
								<div class="card-body">
									<div class="bar-code-view">
										<img src="<?php echo base_url();?>public/assets/img/barcode1.png" alt="barcode">
										<a class="printimg">
											<img src="<?php echo base_url();?>public/assets/img/icons/printer.svg" alt="print">
										</a>
									</div>
									<div class="productdetails">
										<ul class="product-bar">
											<?php 
												if($lst_data!='error'){
													foreach ($lst_data as $key) {
														echo '
															<li>
																<h4>Producto</h4>
																<h6>'.$key->nombre.'</h6>
															</li>
															<li>
																<h4>SKU</h4>
																<h6>'.$key->sku.'</h6>
															</li>
															<li>
																<h4>Marca</h4>
																<h6>'.$key->marca.'</h6>
															</li>
															<li>
																<h4>Categoría</h4>
																<h6>'.$key->categoria.'</h6>
															</li>
															<li>
																<h4>Precio</h4>
																<h6>'.$key->precio.'</h6>
															</li>
															<li>
																<h4>Cantidad</h4>
																<h6>'.$key->cantidad.'</h6>
															</li>
															<li>
																<h4>Descripcion</h4>
																<h6>'.$key->descripcion.'</h6>
															</li>																																																																										
														';
													}
												}
											?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-sm-12">
							<div class="card">
								<div class="card-body">
									<div class="slider-product-details">
										<div class="owl-carousel owl-theme product-slide">
											<div class="slider-product">
												<img src="<?php echo base_url();?>public/assets/img/product/product69.jpg" alt="img">
												<h4>macbookpro.jpg</h4>
												<h6>581kb</h6>
											</div>
											<div class="slider-product">
												<img src="<?php echo base_url();?>public/assets/img/product/product69.jpg" alt="img">
												<h4>macbookpro.jpg</h4>
												<h6>581kb</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

        <!-- jQuery -->
        <script src="<?php echo base_url();?>public/assets/js/jquery-3.6.0.min.js"></script>

        <!-- Feather Icon JS -->
        <script src="<?php echo base_url();?>public/assets/js/feather.min.js"></script>

        <!-- Slimscroll JS -->
        <script src="<?php echo base_url();?>public/assets/js/jquery.slimscroll.min.js"></script>

        <!-- Datatable JS -->
        <script src="<?php echo base_url();?>public/assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/js/dataTables.bootstrap4.min.js"></script>

        <!-- Bootstrap Core JS -->
        <script src="<?php echo base_url();?>public/assets/js/bootstrap.bundle.min.js"></script>

        <!-- Select2 JS -->
        <script src="<?php echo base_url();?>public/assets/plugins/select2/js/select2.min.js"></script>

        <!-- Sweetalert 2 -->
        <script src="<?php echo base_url();?>public/assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/sweetalert/sweetalerts.min.js"></script>

		<!-- Owl JS -->
		<script src="<?php echo base_url();?>public/assets/plugins/owlcarousel/owl.carousel.min.js"></script>

        <!-- Custom JS -->
        <script src="<?php echo base_url();?>public/assets/js/script.js"></script>

    </body>
</html>

        <script>
			$(document).ready(function() {
			});
        </script>
