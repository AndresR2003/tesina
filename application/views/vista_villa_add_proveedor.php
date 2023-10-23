<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Agregar Proveedor</h4>
							<h6>Registrar un nuevo Proveedor</h6>
						</div>
					</div>

					<!-- /add -->
					<div class="card">
						<div class="card-body">
							<div class="row">
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <h4>Datos del Proveedor</h4>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Nro Documento</label>
										<input type="text" id="input_nro_documento" placeholder="Ingrese número de documento" onchange="get_data_nro_documento()">
										<div class="valid-feedback" id="input_nro_documento_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="input_nro_documento_error">
											Por favor, ingrese el nro de documento.
										</div>										
									</div>
								</div>  

								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Tipo de documento</label>
										<select class="form-control" id="select_tipo_documento">
											<option value="">Seleccione</option>
											<?php
												foreach ($lst_tipo_documento as $key) {
													echo '<option value="'.$key->id.'">'.$key->descripcion.'</option>';
												}
											?>
										</select>
										<div class="valid-feedback" id="select_tipo_documento_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="select_tipo_documento_error">
											Por favor, seleccione la villa donde se ubica el cliente.
										</div>	
									</div>
								</div>                                  

								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Razón social</label>
										<input type="text" id="input_razonSocial" placeholder="Ingrese nombre del representante o empresa ">
										<div class="valid-feedback" id="input_razonSocial_success" >
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="input_razonSocial_error">
											Por favor, ingrese nombre del representante o empresa.
										</div>										
									</div>
								</div>

								                         
                                
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Celular</label>
										<input type="text" id="input_celular_1" placeholder="Ingrese número de celular" maxlength="12" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
										<div class="valid-feedback" id="input_celular_1_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="input_celular_1_error">
											Por favor, ingrese celular 1.
										</div>											
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Celular</label>
										<input type="text" id="input_celular_2" placeholder="Ingrese número de celular" maxlength="12" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
										<div class="valid-feedback" id="input_celular_2_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="input_celular_2_error">
											Por favor, ingrese celular 2.
										</div>											
									</div>
								</div>

                                                            
								<div class="col-lg-12">
									<div class="form-group">
										<label>Dirección</label>
										<textarea class="form-control" id="input_direccion"></textarea>
										<div class="valid-feedback" id="input_direccion_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="input_direccion_error">
											Por favor, ingrese una dirección.
										</div>	
									</div>
								</div>

								<!---->
								<div class="col-lg-12">
									<a href="javascript:void(0);" onclick="insert_proveedor();" class="btn btn-submit me-2">Enviar</a>
									<a href="<?php echo base_url();?>proveedores" class="btn btn-cancel">Cancelar</a>
								</div>

                                <!--PARA FOTO-->
								<div class="col-lg-12" style="display:none;">
									<div class="form-group">
										<label>	Foto</label>
										<div class="image-upload">
											<input type="file">
											<div class="image-uploads">
												<img src="<?php echo base_url();?>public/assets/img/icons/upload.svg" alt="img">
												<h4>Drag and drop a file to upload</h4>
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
	$(document).ready(function() {
	});

	function limpiar(){
		$('.invalid-feedback').css('display','none');	
		$('.valid-feedback').css('display','none');	
	}

	function valida_input(input){
		var dato = $('#'+input).val();
		if(dato==''){
			$('#'+input+'_error').css('display','block');
			$('#'+input+'_success').css('display','none');
			return 1;
		}else{
			$('#'+input+'_success').css('display','block');
			$('#'+input+'_error').css('display','none');
			return 0; 
		}
	}

	function insert_proveedor(){
		var validador=0; 

		var input_razonSocial = $('#input_razonSocial').val();
		validador = validador + valida_input('input_razonSocial');
        
		var select_tipo_documento = $('#select_tipo_documento').val();
		validador = validador + valida_input('select_tipo_documento');

		var input_nro_documento = $('#input_nro_documento').val();
		validador = validador + valida_input('input_nro_documento');

		var input_celular_1 = $('#input_celular_1').val();
		validador = validador + valida_input('input_celular_1');

		var input_celular_2 = $('#input_celular_2').val();
		validador = validador + valida_input('input_celular_2');

		/*var select_sector = $('#select_sector').val();
		validador = validador + valida_input('select_sector');*/

		var input_direccion = $('#input_direccion').val();
		validador = validador + valida_input('input_direccion');

		if(validador>0){return;}

		$.ajax({
			type: "POST",
			url: '<?php echo base_url();?>Controller_villa_proveedores/insert_proveedor',
			data: {
				'input_razonSocial':input_razonSocial,				
				'select_tipo_documento':select_tipo_documento,
				'input_nro_documento':input_nro_documento,
				'input_celular_1':input_celular_1,
				'input_celular_2':input_celular_2,
				/*'select_sector':select_sector,*/
				'input_direccion':input_direccion
			}, 
			beforeSend:function(){
			},   
			success: function(data){ 
				if(data=='1'){
					limpiar();
					Swal.fire({ 
						title: "Proveedor agregado!", 
						text: "Gracias por registrar un nuevo Proveedor!", 
						type: "success", confirmButtonClass: "btn btn-primary", buttonsStyling: !1 
					})
				}else{

				}
			}
		});
	}
    </script>