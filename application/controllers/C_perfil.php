<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_perfil extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->model('Mdl_compartido');
        $this->load->model('M_ubigeo');
        $this->load->model('M_settings');
        $this->load->model('M_perfil');
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
        $this->load->view('v_perfil', $data);
        $this->load->view('layouts/v_footer');

    }


    function grabar(){
        $nombres = trim($this->input->post('nombres',true));
        $apellidos = trim($this->input->post('apellidos',true));
        $dni = trim($this->input->post('dni',true));
        $f_nac = trim($this->input->post('fecha',true));
        $correo = trim($this->input->post('correo',true));
        $telefono = trim($this->input->post('celular',true));
        $distrito = trim($this->input->post('distrito',true));
        $direccion = trim($this->input->post('direccion',true));

        $coduser = $_SESSION['_SESSIONUSER']; 
        $array = array(
            'nombres'=>$nombres,
            'apellidos'=>$apellidos,
            'dni'=>$dni,
            'f_nac'=>$f_nac,
            'correo'=>$correo,
            'telefono'=>$telefono,
            'id_distrito'=>$distrito,
            'direccion'=>$direccion,
            'f_upd'=>date('Y-m-d H:i:s')
        );

        $result = $this->M_perfil->update('tb_usuarios',$array,$coduser);
        echo $result;
    }

    function get_datos(){
        $coduser = $_SESSION['_SESSIONUSER'];
        $result = $this->M_perfil->get_datos('tb_usuarios',$coduser);
        echo json_encode($result);
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
            $res = $this->M_perfil->update('tb_usuarios',$array,$id);
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

}

?>
