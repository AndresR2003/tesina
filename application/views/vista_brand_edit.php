<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Editar Marca</h4>
							<h6>Actualizar Marca</h6>
						</div>
					</div>

<?php 
	foreach ($lst_data as $kex){
?>
					<!-- /add -->
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Nombre de Marca</label>
										<input type="text" id="input_nombre" value="<?php echo $kex->descripcion;?>">
										<div class="valid-feedback" id="input_nombre_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="input_nombre_error">
											Por favor, ingrese el nombre de la marca.
										</div>
									</div>
								</div>
								<?php 
									$estado = $kex->estado; 
									$si='';
									$no='';
									if($estado==0){
										$si='selected';
									}else{
										$no='selected';
									}
								?>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>	Estado</label>
										<select class="select" id="select_estado">
											<option value="">Seleccione</option>
											<option <?php echo $si;?> value="0">Activo</option>
											<option <?php echo $no;?> value="1">Cerrado</option>
										</select>
										<div class="valid-feedback" id="select_estado_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="select_estado_error">
											Por favor, seleccione el estado.
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<a href="javascript:void(0);" onclick="update(<?php echo $kex->id;?>);" class="btn btn-submit me-2"> Actualizar </a>
									<a href="<?php echo base_url();?>brand_list" class="btn btn-cancel" >Cancelar</a>
								</div>
							</div>
						</div>
					</div>
					<!-- /add -->
<?php 
	}
?>
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
				var select_estado = $('#select_estado').val();
				validador = validador + valida_input('select_estado');
				if(validador>0){return;}
				$.ajax({
					type: "POST",
					url: '<?php echo base_url();?>Controller_brand/update',
					data: {
						'id':id,
						'input_nombre':input_nombre,
						'select_estado':select_estado
					}, 
					beforeSend:function(){
					},   
					success: function(data){ 
						if(data=='1'){
							limpiar();
							Swal.fire({ 
								title: "Marca actualizada!", 
								text: "Se actualizó correctamente los detalles de la Marca.", 
								type: "success", confirmButtonClass: "btn btn-primary", buttonsStyling: !1 
							})
						}else{

						}
					}
				});
			}
        </script>
