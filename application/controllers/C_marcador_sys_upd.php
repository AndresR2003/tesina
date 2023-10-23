<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_marcador_sys_upd extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->model('Mdl_compartido');
        $this->load->model('M_ubigeo');
        $this->load->model('M_settings');
        $this->load->model('M_marcador_sys_upd');
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
        $this->load->view('marcador_sys_upd', $data);
        $this->load->view('layouts/marcador/v_footer');

    }

    /*VISTA CAMPAÑA MARCADOR WORWAG PHARMA*/
    public function wordwag_pharma(){
        $_SESSION['_SESSION_ID_CUENTA'] = $_GET['address2']; 
        $_SESSION['_SESSION_ID_ANEXO'] = $_GET['user']; 
        $_SESSION['_SESSION_LIST_ID'] = $_GET['list_id']; 
        $_SESSION['_SESSION_LEAD_ID'] = $_GET['lead_id'];
        $_SESSION['_SESSION_TELEFONO'] = $_GET['Telefono_gestionado']; 
        if(isset($_GET['control'])){
            $_SESSION['_SESSION_CONTROL_ID'] =1;  
        }else{
            unset($_SESSION['_SESSION_CONTROL_ID']);
        }

        //En este caso el lead_id se deberá registrar de manera automática en el sistema al ingresar la llamada
        
        $val_lead_id    = $this->existe_registro($_GET['lead_id'],'geochasq_bd_pharma.form_lead_farmovigilancia_datos','lead_id');
        $res_registro       ='';
        if($val_lead_id>0){
            $res_registro='Lead Id Registrado';
        }else{
            $array = array(
                'f_registro'    =>date('Y-m-d H:i:s'),
                'lead_id'       =>$_GET['lead_id'],
                'id_usuario'    =>$_GET['user'],
                'celular'       =>$_GET['Telefono_gestionado']
            );
            $res = $this->M_marcador_sys_upd->insert_registros('geochasq_bd_pharma.form_lead_farmovigilancia_datos',$array);
        }

        $data['datos']           =   '';
        $data['lead_id']         =   $val_lead_id;
        $data['res_registro']    =   $res_registro;
        $header['datos_header']  =   '';
        $header['lang']          ='en';

        $this->load->view('layouts/marcador/v_head',$header);
        if($position=='vertical'){
            $this->load->view('layouts/marcador/vertical_menu',$header);
        }else{
            $this->load->view('layouts/marcador/horizontal-menu',$header);
        }
        $this->load->view('marcador_sys_upd_worwag_pharma', $data);
        $this->load->view('layouts/marcador/v_footer');

    }

    function retirar(){
        $tipo     = trim($this->input->post('tipo',true));
        $id       = trim($this->input->post('id',true));
        switch ($tipo) {
            case '2':
                $table='geochasq_bd_pharma.form_lead_medicamento';
                $array = array(
                    'delete'       => 1
                );
                $result = $this->M_marcador_sys_upd->update($table,$array,$_SESSION['_SESSION_LEAD_ID'],'lead_id',$id,'id_medicamento');
                break; 
            case '1':
                $table='geochasq_bd_pharma.form_lead_sintoma';
                $array = array(
                    'delete'       => 1
                );
                $result = $this->M_marcador_sys_upd->update($table,$array,$_SESSION['_SESSION_LEAD_ID'],'lead_id',$id,'id_sintoma');
                break;                                            
            default:
                break;
        }

        echo $result;
    }

    //Validamos el registro del LEAD_ID en la tabla FORM_
    public function existe_registro($dato,$table,$campo){
        $res = $this->M_marcador_sys_upd->existe_registro($dato,$table,$campo);
        return $res;
    }

    public function validar_nuevo_telefono(){
        $telefono = $this->input->post('telefono',true);
        $valida = $this->M_marcador_sys_upd->get_existe_phone_number($telefono);
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
                $resultado2 = $this->M_marcador_sys_upd->get_data_vicidial_list();
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
                    $resultado3 = $this->M_marcador_sys_upd->grabar_nuevo_numero($array);
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
        $result = $this->M_marcador_sys_upd->update('bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901',$array,$id,'id');
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
        $result = $this->M_marcador_sys_upd->update('bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901',$array,$id,'id');
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
        $result = $this->M_marcador_sys_upd->update('bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901',$array,$id,'id');
        echo $result;
    }

    function actualizar(){
        //$fecha_solicitud     = trim($this->input->post('txt_fecha_sol',true));
        $result=''; 
        $txt_nombres    = trim($this->input->post('txt_nombres',true));
        $txt_sexo       = trim($this->input->post('txt_sexo',true));
        $txt_edad       = trim($this->input->post('txt_edad',true));
        $select_email   = trim($this->input->post('select_email',true));
        $txt_email      = trim($this->input->post('txt_email',true));
        $select_telefono= trim($this->input->post('select_telefono',true));
        $txt_telefono   = trim($this->input->post('txt_telefono',true));
        $txt_celular    = trim($this->input->post('txt_celular',true));
        $select_atencion= trim($this->input->post('select_atencion',true));
        $txt_atencion   = trim($this->input->post('txt_atencion',true));
        $select_sintoma= trim($this->input->post('select_sintoma',true));
        $txt_sintoma   = trim($this->input->post('txt_sintoma',true));
        $txt_descripcion   = trim($this->input->post('txt_descripcion',true));
        $checkbox   = trim($this->input->post('checkbox',true));
        $f_upd               = date('Y-m-d H:i:s');

        //Contadores
        $total = $this->M_marcador_sys_upd->get_total_table('geochasq_bd_pharma.form_lead_medicamento',$_SESSION['_SESSION_LEAD_ID']); 
        if($checkbox!=1){
            $total2 = $this->M_marcador_sys_upd->get_total_table('geochasq_bd_pharma.form_lead_sintoma',$_SESSION['_SESSION_LEAD_ID']); 
        }else{
            $total2=1;
        }

        if($total>0){
            if($total2>0){
                $array = array(
                    'nombres'       =>   $txt_nombres,
                    'id_sexo'          =>   $txt_sexo,
                    'edad'          =>   $txt_edad,
                    'id_select_email' =>   $select_email,
                    'dato_email' =>   $txt_email,
                    'id_select_telefono' =>   $select_telefono,
                    'dato_telefono' =>   $txt_telefono,
                    'celular' =>   $txt_celular,
                    'id_select_centro_atencion' =>   $select_atencion,
                    'dato_centro_atencion' =>   $txt_atencion,
                    'dato_sintoma' =>   $txt_sintoma,
                    'descripcion' =>   $txt_descripcion,
                    'f_upd' =>   $f_upd,
                    'id_check_sintoma' =>   $checkbox
                );
                $result = $this->M_marcador_sys_upd->update_datos('geochasq_bd_pharma.form_lead_farmovigilancia_datos',$array,$_SESSION['_SESSION_LEAD_ID'],'lead_id');
                if($result>0){
                    echo 'ok';
                }else{
                    echo 'error';
                }
                //$this->M_marcador_sys_upd->insert('solicitud_log',$array_log);
            }else{
                echo 'sin_reaccion';
            }
        }else{
            echo 'sin_medicamento';
        }
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
        $tipo       = trim($this->input->post('tipo',true));
        $cadena.='';
        switch ($tipo) {
            case '0':
                $cadena='';
                $result = $this->M_marcador_sys_upd->get_registros_simple('geochasq_bd_pharma.form_lead_farmovigilancia_datos',$_SESSION['_SESSION_LEAD_ID']);
                if($result>0){
                    foreach ($result as $key) {
                        $ar['nombres'] = $key->nombres;
                        $ar['id_usuario'] = $key->id_usuario;
                        $ar['id_sexo'] = $key->id_sexo;
                        $ar['edad'] = $key->edad;
                        $ar['id_select_email'] = $key->id_select_email;
                        $ar['dato_email'] = $key->dato_email;
                        $ar['id_select_telefono'] = $key->id_select_telefono;
                        $ar['dato_telefono'] = $key->dato_telefono;
                        $ar['celular'] = $key->celular;
                        $ar['id_select_centro_atencion'] = $key->id_select_centro_atencion;
                        $ar['dato_centro_atencion'] = $key->dato_centro_atencion;
                        $ar['dato_sintoma'] = $key->dato_sintoma;
                        $ar['descripcion'] = $key->descripcion;
                        $ar['id_check_sintoma'] = $key->id_check_sintoma;
                    }
                }else{
                    //$cadena.='<p> Sin Registros </p>';
                }
                break;            
            case '1':
                $result     = $this->M_marcador_sys_upd->get_registros('geochasq_bd_pharma.form_lead_sintoma',$_SESSION['_SESSION_LEAD_ID'],'geochasq_bd_pharma.form_sintoma','a.id_sintoma=b.id');
                if($result>0){
                    foreach ($result as $key) {
                        $cadena.='
                            <button id="btn_'.$tipo.'_'.$key->id_sintoma.'" onclick="retirar('.$tipo.','.$key->id_sintoma.');" class="btn btn-sm btn-info" style="margin-left:5px;margin-top:5px;">' . $key->texto . ' X </button>
                        ';
                    }
                }else{
                    $cadena.='<p> Sin Registros </p>';
                }
                break;
            case '2':
                $result     = $this->M_marcador_sys_upd->get_registros('geochasq_bd_pharma.form_lead_medicamento',$_SESSION['_SESSION_LEAD_ID'],'geochasq_bd_pharma.form_medicamento','a.id_medicamento=b.id');
                if($result>0){
                    foreach ($result as $key) {
                        $cadena.='
                            <button id="btn_'.$tipo.'_'.$key->id_medicamento.'" onclick="retirar('.$tipo.','.$key->id_medicamento.');" class="btn btn-sm btn-info" style="margin-left:5px;margin-top:5px;">' . $key->texto . ' X </button>
                        ';
                    }
                }else{
                    $cadena.='<p> Sin Registros </p>';
                }
                break;
            default:
                break;
        }

        $ar['registros'] = $cadena; 
        echo json_encode($ar);
    }

    public function get_selects(){
        $tipo = trim($this->input->post('tipo',true));
        $cadena=''; 
        switch ($tipo) {
            case 'medicamento':
                $cadena='<option value="">Seleccione medicamento</option>'; 
                $res = $this->M_marcador_sys_upd->get_selects('geochasq_bd_pharma.form_medicamento','estado','0');
                if($res!='error'){
                    foreach ($res as $key) {
                        $cadena.='<option value="'.$key->id.'">'.$key->descripcion.'</option>';
                    }
                }else{
                }
                break;
            case 'sintoma':
                $cadena='<option value="">Seleccione sintoma</option>'; 
                $res = $this->M_marcador_sys_upd->get_selects('geochasq_bd_pharma.form_sintoma','estado','0');
                if($res!='error'){
                    foreach ($res as $key) {
                        $cadena.='<option value="'.$key->id.'">'.$key->descripcion.'</option>';
                    }
                }else{
                }
                break; 
            case 'email':
                $cadena='<option value="">¿Cuenta con email?</option>'; 
                $res = $this->M_marcador_sys_upd->get_selects('geochasq_bd_pharma.form_selects','email','1');
                if($res!='error'){
                    foreach ($res as $key) {
                        $cadena.='<option value="'.$key->id.'">'.$key->descripcion.'</option>';
                    }
                }else{
                }
                break; 
            case 'telefono':
                $cadena='<option value="">¿Cuenta con teléfono?</option>'; 
                $res = $this->M_marcador_sys_upd->get_selects('geochasq_bd_pharma.form_selects','telefono','1');
                if($res!='error'){
                    foreach ($res as $key) {
                        $cadena.='<option value="'.$key->id.'">'.$key->descripcion.'</option>';
                    }
                }else{
                }
                break;
            case 'centro':
                $cadena='<option value="">Seleccione de centro</option>'; 
                $res = $this->M_marcador_sys_upd->get_selects('geochasq_bd_pharma.form_centro_atencion','estado','0');
                if($res!='error'){
                    foreach ($res as $key) {
                        $cadena.='<option value="'.$key->id.'">'.$key->descripcion.'</option>';
                    }
                }else{
                }
                break;
            case 'sexo':
                $cadena='<option value="">Seleccione</option>'; 
                $res = $this->M_marcador_sys_upd->get_selects('geochasq_bd_pharma.form_sexo','estado','0');
                if($res!='error'){
                    foreach ($res as $key) {
                        $cadena.='<option value="'.$key->id.'">'.$key->descripcion.'</option>';
                    }
                }else{
                }
                break;                                                                                
            default:
                break;
        }
        $ar['resultado']=$cadena;
        echo json_encode($ar);
    }

    function insert(){
        //$id_usuario          = $_SESSION['_SESSIONUSER']; 
        unset($_SESSION['SESSION_SOL_EMPLEADO']);
        $f_registro          = date('Y-m-d H:i:s');
        $array = array(
            'user_insert'   => $_SESSION['_SESSION_ID_ANEXO'],
            'f_registro'    => $f_registro,
            'del'           => 0,
            'insert'           => 1,
            'id_cuenta'     => $_SESSION['_SESSION_ID_CUENTA']
        );
        $result = $this->M_marcador_sys_upd->insert('bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901',$array);
        echo $result;
    }

    function insert_registros(){
        $tipo       = trim($this->input->post('tipo',true));
        $id_select       = trim($this->input->post('id_select',true));
        //1  sintomas
        //2  medicamento
        switch ($tipo) {
            case '2':
                
                $result = $this->M_marcador_sys_upd->valida_registro_doble_campo('geochasq_bd_pharma.form_lead_medicamento','lead_id',$_SESSION['_SESSION_LEAD_ID'],'id_medicamento',$id_select);
                if($result>0){
                    $result='duplicado';
                }else{
                    $array = array(
                        'lead_id'       => $_SESSION['_SESSION_LEAD_ID'],
                        'id_medicamento'=> $id_select,
                        'f_registro'    => date('Y-m-d H:i:s'),
                        'delete'        => 0 
                    );
                    $result = $this->M_marcador_sys_upd->insert('geochasq_bd_pharma.form_lead_medicamento',$array);
                    if($result>0){
                        $result='ok';
                    }else{
                        $result='error';
                    }
                }
                break;
            case '1':
                $result = $this->M_marcador_sys_upd->valida_registro_doble_campo('geochasq_bd_pharma.form_lead_sintoma','lead_id',$_SESSION['_SESSION_LEAD_ID'],'id_sintoma',$id_select);
                if($result>0){
                    $result='duplicado';
                }else{
                    $array = array(
                        'lead_id'       => $_SESSION['_SESSION_LEAD_ID'],
                        'id_sintoma'=> $id_select,
                        'f_registro'    => date('Y-m-d H:i:s'),
                        'delete'        => 0 
                    );
                    $result = $this->M_marcador_sys_upd->insert('geochasq_bd_pharma.form_lead_sintoma',$array);
                    if($result>0){
                        $result='ok';
                    }else{
                        $result='error';
                    }
                }                
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

        $result    = $this->M_marcador_sys_upd->get_select_x_id($table,$id_seleccion,'id_area');

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

        $result    = $this->M_marcador_sys_upd->get_select_x_id($table,$id_sol,'id_solicitud');

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
                $result = $this->M_marcador_sys_upd->update($table,$array,$id_sol,'id');
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
                $result    = $this->M_marcador_sys_upd->eliminar($table,$id_reg);
                break;
            case 'responsabilidad':
                $table='responsabilidades';
                $result    = $this->M_marcador_sys_upd->eliminar($table,$id_reg);
                break; 
            case 'solicitud':
                $table='bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901';
                $array = array(
                    'del'       => 1,
                    'f_del'     => date('Y-m-d H:i:s'),
                    'user_del'  => 1111
                );
                $result = $this->M_marcador_sys_upd->update($table,$array,$id_sol,'id');
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
            $res = $this->M_marcador_sys_upd->update('tb_usuarios',$array,$id);
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
        $r_indicadores = $this->M_marcador_sys_upd->get_totales_indicador('bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901',$_SESSION['_SESSION_ID_CUENTA']);
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
        $r_estado_empleado = $this->M_marcador_sys_upd->get_select('bd_casuisticas_campania.ACTUALIZACION_IPESA_2022112901',$_SESSION['_SESSION_ID_CUENTA']);
        //$r_estado_solicitud = $this->M_marcador_sys_upd->get_select('tb_estado_solicitud');
        //$r_tipo_contrato    = $this->M_marcador_sys_upd->get_select('tipo_contrato');
        //$r_tipo_frecuencia  = $this->M_marcador_sys_upd->get_select('tipo_frecuencia');
        //$r_solicitud  = $this->M_marcador_sys_upd->get_filtro_mes('solicitud');

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
            foreach ($r_estado_empleado as $key) {
                if($empleado==$key->id){
                    $c_empleado .= '<option selected value="'.$key->id.'">'.$key->nombre_completo.'('.$key->id_de_contacto.')'.'</option>';
                }else{
                    $c_empleado .= '<option value="'.$key->id.'">'.$key->nombre_completo.' ('.$key->id_de_contacto.')'.'</option>';
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
                    unset($_SESSION['SESSION_SOL_EMPLEADO']); 
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
