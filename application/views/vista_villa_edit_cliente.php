        <?php 
            $id =0;         
            $nombres ="";        
            $apellidos ="";        
            $id_tipo_documento ="";        
            $nro_documento ="";        
            $celular_1 ="";        
            $celular_2 ="";        
            $id_local ="";        
            $direccion ="";        
            foreach ($lst_data as $key) {
                $id =$key->id;        
                $nombres =$key->nombres;        
                $apellidos =$key->apellidos;        
                $id_tipo_documento =$key->id_tipo_documento;        
                $nro_documento =$key->nro_documento;        
                $celular_1 =$key->celular_1;
                $celular_2 =$key->celular_2;
                $id_local =$key->id_sector;
                $direccion =$key->direccion;
            }
        ?>        
        
        
        <div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Actualizar datos del Clientes</h4>
							<h6>Realizar cambios en los datos del cliente</h6>
						</div>
					</div>
					<!-- /add -->
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Nombres</label>
										<input type="text" id="input_nombre" value="<?php echo $nombres;?>">
										<div class="valid-feedback" id="input_nombre_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="input_nombre_error">
											Por favor, ingrese el nombre del cliente.
										</div>										
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Apellidos</label>
										<input type="text" id="input_apellido" value="<?php echo $apellidos;?>">
										<div class="valid-feedback" id="input_apellido_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="input_apellido_error">
											Por favor, ingrese el apellido del cliente.
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
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Zona de Villa</label>
										<select class="select" id="select_sector">
											<option value="">Seleccione Villa</option>
											<?php
												foreach ($lst_locales as $key) {
                                                    if($key->id==$id_local){
                                                        echo '<option selected value="'.$key->id.'">'.$key->descripcion.'</option>';
                                                    }else{
                                                        echo '<option value="'.$key->id.'">'.$key->descripcion.'</option>';
                                                    }
												}
											?>
										</select>
										<div class="valid-feedback" id="select_sector_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="select_sector_error">
											Por favor, seleccione la villa donde se ubica el cliente.
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
									<a href="<?php echo base_url();?>clientes" class="btn btn-cancel"> Cancelar </a>
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
		var input_nombre = $('#input_nombre').val();
		validador = validador + valida_input('input_nombre');
        
		var input_apellido = $('#input_apellido').val();
		validador = validador + valida_input('input_apellido');

		var select_tipo_documento = $('#select_tipo_documento').val();
		validador = validador + valida_input('select_tipo_documento');

		var input_nro_documento = $('#input_nro_documento').val();
		validador = validador + valida_input('input_nro_documento');

		var input_celular_1 = $('#input_celular_1').val();
		validador = validador + valida_input('input_celular_1');

		var input_celular_2 = $('#input_celular_2').val();
		validador = validador + valida_input('input_celular_2');

		var select_sector = $('#select_sector').val();
		validador = validador + valida_input('select_sector');

		var input_direccion = $('#input_direccion').val();
		validador = validador + valida_input('input_direccion');

		if(validador>0){return;}

		$.ajax({
			type: "POST",
			url: '<?php echo base_url();?>Controller_villa_clientes/update',
			data: {
				'input_nombre':input_nombre,
				'input_apellido':input_apellido,
				'select_tipo_documento':select_tipo_documento,
				'input_nro_documento':input_nro_documento,
				'input_celular_1':input_celular_1,
				'input_celular_2':input_celular_2,
				'select_sector':select_sector,
				'input_direccion':input_direccion
			}, 
			beforeSend:function(){
			},   
			success: function(data){ 
				if(data=='1'){
					limpiar();
					Swal.fire({ 
						title: "Cliente actualizado!", 
						text: "Se actualizó correctamente los datos del cliente!", 
						type: "success", confirmButtonClass: "btn btn-primary", buttonsStyling: !1 
					})
				}else{

				}
			}
		});
    }
    </script>
