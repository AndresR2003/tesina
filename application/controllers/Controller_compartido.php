<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Controller_compartido extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('Mdl_compartido');
            date_default_timezone_set('America/Lima');
        }

        //OBTENEMOS LA INFORMACION
        function get_data_select(){
            $tipo = trim($this->input->post('tipo',true));
            $cadena=''; 

            switch ($tipo) {
                case 'marca':
                    $cadena='<option value="">Marca</option>'; 
                    $result = $this->Mdl_compartido->get_data_select('*','tb_marca','estado','0');
                    break;
                case 'select_sector':
                    $cadena='<option value="">Sector</option>'; 
                    $result = $this->Mdl_compartido->get_data_select('id,descripcion','tinfo_locales','estado','0');
                    if($result!='error'){
                        $selected =""; 
                        if(isset($_SESSION['SESSION_SECTOR'])){
                            $selected = $_SESSION['SESSION_SECTOR'];
                        }
                        foreach ($result as $key) {
                            if($key->id == $selected){
                                $cadena.='<option selected value="'.$key->id.'">'.$key->descripcion.'</option>';
                            }else{
                                $cadena.='<option value="'.$key->id.'">'.$key->descripcion.'</option>';
                            }
                        }
                    }
                    break;
                case 'tipo_proveedor':
                    $cadena='<option value="">Tipo Documento</option>'; 
                    $result = $this->Mdl_compartido->get_data_select('*','tinfo_tipo_proveedor','estado','0');
                    if($result!='error'){
                        $selected =""; 
                        if(isset($_SESSION['SESSION_TIPO_PROVEEDOR'])){
                            $selected = $_SESSION['SESSION_TIPO_PROVEEDOR'];
                        }
                        foreach ($result as $key) {
                            if($key->id == $selected){
                                $cadena.='<option selected value="'.$key->id.'">'.$key->descripcion.'</option>';
                            }else{
                                $cadena.='<option value="'.$key->id.'">'.$key->descripcion.'</option>';
                            }
                        }
                    }
                    break;  
                case 'select_tipo_documento':
                    $cadena='<option value="">Tipo Documento</option>'; 
                    $result = $this->Mdl_compartido->get_data_select('*','tinfo_tipo_documento','estado','0');
                    if($result!='error'){
                        $selected =""; 
                        if(isset($_SESSION['SESSION_TIPO_DOCUMENTO'])){
                            $selected = $_SESSION['SESSION_TIPO_DOCUMENTO'];
                        }
                        foreach ($result as $key) {
                            if($key->id == $selected){
                                $cadena.='<option selected value="'.$key->id.'">'.$key->descripcion.'</option>';
                            }else{
                                $cadena.='<option value="'.$key->id.'">'.$key->descripcion.'</option>';
                            }
                        }
                    }
                    break;
                case 'select_tipo_documento_prov':
                    $cadena='<option value="">Tipo Documento</option>'; 
                    $result = $this->Mdl_compartido->get_data_select('*','tinfo_tipo_documento','document_prov','1');
                    if($result!='error'){
                        $selected =""; 
                        if(isset($_SESSION['SESSION_TIPO_DOCUMENTO_PROV'])){
                            $selected = $_SESSION['SESSION_TIPO_DOCUMENTO_PROV'];
                        }
                        foreach ($result as $key) {
                            if($key->id == $selected){
                                $cadena.='<option selected value="'.$key->id.'">'.$key->descripcion.'</option>';
                            }else{
                                $cadena.='<option value="'.$key->id.'">'.$key->descripcion.'</option>';
                            }
                        }
                    }
                    break;
                case 'unidad':
                    $cadena='<option value="">Unidad</option>'; 
                    $result = $this->Mdl_compartido->get_data_select('*','tb_unidad','estado','0');
                    break;                                
                default:
                    break;
            }


            $ar['resultado'] = $cadena; 
            echo json_encode($ar);
        }

        //ACTIVAMOS LOS FILTROS CON SESSIONES
        function active_filter(){
            $tipo = trim($this->input->post('tipo',true));
            $dato = trim($this->input->post('dato',true));
            $msj = '';

            switch ($tipo) {
                case 'select_sector':
                    if($dato!=''){
                        $_SESSION['SESSION_SECTOR']=$dato;
                        $msj = 'active';
                    }else{
                        unset($_SESSION['SESSION_SECTOR']);
                        $msj = 'inactive';
                    }
                    break;
                case 'select_tipo_documento':
                    if($dato!=''){
                        $_SESSION['SESSION_TIPO_DOCUMENTO']=$dato;
                        $msj = 'active';
                    }else{
                        unset($_SESSION['SESSION_TIPO_DOCUMENTO']);
                        $msj = 'inactive';
                    }
                    break;             
                case 'select_marca':
                    if($dato!=''){
                        $_SESSION['SESSION_MARCA']=$dato;
                        $msj = 'active';
                    }else{
                        unset($_SESSION['SESSION_MARCA']);
                        $msj = 'inactive';
                    }
                    break;
                case 'select_unidad':
                    if($dato!=''){
                        $_SESSION['SESSION_UNIDAD']=$dato;
                        $msj = 'active';
                    }else{
                        unset($_SESSION['SESSION_UNIDAD']);
                        $msj = 'inactive';
                    }
                    break;
                case 'select_estado':
                    if($dato!=''){
                        $_SESSION['SESSION_ESTADO']=$dato;
                        $msj = 'active';
                    }else{
                        unset($_SESSION['SESSION_ESTADO']);
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
