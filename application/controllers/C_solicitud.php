<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_solicitud extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->model('Mdl_compartido');
        $this->load->model('M_ubigeo');
        $this->load->model('M_settings');
        $this->load->model('M_solicitud');
        date_default_timezone_set('America/Lima');
    }

    public function index(){
        $permiso = $this->Mdl_compartido->permisos_controlador('perfil');
        if (!$permiso)
            redirect('');
        
        if(!isset($_SESSION['_SESSIONUSER'])){
            redirect('login');
        }

        /*
            Para Cabecera
        */
        $header['menu'] = $this->Mdl_compartido->permisos_menu();
        $header['menu_activo'] = 'perfil';
        $header['foto'] = $this->Mdl_compartido->retornarcampo($_SESSION['_SESSIONUSER'],'coduser','tb_usuarios','foto');
        $config = $this->M_settings->get_settings();
        $header['config'] = $config;
        $position='horizontal';
        if($config!='error'){
            foreach ($config as $key) {
                $position=$key->layout;
            }
        }

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
        $this->load->view('layouts/v_head',$header);
        if($position=='vertical'){
            $this->load->view('layouts/vertical_menu',$header);
        }else{
            $this->load->view('layouts/horizontal-menu',$header);
        }
        $this->load->view('v_solicitud', $data);
        $this->load->view('layouts/v_footer');

    }

    function actualizar(){
        //$fecha_solicitud     = trim($this->input->post('txt_fecha_sol',true));
        $id                  = trim($this->input->post('id',true));
        $id_cargo            = trim($this->input->post('txt_cargo_sol',true));
        $resumen             = trim($this->input->post('text_resumen_sol',true));
        $id_estado_solicitud = trim($this->input->post('txt_estado_sol',true));
        
        $seleccionados       = trim($this->input->post('txt_seleccionados_sol',true));
        $id_contrato         = trim($this->input->post('text_contrato_sol',true));
        $maximo              = trim($this->input->post('txt_maximo_sol',true));
        $minimo              = trim($this->input->post('txt_minimo_sol',true));
        $id_tipo_moneda      = 1;
        $id_frecuencia       = trim($this->input->post('text_frecuencia_sol',true));

        $id_area       = trim($this->input->post('txt_area_sol',true));

        $f_upd               = date('Y-m-d H:i:s');

        $array = array(
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
        );

        //Insertamos en el log
        $array_log = array(
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
        );

        $result = $this->M_solicitud->update('solicitud',$array,$id,'id');
        $this->M_solicitud->insert('solicitud_log',$array_log);
        echo $result;
    }

    function armar_selects($arr,$id_registro,$id_registro2,$campo){
        $cadena='<option value=""> Seleccione </option>';
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

        /*Para Páginación*/
        $limite     = 5;
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
        $result_pag = $this->M_solicitud->get_total_registros_pag('solicitud');
        
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
        $result     = $this->M_solicitud->get_registros('solicitud',$limite,$paginacion);

        $r_estado_solicitud = $this->M_solicitud->get_select('tb_estado_solicitud');
        $r_tipo_contrato    = $this->M_solicitud->get_select('tipo_contrato');
        $r_tipo_moneda     = $this->M_solicitud->get_select('tipo_moneda');
        $r_tipo_frecuencia  = $this->M_solicitud->get_select('tipo_frecuencia');

        $r_area  = $this->M_solicitud->get_select('area');
        $r_cargo  = $this->M_solicitud->get_select('cargo');

        $resultados =0; 
        $cadena='';
        if($result!='error'){
            foreach ($result as $key) {
                $resultados++; 
                $color      = $this->set_border_left($key->id_estado_solicitud);
                $bg      = $this->set_bg($key->id_estado_solicitud);
                $sel_area   = $this->armar_selects($r_area,$key->id_area,0,'0');
                $sel_cargo   = $this->armar_selects($r_cargo,$key->id_cargo,$key->id_area,'id_area');
                $sel_contrato   = $this->armar_selects($r_tipo_contrato,$key->id_tipo_contrato,0,'0');
                $sel_frecuencia = $this->armar_selects($r_tipo_frecuencia,$key->id_frecuencia,0,'0');
                $sel_estado_solicitud = $this->armar_selects($r_estado_solicitud,$key->id_estado_solicitud,0,'0');
                $cadena.='
                <div class="card p-2" '.$color.'>
                    <div class="card-body">
                        <div>
                            <div class="py-3">
                                <div class="row align-items-center">
                                    <div class="col-lg-2">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div>
                                                    <h5 class="font-size-14">Solicitante</h5>
                                                    <span>Sandro Arenas</span>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                <h5 class="font-size-14">Solicitud</h5>
                                            </div>

                                            <div class="col-md-12 ">
                                                <div>
                                                    <select class="form-control form-control-sm" id="txt_area_sol_'.$key->id.'" onchange="get_datos_select_x_id('."'cargos',".$key->id.','."'txt_area_sol_'".')">
                                                        '.$sel_area.'
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                <div>
                                                    <select class="form-control form-control-sm" id="txt_cargo_sol_'.$key->id.'">
                                                        '.$sel_cargo.'
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                <div>
                                                    <select class="form-control form-control-sm '.$bg.'" id="txt_estado_sol_'.$key->id.'">
                                                        '.$sel_estado_solicitud.'
                                                    </select>
                                                </div>
                                            </div>                                                                                                        
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div id="panel_detalle_'.$key->id.'" style="display:block">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div>
                                                        <h5 class="font-size-13">Fecha</h5>
                                                        <input type="datetime" disabled class="form-control form-control-sm" id="txt_fecha_sol_'.$key->id.'" value="'.$key->f_registro.'">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div>
                                                        <h5 class="font-size-13">S. Minimo</h5>
                                                        <input type="text" class="form-control form-control-sm" id="txt_minimo_sol_'.$key->id.'"  value="'.$key->minimo_salario.'" >
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-2">
                                                    <div>
                                                        <h5 class="font-size-13">S. Máximo</h5>
                                                        <input type="text" class="form-control form-control-sm"  id="txt_maximo_sol_'.$key->id.'"  value="'.$key->maximo_salario.'">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-2">
                                                    <div>
                                                        <h5 class="font-size-13">Contrato</h5>
                                                        <select class="form-control form-control-sm" id="text_contrato_sol_'.$key->id.'">
                                                            '.$sel_contrato.'
                                                        </select>                                                                
                                                    </div>
                                                </div>  
                                                
                                                <div class="col-md-2">
                                                    <div>
                                                        <h5 class="font-size-13">Frecuencia</h5>
                                                        <select class="form-control form-control-sm" id="text_frecuencia_sol_'.$key->id.'">
                                                            '.$sel_frecuencia.'
                                                        </select> 
                                                    </div>
                                                </div>  

                                                <div class="col-md-2">
                                                    <div>
                                                        <h5 class="font-size-13">Seleccionados</h5>
                                                        <input type="number" class="form-control form-control-sm" id="txt_seleccionados_sol_'.$key->id.'"  value="'.$key->nro_seleccionados.'" >
                                                    </div>
                                                </div>                                                    

                                                <div class="col-md-12 pt-3">
                                                    <h5 class="font-size-13">Resumen Breve :</h5>
                                                    <div>
                                                        <textarea class="form-control" id="text_resumen_sol_'.$key->id.'"> '.$key->resumen_breve.' </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="panel_respon_'.$key->id.'" style="display:none;">
                                            <label>Responsabilidades</label>
                                            <div class="d-flex justify-content-center">
                                                <input type="text"  class="form-control form-control-sm" placeholder="Ingrese detalle de responsabilidad." id="txt_des_respon_'.$key->id.'">
                                                <button class="btn btn-sm btn-secondary" onclick="agregar('."'".'responsabilidad'."'".','.$key->id.')"> Agregar</button>
                                            </div>
                                            <label class="mt-2">Registros</label>
                                            <div class="d-flex flex-column justify-content-center" id="lista_respon_'.$key->id.'">
                                            </div>
                                        </div> 
                                        
                                        <div id="panel_reque_'.$key->id.'" style="display:none;">
                                            <label>Requerimientos</label>
                                            <div class="d-flex justify-content-center">
                                                <input type="text"  class="form-control form-control-sm" placeholder="Ingrese detalle del requerimiento." id="txt_des_reque_'.$key->id.'">
                                                <button class="btn btn-sm btn-secondary" onclick="agregar('."'".'requerimiento'."'".','.$key->id.')"> Agregar</button>
                                            </div>
                                            <label class="mt-2">Registros</label>
                                            <div class="d-flex flex-column justify-content-center" id="lista_reque_'.$key->id.'">
                                            </div>
                                        </div> 

                                    </div>

                                    <div class="col-lg-2 col-center">
                                        <button style="display:none;" id="btn_regresar_'.$key->id.'" class="btn btn-sm btn-secondary waves-effect waves-light mb-1 form-control"  onclick="regresar('.$key->id.');"> <i class="mdi mdi-keyboard-backspace"></i> Regresar</button>
                                        <button id="btn_actualizar_'.$key->id.'" class="btn btn-sm btn-info waves-effect waves-light mb-1 form-control"  onclick="actualizar('.$key->id.');"> <i class="mdi mdi-square-edit-outline"></i> Actualizar</button>
                                        <button class="btn btn-sm btn-info waves-effect waves-light mb-1 form-control"  onclick="ver_responsabilidad('.$key->id.');"><i class="mdi mdi-spider-web"></i> Responsabilidad</button>
                                        <button class="btn btn-sm btn-info waves-effect waves-light mb-1  form-control" onclick="ver_requerimientos('.$key->id.');"><i class="mdi mdi-spider-web"></i> Requerimientos</button>
                                        <button class="btn btn-sm btn-danger waves-effect waves-light mb-1  form-control" onclick="eliminar('."'".'solicitud'."',".$key->id.',0);"><i class="mdi mdi-trash-can"></i> Eliminar</button>
                                    </div>

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
        $id_usuario          = $_SESSION['_SESSIONUSER']; 
        $f_registro          = date('Y-m-d H:i:s');
        $array = array(
            'id_usuario'            => $id_usuario,
            'id_estado_solicitud'   => 2,
            'nro_seleccionados'     => 0,
            'minimo_salario'        => 0,
            'maximo_salario'        => 0,
            'id_tipo_moneda'        => 1,
            'f_registro'            => $f_registro
        );
        $result = $this->M_solicitud->insert('solicitud',$array);
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
                $result = $this->M_solicitud->insert('responsabilidades',$array);
                break;
            case 'requerimiento':
                $array = array(
                    'descripcion'            => $des,
                    'id_solicitud'          => $id_sol
                );
                $result = $this->M_solicitud->insert('requerimientos',$array);
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

        $result    = $this->M_solicitud->get_select_x_id($table,$id_seleccion,'id_area');

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

        $result    = $this->M_solicitud->get_select_x_id($table,$id_sol,'id_solicitud');

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

    function eliminar(){
        $tipo       = trim($this->input->post('tipo',true));
        $id_reg       = trim($this->input->post('id_reg',true));
        $id_sol       = trim($this->input->post('id_sol',true));
        
        $table=''; 
        switch ($tipo) {
            case 'requerimiento':
                $table='requerimientos';
                $result    = $this->M_solicitud->eliminar($table,$id_reg);
                break;
            case 'responsabilidad':
                $table='responsabilidades';
                $result    = $this->M_solicitud->eliminar($table,$id_reg);
                break; 
            case 'solicitud':
                $table='responsabilidades';
                $array = array(
                    'del'       => 1,
                    'f_del'     => date('Y-m-d H:i:s'),
                    'user_del'  => $_SESSION['_SESSIONUSER']
                );
                $result = $this->M_solicitud->update('solicitud',$array,$id_sol,'id');
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
            $res = $this->M_solicitud->update('tb_usuarios',$array,$id);
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
        $r_indicadores = $this->M_solicitud->get_totales_indicador('solicitud','tb_estado_solicitud');
        $activo     =0;
        $en_espera  =0;
        $completado =0;
        $cancelado  =0;

        if($r_indicadores!='error'){
            foreach ($r_indicadores as $key) {
                switch ($key->id_estado_solicitud) {
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
        $r_estado_solicitud = $this->M_solicitud->get_select('tb_estado_solicitud');
        $r_tipo_contrato    = $this->M_solicitud->get_select('tipo_contrato');
        $r_tipo_frecuencia  = $this->M_solicitud->get_select('tipo_frecuencia');
        $r_solicitud  = $this->M_solicitud->get_filtro_mes('solicitud');

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

        
        $c_estado_solicitud = '<option value="">Estado Solicitud</option>';
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
        $ar['mes_solicitud'] = $c_solicitud; 

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
