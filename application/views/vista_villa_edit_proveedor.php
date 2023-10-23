        <?php 
            $id =0;         
            $razonSocial ="";                      
            $id_tipo_documento ="";    
			$tipo_proveedor="";    
            $nro_documento ="";        
            $celular_1 ="";        
            $celular_2 ="";        
            $id_local ="";        
            $direccion ="";        
			$id_estado_evento        = "";
            foreach ($lst_data as $key) {
                $id =$key->id;        
                $razonSocial =$key->razon_social;                   
                $id_tipo_documento =$key->id_tipo_documento;   
				$tipo_proveedor =$key->id_tipo_proveedor;     
                $nro_documento =$key->nro_documento;        
                $celular_1 =$key->celular_1;
                $celular_2 =$key->celular_2;
                $id_local =$key->id_sector;
                $direccion =$key->direccion;
				$id_estado_proveedor=$key->estado;
            }
        ?>        
        
        
        <div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Actualizar datos del Proveedor</h4>
							<h6>Realizar cambios en los datos del Proveedor</h6>
						</div>
					</div>
					<!-- /add -->
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Razón Social</label>
										<input type="text" id="input_razonSocial" value="<?php echo $razonSocial;?>">
										<div class="valid-feedback" id="input_razonSocial_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="input_razonSocial_error">
											Por favor, ingrese el nombre del Proveedor.
										</div>										
									</div>
								</div>


								
								
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Tipo de Documento</label>
										<select class="select" id="select_tipo_documento">
											<option value="">Tipo de Documento</option>
											<?php
												foreach ($lst_tipo_documento as $key) {
                                                    if($key->id==$id_tipo_documento){
                                                        echo '<option selected value="'.$key->id.'">'.$key->descripcion.'</option>';
                                                    }else{
                                                        echo '<option value="'.$key->id.'">'.$key->descripcion.'</option>';
                                                    }
												}
											?>
										</select>
										<div class="valid-feedback" id="select_tipo_documento_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="select_tipo_documento_error">
											Por favor, seleccione el tipo de documento.
										</div>	
									</div>
								</div>
							
															
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Nro Documento</label>
										<input type="text" id="input_nro_documento" value="<?php echo $nro_documento;?>">
										<input type="hidden" id="id_proveedor" value="<?php echo $id;?>">
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
										<label>Tipo de Proveedor</label>
										<select class="select" id="select_tipo_proveedor">
											<option value="">Tipo de Proveedor</option>
											<?php
												foreach ($lst_tipos_proveedores as $key) {
                                                    if($key->id==$tipo_proveedor){
                                                        echo '<option selected value="'.$key->id.'">'.$key->descripcion.'</option>';
                                                    }else{
                                                        echo '<option value="'.$key->id.'">'.$key->descripcion.'</option>';
                                                    }
												}
											?>
										</select>
										<div class="valid-feedback" id="select_tipo_proveedor_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="select_tipo_proveedor_error">
											Por favor, seleccione el tipo de proveedor.
										</div>	
									</div>
								</div>

								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Celular</label>
										<input type="text" id="input_celular_1" value="<?php echo $celular_1;?>" maxlength="12" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
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
										<input type="text" id="input_celular_2" value="<?php echo $celular_2;?>" maxlength="12" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
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
										<textarea class="form-control" id="input_direccion"><?php echo $direccion;?></textarea>
										<div class="valid-feedback" id="input_direccion_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="input_direccion_error">
											Por favor, ingrese una dirección.
										</div>	
									</div>
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
                                <!---->
								<div class="col-lg-12">
									<a href="javascript:void(0);" onclick="update(<?php echo $id;?>);" class="btn btn-submit me-2"> Actualizar Datos </a>
									<a href="<?php echo base_url();?>proveedores" class="btn btn-cancel"> Cancelar </a>
								</div>
							</div>
						</div>
					</div>
					<!-- /add -->

					<!-- /Datos de la cotización o tipo de evento a registrar -->
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12 col-sm-12 col-12">
                                    <h4>Estado actual del Proveedor</h4>
                                </div>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Situación del Proveedor </label>
										<select class="form-control" id="select_estado_proveedor">
											<option value="">Seleccion</option>
											<?php
												
												foreach ($lst_estados_proveedor as $key) {
                                                    if($id_estado_proveedor==$key->id){
                                                        echo '<option selected value="'.$key->id.'">'.$key->descripcion.'</option>';
                                                    }else{
                                                        echo '<option  value="'.$key->id.'">'.$key->descripcion.'</option>';
													}
												}
											?>
										</select>
										<div class="valid-feedback" id="select_estado_proveedor_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="select_estado_proveedor_error">
											Por favor, seleccione el estado del evento
										</div>	
									</div>
								</div>   
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
                                        <label style="color:white;">Botón</label>
                                        <button class="btn btn-secondary" onclick="save_estado_proveedor();"> Grabar</button>
									</div>
								</div>                                   
							</div>
						</div>
					</div>
					<!-- /add -->
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
    function update(id){
		var validador=0; 
		var input_razonSocial = $('#input_razonSocial').val();
		validador = validador + valida_input('input_razonSocial');
        
		/*var input_apellido = $('#input_apellido').val();
		validador = validador + valida_input('input_apellido');*/

		var select_tipo_documento = $('#select_tipo_documento').val();
		validador = validador + valida_input('select_tipo_documento');

		var input_nro_documento = $('#input_nro_documento').val();
		validador = validador + valida_input('input_nro_documento');

		var input_celular_1 = $('#input_celular_1').val();
		validador = validador + valida_input('input_celular_1');

		var input_celular_2 = $('#input_celular_2').val();
		validador = validador + valida_input('input_celular_2');

		var select_tipo_proveedor = $('#select_tipo_proveedor').val();
		validador = validador + valida_input('select_tipo_proveedor');

		var input_direccion = $('#input_direccion').val();
		validador = validador + valida_input('input_direccion');

		if(validador>0){return;}

		$.ajax({
			type: "POST",
			url: '<?php echo base_url();?>Controller_villa_proveedores/update',
			data: {
				'id':id,
				'input_razonSocial':input_razonSocial,	
				'select_tipo_documento':select_tipo_documento,
				'input_nro_documento':input_nro_documento,
				'input_celular_1':input_celular_1,
				'input_celular_2':input_celular_2,
				'select_tipo_proveedor':select_tipo_proveedor,
				'input_direccion':input_direccion
			}, 
			beforeSend:function(){
			},   
			success: function(data){ 
				if(data=='1'){
					limpiar();
					Swal.fire({ 
						title: "Proveedor actualizado!", 
						text: "Se actualizó correctamente los datos del Proveedor!", 
						type: "success", confirmButtonClass: "btn btn-primary", buttonsStyling: !1 
					})
				}else{

				}
			}
		});
    }

	function save_estado_proveedor(){
        var id_estado_proveedor = $('#select_estado_proveedor').val(); 
        var id_proveedor =$('#id_proveedor').val(); 
		$.ajax({
			type: "POST",
			url: '<?php echo base_url();?>Controller_villa_proveedores/save_estado_proveedor',
			data: {
				'id_estado_proveedor':id_estado_proveedor,
				'id_proveedor':id_proveedor
			}, 
			beforeSend:function(){
			},   
			success: function(data){ 
				switch (data) {
					case 'no_existe_cliente':
						Swal.fire({ 
							title: "El cliente seleccionado no existe!", 
							text: "Hubo un error, el cliente ingresado no existe!", 
							type: "error", confirmButtonClass: "btn btn-primary", buttonsStyling: !1 
						})
						break;
					case 'ok':
						Swal.fire({ 
							title: "Evento guardado correctamente!", 
							text: "Se  guardaron los registros satisfactoriamente!", 
							type: "success", confirmButtonClass: "btn btn-primary", buttonsStyling: !1 
						})
						break;																													
					default:
						break;
				}
			}
		});
    }


    </script>
