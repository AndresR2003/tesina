
			
			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Clientes Registrados</h4>
							<h6>Administración de clientes registrados</h6>
						</div>
						
					</div>
					

					<!-- /product list -->
					<div class="main-content">

						<div class="page-content">
							<div class="container-fluid">

								
								<style>
								a{
									
									color:blue;
								}
								a:hover{
									color:green;
								}"
								</style>
								<!-- end page title -->
								<div>                                              
									<div class="card">     
														
										<div class="card-body"> 
											<div class="row"> 
											
												<div class="col-12">
													<div class="page-title-box d-sm-flex align-items-center justify-content-between">
														<h6 class="mb-sm-0 font-size-15">IMPORTAR DATA</h6>

														<div class="page-title-right">
															<ol class="breadcrumb m-0">
																<a href="<?php echo base_url('C_cargar_base/exportar_inf_logo'); ?>"><u>Exportar Informe</u></a>
															</ol>
														</div>

														
													</div>
												</div>                       
													<form  action="<?php echo base_url(); ?>C_cargar_base/exportar_plantilla" method="post" id="frm_exportar" target="_blank">
												</form>
													
													<div class="col-lg-5">
														<label>Seleccione archivo (xls, xlsx)</label>
														<p><input type="file" name="file_xls_temporal_masivos" id="file_xls_temporal_masivos" required class="form-control" accept=".xls, .xlsx" /></p>
													</div>                          
													<div class="col-lg-3">
														<label>tipo de envio</label>
														<select class="form-control " id="select_filtro_tipo" >
															<option selected value="">Seleccione</option>
															<option  value="1">SMS</option>
															<option  value="2">WHATSAPP</option>
															<option  value="3">IVR</option>                                                                                                 
														</select>
													</div>
													
													
													<div class="col-lg-2">
														<label style="color:white;">IMPORTAR DATA</label>
														<button type="submit" name="btn_cargar_xls_temporal_masivo" id="btn_cargar_xls_temporal_masivo" class="btn btn-danger  form-control">IMPORTAR DATA</button>                               
													</div>  

													<div clas="row "> 
														<div class="col-lg-12 mt-5">
															<div class="col-lg-12 ">
																<table id="tbl_temporal" style="width:100%" class="table table-striped table-bordered" >
																	<thead>
																		<tr>                                             
																			<th>lista</th>     
																			<th>Dni</th>   
																			<th>telefeno</th>   
																			<th>Operador</th>   
																			<th>mensaje</th>                                                                                                                
																																																						
																		</tr>
																	</thead>
																</table>
															</div>
														</div>   
													</div>                                                    
												</div>
											</div>
										</div>
									</div>
									

								</div>    
								
								<div>
									<div class="row">                                 
										<div class="card">                        
											<div class="card-body"> 
												<div class="row"> 
													<h6>CARGAR DATA</h6>                               
													<div class="col-lg-2">
														<label style="color:white;">CARGAR DATA</label>
														<button type="submit" name="btn_cargar_masivo" id="btn_cargar_masivo" class="btn btn-danger  form-control" onclick=cargar_datos_masivos()>CARGAR DATA</button>    
														<button name="btn_prueba_api" id="btn_prueba_api" class="btn btn-danger  form-control" onclick=prueba_api()>analizar</button>                           
													</div>                                                      
												</div>
											</div>
										</div>
									</div>               

								</div>
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
    
    
    var table_data_temporal; 

    $(document).ready(function() {
        forDataTables('#tbl_temporal','C_cargar_base/listar_temporal_masivo');
             
		$('#btn_cargar_xls_temporal_masivo').click(function() {
			var select_filtro_tipo = $('#select_filtro_tipo').val();
			var inputfile = document.getElementById('file_xls_temporal_masivos');
			var file = inputfile.files[0];
			var data = new FormData();
			data.append('file', file);
			data.append('select_filtro_tipo', select_filtro_tipo);

			var tmp = 0;
			if (file) {
				tmp = 1;
			}

			if (tmp === 1) {
				$.ajax({
					type: 'post',
					contentType: false,
					processData: false,
					url: '<?php echo base_url();?>C_cargar_base/cargar_datos_temporal_masivos',
					data: data,
					beforeSend: function() {
						// Agrega lógica de carga si es necesario
					},
					success: function(data) {
						if (data !== 'error') {
							$('#file_xls_temporal_masivos').val('');
							alert("Total de registros: " + data);
						} else {
							alert("Seleccione el tipo de envío");
						}
					}
				});
			} else {
				alert("Seleccione archivo Excel a cargar");
			}
		});
    });

 

    

    

    function cargar_datos_masivos(){
      $.ajax({
        type: "POST",
        url: '<?php echo  base_url()?>C_cargar_base/cargar_datos',
        data: {}, 
        beforeSend:function(){
          $('#btn_cargar_masivo').attr('disabled','true');
        },
        success: function(data){
            $('#btn_cargar_masivo').attr('disabled','false');
            alert("Resultado : " + data);            
        }
      });          
    }

	function prueba_api(){
      $.ajax({
        type: "POST",
        url: '<?php echo  base_url()?>C_cargar_base/analizarTexto',
        data: {}, 
        beforeSend:function(){
          //$('#btn_cargar_masivo').attr('disabled','true');
        },
        success: function(data){
           // $('#btn_cargar_masivo').attr('disabled','false');
            alert("Resultado : " + data);            
        }
      });          
    }

    function forDataTables( id, ruta) {
        tb_table = $(id).DataTable({
            "scrollX": true,
            "processing":true,
            "serverSide":true,
            "order":[],
            //"dom": 'Bfrtip',
            //"buttons": ['copy', 'excel', 'pdf', 'colvis'],
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
