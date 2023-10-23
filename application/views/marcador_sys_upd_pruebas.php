<div class="main-content">

<div class="page-content" style="margin-top:20px !important;padding-top:10px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <h4 class="card-title">Empresa::  <?php echo $x_empresa;?>__</h4>
                            </div>
                            <div  style="display:flex;">
                                <div class="">
                                    <button style="display:none;"  class="btn btn-sm btn-success"  id="btn_activo" title="Empleado agregado a la razón social">Agregado     0 </button>
                                    <!--<button class="btn btn-sm btn-warning"  id="btn_en_espera" title="Solicitudes en Espera">En Espera  4 </button>-->
                                    <button style="display:none;" class="btn btn-sm btn-info"     id="btn_completado" title="Empleado de razón social">Empleados 0 </button>
                                    <!---<button class="btn btn-sm btn-danger"   id="btn_cancelado" title="Solicitudes Canceladas">Cancelado  2 </button>-->
                                        <button class="btn btn-sm btn-secondary waves-effect waves-light mb-1 form-control"  onclick="abrir_modal_agregar();"> <i class="mdi mdi-minus-circle"></i> Agregar Telf.</button>
                                </div> 

                                <div class="">
                                    <button class="btn btn-sm btn-secondary waves-effect waves-light mb-1 form-control"  onclick="agregar('solicitud',0);"> <i class="mdi mdi-minus-circle"></i> Agregar Empleado</button>
                                </div>

                            </div>
                        </div>                               
                    </div>


                    <div class="card-body">
                        <div class="row">
                            <div class="row">
                                <div class="col-lg-4 offset-md-4">
                                    <select style="background:#ffffc0;" class="form-control form-control-sm" id="s_empleado" onchange="activar_filtro('empleados','s_empleado')">
                                    </select>
                                <div>
                            </div> 
                            <div class="col-lg-2" style="display:none;">
                                <select class="form-control form-control-sm" id="s_estado_solicitud" onchange="activar_filtro('estado_solicitud','s_estado_solicitud')">
                                </select>
                            </div>
                            <div class="col-lg-2" style="display:none;">
                                <select class="form-control form-control-sm" id="s_tipo_contrato" onchange="activar_filtro('tipo_contrato','s_tipo_contrato')">
                                </select>
                            </div>
                            <div class="col-lg-2" style="display:none;">
                                <select class="form-control form-control-sm" id="s_frecuencia" onchange="activar_filtro('frecuencia','s_frecuencia')">
                                </select>
                            </div>
                            <div class="col-lg-2" style="display:none;">
                                <select class="form-control form-control-sm" id="s_mes" onchange="activar_filtro('mes','s_mes')">
                                </select>
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
                                <div id="panel_paginacion" style="display:none;">
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

<div class="modal fade" id="mdl_telefono" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Teléfono Adicional</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12" >
                        <label>Telefono/Celular</label>
                        <input class="form-control" id="telefono" type="number">
                    </div>
                </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="agregar_nuevo_contacto();">Agregar</button>
            </div>
        </div>
    </div>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    let id_contacto =0; 
$(document).ready(function() {
    get_registros();
    get_select_filtros(); 
    get_indicadores();
});


function abrir_modal_agregar(){
    $('#mdl_telefono').modal('show');
}

function agregar_nuevo_contacto(){
    var telefono = $('#telefono').val();
    if(telefono!=''){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_marcador_sys_upd_pruebas/validar_nuevo_telefono',
            data: {
                'telefono':telefono
            }, 
            beforeSend:function(){
            },   
            success: function(data){   
                if(data==='error'){
                    notificacion('¡ Registro incorrecto !','El Número ingresado ya existe!!.','error');
                }else{
                    grabar_nuevo_numero(); 
                } 
            }
        });
    }else{
        alerta('error','','Ingrese un teléfono correcto');
    }

}

function grabar_nuevo_numero(){
    var dato = $('#telefono').val();
    $.ajax({
        type: "POST",
        url: '<?php echo base_url();?>C_marcador_sys_upd_pruebas/grabar_nuevo_numero',
        data: {'dato':dato}, 
        beforeSend:function(){
            //$('.loader_carga').fadeIn('slow');
        },   
        success: function(data){
                //$('.loader_carga').fadeOut('slow');
                if(data=='1'){
                    notificacion('¡ Registro Correcto !','Número agregado correctamente','success');
                    $('#mdl_telefono').modal('hide');
                    cargar_numeros(); 
                    //get_nros_por_address2(address2_x);
                    $('#telefono').val('');
                    //$('#mdl_nuevo_numero').modal('hide');
                }else if(data=='2'){
                    notificacion('¡ Hubo un error !','No se pudo agregar el número de referencia.','error');
                }else if(data=='3'){
                    notificacion('¡ Hubo un error !','El número ingresado ya existe.','error');
                }else if(data=='4'){
                    notificacion('¡ Hubo un error !','Error al registrar, intentalo nuevamente.','error');
                }else if(data=='5'){
                    
                }else{
                }
        },
        error: function(){
        }
    });
}



function resetear_inputs(tipo,id){
    switch (tipo) {
        case 'solicitud':
            $('#select_habilita_nombre_'+id).val('');
            $('#select_habilita_apellido_'+id).val('');
            
            $('#txt_nombre_sol_'+id).val('');
            $('#txt_apellidos_sol_'+id).val('');

            $('#select_sub_respuesta_'+id).val(''); 
            $('#select_sub_respuesta2_'+id).val(''); 

            $('#txt_dia_progra_'+id).val('');
            $('#txt_hora_desde_progra_'+id).val('');
            $('#txt_hora_hasta_progra_'+id).val('');

            $('#select_departamento_'+id).val('');

            $('#txt_correo_upd_'+id).val('');
            $('#select_habilita_correo_'+id).val('');
            
            $('#txt_razon_socual_upd_'+id).val('');
            $('#txt_ruc_upd_'+id).val('');

            break;
    
        default:
            break;
    }
}

