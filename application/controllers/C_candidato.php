<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_candidato extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->model('Mdl_compartido');
        $this->load->model('M_ubigeo');
        $this->load->model('M_settings');
        $this->load->model('M_candidato');
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
        $this->load->view('v_candidato', $data);
        $this->load->view('layouts/v_footer');

    }

    /*
        REGISTRO
    */

    function registrar(){
        $tipo = $this->input->post('tipo',true);
        $table=''; 
        switch ($tipo) {
            case 'candidato':
                $table='candidato'; 
                $txt_correo_add = $this->input->post('txt_correo_add',true);
                $txt_celular_add = $this->input->post('txt_celular_add',true);
                $txt_nro_documento_add = $this->input->post('txt_nro_documento_add',true);
                $txt_tipo_documento_add = $this->input->post('txt_tipo_documento_add',true);
                $txt_f_nacimiento_add = $this->input->post('txt_f_nacimiento_add',true);
                $txt_apellidos_add = $this->input->post('txt_apellidos_add',true);
                $txt_nombres_add = $this->input->post('txt_nombres_add',true);

                $array = array(
                    'nombres' => $txt_nombres_add,
                    'apellidos' => $txt_apellidos_add,
                    'fecha_nacimiento' => $txt_f_nacimiento_add,
                    'id_tipo_documento' => $txt_tipo_documento_add,
                    'nro_documento' => $txt_nro_documento_add,
                    'correo_electronico' => $txt_correo_add,
                    'celular' => $txt_celular_add,
                    'f_registro'=>date('Y-m-d H:i:s'),
                    'user_insert'=>$_SESSION['_SESSIONUSER']                
                );
                break;
            case 'asignacion_candidatura':
                $table='candidatoxsolicitud'; 
                $txt_solicitud_asignar = $this->input->post('txt_solicitud_asignar',true);
                $cod_registro_postulante = $this->input->post('cod_registro_postulante',true);

                $array = array(
                    'id_solicitud' => $txt_solicitud_asignar,
                    'id_candidato' => $cod_registro_postulante,
                    'f_registro'=>date('Y-m-d H:i:s'),
                    'id_usuario'=>$_SESSION['_SESSIONUSER'],
                    'id_tipo_proceso'=>1
                );
                break;                
            
            default:
                break;
        }
        //Retornamos el id del registro
        echo $this->M_candidato->insert_id($table,$array);
    }

    /*
        ACTUALIZAR
    */
    function actualizar(){
        $cod_registro_postulante    = trim($this->input->post('cod_registro_postulante',true));
        $id_dep                     = trim($this->input->post('id_dep',true));
        $id_prov                    = trim($this->input->post('id_prov',true));
        $id_distrito                = trim($this->input->post('id_distrito',true));
        $direccion                  = trim($this->input->post('direccion',true));

        $array = array(
            'id_departamento'   => $id_dep,
            'id_provincia'   => $id_prov,
            'id_distrito'   => $id_distrito,
            'direccion'   => $direccion
        );

        $result = $this->M_candidato->update('candidato',$array,$cod_registro_postulante,'id');
        echo $result;
    }
    

    /*
        CARGA DE TIPOS
    */
    function load_tipos(){
        $tipo                       = $this->input->post('tipo',true);
        $cod_registro_postulante    = $this->input->post('cod_registro_postulante',true);
        switch ($tipo) {
            case 'solicitud':
                //Cargamos candidaturas disponibles
                $datos = $this->M_candidato->get_solicitud_activa();
                $cadena = '<option value="">Solicitudes disponibles</option>'; 
                foreach ($datos as $key) {
                    $cadena.='<option value="'.$key->id.'">'.$key->cargo.' - '.$key->area.'</option>';
                }
                $ar['solicitud'] = $cadena; 
                //Cargamos candidaturas registradas
                $datos = $this->M_candidato->get_solicitud_x_candidato($cod_registro_postulante);
                $cadena = ''; 
                $sub_tipo="'"."candidatoxsolicitud"."'";
                foreach ($datos as $key) {
                    $cadena.='
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="./public/images/iconos/experiencia.png" alt="Solicitudes"/>
                            <div class="d-flex flex-column align-items-start p-2">
                                <h6>'.$key->cargo.' - '.$key->area.'</h6>
                                <span>Inscripción: '.$key->f_registro.'</span>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-danger" onclick="eliminar('.$sub_tipo.','.$key->id.')"><i class="bx bx-trash"></i></button>
                        </div>
                    </div>                  
                    ';
                }
                $ar['reg_candidaturas'] = $cadena; 

                break;
            
            default:
                break;
        }
        echo json_encode($ar);
    }
}

?>
