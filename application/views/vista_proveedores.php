
			
			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Lista de Proveedores</h4>
							<h6>Administra tus proveedores</h6>
						</div>
						<div class="page-btn">
							<a href="<?php echo base_url();?>proveedores/proveedores_add" class="btn btn-added"><img src="<?php echo base_url();?>public/assets/img/icons/plus.svg" alt="img" class="me-1">Agregar nuevo Proveedor</a>
						</div>
					</div>
					

					<!-- /product list -->
					<div class="card">
						<div class="card-body">
							<div class="table-top">
								<div class="search-set">
									<div class="search-path">
										<a class="btn btn-filter" id="filter_search">
											<img src="<?php echo base_url();?>public/assets/img/icons/filter.svg" alt="img">
											<span><img src="<?php echo base_url();?>public/assets/img/icons/closes.svg" alt="img"></span>
										</a>
									</div>
									<div class="search-input">
										<a class="btn btn-searchset"><img src="<?php echo base_url();?>public/assets/img/icons/search-white.svg" alt="img"></a>
									</div>
								</div>
								<div class="wordset">
									<ul>
										<li>
											<a target="_blank" href="<?php echo base_url(); ?>Controller_exportar/exportar_producto_pdf" data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="<?php echo base_url();?>public/assets/img/icons/pdf.svg" alt="img"></a>
										</li>
										<li>
											<a target="_blank" href="<?php echo base_url(); ?>Controller_exportar/exportar_producto" data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="<?php echo base_url();?>public/assets/img/icons/excel.svg" alt="img"></a>
										</li>
										<!--<li>
											<a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="<?php echo base_url();?>public/assets/img/icons/printer.svg" alt="img"></a>
										</li>-->
									</ul>
								</div>
							</div>

							<!-- /Filter -->
							<div class="card mb-0" id="filter_inputs">
								<div class="card-body pb-0">
									<div class="row">
										<div class="col-lg-12 col-sm-12">
											<div class="row">
												
												<div class="col-lg col-sm-6 col-12">
													<div class="form-group">
														<select class="select" id="tipo_proveedor" onchange="active_filter('tipo_proveedor');">
															<?php
																echo '<option value="">Tipo de Proveedor</option>';
																foreach ($lst_tipos_proveedores as $key) {
																	echo '<option value="'.$key->id.'">'.$key->descripcion.'</option>';
																}
                                                            ?>
														</select>
													</div>
												</div>

												<div class="col-lg col-sm-6 col-12">
													<div class="form-group">
														<select class="select" id="select_tipo_documento_prov" onchange="active_filter('select_tipo_documento_prov');">
															<?php
																echo '<option value="">Tipo de Documento</option>';
																foreach ($lst_tipo_documento as $key) {
																	echo '<option value="'.$key->id.'">'.$key->descripcion.'</option>';
																}
                                                            ?>
														</select>
													</div>
												</div>

												<div class="col-lg-3 col-sm-6 col-12">
													<div class="form-group">
														<select class="select" id="select_estado" onchange="active_filter('select_estado');">
                                                            <?php 
                                                               echo '<option value="">Seleccion Estado</option>';
															   foreach ($lst_estados_proveedor as $key) {
																   echo '<option value="'.$key->id.'">'.$key->descripcion.'</option>';
															   }
                                                            ?>														
														</select>
													</div>
												</div>                                              

												<div class="col-lg-1 col-sm-6 col-12">
													<div class="form-group">
														<button class="btn btn-filters ms-auto" onclick="search();"><img src="<?php echo base_url();?>public/assets/img/icons/search-whites.svg" alt="img"></button>
													</div>
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Filter -->

							<div class="table-responsive">                               
								<table id="tb_table" class="table">
									<thead>
										<tr>
											<th>Nro</th>
											<th>tipo de proveedor</th>
											<th>N° de documento</th>
											<th>Tipo de documento</th>
											<th>Razón social</th>
											<th>Direccion</th>
											<th>Celular 1</th>
											<th>Celular 2</th>
											<th>Estado</th>
											<th>fecha de alta</th>
											<th>Opción</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>

						</div>
					</div>
					<!-- /product list -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

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

        <!-- Custom JS -->
        <script src="<?php echo base_url();?>public/assets/js/script.js"></script>

    </body>
</html>

        <script>
                var table; 
                
                $(document).ready(function() {					
                    forDataTables('#tb_table','Controller_villa_proveedores/listar'); 
                });

				function search(){
					table.ajax.reload(null,false);
				}

				function active_filter(tipo){
					var dato = $('#'+tipo).val();
					$.ajax({
						type: "POST",
						url: '<?php echo base_url();?>Controller_villa_proveedores/active_filter',
						data: {
							'dato':dato,
							'tipo':tipo
						}, 
						beforeSend:function(){
						},   
						success: function(data){ 
							var json         = eval("(" + data + ")");
							if(json.mensaje=='active'){search();}else{search();}
						}
					});
				}
				
                function forDataTables( id, ruta) {
                    table = $(id).DataTable({
                        "scrollX": true,
                        "processing":true,
                        "serverSide":true,
                        "order":[],
                        "dom": 'Bfrtip',
                        "buttons": ['copy', 'excel', 'pdf', 'colvis'],
                        "ajax":{
                            url:"<?php echo base_url(); ?>" + ruta,
                            type:"POST"
                        },          
                        "order": [[ 0, "DESC" ]],
                        "language": {
                            "sProcessing": "Procesando...",
                            "sLengthMenu": "Mostrar _MENU_ registros",
                            "sZeroRecords": "No se encontraron resultados",
                            "sEmptyTable": "Ningún dato disponible en esta tabla",
                            "sInfo": "Del _START_ al _END_",
                            "sInfoEmpty": "Del 0 al 0 ",
                            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero",
                                "sLast": "Último",
                                "sNext": "Siguiente",
                                "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            }
                        }
                    });
                } 
        </script>
