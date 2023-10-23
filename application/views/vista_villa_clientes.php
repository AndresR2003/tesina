
			
			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Clientes Registrados</h4>
							<h6>Administración de clientes registrados</h6>
						</div>
						<div class="page-btn">
							<a href="<?php echo base_url();?>clientes/clientes_add" class="btn btn-added"><img src="<?php echo base_url();?>public/assets/img/icons/plus.svg" alt="img" class="me-1">Agregar nuevo cliente</a>
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
												<div class="col-lg-3 col-sm-6 col-12">
													<div class="form-group">
														<select class="select" id="select_estado" onchange="active_filter('select_estado');">
                                                            <?php 
                                                                //Validación de sesión activa..
                                                                $esta="";
                                                                $esta0="";
                                                                $esta1="";
                                                                if(isset($_SESSION['SESSION_ESTADO'])){
                                                                    if($_SESSION['SESSION_ESTADO']==1){
                                                                        $esta1="selected";
                                                                    }else if($_SESSION['SESSION_ESTADO']==0){
                                                                        $esta1="selected";
                                                                    }else{
                                                                        $esta="selected";
                                                                    }
                                                                }
                                                            ?>
															<option value="" <?php echo $esta;?> >Estado</option>
															<option value="0" <?php echo $esta0;?>>Activo</option>
															<option value="1" <?php echo $esta1;?>>Inactivo</option>
														</select>
													</div>
												</div>
												<div class="col-lg col-sm-6 col-12">
													<div class="form-group">
														<select class="select" id="select_sector" onchange="active_filter('select_sector');">
														</select>
													</div>
												</div>
												<div class="col-lg col-sm-6 col-12">
													<div class="form-group">
														<select class="select" id="select_tipo_documento" onchange="active_filter('select_tipo_documento');">
														</select>
													</div>
												</div>

                                                <!--OCULTAMOS-->
												<div class="col-lg col-sm-6 col-12" style="display:none;">
													<div class="form-group">
														<select class="select" id="select_marca" onchange="active_filter('select_marca');">
														</select>
													</div>
												</div>
												<div class="col-lg col-sm-6 col-12" style="display:none;">
													<div class="form-group">
														<select class="select" id="select_unidad" onchange="active_filter('select_unidad');">
														</select>
													</div>
												</div>
                                                <!--OCULTAMOS-->

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
											<th>Nombres</th>
											<th>Apellidos</th>
											<th>Estado</th>
											<th>Local</th>
											<th>Tipo Documento</th>
											<th>Nro Documento</th>
											<th>Direccion</th>
											<th>Celular_1</th>
											<th>Celular_2</th>
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
					//get_select_data('marca');
					get_select_data('select_sector');
					get_select_data('select_tipo_documento');
					//get_select_data('unidad');
                    forDataTables('#tb_table','Controller_villa_clientes/listar'); 
                });

				function search(){
					table.ajax.reload(null,false);
				}

				function active_filter(tipo){
					var dato = $('#'+tipo).val();
					$.ajax({
						type: "POST",
						url: '<?php echo base_url();?>Controller_compartido/active_filter',
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
				
				function get_select_data(tipo){
					$.ajax({
						type: "POST",
						url: '<?php echo base_url();?>Controller_compartido/get_data_select',
						data: {
							'tipo':tipo
						}, 
						beforeSend:function(){
						},   
						success: function(data){ 
							var json         = eval("(" + data + ")");
							switch (tipo) {
								case 'marca':
									$('#select_marca').html(json.resultado);
									break;
								case 'select_sector':
									$('#select_sector').html(json.resultado);
									break;
								case 'select_tipo_documento':
									$('#select_tipo_documento').html(json.resultado);
									break;
								case 'unidad':
									$('#select_unidad').html(json.resultado);
									break;																											
								default:
									break;
							}
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
