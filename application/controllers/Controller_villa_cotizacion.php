<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Controller_villa_cotizacion extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('Mdl_compartido');
            $this->load->model('Mdl_villa_cotizacion');
            date_default_timezone_set('America/Lima');
        }
        public function delete(){
            $id = trim($this->input->post('id',true));
            $result = $this->Mdl_villa_cotizacion->delete($id);
            if($result){
                echo 1;
            }else{
                echo 0;
            }
        }
        public function delete_x_id_cotizacion(){
            $id = trim($this->input->post('id',true));
            $result = $this->Mdl_villa_cotizacion->delete_x_id_cotizacion($id);
            if($result){
                echo 1;
            }else{
                echo 0;
            }
        }
        public function save_cotizacion(){
            $id_key = trim($this->input->post('id_key',true));  // Key temporal

            //Cotización
            $select_tipo_evento = trim($this->input->post('select_tipo_evento',true)); 

            //Data cliente 
            $input_nro_documento    = trim($this->input->post('input_nro_documento',true)); 
            $select_tipo_documento  = trim($this->input->post('select_tipo_documento',true)); 
            $input_nombre           = trim($this->input->post('input_nombre',true)); 
            $id_keyinput_apellido   = trim($this->input->post('input_apellido',true)); 
            $input_celular_1        = trim($this->input->post('input_celular_1',true)); 
            $input_celular_2        = trim($this->input->post('input_celular_2',true)); 
            $select_sector          = trim($this->input->post('select_sector',true)); 
            $input_direccion        = trim($this->input->post('input_direccion',true)); 
            $select_tipo_evento     = trim($this->input->post('select_tipo_evento',true)); 

            //Validación si el cliente se encuentra registrado 
            $result = $this->Mdl_villa_cotizacion->get_existe_cliente($input_nro_documento);
            if($result>0){
                //obtenemos el id del cliente 
                $id_cliente = $this->Mdl_compartido->retornarcampo($input_nro_documento,'nro_documento','tinfo_clientes',id);
                if($id_cliente>0){
                    $result = $this->Mdl_villa_cotizacion->get_data_x_key($id_key);
                    if($result!='error'){
                        //Registramos un evento nuevo
                        $array_event = array('id_tipo_evento'=>$select_tipo_evento,'fecha_registro'=>date('Y-m-d H:i:s'),usuario_registro=>$_SESSION['_SESSIONUSER'],'id_cliente'=>$id_cliente);
                        $result_id_event = $this->Mdl_compartido->insert_table_get_id('tinfo_eventos',$array_event);
                        if($result_id_event>0){
                            $array = array();
                            foreach ($result as $key) {
                                array_push($array,array('id_producto'=>$key->id_producto,'cantidad'=>$key->cantidad,'user_insert'=>$_SESSION['_SESSIONUSER'],'fecha_insert'=>date('Y-m-d H:i:s'),'id_cliente'=>$id_cliente,'id_evento'=>$result_id_event));
                            }
                            $resultado = $this->Mdl_villa_cotizacion->insert_batch($array);
                            if($resultado){
                                echo 'ok';
                            }else{
                                echo 'error_insert_productos';
                            }                            
                        }else{
                            echo 'error_insert_event'; 
                        }
                    }else{
                        echo 'sin_productos'; 
                    }
                }else{
                    echo 'sin_id_cliente';
                }
            }else{
                echo 'no_existe_cliente';
            }
        }

        public function add_temporal(){
            $id_producto = trim($this->input->post('id_producto',true));
            $cantidad = trim($this->input->post('cantidad',true));
            $id_key = trim($this->input->post('id_key',true));
            $array = array(
                'id_producto'=>$id_producto,
                'cantidad'=>$cantidad,
                'id_key'=>$id_key
            ); 
            $result = $this->Mdl_villa_cotizacion->insert('temp_cotizacion',$array);
            if($result){
                echo 1;
            }else{
                echo 0;
            }
        }

        public function add_cotizacion_producto(){
            $id_evento          = trim($this->input->post('id_evento',true));
            $id_producto        = trim($this->input->post('id_producto',true));
            $cantidad           = trim($this->input->post('cantidad',true));
            $id_cliente         = trim($this->input->post('id_cliente',true));
            $array = array(
                'id_evento'=>$id_evento,
                'id_cliente'=>$id_cliente,
                'id_producto'=>$id_producto,
                'cantidad'=>$cantidad,
                'user_insert'=>$_SESSION['_SESSIONUSER'],
                'fecha_insert'=>date('Y-m-d H:i:s')
            ); 
            $result = $this->Mdl_villa_cotizacion->insert('tinfo_cotizacion',$array);
            if($result){
                echo 1;
            }else{
                echo 0;
            }
        }

        public function get_temp_cotizacion(){
            $id_key = trim($this->input->post('id_key',true));
            $res   = $this->Mdl_villa_cotizacion->get_temp_cotizacion($id_key);
            echo json_encode($res);
        }

        public function get_cotizacion(){
            $id_evento = trim($this->input->post('id_evento',true));
            $res   = $this->Mdl_villa_cotizacion->get_cotizacion($id_evento);
            echo json_encode($res);
        }
    }

?>
