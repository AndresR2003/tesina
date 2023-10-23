<div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Agregar Marca de productos</h4>
                        <h6>Crear nueva marca de producto</h6>
                    </div>
                </div>
                <!-- /add -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Nombre de la marca</label>
                                    <input class="input" type="text" id="input_nombre">
                                    <div class="valid-feedback" id="input_nombre_success">
                                        Se ve bien!
                                    </div>
                                    <div class="invalid-feedback" id="input_nombre_error">
                                        Por favor, ingrese el nombre de la marca.
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <a href="javascript:void(0);" onclick="insert();" class="btn btn-submit me-2">Enviar</a>
                                <a href="<?php echo base_url();?>brand_list" class="btn btn-cancel">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /add -->
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
    function restablecer_inputs(){
        $('.input').val('');
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

	function insert(){
		var validador=0; 
		var input_nombre = $('#input_nombre').val();
        validador = validador + valida_input('input_nombre');
        if(validador>0){return;}
		$.ajax({
			type: "POST",
			url: '<?php echo base_url();?>Controller_brand/insert',
			data: {
				'input_nombre':input_nombre
			}, 
			beforeSend:function(){
			},   
			success: function(data){ 
				if(data=='1'){
                    limpiar();
                    restablecer_inputs();
					Swal.fire({ 
						title: "Marca agregada!", 
						text: "Gracias por registrar una nueva marca!", 
						type: "success", confirmButtonClass: "btn btn-primary", buttonsStyling: !1 
					})
				}else{

				}
			}
		});
	}
    </script>
