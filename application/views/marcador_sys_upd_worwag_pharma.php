<link href="<?php echo base_url();?>public/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />


<div class="main-content">

<div class="page-content" style="margin-top:20px !important;padding-top:10px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-8">
                <div class="card" style="background:#eaeaea;">
                    
                    <!--
                        FORMULARIO WOR WAG
                    -->
                    <div class="card-body mt-3">
                        <div class="row">
                        
                            <div class="col-lg-12 mt-3">
                                <label>TIPO DE RECEPCIÓN</label>
                                <select disabled class="form-control form-control-sm">
                                    <option>Seleccione</option>
                                    <option value="" selected>FARMOVIGILANCIA</option> <!--REPORTE INTERNO DE SOSPECHA  DE REACCIÓN ADVERSA - FARMOVIGILANCIA--->
                                    <option value="">PROGRAMA DE BENEFICIO AL PACIENTE</option>
                                </select>     
                            </div>

                            <div class="col-lg-12 mt-3">
                                <span>
                                    Sr./Sra ….   por favor bríndenos sus datos a fin de que la responsable de Farmacovigilancia de WORWAG pueda contactarlo(a) en el transcurso de la semana para aclarar
                                    cualquier duda que tenga sobre el producto. Toda información que nos brinde será tratada con total confidencialidad. 
                                </span>
                            </div>

                            <div class="col-lg-12 mt-3">
                                <label>Nombres: </label><label id="txt_nombres_msj" style="color:red;font-size:8px;">*</label>
                                <input class="form-control form-control-sm" id="txt_nombres" type="text">
                            </div>

                            <div class="col-lg-6 mt-3">
                                <label>Sexo: </label><label id="txt_sexo_msj" style="color:red;font-size:8px;">*</label>
                                <select class="form-control form-control-sm" id="txt_sexo">
                                </select>                                
                            </div>
                            
                            <div class="col-lg-6 mt-3">
                                <label>Edad: </label><label id="txt_edad_msj" style="color:red;font-size:8px;">*</label>
                                <input class="form-control form-control-sm" id="txt_edad" type="number">
                            </div>

                            <div class="col-lg-6 mt-3">
                                <label>E-mail: </label><label id="txt_email_msj" style="color:red;font-size:8px;">*</label>
                                <div class="row">
                                    <div class="col-lg-6 mt-3">
                                        <select id="select_email" class="form-control form-control-sm"  onchange="activar_campos('select_email','txt_email','1',-1);">
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <input class="form-control form-control-sm" id="txt_email" type="text" placeholder="Complete la información." disabled>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 mt-3">
                                <label>Teléfono: </label><label id="txt_telefono_msj" style="color:red;font-size:8px;">*</label>
                                <div class="row">
                                    <div class="col-lg-6 mt-3">
                                        <select class="form-control form-control-sm" id="select_telefono" onchange="activar_campos('select_telefono','txt_telefono','1',-1);">
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <input class="form-control form-control-sm" id="txt_telefono" type="text" placeholder="Complete la información." disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mt-3">
                                <label>Celular: </label><label id="txt_celular_msj" style="color:red;font-size:8px;">*</label>
                                <input class="form-control form-control-sm" id="txt_celular" disabled type="text">
                            </div>

                            <div class="col-lg-6 mt-3">
                                <label>Centro de Atención: </label><label id="txt_atencion_msj" style="color:red;font-size:8px;">*</label>
                                <div class="row">
                                    <div class="col-lg-6 ">
                                        <select class="form-control form-control-sm"  id="select_atencion" onchange="activar_campos('select_atencion','txt_atencion','4',-1);">
                                        </select>
                                    </div>
                                    <div class="col-lg-6 ">
                                        <input class="form-control form-control-sm" id="txt_atencion" type="text" placeholder="Complete la información." disabled>
                                    </div>
                                </div>
                            </div>                            

                        </div>
                        
                        <br>
                        <hr>

                        <div class="row">
                            <div class="col-lg-12 mt-3">
                                <label>Medicamento Identificable: </label><label id="txt_medicamento_msj" style="color:red;font-size:8px;">*</label>
                                <div class="row">
                                    <div class="col-lg-6 ">
                                        <select class="form-control form-control-sm" id="select_medicamento" onchange="activar_campos('select_medicamento','txt_medicamento',0,2);">
                                        </select>
                                    </div>

                                    <!--<div class="col-lg-6 ">
                                        <input class="form-control form-control-sm" id="txt_sintoma" type="text" placeholder="Complete la información." disabled>
                                    </div>-->
                                    
                                    <div class="col-lg-12 mt-3" id="panel_medicamentos">
                                        <!--<button id="btn_sintoma_1" onclick="retirar(1,1);" class="btn btn-sm btn-info" style="margin-left:5px;">HIPERCALCIURIA X</button>
                                        <button id="btn_sintoma_2" onclick="retirar(1,2);" class="btn btn-sm btn-info" style="margin-left:5px;">DIARREA X</button>
                                        <button id="btn_sintoma_3" onclick="retirar(1,3);" class="btn btn-sm btn-info" style="margin-left:5px;">DOLOR X</button>-->
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-12 mt-3">
                                <label>Reacción Adversa ( Síntoma y/o signo): </label><label id="txt_sintoma_msj" style="color:red;font-size:8px;">*</label>
                                <div class="row">
                                    <div class="col-lg-6 ">
                                        <span>Multi Opción: </span>
                                        <select class="form-control form-control-sm" id="select_sintoma" onchange="activar_campos('select_sintoma','txt_sintoma',23,1);">
                                        </select>
                                    </div>

                                    <div class="col-lg-6 ">
                                        <span>¿Otras reacciones?</span>
                                        <div style="display:flex;flex-direction:row;">
                                            <input type="checkbox" id="txt_check" onclick="activar_campos_check('txt_check','txt_sintoma',0,0);"> SI
                                            <input style="margin-left:20px;" class="form-control form-control-sm" id="txt_sintoma" type="text" placeholder="Complete la información." disabled>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12 mt-3" id="panel_sintomas">
                                        <!--<button id="btn_sintoma_1" onclick="retirar(1,1);" class="btn btn-sm btn-info" style="margin-left:5px;">HIPERCALCIURIA X</button>
                                        <button id="btn_sintoma_2" onclick="retirar(1,2);" class="btn btn-sm btn-info" style="margin-left:5px;">DIARREA X</button>
                                        <button id="btn_sintoma_3" onclick="retirar(1,3);" class="btn btn-sm btn-info" style="margin-left:5px;">DOLOR X</button>-->
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-12 mt-3">
                                <label>Observaciones: </label><label id="txt_descripcion_msj" style="color:red;font-size:8px;">*</label>
                                <textarea id="txt_descripcion" class="form-control"></textarea>
                            </div>  
                            
                            
                            <div class="col-lg-12 mt-3">
                                <label>Nombre completo del recopilador</label>
                                <input class="form-control form-control-sm" id="txt_usuario" type="text" disabled placeholder="Datos del teleoperador">
                            </div>  

                        </div> 

                        <div class="row mt-3">
                            <div class="col-lg-12 mt-3 text-center">
                                <button class="btn btn-danger " onclick="registrar();"> Guardar Registros</button>
                            </div>
                        </div>
                    </div>
            
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
                        <input class="form-control"  id="telefono" type="number">
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

