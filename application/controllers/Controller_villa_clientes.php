<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Controller_villa_clientes extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->library('image_lib');
            $this->load->model('Mdl_compartido');
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
            $header['menu_activo'] = 'clientes';
            $this->desactivar_filtros();

            $data['datos']='';
            $header['datos_header']='';
            $header['lang']='en';

            $this->load->view('layouts/v_head',$header);
            $this->load->view('layouts/header',$header);
            $this->load->view('vista_villa_clientes', $data);
            $this->load->view('layouts/v_footer');

        }

        public function listar()
        {
            if (!empty($_POST))
            {
                $fetch_data = $this->Mdl_villa_clientes->make_datatables('tinfo_clientes  a');
                $data = array();
                $contador=0; 
                foreach($fetch_data as $row)
                {
                    $contador++; 
                    $sub_array = array();
                    $sub_array[] = $contador;
                    $sub_array[] = $row->nombres;
                    $sub_array[] = $row->apellidos;
                    if($row->estado){
                        //badges bg-lightred
                        $sub_array[]='<span class="badges bg-lightred">Inactivo</span>';
                    }else{
                        $sub_array[]='<span class="badges bg-lightgreen">Activo</span>';
                    }
                    $sub_array[] = $row->local;
                    $sub_array[] = $row->tipo_documento;
                    $sub_array[] = $row->nro_documento;
                    $sub_array[] = $row->direccion;
                    $sub_array[] = $row->celular_1;
                    $sub_array[] = $row->celular_2;
                    $sub_array[] = '
                        <!--<a class="me-3" href="'.base_url().'clientes/clientes_detail/'.$row->id.'">
                            <img src="'.base_url().'public/assets/img/icons/eye.svg" alt="img">
                        </a>-->
                        <a class="me-3" href="'.base_url().'clientes/clientes_edit/'.$row->id.'">
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
                    "recordsTotal"          =>      $this->Mdl_villa_clientes->get_all_data('tinfo_clientes  a'),
                    "recordsFiltered"     =>     $this->Mdl_villa_clientes->get_filtered_data('tinfo_clientes  a'),
                    "data"                    =>     $data
                );
                echo json_encode($output);
            }
        }

        public function add_clientes(){
            $data['lst_tipo_documento']       = $this->Mdl_villa_clientes->get_data_table('tinfo_tipo_documento',array('estado'=>0));
            $data['lst_locales']   = $this->Mdl_villa_clientes->get_data_table('tinfo_locales',array('estado'=>0));

            $data['datos']='';
            $header['datos_header']='';
            $header['lang']='en';

            $header['menu_activo'] = 'clientes_add';
            $this->load->view('layouts/v_head',$header);
            $this->load->view('layouts/header',$header);
            $this->load->view('vista_villa_add_cliente',$data);
            $this->load->view('layouts/v_footer');

        }

        public function edit_clientes($id){
            $data['lst_tipo_documento']       = $this->Mdl_villa_clientes->get_data_table('tinfo_tipo_documento',array('estado'=>0));
            $data['lst_locales']   = $this->Mdl_villa_clientes->get_data_table('tinfo_locales',array('estado'=>0));

            $data['lst_data']= $this->Mdl_villa_clientes->get_data_detail($id);
            $header['datos_header']='';
            $header['lang']='en';
            $this->load->view('layouts/v_head',$header);
            $this->load->view('layouts/header',$header);
            $this->load->view('vista_villa_edit_cliente',$data);
            $this->load->view('layouts/v_footer');
        }

        function insert_cliente(){
            $input_nombre = trim($this->input->post('input_nombre',true));
            $input_apellido = trim($this->input->post('input_apellido',true));
            $select_tipo_documento = trim($this->input->post('select_tipo_documento',true));
            $input_nro_documento = trim($this->input->post('input_nro_documento',true));
            $input_celular_1 = trim($this->input->post('input_celular_1',true));
            $input_celular_2 = trim($this->input->post('input_celular_2',true));
            $select_sector = trim($this->input->post('select_sector',true));
            $input_direccion = trim($this->input->post('input_direccion',true));
            $valida = $this->Mdl_villa_clientes->validar('tinfo_clientes',$input_nro_documento);
            if($valida<=0){
                $array = array(
                    'nombres' =>$input_nombre,
                    'apellidos' =>$input_apellido,
                    'id_tipo_documento' =>$select_tipo_documento,
                    'nro_documento' =>$input_nro_documento,
                    'celular_1' =>$input_celular_1,
                    'celular_2' =>$input_celular_2,
                    'id_sector' =>$select_sector,
                    'direccion' =>$input_direccion,
                    'fecha_alta'=>date('Y-m-d H:m:s')
                );
        
                $result = $this->Mdl_villa_clientes->insert('tinfo_clientes',$array);
                echo $result;
            }else{
                echo 'duplicado';
            }
        }

        public function detail_product($id){
            $data['lst_data']= $this->Mdl_villa_clientes->get_data_product_detail($id);
            $header['datos_header']='';
            $header['lang']='en';
            $this->load->view('layouts/v_head',$header);
            $this->load->view('layouts/header',$header);
            $this->load->view('vista_detail_product',$data);
            $this->load->view('layouts/v_footer');
        }

        public function update(){
            $id = trim($this->input->post('id',true));
            $input_nombre = trim($this->input->post('input_nombre',true));
            $input_apellido = trim($this->input->post('input_apellido',true));
            $select_tipo_documento = trim($this->input->post('select_tipo_documento',true));
            $input_nro_documento = trim($this->input->post('input_nro_documento',true));
            $input_celular_1 = trim($this->input->post('input_celular_1',true));
            $input_celular_2 = trim($this->input->post('input_celular_2',true));
            $select_sector = trim($this->input->post('select_sector',true));
            $input_direccion = trim($this->input->post('input_direccion',true));
            $array = array(
                'nombres' =>$input_nombre,
                'apellidos' =>$input_apellido,
                'id_tipo_documento' =>$select_tipo_documento,
                'nro_documento' =>$input_nro_documento,
                'celular_1' =>$input_celular_1,
                'celular_2' =>$input_celular_2,
                'id_sector' =>$select_sector,
                'direccion' =>$input_direccion,
                'fecha_alta'=>date('Y-m-d H:m:s')
            );
            $res = $this->Mdl_villa_clientes->update('tinfo_clientes',$array,$id,'id');
            echo $res;
        }

        public function desactivar_filtros(){
            unset($_SESSION['SESSION_CATEGORIA']);
            unset($_SESSION['SESSION_SUBCATEGORIA']);
            unset($_SESSION['SESSION_MARCA']);
            unset($_SESSION['SESSION_UNIDAD']);
        }
    }

?>