//Activación de Speach de acuerdo a la respuesta
function activar_panel(tipo,id,id_input){

    //resetamos
    resetear_inputs(tipo,id);

    let dato='';
    switch (tipo) {
        case 'solicitud':
            dato = $('#'+id_input+id).val();
            switch (dato) {
                case '1':
                        $('#panel_actualizacion_nombres_'+id).css('display','block');
                        $('#panel_si_pertenece_'+id).css('display','block');
                        $('#panel_actualizacion_correo_'+id).css('display','none');
                        $('#panel_departamento_'+id).css('display','none');
                        $('#panel_no_pertenece_'+id).css('display','none');
                        $('#panel_despedida_si_si'+id).css('display','none');
                        $('#panel_no_pertenece_si_acepta_'+id).css('display','none');
                        $('#panel_programacion_'+id).css('display','none');
                        $('#panel_despedida_si_no'+id).css('display','none');
                    break;
                case '2':
                        $('#panel_no_pertenece_'+id).css('display','block');
                        $('#panel_actualizacion_nombres_'+id).css('display','block');

                        $('#panel_actualizacion_correo_'+id).css('display','none');
                        $('#panel_despedida_si_si'+id).css('display','none');
                        
                        $('#panel_si_pertenece_'+id).css('display','none');
                        $('#panel_programacion_'+id).css('display','none');
                        $('#panel_departamento_'+id).css('display','none');
                        $('#panel_si_pertenece_no_acepta_'+id).css('display','none');
                    break;            
                default:
                        $('#panel_actualizacion_nombres_'+id).css('display','none');
                        $('#panel_no_pertenece_'+id).css('display','none');
                        $('#panel_si_pertenece_'+id).css('display','none');   
                        $('#panel_programacion_'+id).css('display','none');
                        $('#panel_si_pertenece_no_acepta_'+id).css('display','none');
                        $('#panel_no_pertenece_si_acepta_'+id).css('display','none');
                        $('#panel_no_pertenece_no_acepta_'+id).css('display','none');
                        $('#panel_despedida_si_no'+id).css('display','none');
                    break;
            }            
            break;
        case 'programacion':
            $('#panel_programacion_'+id).css('display','block');
            dato = $('#'+id_input+id).val();
            switch (dato) {
                case '1':
                        $('#panel_si_pertenece_'+id).css('display','block');
                        $('#panel_no_pertenece_'+id).css('display','none');
                        $('#panel_si_pertenece_no_acepta_'+id).css('display','none');
                        $('#panel_despedida_si_no'+id).css('display','none');
                        $('#panel_despedida_si_si'+id).css('display','block');
                        $('#panel_departamento_'+id).css('display','block');
                        $('#panel_actualizacion_correo_'+id).css('display','block');
                        $('#panel_no_pertenece_no_acepta_'+id).css('display','none');
                    break;
                case '2':
                        $('#panel_no_pertenece_'+id).css('display','none');
                        $('#panel_si_pertenece_'+id).css('display','block');
                        $('#panel_programacion_'+id).css('display','none');
                        $('#panel_si_pertenece_no_acepta_'+id).css('display','block');
                        $('#panel_departamento_'+id).css('display','none');
                        $('#panel_despedida_si_no'+id).css('display','block');
                        $('#panel_actualizacion_correo_'+id).css('display','block');
                        $('#panel_despedida_si_si'+id).css('display','none');
                        $('#panel_no_pertenece_no_acepta_'+id).css('display','none');
                    break;            
                default:
                        $('#panel_si_pertenece_'+id).css('display','block');
                        $('#panel_programacion_'+id).css('display','none');
                        $('#panel_si_pertenece_no_acepta_'+id).css('display','none');
                        $('#panel_despedida_si_no'+id).css('display','none');
                        $('#panel_despedida_si_si'+id).css('display','none');
                        $('#panel_actualizacion_correo_'+id).css('display','none');
                        $('#panel_no_pertenece_no_acepta_'+id).css('display','none');
                    break;
            }   

            break;

        case 'programacion2':
            $('#panel_programacion_'+id).css('display','block');
            dato = $('#'+id_input+id).val();
            switch (dato) {
                case '1':
                    
                        $('#panel_no_pertenece_'+id).css('display','block');
                        $('#panel_no_pertenece_si_acepta_'+id).css('display','block');
                        $('#panel_departamento_'+id).css('display','block');
                        $('#panel_despedida_si_no'+id).css('display','block');
                        $('#panel_actualizacion_correo_'+id).css('display','block');

                        //$('#panel_departamento_'+id).css('display','block');
                        $('#panel_si_pertenece_'+id).css('display','none');
                        $('#panel_si_pertenece_no_acepta_'+id).css('display','none');
                        $('#panel_no_pertenece_no_acepta_'+id).css('display','none');
                        
                    break;
                case '2':
                        $('#panel_no_pertenece_'+id).css('display','none');
                        $('#panel_no_pertenece_si_acepta_'+id).css('display','none');
                        $('#panel_departamento_'+id).css('display','none');
                        $('#panel_despedida_si_no'+id).css('display','none');
                        $('#panel_actualizacion_correo_'+id).css('display','none');

                        $('#panel_si_pertenece_'+id).css('display','none');
                        $('#panel_programacion_'+id).css('display','none');
                        $('#panel_si_pertenece_no_acepta_'+id).css('display','none');


                        $('#panel_no_pertenece_'+id).css('display','block');
                        $('#panel_no_pertenece_no_acepta_'+id).css('display','block');
                    break;            
                default:
                        $('#panel_no_pertenece_'+id).css('display','none');
                        $('#panel_si_pertenece_'+id).css('display','none');            
                        $('#panel_si_pertenece_no_acepta_'+id).css('display','none');
                    break;
            }   

            break;            
        default:
            break;
    }


}


/*FUNCIONES NOVIEMBRE - NUEVO*/

function get_registros(){
    $.ajax({
        type: "POST",
        url: '<?php echo base_url();?>C_marcador_sys_upd_pruebas/get_registros',
        data: {
        }, 
        beforeSend:function(){
        },   
        success: function(e){ 
            var res = jQuery.parseJSON(e);
            $('#panel_paginacion').html(res.paginacion);
            $('#panel_registros').html(res.registros);
            $('#panel_viendo').html(res.viendo);
            get_indicadores();
        }
    });
}
/*CORREO, DEP, NOMBRE DE LA EMPRESA, NOMBRE DEL CONTACTO*/ 
/*FIN FUNCIONES NOVIEMBRE - NUEVO*/




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
    url: '<?php echo base_url();?>C_marcador_sys_upd_pruebas/activar_filtro',
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

