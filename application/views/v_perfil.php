<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Perfíl</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>agenda">Inicio</a></li>
                                    <li class="breadcrumb-item active">Perfíl</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-12 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm order-2 order-sm-1">
                                        <div class="d-flex align-items-start mt-3 mt-sm-0">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xl me-3">
                                                    <img id="img_foto" src="public/images/tag/<?php echo $foto;?>" alt="" class="img-fluid rounded-circle d-block">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div>
                                                    <h5 class="font-size-16 mb-1" id="label_nombres"></h5>
                                                    <p class="text-muted font-size-13" id="label_area"></p>

                                                    <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                                        <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i><span id="label_cargo"></span></div>
                                                        <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i><span id="label_correo"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto order-1 order-sm-2">
                                        <div class="d-flex align-items-start justify-content-end gap-2">
                                            <div>
                                                <!--<button type="button" class="btn btn-sm btn-primary"><i class="bx bx-image-add"></i> Cambiar foto de pérfil</button>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link px-3 active" data-bs-toggle="tab" href="#about" role="tab">Datos Personales</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3" data-bs-toggle="tab" href="#foto_perfil" role="tab">Foto Perfíl</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="tab-content">

                            <div class="tab-pane active" id="about" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Sobre mí</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Nombres</label>
                                                    <label id="text_nombres_msj"></label>
                                                    <input type="text" class="form-control form-control-sm" id="text_nombres" placeholder="Nombres Completos" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Apellidos</label>
                                                    <label id="text_apellidos_msj"></label>
                                                    <input type="text" class="form-control form-control-sm" id="text_apellidos" placeholder="Apellidos Completos" required>
                                                </div> 
                                                <div class="mb-3">
                                                    <label class="form-label" for="">DNI</label>
                                                    <label id="text_dni_msj"></label>
                                                    <input type="text" class="form-control form-control-sm"  disabled id="text_dni" placeholder="DNI" required>
                                                </div> 
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Correo</label>
                                                    <label id="text_correo_msj"></label>
                                                    <input type="text" class="form-control form-control-sm" id="text_correo" placeholder="Correo electrónico" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Teléfono/Celular</label>
                                                    <label id="text_celular_msj"></label>
                                                    <input type="text" class="form-control form-control-sm" id="text_celular" placeholder="Telefono o celular" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Fecha de Nacimiento</label>
                                                    <label id="text_fecha_nac_msj"></label>
                                                    <input type="date" class="form-control form-control-sm" id="text_fecha_nac" required>
                                                </div>                                                         
                                            </div>  

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                        <label class="form-label" for="">Departamento</label>
                                                        <label id="text_departamento_msj"></label>
                                                        <select class="form-control form-control-sm" id="text_departamento" >
                                                        </select>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Distrito</label>
                                                    <label id="text_distrito_msj"></label>
                                                    <select class="form-control form-control-sm" id="text_distrito" >
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                        <label class="form-label" for="">Provincia</label>
                                                        <label id="text_provincia_msj"></label>
                                                        <select class="form-control form-control-sm" id="text_provincia" >
                                                        </select>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Dirección</label>
                                                    <label id="text_direccion_msj"></label>
                                                    <input type="text" class="form-control form-control-sm" id="text_direccion" placeholder="Dirección completa" required>
                                                </div> 
                                            </div>  

                                            
                                            <div class="col-md-12 mb-3">
                                                <div class="mb-3">
                                                    <button class="btn btn-sm btn-danger form-control" onclick="grabar();">Grabar cambios</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>

                            <div class="tab-pane" id="foto_perfil" role="tabpanel">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Cambiar foto</h4>
                                                <p class="card-title-desc">
                                                </p>
                                            </div>
                                            <div class="card-body" style="text-align: center;">
                                                <progress id="progressBar_img" value="0" max="100" style="width:100%;"></progress>
                                                <p style="font-size: 10px;" id="loaded_n_total_img"></p>
                                                <div class="dropzone">
                                                        <div class="fallback mt-3">
                                                            <input name="file" type="file" id="file">
                                                        </div>
                                                        <div class="dz-message needsclick">
                                                            <div class="">
                                                                <i class="display-4 text-muted bx bx-cloud-upload"></i>
                                                            </div>
                                                            <h5>Click para subir foto</h5>
                                                        </div>
                                                </div>

                                                <div class="text-center mt-1">
                                                    <button type="button" onclick="subir_foto();" class="btn btn-primary waves-effect waves-light">Cargar Foto</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                            </div>                            

                        </div>
                        <!-- end tab content -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
        
        </div>
    </div>
    
</div>

    <!--Modals-->
    <!-- Static Backdrop Modal -->
    <div class="modal fade" id="modal_editar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Editar el registro</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Descripción</label>
                                <input type="text" class="form-control" id="text_descripcion_upd" placeholder="Tipo de servicio" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="">Tipo de servicio</label>
                                <select class="form-control" id="select_tiposervicio_upd">
                                    <option value="">Seleccione</option>
                                    <?php 
                                        foreach ($lst_tiposervicio as $key) {
                                            echo '
                                                <option value="'.$key->id.'">'.$key->descripcion.'</option>
                                            ' ;
                                        }
                                    ?>                                            
                                </select>
                            </div>
                        </div>                         
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" onclick="actualizar();">Grabar</button>
                </div>
            </div>
        </div>
    </div>
    <!---------->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    var id_upd; 
    var table; 

    let id_departamento;
    let id_distrito;
    let id_provincia;
    $(document).ready(function() {
        cargar_datos();

        id_departamento =0;
        id_distrito     =0;
        id_provincia    =0;
        //id_upd=0; 
        //table.ajax.reload(null,false);   
        //forDataTables('#tb_table','C_perfil/listar_registros'); 
        //table.buttons().container().appendTo('#tb_table_wrapper .col-md-6:eq(0)');
    });


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
            xhr.open('post', '<?php echo base_url();?>C_perfil/subir_foto', true);
            
            var data = new FormData;
            data.append('file', file);
            xhr.send(data);          
    }

    function cargar_datos(){
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?php echo base_url();?>C_perfil/get_datos',
            data: {
            }, 
            beforeSend:function(){
            },   
            success: function(e){ 
                for(var i=0; i < e.length; i++)
                {
                    $('#text_nombres').val(e[i]['nombres']);
                    $('#label_nombres').text(e[i]['nombres']);
                    $('#text_apellidos').val(e[i]['apellidos']);
                    $('#text_dni').val(e[i]['dni']);
                    $('#text_fecha_nac').val(e[i]['f_nac']);
                    $('#text_correo').val(e[i]['correo']);
                    $('#label_correo').text(e[i]['correo']);
                    $('#label_cargo').text(e[i]['puesto']);
                    $('#label_area').text(e[i]['area']);
                    $('#text_celular').val(e[i]['telefono']);
                    id_departamento = e[i]['id_departamento'];
                    id_provincia    = e[i]['id_provincia'];
                    id_distrito     = e[i]['id_distrito'];
                    $('#text_direccion').val(e[i]['direccion']);  
                }
                load_ubigeos('departamento',id_departamento);
                load_ubigeos('provincia',id_departamento);
                load_ubigeos('distrito',id_provincia);
            }
        });
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
                url: '<?php echo base_url();?>C_perfil/grabar',
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