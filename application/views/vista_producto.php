
			
			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Buscar Por DNI</h4>
							<h6>Encuentralos</h6>
						</div>
						<!-- <div class="page-btn">
							<a href="<?php echo base_url();?>product_add" class="btn btn-added"><img src="<?php echo base_url();?>public/assets/img/icons/plus.svg" alt="img" class="me-1">Agregar nuevo producto</a>
						</div> -->
					</div>

					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Buscar por DNI</label>
										<input type="text" id="input_dni">
										<div class="valid-feedback" id="input_nombre_success">
											Se ve bien!
										</div>
										<div class="invalid-feedback" id="input_nombre_error">
											Por favor, ingrese el Dni 
										</div>	
										<div class="col-lg-12 mt-3" >
											<a href="javascript:void(0);" onclick="buscar_persona();" class="btn btn-submit me-2">Enviar</a>
											<!-- <a href="<?php echo base_url();?>product_list" class="btn btn-cancel">Cancelar</a> -->
										</div>									
									</div>							
											
								
								
							</div>
						</div>
					</div>
					
					<div class=" col-lg-9 card p-3 m-3" style="background-color:#0F4582; border-radius: 15px;">
						<div class="row align-items-center">
							<div class="col-lg-4 col-sm-6 col-12">
								<!-- Tarjeta 1 -->
								<div class="card" style="border: 0;">
									<div class="card-body" style="background-color:#0F4582; color:white ; ">
										<h5 class="card-title" style="color:white">Carnet</h5>
										<h5 class="card-title" style="color:white">Estudiantil</h5>
										<img src="<?= base_url('public/img/user.png') ?>" class="card-img-top rounded-circle" alt="Foto de perfil">
										<h5 class="card-title" style="color:white">SENATI</h5>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<!-- Tarjeta 2 (centrada verticalmente) -->
								<div class="card" style="border: 0;">
									<div class="card-body" style="background-color:#0F4582; color:white">
										<p class="" id="nombre_estudiante">Nombre</p>
										<p class="" id="ape_pat">Apellido Paterno</p>
										<p class="" id="ape_mat">Apellido Materno</p>
										<p class="" id="">Ing. de Software con IA</p>
										<p class="" id="identificacion">Dni: </p>
									</div>
								</div>
							</div>
							<div class="col-lg-4 d-flex flex-column justify-content-between">
								<!-- Tarjeta 3 -->
								<div class="card" style="border: 0;">
									<div class="card-body" style="background-color:#0F4582; color:white; float:">
										<span id="hora_actual">00:00:00</span>
									</div>
								</div>
								<div class="card" style="border: 0;">
									
									<div class="card-body" style="height:150px; background-color:#0F4582;">">
										
									</div>
									
								</div>
								<div class="card" style="border: 0;">
									<div class="card-body" style="background-color:#0F4582; color:white">
										<p id="ape_mat">SOMOS</p>
										<p id="ape_mat">FUTURO</p>
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
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
				
					actualizarHora(); 
                });
				function actualizarHora() {
				var elementoHora = document.getElementById("hora_actual");
				var fecha = new Date();
				var hora = fecha.getHours();
				var minutos = fecha.getMinutes();
				var segundos = fecha.getSeconds();
				var horaActual = hora + ":" + minutos + ":" + segundos;
				elementoHora.textContent = horaActual;
			}

			// Actualizar la hora cada segundo (1000 milisegundos)
			setInterval(actualizarHora, 1000);

			// Llamar a la función para mostrar la hora actual al cargar la página
			

				function search(){
					table.ajax.reload(null,false);
				}
				function buscar_persona(){
					var dni = $('#input_dni').val();
					$.ajax({
						type: "POST",
						url: '<?php echo base_url();?>Controller_producto/buscar_persona',
						data: {
							'dni':dni							
						}, 
						dataType: 'json',
						beforeSend:function(){
							
						},   
						success: function(data){ 
							//var json = JSON.parse(data);
							//alert(data);
							if (data){
								$('#nombre_estudiante').text(data.nombres);
								$('#identificacion').text('DNI: ' + data.dni);
								$('#ape_pat').text(data.apellidoPaterno);
								$('#ape_mat').text(data.apellidoMaterno);
							
							}else{		
								Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: 'Something went wrong!',
								footer: '<a href="">Why do I have this issue?</a>'
								})					
								
							}
						}
					});
				}
				

				
                
        </script>
