    /********************************************************************************************************/
    /*****************************MODULO ASIGNACION**********************************************************/
        function forDataTables_clientesxdep( id, ruta, targets ) {
        table = $(id).DataTable({
            /*"responsive":true,*/
            "scrollX": true,
            "processing":true,
            "serverSide":true,
            "bPaginate": true,
            "bLengthChange": false,
            "searching": false,            
            "order":[],
            "ajax":{
                url:"<?php echo base_url(); ?>" + ruta,
                type:"POST"
            },
            "columnDefs":[
                {
                    "targets":targets,
                    "orderable":false,
                },
            ],
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
                    "sNext": ">>",
                    "sPrevious": "<<"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    }
    function forDataTables_asignados( id, ruta, targets ) {
        table_asignados = $(id).DataTable({
            /*"responsive":true,*/
            "scrollX": true,
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
                url:"<?php echo base_url(); ?>" + ruta,
                type:"POST"
            },
            "columnDefs":[
                {
                    "targets":targets,
                    "orderable":false,
                },
            ],
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
    /*Ante cualquier cambio del tipo de visita del  view_modulo_asignacion se procede a recargar la grilla clientes
    clientes asignados al departamento*/
    /*Tipos de visita de la base que se subió*/
    function f_mdl_asignacion_tpv(){
        var dato = $('#ftr_tpv').val();
        var tipo = 'tipovisita';
        $.ajax(
        {
            async:true,
            type: "POST",
            dataType:"html",
            cache: false,
            contentType:"application/x-www-form-urlencoded",
            url:"/lindley2020/modulo_asignacion/activate_filter",
            data:{'dato':dato,'tipo':tipo},
            success:function(datos){
                table.ajax.reload( null, false );
                load_mdl_asignacion_map(); 
            },
            error: function(){
            }
        })          
    }
    /*Ante cualquier cambio del tipo de visita del  view_modulo_asignacion se procede a recargar la grilla clientes
    asignados al departamento*/
    /*Distritos de la base que se subió*/
    function f_mdl_asignacion_tpd(){
        /*Generamos la sesión de acuerdo al filtro seleccionado*/
        var dato = $('#ftr_tpd').val();
        var tipo = 'distrito';
        //alert(distrito);
        //return;
        $.ajax(
        {
            async:true,
            type: "POST",
            dataType:"html",
            cache: false,
            contentType:"application/x-www-form-urlencoded",
            url:"/lindley2020/modulo_asignacion/activate_filter",
            data:{'dato':dato,'tipo':tipo},
            success:function(datos){
                table.ajax.reload( null, false ); // user paging is not reset on reload
            },
            error: function(){
            }
        })          
        /**/
        //alert();
        //forDataTables('#tb_asignados','modulo_gestion/listar_asignados',[4,6]);    
    }    
    /********************************************************************************************************/
    /********************************************************************************************************/  