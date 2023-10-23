<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Controller_brand extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->library('image_lib');
            $this->load->model('Mdl_compartido');
            $this->load->model('Modelo_brand');
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
            */
            $header['menu_activo'] = 'brand_list';
            $data['datos']='';
            $header['datos_header']='';
            $header['lang']='en';

            $this->load->view('layouts/v_head',$header);
            $this->load->view('layouts/header',$header);
            $this->load->view('vista_brand', $data);
            $this->load->view('layouts/v_footer');

        }

        public function listar()
        {
            if (!empty($_POST))
            {
                $fetch_data = $this->Modelo_brand->make_datatables('tb_marca');
                $data = array();
                $contador=0; 
                foreach($fetch_data as $row)
                {
                    $contador++; 
                    $sub_array = array();
                    $sub_array[] = $contador;
                    $sub_array[] = $row->descripcion;
                    //$sub_array[] = $row->estado;
                    
                    if($row->estado){
                        //badges bg-lightred
                        $sub_array[]='<span class="badges bg-lightred">Inactivo</span>';
                    }else{
                        $sub_array[]='<span class="badges bg-lightgreen">Activo</span>';
                    }

                    $sub_array[] = $row->descripcion;
                    $sub_array[] = $row->f_registro;
                    $sub_array[] = '
                        <a class="me-3" href="'.base_url().'brand_edit/'.$row->id.'">
                            <img src="'.base_url().'public/assets/img/icons/edit.svg" alt="img">
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                            <img src="'.base_url().'public/assets/img/icons/delete.svg" alt="img">
                        </a>                    
                    ';
                    $data[] = $sub_array;
                }
                $output = array(
                    "draw"                    =>     intval($_POST["draw"]),
                    "recordsTotal"          =>      $this->Modelo_brand->get_all_data('tb_marca'),
                    "recordsFiltered"     =>     $this->Modelo_brand->get_filtered_data('tb_marca'),
                    "data"                    =>     $data
                );
                echo json_encode($output);
            }
        }

        public function add_brand(){
            $data['datos']='';
            $header['datos_header']='';
            $header['lang']='en';
            $header['menu_activo'] = 'brand_add';

            $this->load->view('layouts/v_head',$header);
            $this->load->view('layouts/header',$header);
            $this->load->view('vista_add_brand',$data);
            $this->load->view('layouts/v_footer');

        }

        function insert(){
            $input_nombre = trim($this->input->post('input_nombre',true));
            $valida = $this->Modelo_brand->validar('tb_marca',true);
            $user=150;
            if(isset($_SESSION['_SESSIONUSER'])){
                $user=$_SESSION['_SESSIONUSER'];
            }
            if($valida<=0){
                $array = array(
                    'descripcion' =>$input_nombre,
                    'estado' =>0,
                    'f_registro'=>date('Y-m-d H:m:s'),
                    'user_registro'=>$user
                );
        
                $result = $this->Modelo_brand->insert('tb_marca',$array);
                echo $result;
            }else{
                echo 'duplicado';
            }
        }

        public function brand_edit($id){
            $data['lst_data']= $this->Modelo_brand->get_data_details($id);
            $header['datos_header']='';
            $header['lang']='en';
            $this->load->view('layouts/v_head',$header);
            $this->load->view('layouts/header',$header);
            $this->load->view('vista_brand_edit',$data);
            $this->load->view('layouts/v_footer');
        }

        public function update(){
            $id = trim($this->input->post('id',true));
            $input_nombre = trim($this->input->post('input_nombre',true));
            $select_estado = trim($this->input->post('select_estado',true));

            $arr = array(
                'descripcion'=>$input_nombre,
                'estado'=>$select_estado
            );

            $res = $this->Modelo_brand->update('tb_marca',$arr,$id,'id');
            echo $res;
        }
    }

?>
