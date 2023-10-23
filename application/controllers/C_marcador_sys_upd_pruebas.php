<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_marcador_sys_upd_pruebas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->model('Mdl_compartido');
        $this->load->model('M_ubigeo');
        $this->load->model('M_settings');
        $this->load->model('M_marcador_sys_upd_pruebas');
        date_default_timezone_set('America/Lima');
    }

    public function index(){
        //$permiso = $this->Mdl_compartido->permisos_controlador('perfil');
        //if (!$permiso)
        //    redirect('');
        
        /*if(!isset($_SESSION['_SESSIONUSER'])){
            redirect('login');
        }*/

        /*
            Para Cabecera
        */
        unset($_SESSION['SESSION_SOL_EMPLEADO']);

        //$header['menu'] = $this->Mdl_compartido->permisos_menu();
        //$header['menu_activo'] = 'perfil';
        //$header['foto'] = $this->Mdl_compartido->retornarcampo($_SESSION['_SESSIONUSER'],'coduser','tb_usuarios','foto');
        //$config = $this->M_settings->get_settings();
        //$header['config'] = $config;
        //$position='horizontal';
        //if($config!='error'){
        //    foreach ($config as $key) {
        //        $position=$key->layout;
        //    }
        //}

        //Jalamos data
        $_SESSION['_SESSION_ID_CUENTA'] = $_GET['address2']; 
        $_SESSION['_SESSION_ID_ANEXO'] = $_GET['user']; 
        $_SESSION['_SESSION_LIST_ID'] = $_GET['list_id']; 
        $_SESSION['_SESSION_LEAD_ID'] = $_GET['lead_id'];
        $_SESSION['_SESSION_LEAD_TELEFONO'] = $_GET['Telefono_gestionado'];

        $_SESSION['_SESSION_LAST_NAME'] = $_GET['last_name'];
         
        if(isset($_GET['control'])){
            $_SESSION['_SESSION_CONTROL_ID'] =1;  
        }else{
            unset($_SESSION['_SESSION_CONTROL_ID']);
        }

        //$vendor_lead_code = $this->Mdl_compartido->retornarcampo($_GET['lead_id'],'lead_id','asterisk.vicidial_list','vendor_lead_code');
        $_SESSION['_SESSION_VENDOR_LEAD_CODE'] = $_GET['address2']; 
        
        $data['x_empresa'] = $this->Mdl_compartido->retornarcampo($_GET['address2'],'id_cuenta','bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901','razon_social');

        //0011I00000pyBmF

        
        /*
            Retiramos los filtros
        */
        
        //$this->retirar_filtros();

        /*
            Para Ubigeo
        */
        
        $data['datos']='';
        $header['datos_header']='';
        $header['lang']='en';
        $this->load->view('layouts/marcador/v_head',$header);
        if($position=='vertical'){
            $this->load->view('layouts/marcador/vertical_menu',$header);
        }else{
            $this->load->view('layouts/marcador/horizontal-menu',$header);
        }
        $this->load->view('marcador_sys_upd_pruebas', $data);
        $this->load->view('layouts/marcador/v_footer');

    }

    public function validar_nuevo_telefono(){
        $telefono = $this->input->post('telefono',true);
        $valida = $this->M_marcador_sys_upd_pruebas->get_existe_phone_number($telefono);
        if($valida>0){
            echo 'error';
        }else{
            echo 'ok';
        }
    }

    public function grabar_nuevo_numero(){
        $dato = $this->input->post('dato',true);
        //$address2 = $this->input->post('address2',true);
        $last_name = $_SESSION['_SESSION_VENDOR_LEAD_CODE'];
        $lista_id = $_SESSION['_SESSION_LIST_ID'];
        //Validamos q no exista registro duplicado del nuevo nro en la lista que se está trabajando
        /*if($dato!=''){
            $resultado = $this->Mdl_campania_msc_en06->existe_nro_nuevo($lista_id,$dato);*/
            /*if($resultado<=0){*/
                $resultado2 = $this->M_marcador_sys_upd_pruebas->get_data_vicidial_list();
                $resultado3=0; 
                foreach ($resultado2 as $key) {
                    $array= array(
                        'status'=>'NEW',
                        'vendor_lead_code'=>$last_name,
                        'list_id'=>$lista_id,
                        'phone_number'=>$dato,
                        'phone_code'=>1,
                        'first_name'=>$key->first_name,
                        'last_name'=>$key->last_name,
                        'state'=>$key->state,
                        'province'=>$key->province,
                        'country_code'=>$key->country_code,
                        'email'=>$key->email,
                        'security_phrase'=>$key->security_phrase,
                        'source_id'=>$key->source_id,
                        'address1'=>$key->address1,
                        'address2'=>$key->address2,
                        'address3'=>$key->address3,
                        'city'=>$key->city,
                        'province'=>$key->province,
                        'date_of_birth'=>$key->date_of_birth,
                        'rank'=>$key->rank+1,
                        'owner'=>'ADD',
                        'entry_list_id'=>$key->entry_list_id
                    );
                    $resultado3 = $this->M_marcador_sys_upd_pruebas->grabar_nuevo_numero($array);
                }
                
                if($resultado3>0){
                    echo '1';
                }else{
                    echo '4'.$last_name.'--'.$lista_id.'---'.$resultado2;
                }
                
            /*}else{
                echo '3';
            }*/
        /*}else{
            echo '2';
        }*/

    }



    function actualizar_base_no_no(){
        //$fecha_solicitud     = trim($this->input->post('txt_fecha_sol',true));
        $id                     = trim($this->input->post('id',true));
        $si_si                     = trim($this->input->post('si_si',true));

        $array = array(
            'upd_razon_social'  => $this->input->post('id',true),
            'f_upd'             =>  date('Y-m-d H:i:s'),
            'user_upd'          => $_SESSION['_SESSION_ID_ANEXO'],
            'select_upd_nombre' => trim($this->input->post('dato_valida_nombre',true)),
            'upd_nombre' => trim($this->input->post('dato_input_nombre',true)),
            'select_upd_apellido' => trim($this->input->post('dato_valida_apellido',true)),
            'upd_apellido' => trim($this->input->post('dato_input_apellido',true)),
            'id_subrespuesta' => null,
            'f_programada' => null,
            'hora_desde' => null,
            'hora_hasta' => null,
            'select_upd_correo' => null,
            'upd_correo' => null,
            'id_departamento' => null,
            'upd_razon_social' => null,
            'upd_ruc' => null,
            'id_subrespuesta2' => 2,
            'id_respuesta'=>2,
            'upd'=>1
        );
        $result = $this->M_marcador_sys_upd_pruebas->update('bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901',$array,$id,'id');
        echo $result;
    }

    function actualizar_base_no_si(){
        //$fecha_solicitud     = trim($this->input->post('txt_fecha_sol',true));
        $id                     = trim($this->input->post('id',true));
        $si_si                     = trim($this->input->post('si_si',true));

        $array = array(
            'upd_razon_social'  => $this->input->post('id',true),
            'f_upd'             =>  date('Y-m-d H:i:s'),
            'user_upd'          => $_SESSION['_SESSION_ID_ANEXO'],
            'select_upd_nombre' => trim($this->input->post('dato_valida_nombre',true)),
            'upd_nombre' => trim($this->input->post('dato_input_nombre',true)),
            'select_upd_apellido' => trim($this->input->post('dato_valida_apellido',true)),
            'upd_apellido' => trim($this->input->post('dato_input_apellido',true)),
            'id_subrespuesta' => trim($this->input->post('dato_acepta_subrespuesta',true)),
            'f_programada' => trim($this->input->post('dato_dia_progra',true)),
            'hora_desde' => trim($this->input->post('dato_hora_desde_progra',true)),
            'hora_hasta' => trim($this->input->post('dato_hora_hasta_progra',true)),
            'select_upd_correo' => trim($this->input->post('dato_valida_correo',true)),
            'upd_correo' => trim($this->input->post('dato_input_correo',true)),
            'id_departamento' => trim($this->input->post('dato_valida_departamento',true)),
            'upd_razon_social' => trim($this->input->post('dato_razon_social',true)),
            'upd_ruc' => trim($this->input->post('dato_ruc',true)),
            'id_subrespuesta2' => trim($this->input->post('dato_acepta_subrespuesta2',true)),
            'upd_razon_social' => trim($this->input->post('dato_razon_social',true)),
            'upd_ruc' => trim($this->input->post('dato_ruc',true)),
            'id_respuesta'=>2,
            'upd'=>1
        );
        $result = $this->M_marcador_sys_upd_pruebas->update('bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901',$array,$id,'id');
        echo $result;
    }

    function actualizar_base_si_si(){
        //$fecha_solicitud     = trim($this->input->post('txt_fecha_sol',true));
        $id                     = trim($this->input->post('id',true));
        $si_si                     = trim($this->input->post('si_si',true));

        $array = array(
            'upd_razon_social'  => $this->input->post('id',true),
            'f_upd'             =>  date('Y-m-d H:i:s'),
            'user_upd'          => $_SESSION['_SESSION_ID_ANEXO'],
            'select_upd_nombre' => trim($this->input->post('dato_valida_nombre',true)),
            'upd_nombre' => trim($this->input->post('dato_input_nombre',true)),
            'select_upd_apellido' => trim($this->input->post('dato_valida_apellido',true)),
            'upd_apellido' => trim($this->input->post('dato_input_apellido',true)),
            'id_subrespuesta' => trim($this->input->post('dato_acepta_subrespuesta',true)),
            'f_programada' => trim($this->input->post('dato_dia_progra',true)),
            'hora_desde' => trim($this->input->post('dato_hora_desde_progra',true)),
            'hora_hasta' => trim($this->input->post('dato_hora_hasta_progra',true)),
            'select_upd_correo' => trim($this->input->post('dato_valida_correo',true)),
            'upd_correo' => trim($this->input->post('dato_input_correo',true)),
            'id_departamento' => trim($this->input->post('dato_valida_departamento',true)),
            'id_subrespuesta2' => null,
            'upd_razon_social' => null,
            'upd_ruc' => null,
            'id_respuesta'=>1,
            'upd'=>1
        );
        $result = $this->M_marcador_sys_upd_pruebas->update('bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901',$array,$id,'id');
        echo $result;
    }

    function actualizar(){
        //$fecha_solicitud     = trim($this->input->post('txt_fecha_sol',true));
        $id                     = trim($this->input->post('id',true));
        $txt_razon_socual_upd_  =trim($this->input->post('txt_razon_socual_upd_',true));
        $txt_ruc_upd_           =trim($this->input->post('txt_ruc_upd_',true));
        $txt_nombre_sol_        =trim($this->input->post('txt_nombre_sol_',true));
        $txt_apellidos_sol_     =trim($this->input->post('txt_apellidos_sol_',true));
        $txt_celular_upd_       =trim($this->input->post('txt_celular_upd_',true));
        $txt_telefono_upd_      =trim($this->input->post('txt_telefono_upd_',true));
        $txt_correo_upd_        =trim($this->input->post('txt_correo_upd_',true));
        $text_comentario_upd_   =trim($this->input->post('text_comentario_upd_',true));
        
        //Actualización
        $select_respuesta_          =trim($this->input->post('select_respuesta_',true));
        $select_sub_respuesta_      =trim($this->input->post('select_sub_respuesta_',true));
        $select_sub_respuesta2_      =trim($this->input->post('select_sub_respuesta2_',true));
        $txt_dia_progra_            =trim($this->input->post('txt_dia_progra_',true));
        $txt_hora_desde_progra_     =trim($this->input->post('txt_hora_desde_progra_',true));
        $txt_hora_hasta_progra_     =trim($this->input->post('txt_hora_hasta_progra_',true));

        $text_comentario_upd_   =trim($this->input->post('text_comentario_upd_',true));

        //Departamento
        $select_departamento_   =trim($this->input->post('select_departamento_',true));


        $f_upd               = date('Y-m-d H:i:s');

        $array = array(
            'upd_razon_social'          => $txt_razon_socual_upd_,
            'user_upd'          => $txt_ruc_upd_,
            'upd_nombre'          => $txt_nombre_sol_,
            'upd_apellido'     => $txt_apellidos_sol_,
            'upd_celular'=>$txt_celular_upd_,
            'upd_telefono' => $txt_telefono_upd_,
            'upd_correo'  => $txt_correo_upd_,
            'comentario'    => $text_comentario_upd_,
            'f_upd'             => $f_upd,
            'user_upd'          => $_SESSION['_SESSIONUSER'],

            //Actualización de programación
            'id_respuesta' => $select_respuesta_,
            'id_subrespuesta' => $select_sub_respuesta_,
            'id_subrespuesta2' => $select_sub_respuesta2_,
            'f_programada' => $txt_dia_progra_,
            'hora_desde' => $txt_hora_desde_progra_,
            'hora_hasta' => $txt_hora_hasta_progra_,

            //Departamento
            'id_departamento'=> $select_departamento_
        );

        //Insertamos en el log
        /*$array_log = array(
            'id_sol'          => $id,
            'id_cargo'          => $id_cargo,
            'id_area'          => $id_area,
            'resumen_breve'     => $resumen,
            'id_estado_solicitud'=>$id_estado_solicitud,
            'nro_seleccionados' => $seleccionados,
            'id_tipo_contrato'  => $id_contrato,
            'minimo_salario'    => $minimo,
            'maximo_salario'    => $maximo,
            'id_tipo_moneda'    => $id_tipo_moneda,
            'id_frecuencia'     => $id_frecuencia,
            'f_upd'             => $f_upd,
            'user_upd'          => $_SESSION['_SESSIONUSER']
        );*/

        $result = $this->M_marcador_sys_upd_pruebas->update('bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901',$array,$id,'id');
        //$this->M_marcador_sys_upd_pruebas->insert('solicitud_log',$array_log);
        echo $result;
    }

    function armar_selects($arr,$id_registro,$id_registro2,$campo,$tipo){
        if($tipo!=''){
            $cadena='<option value=""> '.$tipo.' </option>';
        }else{
            $cadena='<option value=""> Seleccione </option>';
        }
        foreach ($arr as $key) {
            if($key->id==$id_registro){
                $cadena.='<option selected value="'.$key->id.'">'.$key->descripcion.'</option>';            
            }else{
                if($campo!='0'){
                    if($key->$campo==$id_registro2){
                        $cadena.='<option  value="'.$key->id.'">'.$key->descripcion.'</option>';
                    }
                }else{
                    $cadena.='<option  value="'.$key->id.'">'.$key->descripcion.'</option>';
                }

            }
        }
        return $cadena; 
    }

    function set_border_left($id_estado){
        $cd = '';
        switch ($id_estado) {
            case 0:
                $cd = 'style="border-left: 3px solid #00bcd4;" '; 
                break;

            case 1:
                $cd = ' style="border-left: 3px solid #4caf50;" '; 
                break;
            case 2:
                $cd = ' style="border-left: 3px solid #efc400;" '; 
                break;
            case 3:
                $cd = ' style="border-left: 3px solid #00bcd4;" ';                 
                break;       
            case 4:
                $cd = ' style="border-left: 3px solid red;" ';                 
                break;                                
            default:
                break;
        }
        return $cd;
    }

    function set_bg($id_estado){
        $cd = '';
        switch ($id_estado) {
            case 1:
                $cd = ' bg-soft-success'; 
                break;
            case 2:
                $cd = ' bg-soft-warning'; 
                break;
            case 3:
                $cd = ' bg-soft-info';                 
                break;       
            case 4:
                $cd = ' bg-soft-danger';                 
                break;                                
            default:
                break;
        }
        return $cd;
    }

    function get_registros(){

        //De acuerdo a la sesión
        $id_cuenta = $_SESSION['_SESSION_ID_CUENTA']; 
        /*Para Páginación*/
        $limite     = 1;
        /*Donde te ubicas*/
        $ubica      = 0; 
        //(session_paginacion___-1)*2 
        if(isset($_SESSION['SESSION_SOL_PAG'])){
            $paginacion = ($_SESSION['SESSION_SOL_PAG']-1)*$limite; 
            $ubica = $_SESSION['SESSION_SOL_PAG']; 
        }else{
            $paginacion=0;     
        }
        

        //Armamos la paginación 
        $result_pag = $this->M_marcador_sys_upd_pruebas->get_total_registros_pag('bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901',$id_cuenta);
        
        //Dividimos entre el limite
        $total_bot = ceil($result_pag/$limite); 

        $cad_bot_pag=''; 
        $tipo_filtro = "'"."paginacion"."'";
        for ($i=0; $i <$total_bot ; $i++) { 
            $t = $i+1; 
            //ubica
            if($ubica==$t){
                $cad_bot_pag .= '<button type="button" class="btn btn-danger" onclick="activar_filtro('.$tipo_filtro.','.$t.');">'.$t.'</button>'; 
            }else{
                $cad_bot_pag .= '<button type="button" class="btn btn-secondary" onclick="activar_filtro('.$tipo_filtro.','.$t.');">'.$t.'</button>'; 
            }
        }
        $ar['paginacion'] = $cad_bot_pag; 
        $ar['total_botones'] = $total_bot; 
        $ar['total_items'] = $result_pag; 
        $ar['nro_limite'] = $limite; 
        $ar['nro_paginacion'] = $paginacion; 

        //Obtenemos los datos para el select
        $result     = $this->M_marcador_sys_upd_pruebas->get_registros('bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901',$limite,$paginacion,$id_cuenta);

        //$r_estado_solicitud = $this->M_marcador_sys_upd_pruebas->get_select('tb_estado_solicitud');
        //$r_tipo_contrato    = $this->M_marcador_sys_upd_pruebas->get_select('tipo_contrato');
        //$r_tipo_moneda     = $this->M_marcador_sys_upd_pruebas->get_select('tipo_moneda');
        //$r_tipo_frecuencia  = $this->M_marcador_sys_upd_pruebas->get_select('tipo_frecuencia');

        $r_respuesta  = $this->M_marcador_sys_upd_pruebas->get_select('bd_casuisticas_campania.actualizacion_respuesta');
        $r_sub_respuesta  = $this->M_marcador_sys_upd_pruebas->get_select('bd_casuisticas_campania.actualizacion_respuesta');
        $r_sub_respuesta2  = $this->M_marcador_sys_upd_pruebas->get_select('bd_casuisticas_campania.actualizacion_respuesta');
        $r_departamento  = $this->M_marcador_sys_upd_pruebas->get_select('bd_casuisticas_campania.tb_departamentos');
        $r_hora_inicio  = $this->M_marcador_sys_upd_pruebas->get_select('bd_casuisticas_campania.actualizacion_respuesta_hora');
        $r_valida_correo  = $this->M_marcador_sys_upd_pruebas->get_select('bd_casuisticas_campania.actualizacion_respuesta_correo');
        $r_valida_nombre  = $this->M_marcador_sys_upd_pruebas->get_select('bd_casuisticas_campania.actualizacion_respuesta_nombre');
        //$r_cargo  = $this->M_marcador_sys_upd_pruebas->get_select('cargo');

        //Paneles
        $panel_actualizacion_nombres_='none';
        $panel_si_pertenece_='none';
        $panel_programacion_='none';
        $panel_actualizacion_correo_='none';
        $panel_departamento_='none';
        $panel_despedida_si_si='none';
        $panel_si_pertenece_no_acepta_='none';
        $panel_despedida_si_no='none';
        $panel_no_pertenece_='none';
        $panel_no_pertenece_si_acepta_='none';
        $panel_no_pertenece_no_acepta_='none';
        
        $resultados =0; 
        $cadena='';
        if($result!='error'){
            foreach ($result as $key) {
                //Activación de paneles
                if($key->id_respuesta==1 && $key->id_subrespuesta==1){
                    $panel_actualizacion_nombres_='block';
                    $panel_si_pertenece_='block';
                    $panel_programacion_='block';
                    $panel_actualizacion_correo_='block';
                    $panel_si_pertenece_no_acepta_='none';
                    $panel_departamento_='block';
                    $panel_despedida_si_no='none';
                    $panel_despedida_si_si='block';
                }else if($key->id_respuesta==1 && $key->id_subrespuesta==2){
                    $panel_actualizacion_nombres_='block';
                    $panel_si_pertenece_='block';
                    $panel_programacion_='none';
                    $panel_actualizacion_correo_='block';
                    $panel_departamento_='none';
                    $panel_despedida_si_no='block';
                    $panel_despedida_si_si='none';
                    $panel_si_pertenece_no_acepta_='block';

                }else if($key->id_respuesta==2 && $key->id_subrespuesta2==1){
                    $panel_actualizacion_nombres_='block';
                    $panel_no_pertenece_='block';
                    $panel_no_pertenece_si_acepta_='block';
                    $panel_programacion_='block';
                    $panel_actualizacion_correo_='block';
                    $panel_departamento_='block';
                    $panel_despedida_si_no='block';
                    $panel_despedida_si_si='none';
                    $panel_si_pertenece_no_acepta_='none';

                }else if($key->id_respuesta==2 && $key->id_subrespuesta2==2){
                    $panel_actualizacion_nombres_='block';
                    $panel_no_pertenece_='block';
                    $panel_no_pertenece_si_acepta_='none';
                    $panel_programacion_='none';
                    $panel_actualizacion_correo_='none';
                    $panel_departamento_='none';
                    $panel_despedida_si_no='none';
                    $panel_despedida_si_si='none';
                    $panel_si_pertenece_no_acepta_='none';
                    $panel_no_pertenece_no_acepta_='block';
                }else{

                }


                $resultados++; 
                $color      = $this->set_border_left($key->insert);
                //$bg      = $this->set_bg(3);
                $select_respuesta   = $this->armar_selects($r_respuesta,$key->id_respuesta,0,'0','');
                $select_sub_respuesta   = $this->armar_selects($r_respuesta,$key->id_subrespuesta,0,'0','');
                $select_sub_respuesta2   = $this->armar_selects($r_respuesta,$key->id_subrespuesta2,0,'0','');
                $select_departamento   = $this->armar_selects($r_departamento,$key->id_departamento,0,'0','');
                $select_hora_desde   = $this->armar_selects($r_hora_inicio,$key->hora_desde,0,'0','');
                $select_hora_hasta   = $this->armar_selects($r_hora_inicio,$key->hora_hasta,0,'0','');

                $select_valida_correo   = $this->armar_selects($r_valida_correo,$key->select_upd_correo,0,'0','¿Es correcto el correo ?');
                $select_valida_nombre   = $this->armar_selects($r_valida_nombre,$key->select_upd_nombre,0,'0','¿Es correcto nombre ?');
                $select_valida_apellido   = $this->armar_selects($r_valida_nombre,$key->select_upd_apellido,0,'0','¿Es correcto el apellido ?');


                

                //$sel_cargo   = $this->armar_selects($r_cargo,$key->id_cargo,$key->id_area,'id_area');
                //$sel_contrato   = $this->armar_selects($r_tipo_contrato,$key->id_tipo_contrato,0,'0');
                //$sel_frecuencia = $this->armar_selects($r_tipo_frecuencia,$key->id_frecuencia,0,'0');
                //$sel_estado_solicitud = $this->armar_selects($r_estado_solicitud,$key->id_estado_solicitud,0,'0');
                
                //activadores de disables
                $dis_apellido = ''; 
                if($key->select_upd_apellido==1){
                    $dis_apellido = 'disabled'; 
                }

                $dis_nombres = ''; 
                if($key->select_upd_nombre==1){
                    $dis_nombres = 'disabled'; 
                }

                $dis_correo = 'disabled'; 
                if($key->select_upd_correo==2){
                    $dis_correo = ''; 
                }


                $cadena.='
                <div class="card p-2" '.$color.'>
                    <div class="card-body">
                        <div>
                            <div class="py-3">
                                <div class="row align-items-center">

                                    <div class="col-lg-2">
                                        <div class="row">
                                            <!--SPEACH PRINCIPAL-->
                                            <div class="col-md-12 mt-2">
                                                <p>
                                                    Buenos días/tardes me comunico con <strong>'.$key->nombre_completo.'</strong> de la empresa <strong>'.$key->razon_social.'</strong>?</p>
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                <h5 class="font-size-14">¿Pertenece a la Empresa?</h5>
                                            </div>
                                            <div class="col-md-12 ">
                                                <div>
                                                    <select class="form-control form-control-sm" id="select_respuesta_'.$key->id.'" onchange="activar_panel('."'solicitud',".$key->id.','."'select_respuesta_'".')">
                                                        '.$select_respuesta.'
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div id="panel_detalle_'.$key->id.'" style="display:block">
                                            
                                            <!--ACTUALIZACIÓN DE NOMBRES Y APELLIDOS-->
                                            <div class="row" id="panel_actualizacion_nombres_'.$key->id.'" style="display:'.$panel_actualizacion_nombres_.';">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="font-size-13">Nombres: </h5>
                                                        <div style="display:flex;">
                                                            <input style="margin-left:3px;" type="text" class="form-control form-control-sm" disabled id=""  value="'.$key->nombre.'" >
                                                            <select style="margin-left:3px;background:#ffffdb;" class="form-control form-control-sm" id="select_habilita_nombre_'.$key->id.'" onchange="activar_validador('."'activador'".",'select_habilita_nombre_',".$key->id.','."'txt_nombre_sol_'".')">
                                                            '.$select_valida_nombre.'
                                                            </select>
                                                            <input style="margin-left:3px;" type="text" class="form-control form-control-sm" '.$dis_nombres.' id="txt_nombre_sol_'.$key->id.'"  value="'.$key->upd_nombre.'" >
                                                        </div>
                                                    </div>
                                                    
                                                    

                                                    <div class="col-md-12">
                                                        <h5 class="font-size-13">Apellidos: </h5>
                                                        <div style="display:flex;">
                                                            <input style="margin-left:3px;" type="text" class="form-control form-control-sm"  disabled id=""  value="'.$key->apellidos.'">
                                                            <select style="margin-left:3px;background:#ffffdb;" class="form-control form-control-sm" id="select_habilita_apellido_'.$key->id.'" onchange="activar_validador('."'activador'".",'select_habilita_apellido_',".$key->id.','."'txt_apellidos_sol_'".')">
                                                            '.$select_valida_apellido.'
                                                            </select>
                                                            <input  style="margin-left:3px;" type="text" class="form-control form-control-sm" '.$dis_apellido.' id="txt_apellidos_sol_'.$key->id.'"  value="'.$key->upd_apellido.'">
                                                        </div>
                                                    </div>                                                
                                                </div>
                                            </div>   

                                            <!--SI PERTENECE-->
                                            <div class="row mt-4" id="panel_si_pertenece_'.$key->id.'" style="display:'.$panel_si_pertenece_.';">
                                                <p>
                                                    Estamos llamando de la empresa IPESA representantes de John Deere, ya que nos gustaría comunicarlo con uno de nuestros asesores y así puedan brindarle información sobre nuestros productos como cargador frontal, retroexcavadora, minicargador, promociones y más.
                                                </p>
                                                <div class="col-md-4">
                                                    <div>
                                                        <h5 class="font-size-13">Respuesta </h5>
                                                        <select class="form-control form-control-sm" id="select_sub_respuesta_'.$key->id.'" onchange="activar_panel('."'programacion',".$key->id.','."'select_sub_respuesta_'".')">
                                                        '.$select_sub_respuesta.'
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--PANEL SI PERTENECE PERO NO ACEPTA-->
                                            <div class="row mt-4" id="panel_si_pertenece_no_acepta_'.$key->id.'" style="display:'.$panel_si_pertenece_no_acepta_.';">
                                                <div class="col-md-12">
                                                    <p>
                                                    Le agradecería me confirme su correo electrónico para enviarle novedades sobre nuestros productos. 
                                                    </p>
                                                </div>
                                            </div>

                                            <!--NO PERTENECE-->

                                            <div class="row mt-4" id="panel_no_pertenece_'.$key->id.'" style="display:'.$panel_no_pertenece_.';">
                                                <p>
                                                    En ese caso estaría interesado que le brindemos información sobre nuestros equipos de construcción como cargador frontal, retroexcavadora, minicargador, ¿promociones y más?
                                                </p>

                                               
                                                <div class="col-md-4">
                                                    <div>
                                                        <h5 class="font-size-13">Respuesta </h5>
                                                        <select class="form-control form-control-sm" id="select_sub_respuesta2_'.$key->id.'" onchange="activar_panel('."'programacion2',".$key->id.','."'select_sub_respuesta2_'".')">
                                                        '.$select_sub_respuesta2.'
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--NO PERTENECE PERO NO ACEPTA BRINDAR RUC RAZON SOCIAL,ETC-->
                                            <div class="row mt-4" id="panel_no_pertenece_si_acepta_'.$key->id.'" style="display:'.$panel_no_pertenece_si_acepta_.';">
                                                <div class="col-md-12">
                                                    <p>
                                                        ¿Perfecto, me brinda el RUC o razón social de la empresa donde trabaja actualmente? 
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="font-size-13">Razón Social: </h5>
                                                        <input type="text" class="form-control form-control-sm" disabled id=""  value="'.$key->razon_social.'" >
                                                        <input type="text" class="form-control form-control-sm" id="txt_razon_socual_upd_'.$key->id.'"  value="'.$key->upd_razon_social.'" >
                                                    </div>

                                                    <div class="col-md-6">
                                                        <h5 class="font-size-13">RUC: </h5>
                                                        <input type="text" class="form-control form-control-sm" disabled id=""  value="'.$key->ruc_dni.'" >
                                                        <input type="text" class="form-control form-control-sm" id="txt_ruc_upd_'.$key->id.'"  value="'.$key->upd_ruc.'" >
                                                    </div>                                                    
                                                </div>
                                            </div>


                                            <!--PROGRAMACIÓN-->
                                            <div class="row mt-4" id="panel_programacion_'.$key->id.'" style="display:'.$panel_programacion_.';">
                                                <div class="col-md-12">
                                                    <p>
                                                        ¿Me indicaría cuando y en que horario nuestro asesor puede comunicarse con usted?
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div>
                                                            <h5 class="font-size-13">Día </h5>
                                                            <input type="date" min="'.date('Y-m-d').'" class="form-control form-control-sm" id="txt_dia_progra_'.$key->id.'"  value="'.$key->f_programada.'" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div>
                                                            <h5 class="font-size-13">Hora Desde </h5>
                                                            <select class="form-control form-control-sm" id="txt_hora_desde_progra_'.$key->id.'">
                                                            '.$select_hora_desde.'
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div>
                                                            <h5 class="font-size-13">Hora Hasta </h5>
                                                            <select class="form-control form-control-sm" id="txt_hora_hasta_progra_'.$key->id.'">
                                                            '.$select_hora_hasta.'
                                                            </select>
                                                        </div>
                                                    </div>  
                                                </div>
                                            </div>


                                            <div class="row mt-4" id="panel_actualizacion_correo_'.$key->id.'" style="display:'.$panel_actualizacion_correo_.';">
                                                <div class="col-md-12" >
                                                    <p>
                                                        Me confirma su correo por favor.. 
                                                    </p>
                                                </div>
                                                <div class="col-md-12">
                                                    <h5  class="font-size-13">Correo: </h5>
                                                    <div style="display:flex;">
                                                        <input style="margin-left:3px;" type="text" class="form-control form-control-sm"  disabled id=""  value="'.$key->e_mail.'">
                                                        <select style="margin-left:3px;background:#ffffdb;" class="form-control form-control-sm" id="select_habilita_correo_'.$key->id.'" onchange="activar_validador('."'activador'".",'select_habilita_correo_',".$key->id.','."'txt_correo_upd_'".')">
                                                        '.$select_valida_correo.'
                                                        </select>
                                                        <input style="margin-left:3px;" type="text" class="form-control form-control-sm" '.$dis_correo.' id="txt_correo_upd_'.$key->id.'"  value="'.$key->upd_correo.'">
                                                    </div>
                                                </div>
                                            </div>


                                            <!--SELECCION DE DEPARTAMENTO-->
                                            <div class="row mt-4" id="panel_departamento_'.$key->id.'" style="display:'.$panel_departamento_.';">
                                                <div class="col-md-12">
                                                    <p>¿En qué departamento se encuentra usted?</p>
                                                </div>
                                                <div>
                                                    <h5 class="font-size-13">Seleccione departamento </h5>
                                                    <select class="form-control form-control-sm" id="select_departamento_'.$key->id.'">
                                                    '.$select_departamento.'
                                                    </select>
                                                </div>

                                            </div>


                                            <div class="row mt-4" style="display:none;">


                                                <div class="col-md-2">
                                                    <div>
                                                        <h5 class="font-size-13">Celular: </h5>
                                                        <input type="text" class="form-control form-control-sm"  disabled id=""  value="'.$key->numero_celular.'">
                                                        <input type="text" class="form-control form-control-sm"  id="txt_celular_upd_'.$key->id.'"  value="'.$key->upd_celular.'">
                                                    </div>
                                                </div>                                                

                                                <div class="col-md-2">
                                                    <div>
                                                        <h5 class="font-size-13">Telefono: </h5>
                                                        <input type="text" class="form-control form-control-sm"  disabled id=""  value="'.$key->telefono_fijo.'">
                                                        <input type="text" class="form-control form-control-sm"  id="txt_telefono_upd_'.$key->id.'"  value="'.$key->upd_telefono.'">
                                                    </div>
                                                </div>                                                
                                            </div>

                                            <!--PANEL DESPEDIDA SI PERTENECE NO ACEPTA-->
                                            <div class="row mt-4" id="panel_despedida_si_no'.$key->id.'" style="display:'.$panel_despedida_si_no.';">
                                                <div class="col-md-12">
                                                    <p>Muchas gracias, hasta luego.</p>
                                                </div>
                                            </div>


                                            <!--PANEL DESPEDIDA SI PERTENECE SI ACEPTA-->
                                            <div class="row mt-4" id="panel_despedida_si_si'.$key->id.'" style="display:'.$panel_despedida_si_si.';">
                                                <div class="col-md-12">
                                                    <p>¡Perfecto! El día …. A las …. Se estarán comunicando con usted, agradezco su tiempo brindado, Muchas gracias Hasta luego.</p>

                                                </div>
                                            </div>  

                                            <!--NO PERTENECE PERO NO ACEPTA BRINDAR RUC RAZON SOCIAL,ETC-->
                                            <div class="row mt-4" id="panel_no_pertenece_no_acepta_'.$key->id.'" style="display:'.$panel_no_pertenece_no_acepta_.';">
                                                <div class="col-md-12">
                                                    <p>Comprendemos, le agradezco su tiempo brindado, hasta pronto.</p>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-lg-2 col-center">
                                        <button style="display:none;" id="btn_regresar_'.$key->id.'" class="btn btn-sm btn-secondary waves-effect waves-light mb-1 form-control"  onclick="regresar('.$key->id.');"> <i class="mdi mdi-keyboard-backspace"></i> Regresar</button>
                                        <button id="btn_actualizar_'.$key->id.'" class="btn btn-sm btn-info waves-effect waves-light mb-1 form-control"  onclick="actualizar_mejorado('.$key->id.');"> <i class="mdi mdi-square-edit-outline"></i> Actualizar</button>
                                        <!--<button class="btn btn-sm btn-danger waves-effect waves-light mb-1  form-control" onclick="eliminar('."'".'solicitud'."',".$key->id.',0);"><i class="mdi mdi-trash-can"></i> Eliminar</button>-->';
                                        
                                        if(isset($_SESSION['_SESSION_CONTROL_ID'])){
                                            $cadena.='    <button class="btn btn-sm btn-danger waves-effect waves-light mb-1  form-control" onclick="limpiar_formulario('."'".'solicitud'."',".$key->id.',0);"><i class="mdi mdi-trash-can"></i> Limpiar</button>';
                                        }


                        $cadena.='  </div>

                                </div>
                            </div>
                        </div>                                
                    </div>
                </div>                   
                
                ';
            }

            //Viendo total de resultados
            $ar['viendo'] = 'Viendo '.$resultados.' de '.$result_pag.' resultados';
            
        }else{
            $cadena.='
                <div class="card p-2">
                    <div class="card-body">
                        <label>No encontraron resultados en el filtro aplicado.</label>
                    </div>
                </div>
            ';
        }
        $ar['registros'] = $cadena; 
        //echo $cadena; 
        echo json_encode($ar);
    }

    function insert(){
        //$id_usuario          = $_SESSION['_SESSIONUSER']; 
        $f_registro          = date('Y-m-d H:i:s');
        $array = array(
            'user_insert'   => $_SESSION['_SESSION_ID_ANEXO'],
            'f_registro'    => $f_registro,
            'del'           => 0,
            'insert'           => 1,
            'id_cuenta'     => $_SESSION['_SESSION_ID_CUENTA']
        );
        $result = $this->M_marcador_sys_upd_pruebas->insert('bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901',$array);
        
        //unset($_SESSION['SESSION_SOL_EMPLEADO']);
        $_SESSION['SESSION_SOL_EMPLEADO']=$result;

        echo $result;
    }

    function insert_registros(){
        $tipo       = trim($this->input->post('tipo',true));
        $id_sol       = trim($this->input->post('id',true));
        $des       = trim($this->input->post('des',true));

        switch ($tipo) {
            case 'responsabilidad':
                $array = array(
                    'descripcion'            => $des,
                    'id_solicitud'          => $id_sol
                );
                $result = $this->M_marcador_sys_upd_pruebas->insert('responsabilidades',$array);
                break;
            case 'requerimiento':
                $array = array(
                    'descripcion'            => $des,
                    'id_solicitud'          => $id_sol
                );
                $result = $this->M_marcador_sys_upd_pruebas->insert('requerimientos',$array);
                break;                
            default:
                break;
        }
        echo $result;
    }

    /*Obtener datos de select según el id seleccionado*/
    function get_datos_select_x_id(){
        $tipo       = trim($this->input->post('tipo',true));
        $id_sol       = trim($this->input->post('id_sol',true));
        $id_seleccion       = trim($this->input->post('id_seleccion',true));
        $table=''; 
        switch ($tipo) {
            case 'cargos':
                $table='cargo';
                break;
            default:
                break;
        }

        $result    = $this->M_marcador_sys_upd_pruebas->get_select_x_id($table,$id_seleccion,'id_area');

        $cadena='<option value="">Seleccione</option>'; 
        if($result!='error'){
            foreach ($result as $key) {
                $cadena.='
                <option value="'.$key->id.'">'.$key->descripcion.'</option>
                '; 
            }
        }else{
            $cadena= '<option value="">Sin registros</option>';
        }
        echo $cadena;
    }

    function get_registros_adicional(){
        $tipo       = trim($this->input->post('tipo',true));
        $id_sol       = trim($this->input->post('id_sol',true));
        $table=''; 
        switch ($tipo) {
            case 'requerimiento':
                $table='requerimientos';
                break;
            case 'responsabilidad':
                $table='responsabilidades';
                break;
            default:
                break;
        }

        $result    = $this->M_marcador_sys_upd_pruebas->get_select_x_id($table,$id_sol,'id_solicitud');

        $cadena=''; 
        if($result!='error'){
            foreach ($result as $key) {
                $cadena.='
                    <div class="d-flex bd-highlight align-items-center mb-2">
                        <p class="card-title-desc me-auto bd-highlight"> • '.$key->descripcion.'</p>
                        <button class="btn btn-sm btn-danger btn-rounded bd-highlight m-1" onclick="eliminar('."'".$tipo."'".','.$key->id_solicitud.','.$key->id.')"><i class="mdi mdi-close"></i></button>
                    </div>                
                '; 
            }
        }else{
            $cadena= 'sin registros';
        }
        echo $cadena;
    }

    function limpiar_formulario(){
        $tipo       = trim($this->input->post('tipo',true));
        $id_reg       = trim($this->input->post('id_reg',true));
        $id_sol       = trim($this->input->post('id_sol',true));
        
        $table=''; 
        switch ($tipo) {
            case 'solicitud':
                $table='bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901';
                $array = array(
                    'del'       => 0,
                    'f_del'     => date('Y-m-d H:i:s'),
                    'user_del'  => $_SESSION['_SESSION_ID_ANEXO'],
                    'hora_hasta'=>null,
                    'hora_desde'=>null,
                    'f_programada'=>null,
                    'upd_razon_social'=>null,
                    'upd_ruc'=>null,
                    'id_departamento'=>null,
                    'upd_correo'=>null,
                    'select_upd_correo'=>null,
                    'upd_apellido'=>null,
                    'select_upd_apellido'=>null,
                    'upd_nombre'=>null,
                    'select_upd_nombre'=>null,
                    'upd'=>3,
                    'f_upd'=>date('Y-m-d H:i:s'),
                    'user_upd'=> $_SESSION['_SESSION_ID_ANEXO'],
                    'id_subrespuesta2'=>null,
                    'id_subrespuesta'=>null,
                    'id_respuesta'=>null,
                );
                $result = $this->M_marcador_sys_upd_pruebas->update($table,$array,$id_sol,'id');
                break;                            
            default:
                break;
        }

        echo $result;
    }

    function eliminar(){
        $tipo       = trim($this->input->post('tipo',true));
        $id_reg       = trim($this->input->post('id_reg',true));
        $id_sol       = trim($this->input->post('id_sol',true));
        
        $table=''; 
        switch ($tipo) {
            case 'requerimiento':
                $table='requerimientos';
                $result    = $this->M_marcador_sys_upd_pruebas->eliminar($table,$id_reg);
                break;
            case 'responsabilidad':
                $table='responsabilidades';
                $result    = $this->M_marcador_sys_upd_pruebas->eliminar($table,$id_reg);
                break; 
            case 'solicitud':
                $table='bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901';
                $array = array(
                    'del'       => 1,
                    'f_del'     => date('Y-m-d H:i:s'),
                    'user_del'  => 1111
                );
                $result = $this->M_marcador_sys_upd_pruebas->update($table,$array,$id_sol,'id');
                break;                            
            default:
                break;
        }

        echo $result;
    }
    
    public function subir_foto(){
        $id = $_SESSION['_SESSIONUSER'];
        $valida='';
        $config=[
            'upload_path'=>"./public/images/tag",
            'allowed_types'=>'png|jpg|jpeg',
            'file_name'=> ''.$id.'_'
        ];
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')){
            $data=array("upload_data"=>$this->upload->data());
            $nombre=$data['upload_data']['file_name'];
            $array = array(
                'foto'=>$nombre
            );
            $res = $this->M_marcador_sys_upd_pruebas->update('tb_usuarios',$array,$id);
            if($res){
                    $valida='si';
            }else{
                    $valida='no';
            }         
        }else{
            $nombre="sinimagen.jpg";
            //.$this->upload->display_errors();;
        }        

        $ar['valida'] = $valida;
        $ar['imagen'] = $nombre;
        $dato_json   = json_encode($ar);
        echo $dato_json;                
    }

    /*
        Get Indicadores
    */
    function get_indicadores(){
        $r_indicadores = $this->M_marcador_sys_upd_pruebas->get_totales_indicador('bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901',$_SESSION['_SESSION_ID_CUENTA']);
        $activo     =0;
        $en_espera  =0;
        $completado =0;
        $cancelado  =0;

        if($r_indicadores!='error'){
            foreach ($r_indicadores as $key) {
                switch ($key->id_estado_solicitud) {
                    case 0:
                        $completado=$key->total;
                        break;
                    case 1:
                        $activo=$key->total;
                        break;
                    case 2:
                        $en_espera=$key->total;
                        break;
                    case 3:
                        $completado=$key->total;
                        break;
                    case 4:
                        $cancelado=$key->total;
                        break;                                                                        
                    default:
                        break;
                }
            }
        }
        $ar['activo']       = $activo; 
        $ar['en_espera']    = $en_espera; 
        $ar['completado']   = $completado; 
        $ar['cancelado']    = $cancelado; 
        echo json_encode($ar);
    }

    /*
        FILTROS DE CONSULTA
    */
    function get_select_filtros(){
        $r_estado_empleado = $this->M_marcador_sys_upd_pruebas->get_select('bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901',$_SESSION['_SESSION_ID_CUENTA']);
        //$r_estado_solicitud = $this->M_marcador_sys_upd_pruebas->get_select('tb_estado_solicitud');
        //$r_tipo_contrato    = $this->M_marcador_sys_upd_pruebas->get_select('tipo_contrato');
        //$r_tipo_frecuencia  = $this->M_marcador_sys_upd_pruebas->get_select('tipo_frecuencia');
        //$r_solicitud  = $this->M_marcador_sys_upd_pruebas->get_filtro_mes('solicitud');

        $empleado =''; 
        if(isset($_SESSION['SESSION_SOL_EMPLEADO'])){
            $empleado=$_SESSION['SESSION_SOL_EMPLEADO'];
        }

        $estado =''; 
        if(isset($_SESSION['SESSION_SOL_ESTADO'])){
            $estado=$_SESSION['SESSION_SOL_ESTADO'];
        }

        $contrato =''; 
        if(isset($_SESSION['SESSION_SOL_CONTRATO'])){
            $estado=$_SESSION['SESSION_SOL_CONTRATO'];
        }

        $frecuencia =''; 
        if(isset($_SESSION['SESSION_SOL_FRECUENCIA'])){
            $estado=$_SESSION['SESSION_SOL_FRECUENCIA'];
        }

        $mes =''; 
        if(isset($_SESSION['SESSION_SOL_MES'])){
            $estado=$_SESSION['SESSION_SOL_MES'];
        }

        $c_empleado = '<option value="">Seleccione Empleado</option>';
        if($r_estado_empleado!='error'){
            $id_selected = $_SESSION['_SESSION_LAST_NAME'];

            foreach ($r_estado_empleado as $key) {
                $cad = '';
                $select = '';
                if($key->id_de_contacto==$id_selected){
                    $select=' selected';
                }

                if($key->id_de_contacto==''){
                    $cad = 'CONTACTO AGREGADO: ('.$key->upd_nombre.' '.$key->upd_apellido.' )';
                    $c_empleado .= '<option '.$select.' value="'.$key->id.'">'.$cad.' -- '.$key->nombre_completo.' 3('.$key->id_de_contacto.')'.'</option>';
                }else{
                    if($empleado==$key->id){
                        $c_empleado .= '<option selected value="'.$key->id.'">'.$key->nombre_completo.'2('.$key->id_de_contacto.')'.'</option>';
                    }else{
                        $c_empleado .= '<option '.$select.' value="'.$key->id.'">'.$key->nombre_completo.' 1('.$key->id_de_contacto.')'.'</option>';
                    }
                }
            }
        }
        $ar['s_empleado'] = $c_empleado; 
        
        /*$c_estado_solicitud = '<option value="">Estado Solicitud</option>';
        if($r_estado_solicitud!='error'){
            foreach ($r_estado_solicitud as $key) {
                if($estado==$key->id){
                    $c_estado_solicitud .= '<option selected value="'.$key->id.'">'.$key->descripcion.'</option>';
                }else{
                    $c_estado_solicitud .= '<option value="'.$key->id.'">'.$key->descripcion.'</option>';
                }
            }
        }
        $ar['estado_solicitud'] = $c_estado_solicitud; 

        $c_tipo_contrato = '<option value="">Tipo de Contrato</option>';
        if($r_tipo_contrato!='error'){
            foreach ($r_tipo_contrato as $key) {
                if($contrato==$key->id){
                    $c_tipo_contrato .= '<option selected value="'.$key->id.'">'.$key->descripcion.'</option>';
                }else{
                    $c_tipo_contrato .= '<option value="'.$key->id.'">'.$key->descripcion.'</option>';
                }
            }
        }
        $ar['tipo_contrato'] = $c_tipo_contrato; 

        $c_tipo_frecuencia = '<option value="">Estado Solicitud</option>';
        if($r_tipo_frecuencia!='error'){
            foreach ($r_tipo_frecuencia as $key) {
                if($frecuencia==$key->id){
                    $c_tipo_frecuencia .= '<option selected value="'.$key->id.'">'.$key->descripcion.'</option>';
                }else{
                    $c_tipo_frecuencia .= '<option value="'.$key->id.'">'.$key->descripcion.'</option>';
                }

            }
        }
        $ar['tipo_frecuencia'] = $c_tipo_frecuencia; 

        $c_solicitud = '<option value="">Mes solicitud</option>';
        if($r_solicitud!='error'){
            foreach ($r_solicitud as $key) {
                if($mes==$key->mes){
                    $c_solicitud .= '<option selected value="'.$key->mes.'">'.$key->descripcion.'</option>';
                }else{
                    $c_solicitud .= '<option value="'.$key->mes.'">'.$key->descripcion.'</option>';
                }

            }
        }
        $ar['mes_solicitud'] = $c_solicitud; */

        echo json_encode($ar);

    }   

    /*
        RETIRAR FILTROS
    */
    function retirar_filtros(){
        unset($_SESSION['SESSION_SOL_ESTADO']); 
        unset($_SESSION['SESSION_SOL_CONTRATO']); 
        unset($_SESSION['SESSION_SOL_FRECUENCIA']); 
        unset($_SESSION['SESSION_SOL_MES']); 
    }

    /*
        PARA FILTROS
    */
    function activar_filtro(){
        $tipo   = $this->input->post('tipo');
        $dato   = $this->input->post('dato');

        switch ($tipo) {
            case 'empleados':
                if($dato==''){
                    //unset($_SESSION['SESSION_SOL_EMPLEADO']); 
                    $_SESSION['SESSION_SOL_EMPLEADO']=-1; 
                }else{
                    $_SESSION['SESSION_SOL_EMPLEADO']=$dato; 
                    echo $dato;
                }
                break;            
            case 'paginacion':
                if($dato==''){
                    unset($_SESSION['SESSION_SOL_PAG']); 
                }else{
                    $_SESSION['SESSION_SOL_PAG']=$dato; 
                }
                break;
            case 'estado_solicitud':
                if($dato==''){
                    unset($_SESSION['SESSION_SOL_ESTADO']); 
                }else{
                    $_SESSION['SESSION_SOL_ESTADO']=$dato; 
                }
                break;
            case 'tipo_contrato':
                if($dato==''){
                    unset($_SESSION['SESSION_SOL_CONTRATO']); 
                }else{
                    $_SESSION['SESSION_SOL_CONTRATO']=$dato; 
                }                
                break; 
            case 'frecuencia':
                if($dato==''){
                    unset($_SESSION['SESSION_SOL_FRECUENCIA']); 
                }else{
                    $_SESSION['SESSION_SOL_FRECUENCIA']=$dato; 
                }                  
                break;
            case 'mes':
                if($dato==''){
                    unset($_SESSION['SESSION_SOL_MES']); 
                }else{
                    $_SESSION['SESSION_SOL_MES']=$dato; 
                }                  
                break;           
                
            default:
                break;
        }
    }

}

?>
