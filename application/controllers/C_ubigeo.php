<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_ubigeo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->model('Mdl_compartido');
        $this->load->model('M_ubigeo');
        date_default_timezone_set('America/Lima');
    }

    function get_data_ubigeo(){
        $dato = trim($this->input->post('id',false));
        $tipo = trim($this->input->post('tipo',false));

        switch ($tipo) {
            case 'distrito':
                $res = $this->M_ubigeo->get_dataxid('tb_distrito','id_provincia',$dato);
                break;
            case 'departamento':
                $res = $this->M_ubigeo->get_data('tb_departamento');
                break;
            case 'provincia':
                $res = $this->M_ubigeo->get_dataxid('tb_provincia','id_departamento',$dato);
                break;
            default:
                break;
        }

        echo json_encode($res);
    }

    function get_data_provincia(){

    }

    function get_data_departamentos(){

    }
}
        