function valida_input(id){
    if($('#'+id).val()!=''){
        return 0;
    }else{
        return 1; 
    }
}

function actualizar_mejorado(id_sol){

    //Validación por ruta marcada... 
    let select_respuesta = $('#select_respuesta_'+id_sol).val();

    //Select valida nombre
    var cadena_valida_nombre = 'select_habilita_nombre_'+id_sol;
    var dato_valida_nombre = $('#'+cadena_valida_nombre).val();
    //Input nombre
    var cadena_input_nombre = 'txt_nombre_sol_'+id_sol;
    var dato_input_nombre = $('#'+cadena_input_nombre).val();
    
    //Programacion 
    var cadena_valida_dia_progra = 'txt_dia_progra_'+id_sol;
    var dato_dia_progra = $('#'+cadena_valida_dia_progra).val();

    var cadena_valida_hora_desde_progra = 'txt_hora_desde_progra_'+id_sol;
    var dato_hora_desde_progra = $('#'+cadena_valida_hora_desde_progra).val();

    var cadena_valida_hora_hasta_progra = 'txt_hora_hasta_progra_'+id_sol;
    var dato_hora_hasta_progra = $('#'+cadena_valida_hora_hasta_progra).val();

    //Correo
    var cadena_valida_correo = 'select_habilita_correo_'+id_sol;
    var dato_valida_correo = $('#'+cadena_valida_correo).val();
    //Input nombre
    var cadena_input_correo = 'txt_correo_upd_'+id_sol;
    var dato_input_correo = $('#'+cadena_input_correo).val();

    //Input Razon social
    let dato_razon_social = $('#txt_razon_socual_upd_'+id_sol).val();
    let dato_ruc = $('#txt_ruc_upd_'+id_sol).val();
    switch (select_respuesta) {
        //Seleccionado
        case '1':
            /* VALIDACIÓN DE DATOS NOMBRES*/
            console.log('validación de nombre: '+dato_input_nombre);
            if(dato_valida_nombre==2){
                //2 es que no correcto 
                if(dato_input_nombre==''){
                    alerta('error',cadena_input_nombre,'','');
                    alerta('success',cadena_valida_nombre,'','');
                    return;
                }else{
                    alerta('success',cadena_input_nombre,'','');
                }
            }else if(dato_valida_nombre==1){//Si es correcto, no habrá actualización
                alerta('',cadena_input_nombre,'','');
                alerta('success',cadena_valida_nombre,'','');
                dato_input_nombre='';
            }else{
                alerta('error',cadena_valida_nombre,'','');
                return;
            }
            console.log('RESULTADO DE NOMBRE A GUARDAR: '+dato_input_nombre);
            
            /* VALIDACIÓN DE DATOS APELLIDOS*/
            //Select valida apellido
            var cadena_valida_apellido = 'select_habilita_apellido_'+id_sol;
            var dato_valida_apellido = $('#'+cadena_valida_apellido).val();
            //Input nombre
            var cadena_input_apellido = 'txt_apellidos_sol_'+id_sol;
            var dato_input_apellido = $('#'+cadena_input_apellido).val();
            
            console.log('validación de apellido: '+dato_input_apellido);
            if(dato_valida_apellido==2){
                //2 es que no correcto 
                if(dato_input_apellido==''){
                    alerta('error',cadena_input_apellido,'','');
                    alerta('success',cadena_valida_apellido,'','');
                    return;
                }else{
                    alerta('success',cadena_input_apellido,'','');
                }
            }else if(dato_valida_apellido==1){//Si es correcto, no habrá actualización
                alerta('',cadena_input_apellido,'','');
                alerta('success',cadena_valida_apellido,'','');
                dato_input_apellido='';
            }else{
                alerta('error',cadena_valida_apellido,'','');
                return;
            }
            console.log('RESULTADO DE APELLIDO A GUARDAR: '+dato_input_apellido);

            /*VALIDACIÓN DE SUBRESPUESTA 2 */
            var cadena_valida_subrespuesta = 'select_sub_respuesta_'+id_sol;
            var dato_acepta_subrespuesta = $('#'+cadena_valida_subrespuesta).val();
            
            switch (dato_acepta_subrespuesta) {
                case '1'://si acepta
                    alerta('success',cadena_valida_subrespuesta,'','');
                    //VALIDACIÓN DE PROGRAMACIÓN
                    //alerta('success',cadena_valida_subrespuesta,'','');
                    if(dato_dia_progra==''){
                        alerta('error',cadena_valida_dia_progra,'','');
                        return; 
                    }else{
                        alerta('success',cadena_valida_dia_progra,'','');
                    }
                    if(dato_hora_desde_progra==''){
                        alerta('error',cadena_valida_hora_desde_progra,'','');
                        return; 
                    }else{
                        alerta('success',cadena_valida_hora_desde_progra,'','');
                    }
                    if(dato_hora_hasta_progra==''){
                        alerta('error',cadena_valida_hora_hasta_progra,'','');
                        return; 
                    }else{
                        alerta('success',cadena_valida_hora_hasta_progra,'','');
                    }
                    console.log('DATO PROGRAMACION: '+dato_dia_progra+' / ' + dato_hora_desde_progra + ' ' + dato_hora_hasta_progra);

                    //Validación Correo
                    if(dato_valida_correo==2){
                        //2 es que no correcto 
                        if(dato_input_correo==''){
                            alerta('error',cadena_input_correo,'','');
                            alerta('success',cadena_valida_correo,'','');
                            return;
                        }else{
                            if(valida_correo(cadena_input_correo)==1){
                                notificacion('¡ Correo incorrecto !','Ingrese un correo valido.','error');
                                alerta('error',cadena_input_correo,'','');
                                return;
                            }else{
                                alerta('success',cadena_input_correo,'','');
                            }
                        }
                    }else if(dato_valida_correo==1){//Si es correcto, no habrá actualización
                        alerta('',cadena_input_correo,'','');
                        alerta('success',cadena_valida_correo,'','');
                        dato_input_correo='';
                    }else if(dato_valida_correo==3 || dato_valida_correo==4){
                        alerta('success',cadena_valida_correo,'','');
                        alerta('',cadena_input_correo,'','');
                        dato_input_correo='';
                    }else{
                        alerta('error',cadena_valida_correo,'','');
                        return;
                    }
                    console.log('RESULTADO DE CORREO A GUARDAR: '+dato_input_correo);
                    

                    // Validación Departamento
                    var cadena_input_departamento = 'select_departamento_'+id_sol;
                    var dato_valida_departamento = $('#'+cadena_input_departamento).val();

                    if(dato_valida_departamento==''){
                        alerta('error',cadena_input_departamento,'','');
                        return; 
                    }else{
                        alerta('success',cadena_input_departamento,'','');
                        console.log('RESULTADO DE DEPARTAMENTO A GUARDAR: '+dato_valida_departamento);
                    }

                    break;
                case '2'://no acepta
                    dato_valida_departamento=''; 
                    dato_dia_progra=''; 
                    dato_hora_desde_progra=''; 
                    dato_hora_hasta_progra=''; 

                    //Validación Correo
                    if(dato_valida_correo==2){
                        //2 es que no correcto 
                        if(dato_input_correo==''){
                            alerta('error',cadena_input_correo,'','');
                            alerta('success',cadena_valida_correo,'','');
                            return;
                        }else{
                            if(valida_correo(cadena_input_correo)==1){
                                notificacion('¡ Correo incorrecto !','Ingrese un correo valido.','error');
                                alerta('error',cadena_input_correo,'','');
                            }else{
                                alerta('success',cadena_input_correo,'','');
                            }
                        }
                    }else if(dato_valida_correo==1){//Si es correcto, no habrá actualización
                        alerta('',cadena_input_correo,'','');
                        alerta('success',cadena_valida_correo,'','');
                        dato_input_correo='';
                    }else if(dato_valida_correo==3 || dato_valida_correo==4){
                        alerta('success',cadena_valida_correo,'','');
                        alerta('',cadena_input_correo,'','');
                        dato_input_correo='';
                    }else{
                        alerta('error',cadena_valida_correo,'','');
                        return;
                    }
                    console.log('RESULTADO DE CORREO A GUARDAR: '+dato_input_correo);                    
                    break;
                default:
                    alerta('error',cadena_valida_subrespuesta,'','');
                    console.log('DATO SUBRESPUESTA 2: '+dato_acepta_subrespuesta);
                    return;
                    break;
            }


            //Imprimimos los resultados finales
            console.log('--------------------DATOS A GRABAR SI SI-------------');
            console.log('dato_valida_nombre =>'+dato_valida_nombre); 
            console.log('dato_input_nombre =>'+dato_input_nombre); 
            console.log('dato_valida_apellido =>'+dato_valida_apellido); 
            console.log('dato_input_apellido =>'+dato_input_apellido); 
            console.log('dato_acepta_subrespuesta =>'+dato_acepta_subrespuesta); 
            console.log('dato_dia_progra =>'+dato_dia_progra); 
            console.log('dato_hora_desde_progra =>'+dato_hora_desde_progra); 
            console.log('dato_hora_hasta_progra =>'+dato_hora_hasta_progra); 
            console.log('dato_valida_correo =>'+dato_valida_correo); 
            console.log('dato_input_correo =>'+dato_input_correo); 
            console.log('dato_valida_departamento =>'+dato_valida_departamento); 
            console.log('------------------------ FIN DE DATOS A GRABAR SI SI--.------------------------------');

            grabar_datos_si_si(id_sol,dato_valida_nombre,dato_input_nombre,dato_valida_apellido,dato_input_apellido,dato_acepta_subrespuesta,dato_dia_progra,dato_hora_desde_progra,dato_hora_hasta_progra,dato_valida_correo,dato_input_correo,dato_valida_departamento);
            break;


        //NO PERTENECE A LA EMPRESA
        case '2':

            /* VALIDACIÓN DE DATOS NOMBRES*/
            console.log('validación de nombre: '+dato_input_nombre);
            if(dato_valida_nombre==2){
                //2 es que no correcto 
                if(dato_input_nombre==''){
                    alerta('error',cadena_input_nombre,'','');
                    alerta('success',cadena_valida_nombre,'','');
                    return;
                }else{
                    alerta('success',cadena_input_nombre,'','');
                }
            }else if(dato_valida_nombre==1){//Si es correcto, no habrá actualización
                alerta('',cadena_input_nombre,'','');
                alerta('success',cadena_valida_nombre,'','');
                dato_input_nombre='';
            }else{
                alerta('error',cadena_valida_nombre,'','');
                return;
            }
            console.log('RESULTADO DE NOMBRE A GUARDAR: '+dato_input_nombre);
            
            /* VALIDACIÓN DE DATOS APELLIDOS*/
            //Select valida apellido
            var cadena_valida_apellido = 'select_habilita_apellido_'+id_sol;
            var dato_valida_apellido = $('#'+cadena_valida_apellido).val();
            //Input nombre
            var cadena_input_apellido = 'txt_apellidos_sol_'+id_sol;
            var dato_input_apellido = $('#'+cadena_input_apellido).val();
            
            console.log('validación de apellido: '+dato_input_apellido);
            if(dato_valida_apellido==2){
                //2 es que no correcto 
                if(dato_input_apellido==''){
                    alerta('error',cadena_input_apellido,'','');
                    alerta('success',cadena_valida_apellido,'','');
                    return;
                }else{
                    alerta('success',cadena_input_apellido,'','');
                }
            }else if(dato_valida_apellido==1){//Si es correcto, no habrá actualización
                alerta('',cadena_input_apellido,'','');
                alerta('success',cadena_valida_apellido,'','');
                dato_input_apellido='';
            }else{
                alerta('error',cadena_valida_apellido,'','');
                return;
            }
            console.log('RESULTADO DE APELLIDO A GUARDAR: '+dato_input_apellido);

            // VALIDACIÓN SUB RESPUESTA 2
            var cadena_valida_subrespuesta2 = 'select_sub_respuesta2_'+id_sol;
            var dato_acepta_subrespuesta2 = $('#'+cadena_valida_subrespuesta2).val();

            switch (dato_acepta_subrespuesta2) {
                case '1'://si acepta
                    alerta('success',cadena_valida_subrespuesta2,'','');
                    //VALIDACIÓN DE PROGRAMACIÓN
                    //alerta('success',cadena_valida_subrespuesta,'','');
                    if(dato_dia_progra==''){
                        alerta('error',cadena_valida_dia_progra,'','');
                        return; 
                    }else{
                        alerta('success',cadena_valida_dia_progra,'','');
                    }
                    if(dato_hora_desde_progra==''){
                        alerta('error',cadena_valida_hora_desde_progra,'','');
                        return; 
                    }else{
                        alerta('success',cadena_valida_hora_desde_progra,'','');
                    }
                    if(dato_hora_hasta_progra==''){
                        alerta('error',cadena_valida_hora_hasta_progra,'','');
                        return; 
                    }else{
                        alerta('success',cadena_valida_hora_hasta_progra,'','');
                    }
                    console.log('DATO PROGRAMACION: '+dato_dia_progra+' / ' + dato_hora_desde_progra + ' ' + dato_hora_hasta_progra);

                    //Validación Correo
                    if(dato_valida_correo==2){
                        //2 es que no correcto 
                        if(dato_input_correo==''){
                            alerta('error',cadena_input_correo,'','');
                            alerta('success',cadena_valida_correo,'','');
                            return;
                        }else{
                            if(valida_correo(cadena_input_correo)==1){
                                notificacion('¡ Correo incorrecto !','Ingrese un correo valido.','error');
                                alerta('error',cadena_input_correo,'','');
                            }else{
                                alerta('success',cadena_input_correo,'','');
                            }
                        }
                    }else if(dato_valida_correo==1){//Si es correcto, no habrá actualización
                        alerta('',cadena_input_correo,'','');
                        alerta('success',cadena_valida_correo,'','');
                        dato_input_correo='';
                    }else if(dato_valida_correo==3 || dato_valida_correo==4){
                        alerta('success',cadena_valida_correo,'','');
                        alerta('',cadena_input_correo,'','');
                        dato_input_correo='';
                    }else{
                        alerta('error',cadena_valida_correo,'','');
                        return;
                    }
                    console.log('RESULTADO DE CORREO A GUARDAR: '+dato_input_correo);
            

                    // Validación Departamento
                    var cadena_input_departamento = 'select_departamento_'+id_sol;
                    var dato_valida_departamento = $('#'+cadena_input_departamento).val();

                    if(dato_valida_departamento==''){
                        alerta('error',cadena_input_departamento,'','');
                        return; 
                    }else{
                        alerta('success',cadena_input_departamento,'','');
                        console.log('RESULTADO DE DEPARTAMENTO A GUARDAR: '+dato_valida_departamento);
                    }

                    //Imprimimos los resultados finales
                    console.log('--------------------DATOS A GRABAR SI SI-------------');
                    console.log('dato_valida_nombre =>'+dato_valida_nombre); 
                    console.log('dato_input_nombre =>'+dato_input_nombre); 
                    console.log('dato_valida_apellido =>'+dato_valida_apellido); 
                    console.log('dato_input_apellido =>'+dato_input_apellido); 
                    console.log('dato_acepta_subrespuesta =>'+dato_acepta_subrespuesta); 
                    console.log('dato_dia_progra =>'+dato_dia_progra); 
                    console.log('dato_hora_desde_progra =>'+dato_hora_desde_progra); 
                    console.log('dato_hora_hasta_progra =>'+dato_hora_hasta_progra); 
                    console.log('dato_valida_correo =>'+dato_valida_correo); 
                    console.log('dato_input_correo =>'+dato_input_correo); 
                    console.log('dato_valida_departamento =>'+dato_valida_departamento); 
                    console.log('dato_razon_social =>'+dato_razon_social); 
                    console.log('dato_ruc =>'+dato_ruc); 
                    console.log('------------------------ FIN DE DATOS A GRABAR SI SI--.------------------------------');

                    grabar_datos_no_si(id_sol,dato_razon_social,dato_ruc,dato_acepta_subrespuesta2,dato_valida_nombre,dato_input_nombre,dato_valida_apellido,dato_input_apellido,dato_acepta_subrespuesta,dato_dia_progra,dato_hora_desde_progra,dato_hora_hasta_progra,dato_valida_correo,dato_input_correo,dato_valida_departamento);
                    break;
                    
                    break;
                case '2'://no acepta
                    /* VALIDACIÓN DE DATOS NOMBRES*/
                    console.log('validación de nombre: '+dato_input_nombre);
                    if(dato_valida_nombre==2){
                        //2 es que no correcto 
                        if(dato_input_nombre==''){
                            alerta('error',cadena_input_nombre,'','');
                            alerta('success',cadena_valida_nombre,'','');
                            return;
                        }else{
                            alerta('success',cadena_input_nombre,'','');
                        }
                    }else if(dato_valida_nombre==1){//Si es correcto, no habrá actualización
                        alerta('',cadena_input_nombre,'','');
                        alerta('success',cadena_valida_nombre,'','');
                        dato_input_nombre='';
                    }else{
                        alerta('error',cadena_valida_nombre,'','');
                        return;
                    }
                    console.log('RESULTADO DE NOMBRE A GUARDAR: '+dato_input_nombre);
                    
                    /* VALIDACIÓN DE DATOS APELLIDOS*/
                    //Select valida apellido
                    var cadena_valida_apellido = 'select_habilita_apellido_'+id_sol;
                    var dato_valida_apellido = $('#'+cadena_valida_apellido).val();
                    //Input nombre
                    var cadena_input_apellido = 'txt_apellidos_sol_'+id_sol;
                    var dato_input_apellido = $('#'+cadena_input_apellido).val();
                    
                    console.log('validación de apellido: '+dato_input_apellido);
                    if(dato_valida_apellido==2){
                        //2 es que no correcto 
                        if(dato_input_apellido==''){
                            alerta('error',cadena_input_apellido,'','');
                            alerta('success',cadena_valida_apellido,'','');
                            return;
                        }else{
                            alerta('success',cadena_input_apellido,'','');
                        }
                    }else if(dato_valida_apellido==1){//Si es correcto, no habrá actualización
                        alerta('',cadena_input_apellido,'','');
                        alerta('success',cadena_valida_apellido,'','');
                        dato_input_apellido='';
                    }else{
                        alerta('error',cadena_valida_apellido,'','');
                        return;
                    }
                    console.log('RESULTADO DE APELLIDO A GUARDAR: '+dato_input_apellido);

                    dato_valida_departamento=''; 
                    dato_dia_progra=''; 
                    dato_hora_desde_progra=''; 
                    dato_hora_hasta_progra=''; 
                    dato_razon_social=''; 
                    dato_valida_correo='';
                    dato_input_correo='';
                    dato_ruc=''; 
                    dato_hora_hasta_progra=''; 
                    grabar_datos_no_no(id_sol,dato_razon_social,dato_ruc,dato_acepta_subrespuesta2,dato_valida_nombre,dato_input_nombre,dato_valida_apellido,dato_input_apellido,dato_acepta_subrespuesta,dato_dia_progra,dato_hora_desde_progra,dato_hora_hasta_progra,dato_valida_correo,dato_input_correo,dato_valida_departamento);
                    break;
                default:
                    alerta('error',cadena_valida_subrespuesta2,'','');
                    console.log('DATO SUBRESPUESTA 2: '+dato_acepta_subrespuesta2);
                    break;
            }

            break;            
        default:
            //Alerta no seleccionado
            notificacion('¡ Ocurrió un error !','Para grabar debe seleccionar si pertenece o no a la empresa.','error');
            break;
    }
}
function grabar_datos_no_no(id_sol,dato_razon_social,dato_ruc,dato_acepta_subrespuesta2,dato_valida_nombre,dato_input_nombre,dato_valida_apellido,dato_input_apellido,dato_acepta_subrespuesta,dato_dia_progra,dato_hora_desde_progra,dato_hora_hasta_progra,dato_valida_correo,dato_input_correo,dato_valida_departamento){
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: '<?php echo base_url();?>C_marcador_sys_upd_pruebas/actualizar_base_no_no',
        data: {
            'dato_valida_nombre':dato_valida_nombre,
            'dato_input_nombre':dato_input_nombre,
            'dato_valida_apellido':dato_valida_apellido,
            'dato_input_apellido':dato_input_apellido,
            'dato_acepta_subrespuesta':dato_acepta_subrespuesta,
            'dato_acepta_subrespuesta2':dato_acepta_subrespuesta2,
            'dato_dia_progra':dato_dia_progra,
            'dato_hora_desde_progra':dato_hora_desde_progra,
            'dato_hora_hasta_progra':dato_hora_hasta_progra,
            'dato_valida_correo':dato_valida_correo,
            'dato_input_correo':dato_input_correo,
            'dato_valida_departamento':dato_valida_departamento,
            'dato_razon_social':dato_razon_social,
            'dato_ruc':dato_ruc,
            'id':id_sol,
            'si_si':'si_no'
        }, 
        beforeSend:function(){
        },   
        success: function(e){ 
            notificacion('Actualización completa','Se actualizó el registro seleccionado..','success');
            get_registros();
        }
    });
}


