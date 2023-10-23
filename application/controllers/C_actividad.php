<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_actividad extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->model('Mdl_compartido');
        //$this->load->model('Model_marcas');
        //$this->load->model('Model_categorias');
        $this->load->model('M_actividad');
        $this->load->model('M_settings');

        date_default_timezone_set('America/Lima');
    }

    public function index(){
        $permiso = $this->Mdl_compartido->permisos_controlador('actividad');
        if (!$permiso)
            redirect('');
        
        if(!isset($_SESSION['_SESSIONUSER'])){
            redirect('login');
        }

        $header['menu'] = $this->Mdl_compartido->permisos_menu();
        $header['menu_activo'] = 'actividad';

        $config = $this->M_settings->get_settings();
        $header['config'] = $config;
        $position='horizontal';
        if($config!='error'){
            foreach ($config as $key) {
                $position=$key->layout;
            }
        }


        $data['datos']='';
        $header['datos_header']='';
        $header['lang']='en';
        $this->load->view('layouts/v_head',$header);
        if($position=='vertical'){
            $this->load->view('layouts/vertical_menu',$header);
        }else{
            $this->load->view('layouts/horizontal-menu',$header);
        }
        $this->load->view('v_actividad', $data);
        $this->load->view('layouts/v_footer');

    }

    function obtener_datos(){
        $id = trim($this->input->post('id',true));

        $valida = $this->M_actividad->validar_x_id('tb_actividad',$id);
        
        if($valida>0){
            $result = $this->M_actividad->get_data_x_id('tb_actividad',$id);
            foreach ($result as $key) {
                $ar['descripcion']=$key->descripcion; 
            }            
            echo json_encode($ar); 
        }else{
            echo 'noexiste';
        }
    }

    function registrar(){
        $des = trim($this->input->post('des',true));

        $valida = $this->M_actividad->validar('tb_actividad',$des);
        
        if($valida<=0){
            $array = array(
                'descripcion'=>$des,
                'f_registro'=>date('Y-m-d H:m:s'),
                'estado'=>0
            );
    
            $result = $this->M_actividad->insert('tb_actividad',$array);
            echo $result;
        }else{
            echo 'duplicado';
        }
    }

    function actualizar(){
        $des = trim($this->input->post('des',true));
        $id = trim($this->input->post('id',true));

        $valida = $this->M_actividad->validar('tb_actividad',$des);
        
        if($valida<=0){
            $array = array(
                'descripcion'=>$des,
                'f_upd'=>date('Y-m-d H:m:s'),
                'estado'=>0
            );
    
            $result = $this->M_actividad->update('tb_actividad',$array,$id);
            echo $result;
        }else{
            echo 'duplicado';
        }
    }

    public function listar_registros()
    {
        if (!empty($_POST))
        {
            $fetch_data = $this->M_actividad->make_datatables('tb_actividad');
            $data = array();
            $contador=0; 
            foreach($fetch_data as $row)
            {
                $contador++; 
                $sub_array = array();
                $sub_array[] = $contador;
                $sub_array[] = $row->descripcion;
                $sub_array[] = $row->f_registro;
                $sub_array[] = '
                    <button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="editar('.$row->id.')"><i class="bx bx-edit-alt"></i></button>
                    <button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="eliminar('.$row->id.');"><i class="bx bx-trash"></i></button>
                ';
                $data[] = $sub_array;
            }
            $output = array(
                "draw"                    =>     intval($_POST["draw"]),
                "recordsTotal"          =>      $this->M_actividad->get_all_data('tb_actividad'),
                "recordsFiltered"     =>     $this->M_actividad->get_filtered_data('tb_actividad'),
                "data"                    =>     $data
            );
            echo json_encode($output);
        }
    }

    function listar(){
        $result = $this->M_actividad->list('tb_actividad');
        $cadena='';
        $contador=0;
        if($result!='error'){
            foreach ($result as $key) {
                $contador++; 
                $cadena.='
                <tr>
                    <th scope="row">'.$contador.'</th>
                    <td>'.$key->descripcion.'</td>
                    <td>'.$key->f_registro.'</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="editar('.$key->id.')"><i class="bx bx-edit-alt"></i></button>
                        <button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="eliminar('.$key->id.');"><i class="bx bx-trash"></i></button>
                    </td>
                </tr>                
                ';
            }
            echo $cadena; 
        }else{
            echo '<tr><td>Sin resultados</td></tr>';
        }
    }

    function eliminar(){
        $id = trim($this->input->post('id',true));

        $resultado = $this->M_actividad->eliminar('tb_actividad',$id);
        
        if($resultado<=0){
            echo 'error';
        }else{
            echo 'ok';
        }
    }
}

?>
