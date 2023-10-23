<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Agregar Evento</h4>
							<h6>Registrar un nuevo evento</h6>
						</div>
					</div>

					<!-- /add -->
					<div class="card">
						<div class="card-body">
							<div class="row">
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <h4>Datos del Cliente</h4>
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
										<label>Nombres</label>
										<input type="text" id="input_nombre" placeholder="Ingrese nombres completos">
										<div class="valid-feedback" id="input_nombre_success" >
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
										<input type="text" id="input_apellido" placeholder="Ingrese apellidos completos">
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

								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Zona de Villa</label>
										<select class="form-control" id="select_sector" placeholder="Ingrese local o sector">
											<option value="">Seleccione Villa</option>
											<?php
												foreach ($lst_locales as $key) {
													echo '<option value="'.$key->id.'">'.$key->descripcion.'</option>';
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
										<textarea class="form-control" id="input_direccion"></textarea>
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
							</div>
						</div>
					</div>
					<!-- /add -->                    

					<!---->
					<input type="hidden" id="id_key" value='<?php echo $key_generada;?>'>
					<!---->

					<!-- /Datos de la cotización o tipo de evento a registrar -->
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12 col-sm-12 col-12">
                                    <h4>Registrar tipo de evento</h4>
                                </div>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Tipo de evento</label>
										<select class="form-control" id="select_tipo_evento" onchange="change_select('select_tipo_evento')">
											<option value="">Seleccion</option>
											<?php
												foreach ($lst_tipo_eventos as $key) {
													echo '<option value="'.$key->id.'">'.$key->descripcion.'</option>';
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
								<div class="col-lg-3 col-sm-6 col-12" style="display:none;" id="panel_proforma">
									<div class="form-group">
										<label>Código Proforma</label>
										<select class="form-control" id="select_codigo_proforma">
											<option value="">Seleccion</option>
											<?php
												foreach ($lst_proforma as $key) {
													echo '<option value="'.$key->id.'">'.$key->descripcion.'</option>';
												}
											?>
										</select>
										<div class="valid-feedback" id="select_tipo_documento_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="select_tipo_documento_error">
											Por favor, seleccione la proforma
										</div>	
									</div>
								</div>								
							</div>
						</div>
					</div>
					<!-- /add -->



                    <!--AGENDA DE CITA-->
					<div class="card" id="panel_agenda" style="display:none;">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12 col-sm-12 col-12">
                                    <h4>Agendar Cita</h4>
                                </div>
                                <!--PANEL AGENDA-->
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Fecha Cita</label>
										<input class="form-control"  type="date" id="">
										<div class="valid-feedback" id="_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="_error">
											Por favor, .
										</div>		
									</div>
								</div>
								<div class="col-lg-1 col-sm-6 col-12">
									<div class="form-group">
										<label>Hora Inicio</label>
										<select class="form-control" id="select_hora_inicio">
											<option value="">00 am</option>
											<?php
                                                for ($i=8; $i < 20; $i++) {
                                                    echo '<option value="'.$i.'">'.$i.' am</option>';
                                                }
											?>
										</select>
										<div class="valid-feedback" id="_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="_error">
											Por favor, .
										</div>		
									</div>
								</div>
								<div class="col-lg-1 col-sm-6 col-12">
									<div class="form-group">
										<label>Hora Fin</label>
										<select class="form-control" id="select_hora_fin">
											<option value="">00 am</option>
											<?php
                                                for ($i=8; $i < 20; $i++) {
                                                    echo '<option value="'.$i.'">'.$i.' am</option>';
                                                }
											?>
										</select>
										<div class="valid-feedback" id="_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="_error">
											Por favor, .
										</div>		
									</div>
								</div>								
								<div class="col-lg-12">
									<div class="form-group">
										<label>Descripción breve</label>
										<textarea class="form-control" id="input_descripcion"></textarea>
										<div class="valid-feedback" id="input_descripcion_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="input_descripcion_error">
											Por favor, ingrese una dirección.
										</div>	
									</div>
								</div>                           
                                <div class="col-lg-1 col-sm-6 col-12">
                                    <div class="form-group">
                                        <button class="btn btn-secondary" onclick="add_agenda();"> Grabar agenda </button>
                                    </div>
                                </div>								  
                                <!--FIN PANEL AGENDA-->
							</div>
						</div>
					</div>
					<!-- /add -->

                    <!--AGENDA DE CITA-->
					<div class="card" id="panel_cotizacion" style="display:none;">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12 col-sm-12 col-12">
                                    <h4>Cotizador</h4>
                                </div>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Seleccione Producto</label>
										<select class="form-control" id="select_producto">
											<option value="">Producto / Servicio</option>
											<?php 
												foreach ($lst_productos as $key){
													echo'<option value="'.$key->id.'">'.$key->nombre.'</option>'; 
												}
											?>
										</select>                                        
										<div class="valid-feedback" id="select_producto_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="select_producto_error">
											Por favor, ingrese una dirección.
										</div>	
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Cantidad</label>
										<input class="form-control"  type="number" id="input_cantidad" min="0" value="" placeholder="0">
										<div class="valid-feedback" id="input_cantidad_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="input_cantidad_error">
											Por favor, ingrese la cantidad a cotizar.
										</div>	
									</div>
								</div>								                         
                                <div class="col-lg-1 col-sm-6 col-12">
                                    <div class="form-group">
                                        <button class="btn  btn-sm btn-cancel" onclick="add();"> Agregar </button>
                                    </div>
                                </div>
								<div class="col-lg-12 col-sm-12 col-12">
									<div class="table-responsive">
										<table class="table table-bordered mb-0">
											<thead>
												<tr>
													<th>Producto/Servicio</th>
													<th>Precio</th>
													<th>Cantidad</th>
													<th>Total</th>
													<th>Opción</th>
												</tr>
											</thead>
											<tbody id="temp_detalle">
											</tbody>
										</table>
									</div>
								</div>
								<div class="col-lg-12 col-sm-12 col-12">
									<div class="table-responsive">
										<table class="table table-bordered mb-0">
											<tbody>
												<tr><td> <label>Total</label> </td><td><label id="t_total">00.00</label></td></tr>
											</tbody>
										</table>
									</div>
								</div>
								<!--Agregar--> 	
                                <div class="col-lg-1 col-sm-6 col-12 mt-1">
                                    <div class="form-group">
                                        <button class="btn  btn-sm btn-cancel" onclick="save_cotizacion();"> Guardar</button>
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
    function get_value(id){
        return $('#'+id).val();
    }
    function reset_value(id){
        return $('#'+id).val('');
    }
    
	function save_cotizacion(){
        var id_key = get_value('id_key');
        
		//Cotización
        var select_tipo_evento = get_value('select_tipo_evento');

		//Datos del cliente
		var id_key = get_value('id_key');
		var input_nro_documento 	= get_value('input_nro_documento');
		var select_tipo_documento 	= get_value('select_tipo_documento');
		var input_nombre 			= get_value('input_nombre');
		var input_apellido 			= get_value('input_apellido');
		var input_celular_1 		= get_value('input_celular_1');
		var input_celular_2 		= get_value('input_celular_2');
		var select_sector 			= get_value('select_sector');
		var input_direccion 		= get_value('input_direccion');
		var select_tipo_evento 		= get_value('select_tipo_evento');
		
		$.ajax({
			type: "POST",
			url: '<?php echo base_url();?>Controller_villa_cotizacion/save_cotizacion',
			data: {
				'id_key':id_key,
				'select_tipo_evento':select_tipo_evento,
				'input_nro_documento':input_nro_documento,
				'select_tipo_documento':select_tipo_documento,
				'input_nombre':input_nombre,
				'input_apellido':input_apellido,
				'input_celular_1':input_celular_1,
				'input_celular_2':input_celular_2,
				'select_sector':select_sector,
				'input_direccion':input_direccion
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
					case 'sin_id_cliente':
						Swal.fire({ 
							title: "El cliente no cuenta con un código de registro!", 
							text: "Hubo un error, el cliente ingresado no cuenta con código!", 
							type: "error", confirmButtonClass: "btn btn-primary", buttonsStyling: !1 
						})				
						break;
					case 'sin_productos':
						Swal.fire({ 
							title: "Cotización sin productos/servicios seleccionados!", 
							text: "Ocurrió un erro, el cotizador no cuenta con productos a registrar!", 
							type: "error", confirmButtonClass: "btn btn-primary", buttonsStyling: !1 
						})
						break;
					case 'error_insert_event':
						Swal.fire({ 
							title: "Ocurrió un error al registrar el evento!", 
							text: "Ocurrió un error, no se pudo guardar el evento seleccionado, intentarlo de nuevo!", 
							type: "error", confirmButtonClass: "btn btn-primary", buttonsStyling: !1 
						})
						break;
					case 'error_insert_productos':
						Swal.fire({ 
							title: "Ocurrió un error al registrar los productos!", 
							text: "Ocurrió un error al insertar los productos cotizados,  intentarlo de nuevo!", 
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
    function add(){
        var id_producto = get_value('select_producto');
        var cantidad = get_value('input_cantidad');
        var id_key = get_value('id_key');
        if(id_producto!='' && cantidad!='' && cantidad!='0'){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>Controller_villa_cotizacion/add_temporal',
                data: {
                    'id_key':id_key,
                    'id_producto':id_producto,
                    'cantidad':cantidad
                }, 
                beforeSend:function(){
                },   
                success: function(data){ 
                    reset_value('select_producto');
                    reset_value('input_cantidad');
                    Swal.fire({ 
                        title: "Producto o Servicio agregado!", 
                        text: "Se agregó un producto o servicio a su cotización!", 
                        type: "success", confirmButtonClass: "btn btn-primary", buttonsStyling: !1 
                    })
                    get_temp_cotizacion(); 
                }
            });
        }else{
            Swal.fire({ 
                title: "Seleccione un producto o servicio!", 
                text: "Elija un producto o servicio para su cotización!", 
                type: "error", confirmButtonClass: "btn btn-danger", buttonsStyling: !1 
            })
        }
    }
    function get_temp_cotizacion(){
        var id_key = get_value('id_key');
        if(id_key!=''){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>Controller_villa_cotizacion/get_temp_cotizacion',
                data: {
                    'id_key':id_key
                }, 
                beforeSend:function(){
                },   
                success: function(data){
                    var cadena=''; 
					var content = JSON.parse(data);
					var monto_total = 0;
					if(content!='error'){
						for(var i=0; i < content.length; i++)
						{
							var id_producto =content[i]['id_producto'];
							var nombre	 	=content[i]['nombre'];
							var precio	 	=content[i]['precio'];
							var cantidad 	=content[i]['cantidad'];
							var id_key 		=content[i]['id_key'];
							var id 			=content[i]['id'];
							var totalito 	=precio * cantidad; 
							monto_total 	=totalito + monto_total; 
							cadena +='<tr><td> '+nombre+' </td><td> S/. '+precio+' </td><td> '+cantidad+' </td><td> S/. '+totalito+' </td><td><i class="fa fa-trash" onclick="delete_id('+id+');" data-bs-toggle="tooltip" title="" data-bs-original-title="fa fa-trash" aria-label="fa fa-trash"></i> </td></tr>';
						}
						$('#t_total').text('S/. '+ monto_total);
					}else{
						cadena +='<tr><td>Sin Registros</td></tr>';
						$('#t_total').text('S/. 00.00');
					}

                    $('#temp_detalle').html(cadena);
                }
            });
        }else{
            Swal.fire({ 
                title: "Seleccione un producto o servicio!", 
                text: "Elija un producto o servicio para su cotización!", 
                type: "error", confirmButtonClass: "btn btn-danger", buttonsStyling: !1 
            })
        }
    }
    function change_select(tipo){
        switch (tipo) {
            case 'select_tipo_evento':
                if(get_value(tipo)==2){
                    $('#panel_agenda').css('display','block');
                    $('#panel_cotizacion').css('display','none');
                    $('#panel_proforma').css('display','none');
                }else if(get_value(tipo)==1){
                    $('#panel_agenda').css('display','none');
                    $('#panel_cotizacion').css('display','block');
                    $('#panel_proforma').css('display','block');
                }else{
                    $('#panel_cotizacion').css('display','none');
                    $('#panel_agenda').css('display','none');
                    $('#panel_proforma').css('display','none');
                }
                break;
            default:
                break;
        }
    }
    //
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
	function delete_id(id){
        $.ajax({
			type: "POST",
			url: '<?php echo base_url();?>Controller_villa_cotizacion/delete',
			data: {
				'id':id
			}, 
			beforeSend:function(){
			},   
			success: function(data){ 
				if(data==1){
					Swal.fire({ 
						title: "Eliminado correctamente!", 
						text: "El producto o servicio seleccionado ha sido eliminado correctamente!", 
						type: "success", confirmButtonClass: "btn btn-primary", buttonsStyling: !1 
					})
					get_temp_cotizacion();
				}else{
					Swal.fire({ 
						title: "Ocurrió un error!", 
						text: "Ocurrio un error al eliminar el producto/servicio seleccionado!", 
						type: "error", confirmButtonClass: "btn btn-primary", buttonsStyling: !1 
					})
				}

			}
		});
    }
    function get_data_nro_documento(){
        var nro_documento = $('#input_nro_documento').val();
        $.ajax({
			type: "POST",
			url: '<?php echo base_url();?>Controller_villa_eventos/get_data_nro_documento',
			data: {
				'nro_documento':nro_documento
			}, 
			beforeSend:function(){
			},   
			success: function(data){ 
                var content = JSON.parse(data);
                $('#input_nombre').val(content[0].nombres);
                $('#input_apellido').val(content[0].apellidos);
                $('#input_celular_1').val(content[0].celular_1);
                $('#input_celular_2').val(content[0].celular_2);
                $('#input_direccion').val(content[0].direccion);
                $('#select_sector').val(content[0].id_local);
                $('#select_tipo_documento').val(content[0].id_tipo_documento);
			}
		});
    }
	function insert_cliente(){
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
			url: '<?php echo base_url();?>Controller_villa_clientes/insert_cliente',
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
						title: "Cliente agregado!", 
						text: "Gracias por registrar un nuevo Cliente!", 
						type: "success", confirmButtonClass: "btn btn-primary", buttonsStyling: !1 
					})
				}else{

				}
			}
		});
	}
    </script>