function grabar_datos_no_si(id_sol,dato_razon_social,dato_ruc,dato_acepta_subrespuesta2,dato_valida_nombre,dato_input_nombre,dato_valida_apellido,dato_input_apellido,dato_acepta_subrespuesta,dato_dia_progra,dato_hora_desde_progra,dato_hora_hasta_progra,dato_valida_correo,dato_input_correo,dato_valida_departamento){
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: '<?php echo base_url();?>C_marcador_sys_upd_pruebas/actualizar_base_no_si',
        data: {
            'dato_valida_nombre':dato_valida_nombre,
            'dato_input_nombre':dato_input_nombre,
            'dato_valida_apellido':dato_valida_apellido,
            'dato_input_apellido':dato_input_apellido,
            'dato_acepta_subrespuesta':dato_acepta_subrespuesta,
            'dato_acepta_subrespuesta2':dato_acepta_subrespuesta2,
            'dato_dia_progra':dato_dia_progra,
            'dato_hora_desde_progra':dato_hora_desde_progra,
            'dato_hora_hasta_progra':dato_hora_hasta_progra,
            'dato_valida_correo':dato_valida_correo,
            'dato_input_correo':dato_input_correo,
            'dato_valida_departamento':dato_valida_departamento,
            'dato_razon_social':dato_razon_social,
            'dato_ruc':dato_ruc,
            'id':id_sol,
            'si_si':'si_no'
        }, 
        beforeSend:function(){
        },   
        success: function(e){ 
            notificacion('Actualización completa','Se actualizó el registro seleccionado..','success');
            get_registros();
        }
    });
}

