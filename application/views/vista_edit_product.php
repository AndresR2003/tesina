        <div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Editar Producto</h4>
							<h6>Actualizar tu producto</h6>
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
										<label>Nombre de producto</label>
										<input type="text" id="input_nombre" value="<?php echo $kex->nombre;?>">
										<div class="valid-feedback" id="input_nombre_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="input_nombre_error">
											Por favor, ingrese el nombre del producto.
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Marca</label>
										<select class="select" id="select_marca">
											<option value="">Seleccione Marca<?php echo $kex->id_marca;?></option>
											<?php 
												foreach ($lst_marca as $key) {
													if($key->id==$kex->id_marca){
														echo '<option selected value="'.$key->id.'">'.$key->descripcion.'</option>';
													}else{
														echo '<option value="'.$key->id.'">'.$key->descripcion.'</option>';
													}
												}
											?>
										</select>
										<div class="valid-feedback" id="select_marca_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="select_marca_error">
											Por favor, seleccione la marca.
										</div>		
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Categoría</label>
										<select class="select" id="select_categoria">
											<option value="">Seleccione Categoría</option>
											<?php 
												foreach ($lst_categoria as $key) {
													if($key->id==$kex->id_categoria){
														echo '<option selected value="'.$key->id.'">'.$key->nombre.'</option>';
													}else{
														echo '<option value="'.$key->id.'">'.$key->nombre.'</option>';
													}
												}
											?>
										</select>
										<div class="valid-feedback" id="select_categoria_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="select_categoria_error">
											Por favor, seleccione la categoría.
										</div>	
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Sub Categoría</label>
										<select class="select" id="select_subcategoria">
											<option value="">Seleccione SubCategoría</option>
											<?php 
												foreach ($lst_subcategoria as $key) {
													if($key->id==$kex->id_subcategoria){
														echo '<option selected value="'.$key->id.'">'.$key->descripcion.'</option>';
													}else{
														echo '<option value="'.$key->id.'">'.$key->descripcion.'</option>';
													}
												}
											?>
										</select>
										<div class="valid-feedback" id="select_subcategoria_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="select_subcategoria_error">
											Por favor, seleccione la subcategoría.
										</div>	
									</div>
								</div>								
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Unidad</label>
										<select class="select" id="select_unidad">
											<option value="">Seleccione Unidad</option>
											<?php 
												foreach ($lst_unidad as $key) {
													if($key->id==$kex->id_unidad){
														echo '<option selected value="'.$key->id.'">'.$key->descripcion.'</option>';
													}else{
														echo '<option value="'.$key->id.'">'.$key->descripcion.'</option>';
													}
												}
											?>											
										</select>
										<div class="valid-feedback" id="select_unidad_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="select_unidad_error">
											Por favor, seleccione la unidad.
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>SKU</label>
										<input type="text" id="input_sku" value="<?php echo $kex->sku;?>">
										<div class="valid-feedback" id="input_sku_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="input_sku_error">
											Por favor, ingrese el código SKU.
										</div>	
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Cantidad</label>
										<input type="text" id="input_cantidad" value="<?php echo $kex->cantidad;?>" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
										<div class="valid-feedback" id="input_cantidad_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="input_cantidad_error">
											Por favor, ingrese la cantidad.
										</div>	
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label>Descripción</label>
										<textarea class="form-control" id="input_descripcion"><?php echo $kex->descripcion;?></textarea>
										<div class="valid-feedback" id="input_descripcion_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="input_descripcion_error">
											Por favor, ingrese una descripción.
										</div>	
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Precio</label>
										<input type="text" id="input_precio" value="<?php echo $kex->precio;?>" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
										<div class="valid-feedback" id="input_precio_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="input_precio_error">
											Por favor, ingrese el precio.
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
											<option <?php echo $si;?> value="1">Activo</option>
											<option <?php echo $no;?> value="0">Cerrado</option>
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
									<div class="form-group">
										<label>	Product Image</label>
										<div class="image-upload">
											<input type="file">
											<div class="image-uploads">
												<img src="<?php echo base_url();?>public/assets/img/icons/upload.svg" alt="img">
												<h4>Drag and drop a file to upload</h4>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12">
									<div class="product-list">
										<ul class="row">
											<li>
												<div class="productviews">
													<div class="productviewsimg">
														<img src="<?php echo base_url();?>public/assets/img/icons/macbook.svg" alt="img">
													</div>
													<div class="productviewscontent">
														<div class="productviewsname">
															<h2>macbookpro.jpg</h2>
															<h3>581kb</h3>
														</div>
														<a href="javascript:void(0);" class="hideset">x</a>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
								<div class="col-lg-12">
									<a href="javascript:void(0);" onclick="update(<?php echo $kex->id;?>);" class="btn btn-submit me-2"> Actualizar </a>
									<a href="<?php echo base_url();?>product_list" class="btn btn-cancel" >Cancelar</a>
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
				var select_categoria = $('#select_categoria').val();
				validador = validador + valida_input('select_categoria');
				var select_subcategoria = $('#select_subcategoria').val();
				validador = validador + valida_input('select_subcategoria');
				var select_marca = $('#select_marca').val();
				validador = validador + valida_input('select_marca');
				var select_unidad = $('#select_unidad').val();
				validador = validador + valida_input('select_unidad');
				var input_sku = $('#input_sku').val();
				validador = validador + valida_input('input_sku');
				var input_cantidad = $('#input_cantidad').val();
				validador = validador + valida_input('input_cantidad');
				var input_descripcion = $('#input_descripcion').val();
				validador = validador + valida_input('input_descripcion');
				var input_precio = $('#input_precio').val();
				validador = validador + valida_input('input_precio');
				var select_estado = $('#select_estado').val();
				validador = validador + valida_input('select_estado');
				if(validador>0){return;}
				$.ajax({
					type: "POST",
					url: '<?php echo base_url();?>Controller_producto/update',
					data: {
						'id':id,
						'input_nombre':input_nombre,
						'select_marca':select_marca,
						'select_categoria':select_categoria,
						'select_subcategoria':select_subcategoria,
						'select_unidad':select_unidad,
						'input_sku':input_sku,
						'input_cantidad':input_cantidad,
						'input_descripcion':input_descripcion,
						'input_precio':input_precio,
						'select_estado':select_estado
					}, 
					beforeSend:function(){
					},   
					success: function(data){ 
						if(data=='1'){
							limpiar();
							Swal.fire({ 
								title: "¡Producto actualizado!", 
								text: "Se actualizó correctamente los detalles del producto.", 
								type: "success", confirmButtonClass: "btn btn-primary", buttonsStyling: !1 
							})
						}else{

						}
					}
				});
			}
        </script>
