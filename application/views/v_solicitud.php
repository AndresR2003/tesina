    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <h4 class="card-title">Solicitudes</h4>
                                        <p class="card-title-desc">Detalle de solicitudes registradas</p>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-sm btn-success"  id="btn_activo" title="Solicitudes Activas">Activo     1 </button>
                                        <button class="btn btn-sm btn-warning"  id="btn_en_espera" title="Solicitudes en Espera">En Espera  4 </button>
                                        <button class="btn btn-sm btn-info"     id="btn_completado" title="Solicitudes Completadas">Completado 3 </button>
                                        <button class="btn btn-sm btn-danger"   id="btn_cancelado" title="Solicitudes Canceladas">Cancelado  2 </button>
                                    </div> 
                                </div>                               
                            </div>


                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <select class="form-control form-control-sm" id="s_estado_solicitud" onchange="activar_filtro('estado_solicitud','s_estado_solicitud')">
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <select class="form-control form-control-sm" id="s_tipo_contrato" onchange="activar_filtro('tipo_contrato','s_tipo_contrato')">
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <select class="form-control form-control-sm" id="s_frecuencia" onchange="activar_filtro('frecuencia','s_frecuencia')">
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <select class="form-control form-control-sm" id="s_mes" onchange="activar_filtro('mes','s_mes')">
                                        </select>
                                    </div>                                    
                                    <div class="col-lg-2 offset-md-2">
                                        <button class="btn btn-sm btn-secondary waves-effect waves-light mb-1 form-control"  onclick="agregar('solicitud',0);"> <i class="mdi mdi-minus-circle"></i> Agregar Solicitud</button>
                                    </div>                                    
                                </div>
                            </div>

                            <!--
                                Registros
                            -->
                            <div class="card-body mt-3">
                                <div id="panel_viendo">
                                </div>
                            </div>

                            <!---
                                Fin registros 
                            --->

                            <!--
                                Registros
                            -->
                            <div id="panel_registros">
                            </div>
                            <!---
                                Fin registros 
                            --->
                          

                            <!---
                                Páginación
                            --->
                            <div class="card-body">
                                <div class="btn-toolbar gap-2" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group" role="group" aria-label="First group">
                                        <div id="panel_paginacion">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!---
                                Fin paginación
                            --->
                          
                        </div>
                    </div>
                </div>            
            </div>
        </div>
        
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        get_registros();
        get_select_filtros(); 
        get_indicadores();
    });

    /*
        - Filtros de busqueda
    */

    function activar_filtro(tipo,id){
        let dato = '';
        switch (tipo) {
            case 'paginacion':
                dato = id;
                break;
            default:
                dato = $('#'+id).val();
                break;
        }
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_solicitud/activar_filtro',
            data: {
                'tipo':tipo,
                'dato':dato
            }, 
            beforeSend:function(){
            },   
            success: function(e){ 
                get_registros();
            }
        });
    }

    /*
        -- JAVASCRIPT SOLICITUDES
    */

    function ver_responsabilidad(id){
        $('#btn_regresar_'+id).css('display','block');
        $('#btn_actualizar_'+id).css('display','none');
        $('#panel_detalle_'+id).css('display','none');

        $('#panel_respon_'+id).css('display','block');
        $('#panel_reque_'+id).css('display','none');

        get_registros_adicional('responsabilidad',id);
    }

    function ver_requerimientos(id){
        $('#btn_regresar_'+id).css('display','block');
        $('#btn_actualizar_'+id).css('display','none');
        $('#panel_detalle_'+id).css('display','none');

        $('#panel_respon_'+id).css('display','none');
        $('#panel_reque_'+id).css('display','block');

        get_registros_adicional('requerimiento',id);

    }

    function regresar(id){
        $('#btn_regresar_'+id).css('display','none');
        $('#btn_actualizar_'+id).css('display','block');
        $('#panel_detalle_'+id).css('display','block');

        $('#panel_respon_'+id).css('display','none');
        $('#panel_reque_'+id).css('display','none');
    }

    /*
        -- Actualizar Solicitud
    */


    function actualizar(id_sol){
        //Validador
        let contador = 0 ; 
        //Obtención de datos
        let txt_fecha_sol = $('#txt_fecha_sol_'+id_sol).val();
        let txt_cargo_sol = $('#txt_cargo_sol_'+id_sol).val();
        let txt_minimo_sol = $('#txt_minimo_sol_'+id_sol).val();
        let txt_maximo_sol = $('#txt_maximo_sol_'+id_sol).val();
        let text_contrato_sol = $('#text_contrato_sol_'+id_sol).val();
        let text_frecuencia_sol = $('#text_frecuencia_sol_'+id_sol).val();
        let txt_seleccionados_sol = $('#txt_seleccionados_sol_'+id_sol).val();
        let txt_area_sol = $('#txt_area_sol_'+id_sol).val();
        let txt_estado_sol = $('#txt_estado_sol_'+id_sol).val();

        
        
        let text_resumen_sol = $('#text_resumen_sol_'+id_sol).val();

        //Validación de casos
        
        
        let cade9 ='txt_estado_sol_'+id_sol; 
        if(txt_estado_sol==''){alerta('error',cade9,'','');contador++;}else{alerta('success',cade9,'','');}
        let cade0 ='txt_area_sol_'+id_sol; 
        if(txt_area_sol==''){alerta('error',cade0,'','');contador++;}else{alerta('success',cade0,'','');}
        let cade1 ='txt_fecha_sol_'+id_sol; 
        if(txt_fecha_sol==''){alerta('error',cade1,'','');contador++;}else{alerta('success',cade1,'','');}
        let cade2 ='txt_cargo_sol_'+id_sol; 
        if(txt_cargo_sol==''){alerta('error',cade2,'','');contador++;}else{alerta('success',cade2,'','');}
        let cade3 ='txt_minimo_sol_'+id_sol; 
        if(txt_minimo_sol=='0'){alerta('error',cade3,'','');contador++;}else{alerta('success',cade3,'','');}
        let cade4 ='txt_maximo_sol_'+id_sol; 
        if(txt_maximo_sol=='0'){alerta('error',cade4,'','');contador++;}else{alerta('success',cade4,'','');}
        let cade5 ='text_contrato_sol_'+id_sol; 
        if(text_contrato_sol==''){alerta('error',cade5,'','');contador++;}else{alerta('success',cade5,'','');}
        let cade6 ='text_frecuencia_sol_'+id_sol; 
        if(text_frecuencia_sol==''){alerta('error',cade6,'','');contador++;}else{alerta('success',cade6,'','');}
        let cade8 ='txt_seleccionados_sol_'+id_sol; 
        if(txt_seleccionados_sol=='0'){alerta('error',cade8,'','');contador++;}else{alerta('success',cade8,'','');}
        let cade7 ='text_resumen_sol_'+id_sol; 
        if(text_resumen_sol==''){alerta('error',cade7,'','');contador++;}else{alerta('success',cade7,'','');}

        if(contador<=0){
            notificacion('¡ Actualización completa !','Se actualizó correctamente la información de la solicitud.','success');

            //enviamos el ajax
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: '<?php echo base_url();?>C_solicitud/actualizar',
                data: {
                    'txt_fecha_sol':txt_fecha_sol,
                    'txt_area_sol':txt_area_sol,
                    'txt_cargo_sol':txt_cargo_sol,
                    'txt_minimo_sol':txt_minimo_sol,
                    'txt_maximo_sol':txt_maximo_sol,
                    'text_contrato_sol':text_contrato_sol,
                    'text_frecuencia_sol':text_frecuencia_sol,
                    'txt_seleccionados_sol':txt_seleccionados_sol,
                    'text_resumen_sol':text_resumen_sol,
                    'txt_estado_sol':txt_estado_sol,
                    'id':id_sol
                }, 
                beforeSend:function(){
                },   
                success: function(e){ 
                    /*Limpiamos*/
                    alerta('',cade0,'','');
                    alerta('',cade1,'','');
                    alerta('',cade2,'','');
                    alerta('',cade3,'','');
                    alerta('',cade4,'','');
                    alerta('',cade5,'','');
                    alerta('',cade6,'','');
                    alerta('',cade7,'','');
                    alerta('',cade8,'','');
                    alerta('',cade9,'','');
                    notificacion('Actualización completa','Se actualizó el registro de la solicitud seleccionada..','success');
                    get_registros();
                }
            });
        }else{
            notificacion('¡ Ocurrió algo !','Toda la información solicitada es importante para el reclutamiento del personal.','error');
        }

    }

    /*
        AGREGAR RESPONSABILIDADES
    */

    function agregar(tipo,id){
        let des      = '';
        let cade     = '';
        switch (tipo) {
            case 'solicitud':
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '<?php echo base_url();?>C_solicitud/insert',
                    data: {
                    }, 
                    beforeSend:function(){
                    },   
                    success: function(e){ 
                        notificacion('Solicitud En Espera','Se registró correctamente una solicitud, complete los detalles solicitados.','success');
                        get_registros();
                    }
                });
                break;            
            case 'responsabilidad':
                des = get_data('txt_des_respon_'+id);
                cade = 'txt_des_respon_'+id;
                if(des==''){
                    alerta('error',cade,'','');
                    notificacion('¡ Ocurrió un error !','Ingrese una descripción correcta.','error');
                }else{
                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        url: '<?php echo base_url();?>C_solicitud/insert_registros',
                        data: {
                            'id':id,
                            'des':des,
                            'tipo':tipo
                        }, 
                        beforeSend:function(){
                        },   
                        success: function(e){ 
                            alerta('success',cade,'','');
                            notificacion('¡ Responsabilidad agregada !','Se registró correctamente la responsabilidad para la solicitud seleccionada.','success');
                            get_registros_adicional(tipo,id);
                            setTimeout(() => {
                                set_data('txt_des_respon_'+id);
                                alerta('',cade,'','');
                            }, 2000);
                        }
                    });
                }
                break;
            case 'requerimiento':
                des = get_data('txt_des_reque_'+id);
                cade = 'txt_des_reque_'+id;
                if(des==''){
                    alerta('error',cade,'','');
                    notificacion('¡ Ocurrió un error !','Ingrese una descripción del requerimiento solicitado.','error');
                }else{
                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        url: '<?php echo base_url();?>C_solicitud/insert_registros',
                        data: {
                            'id':id,
                            'des':des,
                            'tipo':tipo
                        }, 
                        beforeSend:function(){
                        },   
                        success: function(e){ 
                            alerta('success',cade,'','');
                            notificacion('¡ Requerimiento agregado !','Se registró correctamente el requerimiento para la solicitud seleccionada.','success');
                            get_registros_adicional(tipo,id);
                            setTimeout(() => {
                                set_data('txt_des_reque_'+id);
                                alerta('',cade,'','');
                            }, 2000);
                        }
                    });
                }
                break;                
            default:
                break;
        }
    }

    function get_registros(){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_solicitud/get_registros',
            data: {
            }, 
            beforeSend:function(){
            },   
            success: function(e){ 
                var res = jQuery.parseJSON(e);
                $('#panel_paginacion').html(res.paginacion);
                $('#panel_registros').html(res.registros);
                $('#panel_viendo').html(res.viendo);
            }
        });
    }

    function get_registros_adicional(tipo,id_sol){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_solicitud/get_registros_adicional',
            data: {
                'tipo':tipo,
                'id_sol':id_sol
            }, 
            beforeSend:function(){
            },   
            success: function(e){ 
                switch (tipo) {
                    case 'requerimiento':
                        $('#lista_reque_'+id_sol).html(e);
                        break;
                    case 'responsabilidad':
                        $('#lista_respon_'+id_sol).html(e); 
                        break;
                    case 'cargos':
                        $('#txt_cargo_sol_'+id_sol).html(e); 
                        break;                                                
                    default:
                        break;
                }
            }
        });
    }

    /*Obtenemos datos del select por id registrado*/
    function get_datos_select_x_id(tipo,id_sol,input){
        let id_seleccion = $('#'+input+id_sol).val(); 
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_solicitud/get_datos_select_x_id',
            data: {
                'tipo':tipo,
                'id_sol':id_sol,
                'id_seleccion':id_seleccion
            }, 
            beforeSend:function(){
            },   
            success: function(e){ 
                switch (tipo) {
                    case 'requerimiento':
                        $('#lista_reque_'+id_sol).html(e);
                        break;
                    case 'responsabilidad':
                        $('#lista_respon_'+id_sol).html(e); 
                        break;
                    case 'cargos':
                        $('#txt_cargo_sol_'+id_sol).html(e); 
                        break;                                                
                    default:
                        break;
                }
            }
        });
    }

    function eliminar(tipo,id_sol,id_reg){
        alertify.confirm("¿Està seguro de eliminar el registro?.",
        function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>C_solicitud/eliminar',
                data: {
                    'tipo':tipo,
                    'id_sol':id_sol,
                    'id_reg':id_reg
                }, 
                beforeSend:function(){
                },   
                success: function(e){ 
                    switch (tipo) {
                        case 'requerimiento':
                            get_registros_adicional(tipo,id_sol);
                            alertify.success('Registro eliminado correctamente.');
                            break;
                        case 'responsabilidad':
                            get_registros_adicional(tipo,id_sol);
                            alertify.success('Registro eliminado correctamente.');
                            break;  
                        case 'solicitud':
                            get_registros();
                            alertify.success('Registro eliminado correctamente.');
                            break;                                                    
                        default:
                            break;
                    }
                }
            });
        },
        function(){
            alertify.error('No se pudo completar la acción de eliminar sobre el registro seleccionado.');
        }); 
    }


    /*
        //Funciones de filtro
    */
    function get_select_filtros(){
        $.ajax({
            type: "POST",
            //dataType: 'json',
            url: '<?php echo base_url();?>C_solicitud/get_select_filtros',
            data: {
            }, 
            beforeSend:function(){
            },   
            success: function(e){ 
                var res = jQuery.parseJSON(e);

                $('#s_estado_solicitud').html(res.estado_solicitud);
                $('#s_tipo_contrato').html(res.tipo_contrato);
                $('#s_frecuencia').html(res.tipo_frecuencia);
                $('#s_mes').html(res.mes_solicitud);

            }
        });
    }


    /*
        Funciones obtener indicadores
    */
    function get_indicadores(){
        $.ajax({
            type: "POST",
            //dataType: 'json',
            url: '<?php echo base_url();?>C_solicitud/get_indicadores',
            data: {
            }, 
            beforeSend:function(){
            },   
            success: function(e){ 
                var res = jQuery.parseJSON(e);

                $('#btn_activo').html('Activo '+ res.activo);
                $('#btn_en_espera').html('En Espera '+ res.en_espera);
                $('#btn_completado').html('Completado '+ res.completado);
                $('#btn_cancelado').html('Cancelado '+res.cancelado);

            }
        });
    }




    function subir_foto(){
            /*Con evento carga*/
            var inputfile = document.getElementById('file');
            var file      = inputfile.files[0];
            var xhr = new XMLHttpRequest();
            (xhr.upload || xhr).addEventListener('progress', function(e) {
                var done = e.position || e.loaded;
                var total = e.totalSize || e.total;
                var carg = Math.round(done/total*100);
                $("#progressBar_img").val(carg);
                $('#loaded_n_total_img').text(carg + ' % ');
            });
            xhr.addEventListener('load', function(e) {
                    var json         = eval("(" + this.responseText + ")");
                    if($.trim(json.valida)=='si'){            
                        //$('#foto_visita').val('');
                        var  caden  = '<?php echo base_url();?>public/images/tag/'+json.imagen;
                        $('#img_foto').attr('src',caden);
                        $('#img_foto_2').attr('src',caden);
                        alertify.success('success','Foto de perfil actualizada.');
                    }else{
                        alertify.error('error','Hubo un error al actualizar su foto de perfil');
                    }
            });
            xhr.addEventListener('error', function(e) {
                alertify.error('error','Ocurrio un error, vuelva a intentarlo','Error');
            });  
            
            xhr.addEventListener('abort', function(e) {
                alertify.error('error','Ocurrio un error, vuelva a intentarlo','Error');
            });     
            xhr.open('post', '<?php echo base_url();?>C_solicitud/subir_foto', true);
            
            var data = new FormData;
            data.append('file', file);
            xhr.send(data);          
    }



    /*CARGA DE UBIGEO*/
    function load_ubigeos(tipo,id){
        let cadena=''; 
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?php echo base_url();?>C_ubigeo/get_data_ubigeo',
            data: {
                'tipo':tipo,
                'id':id
            }, 
            beforeSend:function(){
            },   
            success: function(e){ 
                for(var i=0; i < e.length; i++)
                {
                    cadena +='<option value="'+e[i]['id']+'">'+e[i]['descripcion']+'</option>'
                }

                switch (tipo) {
                    case 'departamento':
                        $('#text_departamento').html(cadena);
                        $('#text_departamento').val(id);
                        break;
                    case 'provincia':
                        $('#text_provincia').html(cadena);
                        $('#text_provincia').val(id_provincia);
                        break;          
                    case 'distrito':
                        $('#text_distrito').html(cadena);
                        $('#text_distrito').val(id_distrito);
                    break;                                                              
                    default:
                        break;
                }

            }
        });
    }

    function grabar(){
        let nombres     = $('#text_nombres').val();
        let apellidos   = $('#text_apellidos').val();
        let dni         = $('#text_dni').val();
        let fecha       = $('#text_fecha_nac').val();
        let correo      = $('#text_correo').val();
        let celular     = $('#text_celular').val();
        let direccion   = $('#text_direccion').val();

        let id_departamento   = $('#text_departamento').val();
        let id_provincia      = $('#text_provincia').val();
        let id_distrito       = $('#text_distrito').val();

        let contador = 0; 
        /* VALIDACIONES */
        if(nombres==''){alerta('error','text_nombres','text_nombres_msj',' * Obligatorio');contador++;}else{alerta('success','text_nombres','text_nombres_msj','');}
        if(apellidos==''){alerta('error','text_apellidos','text_apellidos_msj',' * Obligatorio');contador++;}else{alerta('success','text_apellidos','text_apellidos_msj','');}
        if(dni==''){alerta('error','text_dni','text_dni_msj',' * Obligatorio');contador++;}else{alerta('success','text_dni','text_dni_msj','');}
        if(fecha==''){alerta('error','text_fecha_nac','text_fecha_nac_msj',' * Obligatorio');contador++;}else{alerta('success','text_fecha_nac','text_fecha_nac_msj','');}
        if(correo==''){alerta('error','text_correo','text_correo_msj',' * Obligatorio');contador++;}else{alerta('success','text_correo','text_correo_msj','');}
        if(celular==''){alerta('error','text_celular','text_celular_msj',' * Obligatorio');contador++;}else{alerta('success','text_celular','text_celular_msj','');}
        if(direccion==''){alerta('error','text_direccion','text_direccion_msj',' * Obligatorio');contador++;}else{alerta('success','text_direccion','text_direccion_msj','');}

        //Ubigeos
        if(id_departamento==''){alerta('error','text_departamento','text_departamento_msj',' * Obligatorio');contador++;}else{alerta('success','text_departamento','text_departamento_msj','');}
        if(id_provincia==''){alerta('error','text_provincia','text_provincia_msj',' * Obligatorio');contador++;}else{alerta('success','text_provincia','text_provincia_msj','');}
        if(id_distrito==''){alerta('error','text_distrito','text_distrito_msj',' * Obligatorio');contador++;}else{alerta('success','text_distrito','text_distrito_msj','');}


        if(contador<=0){

            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>C_solicitud/grabar',
                data: {
                   'nombres':nombres,
                    'apellidos':apellidos,
                    'dni':dni,
                    'fecha':fecha,
                    'correo':correo,
                    'celular':celular,
                    'distrito':id_distrito,
                    'direccion':direccion
                }, 
                beforeSend:function(){
                },   
                success: function(data){ 
                    if(data=='duplicado'){
                        notificacion('¡ Ocurrió algo !','La información de su perfíl no se actualizó, vuelva a intentarlo.','error');
                    }else{
                        notificacion('Datos actualizados','La información de su perfíl se actualizó correctamente','success');
                    }
                }
            });
        }else{
            notificacion('Ocurrió algo','Uno o más datos no se encuentran correctos.','error');
        }

    }
                                                                         
    function forDataTables( id, ruta) {
        table = $(id).DataTable({
            "scrollX": true,
            "processing":true,
            "serverSide":true,
            "order":[],
            "dom": 'Bfrtip',
            "buttons": ['copy', 'excel', 'pdf', 'colvis'],
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