function grabar_datos_si_si(id_sol,dato_valida_nombre,dato_input_nombre,dato_valida_apellido,dato_input_apellido,dato_acepta_subrespuesta,dato_dia_progra,dato_hora_desde_progra,dato_hora_hasta_progra,dato_valida_correo,dato_input_correo,dato_valida_departamento){
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: '<?php echo base_url();?>C_marcador_sys_upd_pruebas/actualizar_base_si_si',
        data: {
            'dato_valida_nombre':dato_valida_nombre,
            'dato_input_nombre':dato_input_nombre,
            'dato_valida_apellido':dato_valida_apellido,
            'dato_input_apellido':dato_input_apellido,
            'dato_acepta_subrespuesta':dato_acepta_subrespuesta,
            'dato_dia_progra':dato_dia_progra,
            'dato_hora_desde_progra':dato_hora_desde_progra,
            'dato_hora_hasta_progra':dato_hora_hasta_progra,
            'dato_valida_correo':dato_valida_correo,
            'dato_input_correo':dato_input_correo,
            'dato_valida_departamento':dato_valida_departamento,
            'id':id_sol,
            'si_si':'si_si'
        }, 
        beforeSend:function(){
        },   
        success: function(e){ 
            notificacion('Actualización completa','Se actualizó el registro seleccionado..','success');
            get_registros();
        }
    });
}