<script src="<?php echo base_url();?>public/libs/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="<?php echo base_url();?>public/js/pages/form-advanced.init.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


<script>

    let contador=4;

    $(document).ready(function() {
        get_selects('medicamento').then(r =>{
            //row.child(r).show();
            //tr.addClass('shown');
            get_selects('sintoma').then(r =>{
                get_selects('sexo').then(r =>{
                    get_selects('email').then(r =>{
                        get_selects('telefono').then(r =>{
                            get_selects('centro').then(r =>{
                                //llamos a funciones de carga de datos.. 
                                get_registros(0); //DATOS DEL FORMULARIO
                                get_registros(1); //DATOS SINTOMA
                                get_registros(2); //DATOS MEDICAMENTO
                            }).catch(() => {
                                console.log('Hubo un error al cargar centro de atención');
                            });                             
                        }).catch(() => {
                            console.log('Hubo un error al cargar telefono');
                        });                          
                    }).catch(() => {
                        console.log('Hubo un error al cargar correo');
                    });  
                }).catch(() => {
                    console.log('Hubo un error al cargar genero');
                });                
            }).catch(() => {
                console.log('Hubo un error al cargar los sintomas');
            });
        }).catch(() => {
            console.log('Hubo un error al cargar los medicamentos');
        });
    });

    //PROMISE
    function get_selects(tipo) { 
        return new Promise(function(resolve, reject) {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>C_marcador_sys_upd/get_selects',
                data: {
                    'tipo':tipo
                }, 
                beforeSend:function(){
                },   
                success: function(e){ 
                    var res = jQuery.parseJSON(e);
                    switch (tipo) {
                        case 'medicamento':
                            $('#select_medicamento').html(res.resultado);
                            resolve(1); 
                            break;
                        case 'sintoma':
                            $('#select_sintoma').html(res.resultado);
                            resolve(1); 
                            break;
                        case 'sexo':
                            $('#txt_sexo').html(res.resultado);
                            resolve(1); 
                            break;
                        case 'email':
                            $('#select_email').html(res.resultado);
                            resolve(1); 
                            break;   
                        case 'telefono':
                            $('#select_telefono').html(res.resultado);
                            resolve(1); 
                            break; 
                        case 'centro':
                            $('#select_atencion').html(res.resultado);
                            resolve(1); 
                            break;                                                                                                                
                        case '':
                            break;                
                        default:
                            break;
                    }
                },
                error: function(){
                    reject('Hubo un error al cargar.');
                }
            });
        })
    }


    // GET SELECTS
    function get_selects__x(tipo){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_marcador_sys_upd/get_selects',
            data: {
                'tipo':tipo
            }, 
            beforeSend:function(){
            },   
            success: function(e){ 
                var res = jQuery.parseJSON(e);
                switch (tipo) {
                    case 'medicamento':
                        $('#select_medicamento').html(res.resultado);
                        break;
                    case 'sintoma':
                        $('#select_sintoma').html(res.resultado);
                        break;
                    case '':
                        break;                
                    default:
                        break;
                }
            }
        });
    }

    function get_data(id){
        var dato = $('#'+id).val();
        return dato; 
    }

    function notificar_input(id,tipo,msj){
        switch (tipo) {
            case 'error':
                $('#'+id).css('border','1px solid red');
                $('#'+id+'_msj').text(msj);
                break;
            case 'success':
                $('#'+id).css('border','1px solid green');
                $('#'+id+'_msj').text(msj);
                break;            
            default:
                $('#'+id).css('border','1px solid #ced4da');
                break;
        }
    }

    function valida_input_condicionados(id_input,id_input_obligatorio,respuesta){
        var dato = get_data(id_input);
        if(dato===respuesta){
            var dato2 = get_data(id_input_obligatorio); 
            if(dato2===''){
                return 'vacio';
            }else{
                return 'correcto'; 
            }
        }else{
            //$('#'+id_input_obligatorio).val('');
            return 'correcto'; 
        }
    }

    function get_registros(tipo){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_marcador_sys_upd/get_registros',
            data: {
                'tipo':tipo
            }, 
            beforeSend:function(){
            },   
            success: function(e){ 
                var res = jQuery.parseJSON(e);
                //$('#panel_paginacion').html(res.paginacion);
                //$('#panel_registros').html(res.registros);
                switch (tipo) {
                    case 0:
                        $('#txt_nombres').val(res.nombres);
                        $('#txt_sexo').val(res.id_sexo);
                        $('#txt_edad').val(res.edad);

                        $('#select_email').val(res.id_select_email);
                        $('#txt_email').val(res.dato_email);
                        if(res.id_select_email=='1'){
                            $('#txt_email').removeAttr('disabled');
                        }

                        
                        $('#select_telefono').val(res.id_select_telefono);
                        $('#txt_telefono').val(res.dato_telefono);
                        if(res.id_select_telefono=='1'){
                            $('#txt_telefono').removeAttr('disabled');
                        }

                        $('#txt_celular').val(res.celular);

                        $('#select_atencion').val(res.id_select_centro_atencion);
                        $('#txt_atencion').val(res.dato_centro_atencion);
                        if(res.id_select_centro_atencion=='4'){
                            $('#txt_atencion').removeAttr('disabled');
                        }

                        if(res.id_check_sintoma==='0'){
                            $('#txt_sintoma').val('');
                            $("#txt_check").prop("checked", false);
                        }else{
                            $('#txt_sintoma').val(res.dato_sintoma);
                            $("#txt_check").prop("checked", true);
                            $('#txt_sintoma').removeAttr('disabled');
                        }

                        /*if(res.dato_sintoma!=''){
                            $('#txt_sintoma').val(res.dato_sintoma);
                            $('#txt_sintoma').removeAttr('disabled');
                        }*/


                        $('#txt_descripcion').val(res.descripcion);
                        
                        $('#txt_usuario').val(res.id_usuario);
                        break;
                    case 1:
                        $('#panel_sintomas').html(res.registros);
                        break;
                    case 2:
                        $('#panel_medicamentos').html(res.registros);
                        break;                
                    default:
                        break;
                }
                //get_indicadores();
            }
        });
    }

    function agregar(tipo,id,contador,dato){
        // 1 sintomas
        // 2 medicamentos
        var dato = get_data(id);
        switch (tipo) {
            case 2:
                $.ajax({
                    type: "POST",
                    //dataType: 'json',
                    url: '<?php echo base_url();?>C_marcador_sys_upd/insert_registros',
                    data: {
                        'tipo':tipo,
                        'id_select':dato
                    }, 
                    beforeSend:function(){
                    },   
                    success: function(e){ 
                        switch (e) {
                            case 'duplicado':
                                notificacion('Registro duplicado','El registro seleccionado ya se encuentra registrado..','error');
                                break;
                            case 'error':
                                notificacion('Ocurirró un error','Vuelva a intentarlo..','error');
                                break; 
                            case 'ok':
                                notificacion('Registro realizado','Registrado correctamente..','success');
                                get_registros(tipo);
                                //var cadena='<button id="btn_'+tipo+'_'+contador+'" onclick="retirar('+tipo+','+contador+');" class="btn btn-sm btn-info" style="margin-left:5px;margin-top:5px;">' + dato + ' X </button>';
                                //var botones = $('#'+panel).html();
                                //contador++;
                                //$('#'+panel).html(botones+cadena);
                                break;                                                                
                            default:
                                break;
                        }
                    }
                });
                break; 
            case 1:
                $.ajax({
                    type: "POST",
                    //dataType: 'json',
                    url: '<?php echo base_url();?>C_marcador_sys_upd/insert_registros',
                    data: {
                        'tipo':tipo,
                        'id_select':dato
                    }, 
                    beforeSend:function(){
                    },   
                    success: function(e){ 
                        switch (e) {
                            case 'duplicado':
                                notificacion('Registro duplicado','El registro seleccionado ya se encuentra registrado..','error');
                                break;
                            case 'error':
                                notificacion('Ocurirró un error','Vuelva a intentarlo..','error');
                                break; 
                            case 'ok':
                                notificacion('Registro realizado','Registrado correctamente..','success');
                                get_registros(tipo);
                                //var cadena='<button id="btn_'+tipo+'_'+contador+'" onclick="retirar('+tipo+','+contador+');" class="btn btn-sm btn-info" style="margin-left:5px;margin-top:5px;">' + dato + ' X </button>';
                                //var botones = $('#'+panel).html();
                                //contador++;
                                //$('#'+panel).html(botones+cadena);
                                break;                                                                
                            default:
                                break;
                        }
                    }
                });
                break;                            
            default:
                break;
        }
    }

    function registrar(){
        var txt_nombres = get_data('txt_nombres');
        if(txt_nombres==''){notificar_input('txt_nombres','error',' Campo Obligatorio..');return;}else{notificar_input('txt_nombres','success','');}

        var txt_sexo = get_data('txt_sexo');
        if(txt_sexo==''){notificar_input('txt_sexo','error',' Campo Obligatorio..');return;}else{notificar_input('txt_sexo','success','');}

        var txt_edad = get_data('txt_edad');
        if(txt_edad==''){notificar_input('txt_edad','error',' Campo Obligatorio..');notificar_input('txt_email','','');return;}else{notificar_input('txt_edad','success','');}

        var select_email = get_data('select_email');
        if(select_email===''){
            notificar_input('select_email','error',' Campo Obligatorio..');
            return;
        }else{
            notificar_input('select_email','success','');
            var dato = valida_input_condicionados('select_email','txt_email','1');
            if(dato=='vacio'){
                notificar_input('txt_email','error','');
                return;
            }else{
                notificar_input('txt_email','success','');
            }
        }

        var txt_email = get_data('txt_email');
        //if(txt_email==''){notificar_input('txt_email','error',' Campo Obligatorio..');}else{notificar_input('txt_email','success','');}

        var select_telefono = get_data('select_telefono');
        if(select_telefono===''){
            notificar_input('select_telefono','error',' Campo Obligatorio..');
            return;
        }else{
            notificar_input('select_telefono','success','');
            var dato = valida_input_condicionados('select_telefono','txt_telefono','1');
            if(dato=='vacio'){
                notificar_input('txt_telefono','error','');
                return;
            }else{
                notificar_input('txt_telefono','success','');
            }
        }

        var txt_telefono = get_data('txt_telefono');
        //if(txt_telefono==''){notificar_input('txt_telefono','error',' Campo Obligatorio..');}else{notificar_input('txt_telefono','success','');}

        var txt_celular = get_data('txt_celular');
        if(txt_celular==''){notificar_input('txt_celular','error',' Campo Obligatorio..');return;}else{notificar_input('txt_celular','success','');}

        var select_atencion = get_data('select_atencion');
        if(select_atencion===''){
            notificar_input('select_atencion','error',' Campo Obligatorio..');
            return;
        }else{
            notificar_input('select_atencion','success','');
            var dato = valida_input_condicionados('select_atencion','txt_atencion','4');
            if(dato==='vacio'){
                notificar_input('txt_atencion','error','');
                return;
            }else{
                notificar_input('txt_atencion','success','');
            }
        }

        var txt_atencion = get_data('txt_atencion');
        //if(txt_atencion==''){notificar_input('txt_atencion','error',' Campo Obligatorio..');}else{notificar_input('txt_atencion','success','');}

        var select_medicamento = get_data('select_medicamento');
        //if(select_medicamento==''){notificar_input('select_medicamento','error',' Campo Obligatorio..');}else{notificar_input('select_medicamento','success','');}

        var select_sintoma = get_data('select_sintoma');
        if(select_sintoma===''){
            //notificar_input('select_sintoma','error',' Campo Obligatorio..');
        }else{
            notificar_input('select_sintoma','success','');
            var dato = valida_input_condicionados('select_sintoma','txt_sintoma','23');
            if(dato==='vacio'){
                notificar_input('txt_sintoma','error','');
                notificacion('Mensaje','Complete El campo OTROS de reacciones adversas.','error');
                return; 
            }else{
                notificar_input('txt_sintoma','success','');
            }
        }

        /*
            para reacciones otros
        */
        var txt_sintoma = get_data('txt_sintoma');
        var checkbox = 0; 
        if($('#txt_check').prop("checked") == true){
            if(txt_sintoma===''){
                notificar_input('txt_sintoma','error','');
                notificacion('Mensaje','Complete El campo OTROS de reacciones adversas.','error');
                return;
            }else{
                checkbox=1; 
                notificar_input('txt_sintoma','success','');
            }
            //$('#'+id_activa).removeAttr('disabled');
        }else if($('#txt_check').prop("checked") == false){
            $('#txt_sintoma').attr('disabled','true');
            $('#txt_sintoma').val('');
        }

        

        //if(select_sintoma==''){notificar_input('select_sintoma','error',' Campo Obligatorio..');}else{notificar_input('select_sintoma','success','');}
        //var txt_sintoma = get_data('txt_sintoma');
        //if(txt_sintoma==''){notificar_input('txt_sintoma','error',' Campo Obligatorio..');}else{notificar_input('txt_sintoma','success','');}

        var txt_descripcion = get_data('txt_descripcion');
        if(txt_descripcion==''){notificar_input('txt_descripcion','error',' Campo Obligatorio..');}else{notificar_input('txt_descripcion','success','');}


        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_marcador_sys_upd/actualizar',
            data: {
                'txt_nombres':txt_nombres,
                'txt_sexo':txt_sexo,
                'txt_edad':txt_edad,
                'select_email':select_email,
                'txt_email':txt_email,
                'select_telefono':select_telefono,
                'txt_telefono':txt_telefono,
                'txt_celular':txt_celular,
                'select_atencion':select_atencion,
                'txt_atencion':txt_atencion,
                'select_medicamento':select_medicamento,
                'select_sintoma':select_sintoma,
                'txt_sintoma':txt_sintoma,
                'txt_descripcion':txt_descripcion,
                'checkbox':checkbox
            }, 
            beforeSend:function(){
            },   
            success: function(data){
                switch (data) {
                    case 'sin_medicamento':
                        notificacion('¡ Seleccione al menos un medicamento !','Por favor seleccione algún medicamento identificable.','error');
                        notificar_input('select_medicamento','error',' Campo Obligatorio..');
                        break;
                    case 'sin_reaccion':
                        notificacion('¡ Seleccione al menos una reacción !','Por favor seleccione algún reacción adversa.','error');
                        notificar_input('select_sintoma','error',' Campo Obligatorio..');
                        notificar_input('select_medicamento','success','');
                        break;
                    case 'sin_reaccion':
                        notificacion('¡ Seleccione al menos una reacción !','Por favor seleccione algún reacción adversa.','error');
                        notificar_input('select_sintoma','error',' Campo Obligatorio..');
                        notificar_input('select_medicamento','success','');
                        break;             
                    case 'ok':
                        notificacion('¡ Información Guardad !','Los datos ingresados han sido actualizados correctamente..','success');
                        notificar_input('select_sintoma','success','');
                        notificar_input('select_medicamento','success','');
                        break;                                                              
                    default:
                        break;
                }
                //get_registros(1);
            },
            error: function(){
            }
        });

        

    }

    

    function retirar(tipo,id){
        //1 sintomas
        switch (tipo) {
            case 1:
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url();?>C_marcador_sys_upd/retirar',
                        data: {'tipo':tipo,'id':id}, 
                        beforeSend:function(){
                        },   
                        success: function(data){
                            get_registros(1);
                        },
                        error: function(){
                        }
                    });
                    //$('#btn_'+tipo+'_'+id).css('display','none');
                break;
            case 2:
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url();?>C_marcador_sys_upd/retirar',
                        data: {'tipo':tipo,'id':id}, 
                        beforeSend:function(){
                        },   
                        success: function(data){
                            get_registros(2);
                        },
                        error: function(){
                        }
                    });                
                    //$('#btn_'+tipo+'_'+id).css('display','none');
                break;            
            default:
                break;
        }
    }

    function activar_campos_check(id,id_activa,valor_activa,tipo){
        if($('#'+id).prop("checked") == true){
            $('#'+id_activa).removeAttr('disabled');
        }else if($('#'+id).prop("checked") == false){
            $('#'+id_activa).attr('disabled','true');
            $('#'+id_activa).val('');
        }
    }

    function activar_campos(id,id_activa,valor_activa,tipo){
        //1sintomas
        //2 mediamento
        let panel='';
        switch (tipo) {
            case 1:
                panel="panel_sintomas";
                break;
            case 2:
                panel="panel_medicamentos";
                break;            
            default:
                break;
        }

        var dato = $('#'+id).val();

        if(dato!=''){
            var texto = $('#'+id).find('option:selected').text(); 
            if(valor_activa===dato && tipo==-1){
                $('#'+id_activa).removeAttr('disabled');
            }else if(tipo!=-1){
                //Agregar casos por select
                //alert('---');
                if(dato==='23'){
                    $('#'+id_activa).removeAttr('disabled');
                }else{
                    agregar(tipo,id,contador,dato);
                }
            }else{
                $('#'+id_activa).val('');
                $('#'+id_activa).attr('disabled','true');
            }
        }else{
            $('#'+id_activa).val('');
            $('#'+id_activa).attr('disabled','true');
        }

    }


    function abrir_modal_agregar(){
        $('#mdl_telefono').modal('show');
    }

    function agregar_nuevo_contacto(){
        var telefono = $('#telefono').val();
        if(telefono!=''){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>C_marcador_sys_upd/validar_nuevo_telefono',
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
            url: '<?php echo base_url();?>C_marcador_sys_upd/grabar_nuevo_numero',
            data: {'dato':dato}, 
            beforeSend:function(){
                //$('.loader_carga').fadeIn('slow');
            },   
            success: function(data){
                    //$('.loader_carga').fadeOut('slow');
                    if(data=='1'){
                        notificacion('¡ Registro Correcto !','Número agregado correctamente','success');
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

    /*FUNCIONES NOVIEMBRE - NUEVO*/


    /*CORREO, DEP, NOMBRE DE LA EMPRESA, NOMBRE DEL CONTACTO*/ 
    /*FIN FUNCIONES NOVIEMBRE - NUEVO*/

    function valida_correo(input_correo){
        if($("#"+input_correo).val().indexOf('@', 0) == -1 || $("#"+input_correo).val().indexOf('.', 0) == -1) {
            return 1;//error
        }else{
            return 2; //correcto
        }
    }






    /*Obtenemos datos del select por id registrado*/
    function get_datos_select_x_id(tipo,id_sol,input){
        let id_seleccion = $('#'+input+id_sol).val(); 
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>C_marcador_sys_upd/get_datos_select_x_id',
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
                url: '<?php echo base_url();?>C_marcador_sys_upd/limpiar_formulario',
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
                url: '<?php echo base_url();?>C_marcador_sys_upd/eliminar',
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

    function get_select_filtros(){
        $.ajax({
            type: "POST",
            //dataType: 'json',
            url: '<?php echo base_url();?>C_marcador_sys_upd/get_select_filtros',
            data: {
            }, 
            beforeSend:function(){
            },   
            success: function(e){ 
                var res = jQuery.parseJSON(e);

                $('#s_empleado').html(res.s_empleado);
                //$('#s_estado_solicitud').html(res.estado_solicitud);
                //$('#s_tipo_contrato').html(res.tipo_contrato);
                //$('#s_frecuencia').html(res.tipo_frecuencia);
                //$('#s_mes').html(res.mes_solicitud);

            }
        });
    }

</script>