<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Controller_villa_eventos extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->library('image_lib');
            $this->load->model('Mdl_compartido');
            $this->load->model('Modelo_producto');
            $this->load->model('Mdl_villa_eventos');
            $this->load->model('Mdl_villa_eventos');
            $this->load->model('Mdl_villa_tipo_eventos');
            $this->load->model('Mdl_villa_estados_evento');
            $this->load->model('Mdl_villa_tipo_documento');
            $this->load->model('Mdl_locales');
            $this->load->model('Mdl_villa_proforma');
            $this->load->model('Mdl_villa_clientes');
            date_default_timezone_set('America/Lima');
        }

        public function index(){
            /*
            $permiso = $this->Mdl_compartido->permisos_controlador('actividad');
            if (!$permiso)
                redirect('');
            
            if(!isset($_SESSION['_SESSIONUSER'])){
                redirect('login');
            }

            $header['menu'] = $this->Mdl_compartido->permisos_menu();
            $header['menu_activo'] = 'actividad';
            */
            $data['lst_estados_evento']        = $this->Mdl_villa_estados_evento->get_data();
            $data['lst_tipos_eventos']        = $this->Mdl_villa_tipo_eventos->get_data();

            $header['menu_activo'] = 'eventos';
            //$this->desactivar_filtros();

            $data['datos']='';
            $header['datos_header']='';
            $header['lang']='en';

            $this->load->view('layouts/v_head',$header);
            $this->load->view('layouts/header',$header);
            $this->load->view('vista_villa_eventos', $data);
            $this->load->view('layouts/v_footer');

        }

        public function listar()
        {
            if (!empty($_POST))
            {
                $fetch_data = $this->Mdl_villa_eventos->make_datatables();
                $data = array();
                $contador=0; 
                foreach($fetch_data as $row)
                {
                    $contador++; 
                    $sub_array = array();
                    $sub_array[] = $contador;
                    $sub_array[] = $row->usuario_registro;
                    $sub_array[] = $row->nombre_cliente.' '.$row->apellidos;
                    $sub_array[] = $row->celular_1;
                    $sub_array[] = $row->celular_2;
                    $sub_array[] = $row->nro_documento;
                    $sub_array[] = $row->tipo_evento;
                    $sub_array[] = '<span class="'.$row->class.'">'.$row->estado_evento.'</span>';
                    $sub_array[] = $row->fecha_registro;
                    $sub_array[] = '
                        <!--<a class="me-3" href="'.base_url().'clientes/clientes_detail/'.$row->id_evento.'">
                            <img src="'.base_url().'public/assets/img/icons/eye.svg" alt="img">
                        </a>-->
                        <a class="me-3" href="'.base_url().'eventos/eventos_edit/'.$row->id_evento.'">
                            <img src="'.base_url().'public/assets/img/icons/edit.svg" alt="img">
                        </a>
                        <!--<a class="confirm-text" href="javascript:void(0);">
                            <img src="'.base_url().'public/assets/img/icons/delete.svg" alt="img">
                        </a>--> 
                    ';
                    $data[] = $sub_array;
                }
                $output = array(
                    "draw"                    =>     intval($_POST["draw"]),
                    "recordsTotal"          =>      $this->Mdl_villa_eventos->get_all_data(),
                    "recordsFiltered"     =>     $this->Mdl_villa_eventos->get_filtered_data(),
                    "data"                    =>     $data
                );
                echo json_encode($output);
            }
        }

        public function add_eventos(){
            //$data['lst_tipo_documento']       = $this->Mdl_villa_eventos->get_data_table('tinfo_tipo_documento',array('estado'=>0));
            //$data['lst_locales']   = $this->Mdl_villa_eventos->get_data_table('tinfo_locales',array('estado'=>0));
            
            $data['lst_tipo_eventos']   = $this->Mdl_villa_tipo_eventos->get_data();
            $data['lst_tipo_documento']   = $this->Mdl_villa_tipo_documento->get_data();
            $data['lst_locales']   = $this->Mdl_locales->get_data();
            $data['lst_productos']   = $this->Modelo_producto->get_data_productos();
            
            $data['lst_proforma']   = $this->Mdl_villa_proforma->get_proforma();
            
            $data['datos']='';
            $header['datos_header']='';
            $header['lang']='en';
            $header['menu_activo'] = 'eventos_add';

            $length = 32; // longitud en bytes de la clave
            $key = bin2hex(random_bytes($length)); // convierte los bytes aleatorios en una cadena hexadecimal
            $data['key_generada']=$key;

            $this->load->view('layouts/v_head',$header);
            $this->load->view('layouts/header',$header);
            $this->load->view('vista_villa_add_evento',$data);
            $this->load->view('layouts/v_footer');

        }

        public function get_data_nro_documento(){
            $nro_documento = trim($this->input->post('nro_documento',true));
            $res   = $this->Mdl_villa_eventos->get_data_nro_documento($nro_documento);
            echo json_encode($res);
        }

        public function eventos_edit($id_evento){
            //$data['lst_tipo_documento']       = $this->Mdl_villa_clientes->get_data_table('tinfo_tipo_documento',array('estado'=>0));
            //$data['lst_locales']   = $this->Mdl_villa_clientes->get_data_table('tinfo_locales',array('estado'=>0));
            //$data['lst_data']= $this->Mdl_villa_clientes->get_data_detail($id);

            //Data del cliente
            $data['lst_tipo_eventos']       = $this->Mdl_villa_tipo_eventos->get_data();
            $data['lst_tipo_documento']     = $this->Mdl_villa_tipo_documento->get_data();
            $data['lst_locales']            = $this->Mdl_locales->get_data();
            $data['lst_productos']          = $this->Modelo_producto->get_data_productos();
            $data['lst_proforma']           = $this->Mdl_villa_proforma->get_proforma();
            //obtenemos el id del cliente teniendo en cuenta el id del evento 
            $id_cliente                     = $this->Mdl_compartido->retornarcampo($id_evento,'id','tinfo_eventos','id_cliente');
            $data['lst_data_cliente']       = $this->Mdl_villa_clientes->get_data_x_id($id_cliente);
            $data['lst_data_evento']        = $this->Mdl_villa_eventos->get_data_x_id($id_evento);
            $data['id_evento']              = $id_evento;
            //Obtenemos estados de los eventos
            $data['lst_estados_evento']        = $this->Mdl_villa_estados_evento->get_data();

            //Data del evento

            $header['datos_header']='';
            $header['lang']='en';
            $header['menu_activo'] = 'eventos';
            
            $this->load->view('layouts/v_head',$header);
            $this->load->view('layouts/header',$header);
            $this->load->view('vista_villa_edit_evento',$data);
            $this->load->view('layouts/v_footer');
        }

        
        function save_estado_evento(){
            $id_estado_evento   = $this->input->post('id_estado_evento');
            $id_evento  = $this->input->post('id_evento');
            $array = array(
                'id_estado_evento'=>$id_estado_evento
            );
            $retorno = $this->Mdl_villa_eventos->update_estado_evento($array,$id_evento);
            if($retorno>0){
                echo 'ok';
            }else{
                echo 'error';
            }
        }

        function active_filter(){
            $tipo = trim($this->input->post('tipo',true));
            $dato = trim($this->input->post('dato',true));
            $msj = '';
            switch ($tipo) {
                case 'select_tipo_evento':
                    if($dato!=''){
                        $_SESSION['SESSION_TIPO_EVENTO']=$dato;
                        $msj = 'active';
                    }else{
                        unset($_SESSION['SESSION_TIPO_EVENTO']);
                        $msj = 'inactive';
                    }
                    break;                
                case 'select_estado':
                    if($dato!=''){
                        $_SESSION['SESSION_ESTADO_EVENTO']=$dato;
                        $msj = 'active';
                    }else{
                        unset($_SESSION['SESSION_ESTADO_EVENTO']);
                        $msj = 'inactive';
                    }
                    break;                                                                                
                default:
                    break;
            }
            $ar['mensaje']=$msj;
            echo json_encode($ar); 
        }
    }

?>