function valida_correo(input_correo){
    if($("#"+input_correo).val().indexOf('@', 0) == -1 || $("#"+input_correo).val().indexOf('.', 0) == -1) {
        return 1;//error
    }else{
        return 2; //correcto
    }
}

/*
-- Actualizar Solicitud
*/


function actualizar(id_sol){
//Validador
let contador = 0 ; 
//Obtención de datos
let txt_razon_socual_upd_ = $('#txt_razon_socual_upd_'+id_sol).val();
let txt_ruc_upd_ = $('#txt_ruc_upd_'+id_sol).val();
let txt_nombre_sol_ = $('#txt_nombre_sol_'+id_sol).val();
let txt_apellidos_sol_ = $('#txt_apellidos_sol_'+id_sol).val();
let txt_celular_upd_ = $('#txt_celular_upd_'+id_sol).val();
let txt_telefono_upd_ = $('#txt_telefono_upd_'+id_sol).val();
let txt_correo_upd_ = $('#txt_correo_upd_'+id_sol).val();
let text_comentario_upd_ = $('#text_comentario_upd_'+id_sol).val();

// Grabar datos
let select_respuesta_ = $('#select_respuesta_'+id_sol).val();
let select_sub_respuesta_ = $('#select_sub_respuesta_'+id_sol).val();
let select_sub_respuesta2_ = $('#select_sub_respuesta2_'+id_sol).val();
let txt_dia_progra = $('#txt_dia_progra_'+id_sol).val();
let txt_hora_desde_progra = $('#txt_hora_desde_progra_'+id_sol).val();
let txt_hora_hasta_progra = $('#txt_hora_hasta_progra_'+id_sol).val();

//Grabar dep
let select_departamento_ = $('#select_departamento_'+id_sol).val();

let cade0 ='select_respuesta_'+id_sol; 
if(select_respuesta_==''){alerta('error',cade0,'','');contador++;}else{alerta('success',cade0,'','');}

switch (select_respuesta_) {
    case '1'://si
        let cade00 ='select_sub_respuesta_'+id_sol; 
        if(select_sub_respuesta_==''){alerta('error',cade00,'','');contador++;}else{alerta('success',cade00,'','');}
        break;

    case '2'://no
        let cade000 ='select_sub_respuesta2_'+id_sol; 
        if(select_sub_respuesta2_==''){alerta('error',cade000,'','');contador++;}else{alerta('success',cade000,'','');}
        break;

    default:
        break;
}




let cade001 ='txt_dia_progra_'+id_sol;
let cade002 ='txt_hora_desde_progra_'+id_sol;
let cade003 ='txt_hora_hasta_progra_'+id_sol;
switch (select_sub_respuesta_) {
    case '1'://si
        if(txt_dia_progra==''){alerta('error',cade001,'','');contador++;}else{alerta('success',cade001,'','');}
        if(txt_hora_desde_progra==''){alerta('error',cade002,'','');contador++;}else{alerta('success',cade002,'','');}
        if(txt_hora_hasta_progra==''){alerta('error',cade003,'','');contador++;}else{alerta('success',cade003,'','');}
        break;
    case '2'://no
        if(select_sub_respuesta2_!='1'){
            txt_dia_progra='';
            txt_hora_desde_progra='';
            txt_hora_hasta_progra='';
        }
        break;        
    default:
        break;
}

switch (select_sub_respuesta2_) {
    case '1'://si
        if(txt_dia_progra==''){alerta('error',cade001,'','');contador++;}else{alerta('success',cade001,'','');}
        if(txt_hora_desde_progra==''){alerta('error',cade002,'','');contador++;}else{alerta('success',cade002,'','');}
        if(txt_hora_hasta_progra==''){alerta('error',cade003,'','');contador++;}else{alerta('success',cade003,'','');}
        break;
    case '2'://no
        if(select_sub_respuesta_!='1'){
            txt_dia_progra='';
            txt_hora_desde_progra='';
            txt_hora_hasta_progra='';
        }
        break;        
    default:
        break;
}

console.log(select_sub_respuesta_);
//return;

let cade_ruc ='txt_ruc_upd_'+id_sol; 
if(txt_ruc_upd_==''){alerta('error',cade_ruc,'','');}else{alerta('success',cade_ruc,'','');}

let cade1 ='txt_razon_socual_upd_'+id_sol; 
if(txt_razon_socual_upd_==''){alerta('error',cade1,'','');}else{alerta('success',cade1,'','');}

let cade2 ='txt_nombre_sol_'+id_sol; 
if(txt_nombre_sol_==''){}else{alerta('success',cade2,'','');}

let cade3 ='txt_apellidos_sol_'+id_sol; 
if(txt_apellidos_sol_==''){}else{alerta('success',cade3,'','');}

let cade4 ='txt_celular_upd_'+id_sol; 
if(txt_celular_upd_==''){alerta('error',cade4,'','');}else{alerta('success',cade4,'','');}

let cade5 ='txt_telefono_upd_'+id_sol; 
if(txt_telefono_upd_==''){alerta('error',cade5,'','');}else{alerta('success',cade5,'','');}

let cade6 ='txt_correo_upd_'+id_sol; 
if(txt_correo_upd_==''){alerta('error',cade6,'','');}else{alerta('success',cade6,'','');}


let cade7 ='text_comentario_upd_'+id_sol; 
if(text_comentario_upd_==''){alerta('error',cade7,'','');}else{alerta('success',cade7,'','');}


//Validación de razón social  o RUC
if(select_respuesta_==2){
    if(select_sub_respuesta2_==1){
        console.log('Se solicita si o si el RUC o RAZON SOCIAL');
        //$('#txt_razon_socual_upd_'+id_sol).
        //vacio ? 
        if(txt_razon_socual_upd_==''){
            notificacion('¡ Razon Social Obligatoria !','Ingrese la razón social o RUC de la empresa.','error');
            alerta('error',cade1,'','');
            return;
            console.log('Razón social no completada');
        }
    }
}
//Validación de correo
if(select_respuesta_==1){
    if(select_sub_respuesta_==1 || select_sub_respuesta_==2 || select_sub_respuesta2_==1){
        console.log('Seleccionó pertenece a empressa si');
        console.log('Seleccionó si o no acepta (subrespuesta)');

        //validamos correo si se cambió 
        if(txt_correo_upd_!=''){
            if($("#txt_correo_upd_"+id_sol).val().indexOf('@', 0) == -1 || $("#txt_correo_upd_"+id_sol).val().indexOf('.', 0) == -1) {
                notificacion('¡ Correo electrónico erroneo !','Ingrese un correo electrónico correcto.','error');
                console.log('Correo electrónico erroneo');
                alerta('error',cade6,'','');
                return;
                //return false;
            }
        }
    }
}


if(contador<=0){
    notificacion('¡ Actualización completa !','Se actualizó correctamente la información de la solicitud.','success');

    //enviamos el ajax
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: '<?php echo base_url();?>C_marcador_sys_upd_pruebas/actualizar',
        data: {
            'txt_razon_socual_upd_':txt_razon_socual_upd_,
            'txt_ruc_upd_':txt_ruc_upd_,
            'txt_nombre_sol_':txt_nombre_sol_,
            'txt_apellidos_sol_':txt_apellidos_sol_,
            'txt_celular_upd_':txt_celular_upd_,
            'txt_telefono_upd_':txt_telefono_upd_,
            'txt_correo_upd_':txt_correo_upd_,
            'text_comentario_upd_':text_comentario_upd_,

            //Programacion
            'select_respuesta_':select_respuesta_,
            'select_sub_respuesta_':select_sub_respuesta_,
            'select_sub_respuesta2_':select_sub_respuesta2_,
            'txt_dia_progra_':txt_dia_progra,
            'txt_hora_desde_progra_':txt_hora_desde_progra,
            'txt_hora_hasta_progra_':txt_hora_hasta_progra,

            //Departamento
            'select_departamento_':select_departamento_,

            'id':id_sol
        }, 
        beforeSend:function(){
        },   
        success: function(e){ 
            /*Limpiamos*/
            alerta('',cade1,'','');
            alerta('',cade2,'','');
            alerta('',cade3,'','');
            alerta('',cade4,'','');
            alerta('',cade5,'','');
            alerta('',cade6,'','');
            alerta('',cade7,'','');
            notificacion('Actualización completa','Se actualizó el registro seleccionado..','success');
            get_registros();
        }
    });
}else{
    console.log(contador);
    notificacion('¡ Complete los datos !','Toda la información solicitada es importante para la actualización de los datos.','error');
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
            url: '<?php echo base_url();?>C_marcador_sys_upd_pruebas/insert',
            data: {
            }, 
            beforeSend:function(){
            },   
            success: function(e){ 
                notificacion('Ingreso correcto','Se registró correctamente un empleado, complete los detalles solicitados.','success');
                get_registros();
                get_select_filtros(); 
                id_contacto=e; 
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
                url: '<?php echo base_url();?>C_marcador_sys_upd_pruebas/insert_registros',
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
                url: '<?php echo base_url();?>C_marcador_sys_upd_pruebas/insert_registros',
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


function get_registros_adicional(tipo,id_sol){
$.ajax({
    type: "POST",
    url: '<?php echo base_url();?>C_marcador_sys_upd_pruebas/get_registros_adicional',
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
    url: '<?php echo base_url();?>C_marcador_sys_upd_pruebas/get_datos_select_x_id',
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

function limpiar_formulario(tipo,id_sol,id_reg){
    alertify.confirm("¿Està seguro de limpiar los datos del formulario el registro?.",
    function(){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_marcador_sys_upd_pruebas/limpiar_formulario',
            data: {
                'tipo':tipo,
                'id_sol':id_sol,
                'id_reg':id_reg
            }, 
            beforeSend:function(){
            },   
            success: function(e){ 
                switch (tipo) {
                    case 'solicitud':
                        get_registros();
                        alertify.success('Registro limpiado correctamente.');
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


function eliminar(tipo,id_sol,id_reg){
    alertify.confirm("¿Està seguro de eliminar el registro?.",
    function(){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_marcador_sys_upd_pruebas/eliminar',
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
    url: '<?php echo base_url();?>C_marcador_sys_upd_pruebas/get_select_filtros',
    data: {
    }, 
    beforeSend:function(){
    },   
    success: function(e){ 
        var res = jQuery.parseJSON(e);

        $('#s_empleado').html(res.s_empleado);
        if(id_contacto!=0){
            $('#s_empleado').val(id_contacto);
        }
        //$('#s_estado_solicitud').html(res.estado_solicitud);
        //$('#s_tipo_contrato').html(res.tipo_contrato);
        //$('#s_frecuencia').html(res.tipo_frecuencia);
        //$('#s_mes').html(res.mes_solicitud);

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
    url: '<?php echo base_url();?>C_marcador_sys_upd_pruebas/get_indicadores',
    data: {
    }, 
    beforeSend:function(){
    },   
    success: function(e){ 
        var res = jQuery.parseJSON(e);

        $('#btn_activo').html('Emp. Agregado '+ res.activo);
        $('#btn_en_espera').html('En Espera '+ res.en_espera);
        $('#btn_completado').html('Emp. Base '+ res.completado);
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
    xhr.open('post', '<?php echo base_url();?>C_marcador_sys_upd_pruebas/subir_foto', true);
    
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

function activar_validador(tipo,input_seleccion,id,input_hab){
    //Input que se selecciona, id e input habilitar
    let dato_seleccionado = '';
    switch (tipo) {
        case 'activador':
            dato_seleccionado = $('#'+input_seleccion+id).val(); 
            console.log('--->'+dato_seleccionado);
            switch (dato_seleccionado) {
                case '2'://No correcto
                    $('#'+input_hab+id).removeAttr('disabled');
                    break;
                default:
                    $('#'+input_hab+id).val('');
                    $('#'+input_hab+id).attr('disabled','disabled');
                    break;
            }
            break;
        default:
            break;
    }
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
        url: '<?php echo base_url();?>C_marcador_sys_upd_pruebas/grabar',
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