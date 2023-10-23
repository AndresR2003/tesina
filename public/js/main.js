		/**********************************************************************************************************/
		/****************************************FUNCIONES GLOBALES************************************************/
		/**********************************************************************************************************/
		/**********************************************************************************************************/
        function alerta_error(tipo,titulo,mensaje){
            var $toast = toastr[tipo](titulo,mensaje); 
            $toastlast = $toast; 
        }
        function alerta_success(tipo,titulo,mensaje){
            var $toast = toastr[tipo](titulo,mensaje); 
            $toastlast = $toast; 
        }  
        		
		function  get_data_input(id){
			var retorno = $(id).val();
			return retorno;
		}
		function pintar_input_success(id){
			$(id).css('border','1px solid green');
		}
		function pintar_input_error(id){
			$(id).css('border','1px solid red');
		}
		function set_data_carga(title,mensaje,imagen){
			$('#txt_carga').text(title);
			$('#img_carga').attr('src','/sistema_lindley/public/img/'+imagen);
		}		
        function input_error(id){
            $(id).css('border','1px solid red');
        }
        function input_success(id){
            $(id).css('border','1px solid #7fc185');
        }   

		/**********************************************************************************************************/
		/****************************FUNCIONES ASIGNACION GUIAS A CHOFER ******************************************/
		/**********************************************************************************************************/
		/**********************************************************************************************************/
		function abrir_modal_guia_asignacion (id_clientexuser){
			$('#updclientexuser').val(id_clientexuser);
			/*Cargamos las guias disponibles del usuario supervisor*/
			$.ajax({
				type: "POST",
				url: 'cargar_guias_supervisor',
				data: {}, 
				beforeSend:function(){
					$(".loader").fadeIn('slow');
				},   
				success: function(data){
					$('#slc_guias_disponibles').html(data);
				  	$(".loader").fadeOut('slow');
				  	setTimeout(function(){$('#mdl_asignacion_guia_x_chofer').modal('show');},1000);
					//tb_recojos_supervisor.ajax.reload(null,false);
					//tb_recojos_supervisor_asignados.ajax.reload(null,false);
					//$(".loader").fadeOut("slow");
				}
			});   			
			/**/
		}
		function asignar_guia_usuario(){
			/*Obtenemos ids*/
			idclientexuser = $('#updclientexuser').val();
			idguiaxusuario = $('#slc_guias_disponibles').val();
			$.ajax({
				type: "POST",
				url: 'asignar_guia_usuario',
				data: {'idclientexuser':idclientexuser,'idguiaxusuario':idguiaxusuario}, 
				beforeSend:function(){
					$(".loader").fadeIn('slow');
				},   
				success: function(data){
					//$('#slc_guias_disponibles').html(data);
				  	$(".loader").fadeOut('slow');
					//$('#mdl_asignacion_guia_x_chofer').modal('show');
					tb_guias_supervisor.ajax.reload(null,false);
					tb_asignacion_guias_chofer.ajax.reload(null,false);
					//tb_recojos_supervisor_asignados.ajax.reload(null,false);
					//$(".loader").fadeOut("slow");
				}
			}); 			
		}

		/**********************************************************************************************************/
		/**********************************************************************************************************/
		/**********************************************************************************************************/
		/**********************************************************************************************************/
		/**********************************************************************************************************/



		function registrar_user_dep(iduser,idsuper){
			if(iduser>0 && idsuper>0){
			    $.ajax(
		        {
		            async:true,
		            type: "POST",
		            dataType:"html",
		            cache: false,
		            contentType:"application/x-www-form-urlencoded",
		            url:"/sistema_lindley/usuarios/asignar_usuario",
		            data:{'iduser':iduser,'idsuper':idsuper},
		            success:function(datos){
						modal_mensaje('Usuario asignado','Usuario registrado a su gestión');
		            	location.reload();
		            },
		            error: function(){
		            }
		        })				
			}else{
				modal_mensaje('Usuario no puede asociarse a su cargo','Lo sentmos');
			}
		}
		function actualizar_estado(iduser){
			estado = obtener_data_chk('#chklogin');
			if(estado>=0){
			    $.ajax(
		        {
		            async:true,
		            type: "POST",
		            dataType:"html",
		            cache: false,
		            contentType:"application/x-www-form-urlencoded",
		            url:"/sistema_lindley/usuarios/actualizar_estado",
		            data:{'iduser':iduser,'estado':estado},
		            success:function(datos){
						alerta_success('success','Estado de login actualizado','');
		            	setTimeout(function(){ location.reload();}, 3000); 
		            },
		            error: function(){
		            }
		        })				
			}else{
				modal_mensaje('Seleccione el dato','Seleccione uno de los campos');
			}
		}
		function agregar_user_dep(iduser,idsuper){
			iddepa = obtener_data('#adddepar');
			if(iduser!='' && idsuper!='' && iddepa!=''){
			    $.ajax(
		        {
		            async:true,
		            type: "POST",
		            dataType:"html",
		            cache: false,
		            contentType:"application/x-www-form-urlencoded",
		            url:"/sistema_lindley/usuarios/agregar_departamento",
		            data:{'iduser':iduser,'idsuper':idsuper,'iddepa':iddepa},
		            success:function(datos){
		            	if($.trim(datos)=='ok'){
		            		alerta_success('success','Departamento asignado correctamente','');
		            		setTimeout(function(){ location.reload();}, 2000); 
		            	}
		            	if($.trim(datos)=='error2'){
		            		alerta_error('warning','El departamento ya se encuentra asignado a otro usuario.','');
		            		$('#adddepar').val('');
		            	}

		            	if($.trim(datos)=='error'){
		            		alerta_error('warning','Retirar para asignar otro','El supervisor tiene un departamento activo');
		            		$('#adddepar').val('');
		            	}
		            },
		            error: function(){
		            }
		        })				
			}else{
		        alerta_error('warning','Seleccione el departamento','El departamento es obligatorio.');
			}		
		}

		function retirar_user_dep(iduser,idsuper,idclientexuser){
			if(iduser!='' && idsuper!=''){
			    $.ajax(
		        {
		            async:true,
		            type: "POST",
		            dataType:"html",
		            cache: false,
		            contentType:"application/x-www-form-urlencoded",
		            url:"/sistema_lindley/usuarios/retirar_user",
		            data:{'iduser':iduser,'idsuper':idsuper,'idclientexuser':idclientexuser},
		            success:function(datos){
		            	if($.trim(datos)!='1error'){
		            		alerta_success('success','Usuario retirado del departamento activo.','');
		            		//setTimeout(function(){ location.reload();}, 3000); 		            	
		            	}else{
		            		alerta_error('warning','No se pudo actualizar.','');
		            	}
		            },
		            error: function(){
		            }
		        })				
			}
		}

		function abrir_mdl_activo(){
			cambiar_data('#titleactivo','¿Está seguro de cambiar el estado activo?');
			cambiar_data('#desactivo','Se actualizará siempre y cuando no haya visitas pendientes por realizar');
			$('#mldactivo').modal('show');
		}

    	function verifica_usuario(id){
    		var dep = $(id).val();
    		if(dep!='40' && dep!='60'){
    			$("#addsuper").prop('disabled', false);
    		}else{
    			if(dep=='60'){
	    			$("#adddepar").prop('disabled', true);
    			}
    			if(dep=='40'){
	    			$("#adddepar").prop('disabled', false);
    			}    			
    			$("#addsuper").prop('disabled', true);
    		}

    	}    
		function load_depar_usuario(id){

			if(id!=''){
			    $.ajax(
		        {
		            async:true,
		            type: "POST",
		            dataType:"html",
		            cache: false,
		            contentType:"application/x-www-form-urlencoded",
		            url:"/sistema_lindley/usuarios/load_departmento",
		            data:{'id':obtener_data(id)},
		            success:function(datos){
		                if($.trim(datos)!='error'){
		                	$('#adddepar').val(datos);
		                }
		            },
		            error: function(){
		            }
		        })				
			}
		}

        function regresar(){
        	location.reload();
        }
		function activa_panel_actualizar(panel){
	       $(panel).css('display','block');
	       $('#panel_lista').css('display','none');
	       $('#panel_lista2').css('display','none');	       
		} 
        function validador_data(src,dato){
        	if(dato!=''){
		        $(src).attr('src','/sistema_lindley/public/img/check.png');
		        return 1;
        	}else{
		        $(src).attr('src','/sistema_lindley/public/img/close.png');
        		return 0;
        	}
        }        

        function set_data(id){
	    	return $(id).val("");
        }
        function set_img(src){
		    $(src).attr('src','');
        }
        function limpiar_campos(){
        	set_data('#addnombres');
        	set_data('#addapellidos');
        	set_data('#adddni');
        	set_data('#addcorreo');
        	set_data('#addtelef');
        	set_data('#addtipouser');
        	set_data('#adduser');
        	set_data('#addclave');
        	set_data('#addsuper');
        	set_img('.msg_img');
        }
	    function obtener_data(id){
	    	return $(id).val();
	    }
		function cambiar_data(id,dato){
	    	return $(id).text(dato);
		}
		function cambiar_in(id,dato){
	    	return $(id).val(dato);
		}		
		function obtener_data_chk(id){
	    	var valor = 0 ;
	    	if($(id).is(':checked')){
        		valor=1;
        	}
        	return valor;
	    }
	    function modal_mensaje(titulo,mensaje){
			cambiar_data('#titlemsg',titulo);
			cambiar_data('#descrmsg',mensaje);
	         $('#modalmensaje').modal('show');
	    }
	    function ajax_validador(parametros,etiqueta,msg){
		    $.ajax(
	        {
	            async:true,
	            type: "POST",
	            dataType:"html",
	            cache: false,
	            contentType:"application/x-www-form-urlencoded",
	            url:"/sistema_lindley/usuarios/valida_usuario",
	            data:parametros,
	            success:function(datos){
	                if($.trim(datos)>0){
	                	$(etiqueta).css('border','1px solid red');
	                	$(msg).css('color','red');
	                	$(msg).text('El registro ya existe');
                		setTimeout(function(){
		                	$(msg).text('');
                		}, 3000);
	                }
	            },
	            error: function(){
	            }
	        })
	    }    	
	    function agregar_usuario(parametros){
		    $.ajax(
	        {
	            async:true,
	            type: "POST",
	            dataType:"html",
	            cache: false,
	            contentType:"application/x-www-form-urlencoded",
	            url:"/sistema_lindley/usuarios/agregar_usuario",
	            data:parametros,
	            beforeSend:function(){
	            	modal_mensaje('Agregando Usuario','Espere un momento....');
	            },
	            success:function(datos){
	            	if($.trim(datos)!='error'){
		            	modal_mensaje('Usuario Agregado','Gracias por esperar');
		            	$('#imgmensaje').attr('src','/sistema_lindley/public/img/check.png');
		            	location.reload();
		            	//limpiar_campos();	            		
	            	}else{
		            	modal_mensaje('Hubo un Errror','Parece que el registro de usuario / dni ya están registrados.');
		            	$('#imgmensaje').attr('src','/sistema_lindley/public/img/close.png');
	            	}
	            },
	            error: function(){
	            }
	        })	
	    }	
    	function load_data_usuario(id){
			if(id!=''){
            	cambiar_in('#idupd',id);
			    $.ajax(
		        {
		            async:true,
		            type: "POST",
		            dataType:"html",
		            cache: false,
		            contentType:"application/x-www-form-urlencoded",
		            url:"/sistema_lindley/usuarios/load_data",
		            data:{'id':id},
		            beforeSend:function(){
		            	modal_mensaje('Cargando Información','Espere un momento....');
		            },
		            success:function(datos){
		            	activa_panel_actualizar('#panel_agregar');
		            	modal_mensaje('Información lista para actualizar','Gracias por esperar');
		            	
		            	var json         = eval("(" + datos + ")");
     		 			cambiar_in('#addnombres',json.nombres);
     		 			cambiar_in('#addapellidos',json.apellidos);
     		 			cambiar_in('#addcorreo',json.correo);
     		 			cambiar_in('#addtelef',json.telefono);
     		 			cambiar_in('#addtipouser',json.tipo_usuario);
     		 			cambiar_in('#addsuper',json.user_supervisor);
     		 			cambiar_in('#adddni',json.dni);
     		 			cambiar_in('#adduser',json.usuario);
						if(json.estado==1) 
						$("#addestado").attr('checked', true); 
						else
						$("#addestado").attr('checked', false); 
						cambiar_data('#tipo','Actualizar Usuario');
						cambiar_data('#btnadduser','Actualizar Usuario');
						/*Deshabilitamos departamento*/
						$('#adddepar').attr('disabled',true);
						$('#addsuper').attr('disabled',true);
						$('#adduser').attr('disabled',true);
						$('#adddni').attr('adddni',true);
		            	/**/
		            	$('#imgmensaje').attr('src','/sistema_lindley/public/img/check.png');
		            },
		            error: function(){
		            }
		        })					
			}
		} 
		/*Para validadores de inputs*/



    $(document).ready(function(){



    	/*************************************************************************************************/
    	/*************************************************************************************************/
    	/*************************************************************************************************/
    	/*************************************************************************************************/
    	/**************************************MODULO ASIGNACION******************************************/
    	$('#check_selected_all_asignacion').click(function(){
    		var seleccionado = obtener_data_chk('#check_selected_all_asignacion');
    		/*Recorremos todos los checkbox para seleccionarlos*/
    		if(seleccionado==1){
	    		$("input:checkbox:checked").each(function() {
	    			  $(".check_asignacion").prop("checked", this.checked);  
				});    			
    		}else{
	    		$("input:checkbox:checked").each(function() {
	    			  $(".check_asignacion").prop("checked", false);  
				});  
    		}

    	});



    	/*************************************************************************************************/
    	/*************************************************************************************************/
    	/*************************************************************************************************/
    	/*************************************************************************************************/
    	/**************************************MODULO DATOS***********************************************/
    	$('#btn_cargar_xls_temporal').click(function(){
    		var inputfile = document.getElementById('file_xls_temporal');
			var file      = inputfile.files[0];
			var data      = new FormData();
			data.append('file',file);
			var tmp=0;
			$(':file').each(function(index, element) { 
			  if($(this).val() !=''){ tmp = 1; }
			}); 
			if(tmp==1){
				$.ajax({
				  type:'post',
				    contentType:false,
				    url:'/sistema_lindley/datos/subir_base_temporal',
				    data:data,
				    processData:false,
				    beforeSend:function(){
				    },
				    success: function(response){
                		/*Actualizamos por ajax*/
    					$('#file_xls_temporal').val('');
                		table_data_temporal.ajax.reload( null, false );
                		/*Retiramos la selección de base*/
				    }
				});
			}else{
				alerta_error('warning','Seleccione archivo excel a cargar',"Subir Excel");
			}			
		});

    	$('#btn_analizar_datos').click(function(){
			$.ajax({
			  type:'post',
			    contentType:false,
			    url:'/sistema_lindley/datos/verificar_clientes_repetidos',
			    data:{},
			    processData:false,
			    beforeSend:function(){
			    },
			    success: function(response){
		        	var json         = eval("(" + response + ")");
			    	$('#tb_clientes_duplicados').html(json.duplicados);
			    	$('#lbl_clientes_duplicados').text(json.total_duplicados);
			    	$('#tb_clientes_nuevos').html(json.nuevos);
			    	$('#lbl_clientes_nuevos').text(json.total_nuevos);
	        		//table_data_temporal.ajax.reload( null, false ); 
			    }
			});
    	})

   		$('#btn_analizar_datos_edf').click(function(){
			$.ajax({
			  type:'post',
			    contentType:false,
			    url:'/sistema_lindley/datos/verificar_edf_repetidos',
			    data:{},
			    processData:false,
			    beforeSend:function(){
			    },
			    success: function(response){
		        	var json         = eval("(" + response + ")");
			    	$('#tb_edf_duplicados').html(json.duplicados);
			    	$('#lbl_edf_duplicados').text(json.total_duplicados);
			    	$('#tb_edf_nuevos').html(json.nuevos);
			    	$('#lbl_edf_nuevos').text(json.total_nuevos);
			    	$('#tb_edf_sin_cliente').html(json.sin_cliente);
			    	$('#lbl_edf_sincliente').text(json.total_sin_clientes);

			    	
	        		//table_data_temporal.ajax.reload( null, false ); 
			    }
			});
    	})

        $('#btn_upload_clientes').click(function(){
			$.ajax({
			  type:'post',
			    contentType:false,
			    url:'/sistema_lindley/datos/upload_clientes_nuevos',
			    data:{},
			    processData:false,
			    beforeSend:function(){
			    },
			    success: function(response){
			    	/**/
			    	alert();
			    }
			});
    	})	

        $('#btn_upload_equipos').click(function(){
			$.ajax({
			  type:'post',
			    contentType:false,
			    url:'/sistema_lindley/datos/upload_equipos_nuevos',
			    data:{},
			    processData:false,
			    beforeSend:function(){
			    },
			    success: function(response){
			    	/**/
			    	alert();
			    }
			});
    	})	    	

    	$('#btn_cargar_xls_temporal_edf').click(function(){
    		var inputfile = document.getElementById('file_xls_temporal_edf');
			var file      = inputfile.files[0];
			var data      = new FormData();
			data.append('file',file);
			var tmp=0;
			$(':file').each(function(index, element) { 
			  if($(this).val() !=''){ tmp = 1; }
			}); 
			if(tmp==1){
				$.ajax({
				  type:'post',
				    contentType:false,
				    url:'/sistema_lindley/datos/subir_base_temporal_edf',
				    data:data,
				    processData:false,
				    beforeSend:function(){
				    },
				    success: function(response){
                		table_data_temporal_edf.ajax.reload( null, false ); 
    					$('#file_xls_temporal_edf').val('');
				    }
				});
			}else{
				alerta_error('warning','Seleccione archivo excel a cargar',"Subir Excel");
			}			
		});    	

    	/*************************************************************************************************/
    	/*************************************************************************************************/
    	/*************************************************************************************************/
    	/*************************************************************************************************/
    	/*************************************************************************************************/











    	$('#tb_pasignacion').DataTable();

	    $('#tb_userlibres').DataTable();
	    $('#tb_usersuper').DataTable();
	    $('#tb_cliexuser').DataTable();


  	
    	/********************************************************************************************************************/
    	/********************************************************************************************************************/
    	/************************** PARA GESTOR DE CAMPO - MODULO GESTION****************************************************/
    	/********************************************************************************************************************/
    	/********************************************************************************************************************/






				
	    /*PARA AGREGAR DATOS*/
        $("#adduser").change(function(){
        	var dato = obtener_data('#adduser');
			var parametros={'dato':dato,'campo':'usuario'}
			ajax_validador(parametros,'#adduser','#msgadduser');
    	});

        $("#adddni").change(function(){
        	var dato = obtener_data('#adddni');
			var parametros={'dato':dato,'campo':'dni'}
			ajax_validador(parametros,'#adddni','#msgadddni');
    	}); 

        $("#addcorreo").change(function(){
        	var dato = obtener_data('#addcorreo');
			var parametros={'dato':dato,'campo':'correo'}
			ajax_validador(parametros,'#addcorreo','#msgaddcorreo');
    	});

        $("#btnadduser").click(function(){
        	var validador = 0;

        	validador = validador_data('#imgnombres',obtener_data('#addnombres')) + 1 ;
        	validador = validador_data('#imgapellidos',obtener_data('#addapellidos')) + 1 ;
        	validador = validador_data('#imgdni',obtener_data('#adddni')) + 1 ;
        	validador = validador_data('#imgcorreo',obtener_data('#addcorreo')) + 1 ;
        	validador = validador_data('#imgtelefono',obtener_data('#addtelef')) + 1 ;
        	validador = validador_data('#imgtipousuario',obtener_data('#addtipouser')) + 1 ;
        	validador = validador_data('#imgusuario',obtener_data('#adduser')) + 1 ;
        	validador = validador_data('#imgclave',obtener_data('#addclave')) + 1 ;
        	validador = validador_data('#imgsuper',obtener_data('#addsuper')) + 1 ;
        	validador = validador_data('#imgdepar',obtener_data('#adddepar')) + 1 ;
        	if(obtener_data('#addtipouser')==''){return;}
        	if(obtener_data('#adduser')==''){return;}
			var parametros={
				'addnombres':obtener_data('#addnombres'),
				'addapellidos':obtener_data('#addapellidos'),
				'adddni':obtener_data('#adddni'),
				'addcorreo':obtener_data('#addcorreo'),
				'addtelef':obtener_data('#addtelef'),
				'adduser':obtener_data('#adduser'),
				'addtipouser':obtener_data('#addtipouser'),
				'addclave':obtener_data('#addclave'),
				'addsuper':obtener_data('#addsuper'),
				'addestado':obtener_data_chk('#addestado'),
				'adddepartamento':obtener_data('#adddepar')
			}
			agregar_usuario(parametros);
    	});
    	$("#btnload").click(function(){
              $(".loader").fadeOut("slow");
    	});
    });

	// mensajes de validaciÃ³n para los formularios
	jQuery(document).ready(function($) {
	    jQuery.extend(jQuery.validator.messages, {
	        required: "Este campo es requerido.",
	        remote: "Por favor arregla este campo.",
	        email: "Por favor, introduce una dirección de correo electrónico válida.",
	        url: "Por favor, introduce una URL válida.",
	        date: "Por favor, introduce una fecha válida.",
	        dateISO: "Por favor, introduce una fecha válida (ISO).",
	        number: "Por favor, introduce un número válido.",
	        digits: "Por favor ingrese solo dígitos.",
	        equalTo: "Por favor, introduzca el mismo valor de nuevo.",
	        accept: "Introduzca un valor con una extensión válida.",
	        maxlength: jQuery.validator.format("No ingrese más de {0} caracteres."),
	        minlength: jQuery.validator.format("Introduzca al menos {0} caracteres."),
	        rangelength: jQuery.validator.format("Introduzca un valor entre {0} y {1} caracteres."),
	        range: jQuery.validator.format("Introduzca un valor entre {0} y {1}."),
	        max: jQuery.validator.format("Ingrese un valor menor o igual a {0}."),
	        min: jQuery.validator.format("Ingrese un valor mayor o igual a {0}.")
	    });
	});

	$('#modalDelete').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});