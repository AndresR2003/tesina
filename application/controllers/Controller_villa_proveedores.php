<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Controller_villa_proveedores extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->library('image_lib');
            $this->load->model('Mdl_compartido');
            $this->load->model('Mdl_villa_proveedores');
            $this->load->model('Mdl_villa_tipo_proveedores');
            $this->load->model('Mdl_villa_estados_proveedores');
            $this->load->model('Mdl_villa_tipo_documento');                                                  
            date_default_timezone_set('America/Lima');
        }

        public function index(){
           
            $data['lst_tipos_proveedores']        = $this->Mdl_villa_tipo_proveedores->get_data();   
            $data['lst_tipo_documento']        = $this->Mdl_villa_tipo_documento->get_data_proveedor();
            $data['lst_estados_proveedor']        = $this->Mdl_villa_estados_proveedores->get_data();

            $header['menu_activo'] = 'proveedores';
            //$this->desactivar_filtros();

            $data['datos']='';
            $header['datos_header']='';
            $header['lang']='en';

            $this->load->view('layouts/v_head',$header);
            $this->load->view('layouts/header',$header);
            $this->load->view('vista_proveedores', $data);
            $this->load->view('layouts/v_footer');

        }

        public function listar()
        {
            if (!empty($_POST))
            {
                $fetch_data = $this->Mdl_villa_proveedores->make_datatables('tinfo_proveedores  a');
                $data = array();
                $contador=0; 
                foreach($fetch_data as $row)
                {
                    $contador++; 
                    $sub_array = array();
                    $sub_array[] = $contador;
                    //$sub_array[] = $row->id;
                    //$sub_array[] = $row->usuario_registro;
                    $sub_array[] = $row->descripcion;
                    $sub_array[] = $row->nro_documento;
                    $sub_array[] = $row->tip_documento;
                    $sub_array[] = $row->razon_social;
                    $sub_array[] = $row->direccion;
                    $sub_array[] = $row->celular_1;
                    $sub_array[] = $row->celular_2;                      
                    if($row->estado==1){                      
                        $sub_array[]='<span class="badges bg-lightgreen">Activo</span>';
                    }else{                       
                        $sub_array[]='<span class="badges bg-lightred">Inactivo</span>';
                    }
                    // $sub_array[] = $row->estado;
                    $sub_array[] = $row->fecha_alta;
                    $sub_array[] = '
                        <!--<a class="me-3" href="'.base_url().'clientes/clientes_detail/'.$row->id.'">
                            <img src="'.base_url().'public/assets/img/icons/eye.svg" alt="img">
                        </a>-->
                        <a class="me-3" href="'.base_url().'proveedores/proveedores_edit/'.$row->id.'">
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
                    "recordsTotal"          =>      $this->Mdl_villa_proveedores->get_all_data('tinfo_proveedores  a'),
                    "recordsFiltered"     =>     $this->Mdl_villa_proveedores->get_filtered_data('tinfo_proveedores  a'),
                    "data"                    =>     $data
                );
                echo json_encode($output);
            }
        }

        //funcion para el modulo de agregar proveedor
        public function add_proveedores(){         
            $data['lst_tipo_eventos']   = $this->Mdl_villa_tipo_eventos->get_data();
            $data['lst_tipo_documento']   = $this->Mdl_villa_tipo_documento->get_data_proveedor();
            $data['lst_locales']   = $this->Mdl_locales->get_data();
            $data['lst_productos']   = $this->Modelo_producto->get_data_productos();     
            $data['lst_proforma']   = $this->Mdl_villa_proforma->get_proforma();
               
            $data['datos']='';
            $header['datos_header']='';
            $header['lang']='en';
            $header['menu_activo'] = 'proveedores_add';

            $length = 32; 
            $key = bin2hex(random_bytes($length)); 
            $data['key_generada']=$key;

            $this->load->view('layouts/v_head',$header);
            $this->load->view('layouts/header',$header);
            $this->load->view('vista_villa_add_proveedor',$data);
            $this->load->view('layouts/v_footer');

        }

        //funcion para el modulo editar proveedor
        public function edit_proveedores($id){
            $data['lst_tipo_documento']       = $this->Mdl_villa_proveedores->get_data_table('tinfo_tipo_documento',array('document_prov'=>1));
            $data['lst_estados_proveedor']        = $this->Mdl_villa_estados_proveedores->get_data();
            $data['lst_tipos_proveedores']        = $this->Mdl_villa_tipo_proveedores->get_data();

            //$data['lst_locales']   = $this->Mdl_villa_clientes->get_data_table('tinfo_locales',array('estado'=>0));
            $data['lst_data']= $this->Mdl_villa_proveedores->get_data_detail($id);
            $header['datos_header']='';
            $header['lang']='en';
            $this->load->view('layouts/v_head',$header);
            $this->load->view('layouts/header',$header);
            $this->load->view('vista_villa_edit_proveedor',$data);
            $this->load->view('layouts/v_footer');
        }

        //INSERCIONES
        function insert_Proveedor(){
            $input_nombre = trim($this->input->post('input_razonSocial',true));           
            $select_tipo_documento = trim($this->input->post('select_tipo_documento',true));
            $input_nro_documento = trim($this->input->post('input_nro_documento',true));
            $input_celular_1 = trim($this->input->post('input_celular_1',true));
            $input_celular_2 = trim($this->input->post('input_celular_2',true));
            //$select_sector = trim($this->input->post('select_sector',true));
            $input_direccion = trim($this->input->post('input_direccion',true));

            $valida = $this->Mdl_villa_proveedores->validar('tinfo_proveedores',$input_nro_documento);
            if($valida<=0){
                $array = array(
                    'razon_social' =>$input_nombre,                   
                    'id_tipo_documento' =>$select_tipo_documento,
                    'nro_documento' =>$input_nro_documento,
                    'celular_1' =>$input_celular_1,
                    'celular_2' =>$input_celular_2,
                    /*'id_sector' =>$select_sector,*/
                    'direccion' =>$input_direccion,
                    'fecha_alta'=>date('Y-m-d H:m:s')
                );
        
                $result = $this->Mdl_villa_proveedores->insert('tinfo_proveedores',$array);
                echo $result;
            }else{
                echo 'duplicado';
            }
        }

        //ACTUALIZAR
        public function update() {
            $id = trim($this->input->post('id', true));       
            $razon = trim($this->input->post('input_razonSocial', true));
            $select_tipo_documento = trim($this->input->post('select_tipo_documento', true));
            $input_nro_documento = trim($this->input->post('input_nro_documento', true));
            $input_celular_1 = trim($this->input->post('input_celular_1', true));
            $input_celular_2 = trim($this->input->post('input_celular_2', true));
            $select_tipo_proveedor = trim($this->input->post('select_tipo_proveedor', true));
            $input_direccion = trim($this->input->post('input_direccion', true));
            $array = array(
                'razon_social' => $razon,
                'id_tipo_documento' => $select_tipo_documento,
                'nro_documento' => $input_nro_documento,
                'celular_1' => $input_celular_1,
                'celular_2' => $input_celular_2,
                'id_tipo_proveedor' => $select_tipo_proveedor,
                'direccion' => $input_direccion,
                'fecha_alta' => date('Y-m-d H:i:s')
            );
            $res = $this->Mdl_villa_proveedores->update('tinfo_proveedores', $array, $id, 'id');
            echo $res;
        }   

        public function desactivar_filtros(){
            unset($_SESSION['SESSION_TIPO_PROVEEDOR']);
            unset($_SESSION['SESSION_TIPO_DOCUMENTO_PROV']);
            unset($_SESSION['SESSION_ESTADO']);
           
        }
        
        //SAVE ESTADO
        function save_estado_proveedor(){
            $id_estado_proveedor   = $this->input->post('id_estado_proveedor');
            $id_proveedor  = $this->input->post('id_proveedor');
            $estado=0;

            if($id_estado_proveedor ==0){
                $estado= 2;
            }else{
                $estado= 1;
            }
            $array = array(
                'estado'=>$estado
            );
            $retorno = $this->Mdl_villa_proveedores->update_estado_proveedor($array,$id_proveedor);
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
                case 'tipo_proveedor':
                    if($dato!=''){
                        $_SESSION['SESSION_TIPO_PROVEEDOR']=$dato;
                        $msj = 'active';
                    }else{
                        unset($_SESSION['SESSION_TIPO_PROVEEDOR']);
                        $msj = 'inactive';
                    }
                    break;
    
                case 'select_tipo_documento_prov':
                    if($dato!=''){
                        $_SESSION['SESSION_TIPO_DOCUMENTO_PROV']=$dato;
                        $msj = 'active';
                    }else{
                        unset($_SESSION['SESSION_TIPO_DOCUMENTO_PROV']);
                        $msj = 'inactive';
                    }
                    break;
                      
                case 'select_estado':
                    if($dato!=''){
                        $_SESSION['SESSION_ESTADO_PROVEEDOR']=$dato;
                        $msj = 'active';
                    }else{
                        unset($_SESSION['SESSION_ESTADO_PROVEEDOR']);
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
