<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_cargar_base extends CI_Model
{   
    function insert($table,$array){
        return $this->db->insert($table,$array);
    }
    function insert_full($table,$data){
        return $this->db->insert_batch($table,$data);
    }

    function get_datos($table,$array){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($array);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }
  
    function get_estado_id($table,$array){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($array);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }
    function obtener_datos_temporal(){
        $this->db->select('*');
        $this->db->from('BBDD_COBRANZA.tb_temp_masivos');
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 

    }
    function truncate_table($table){
        $this->db->truncate($table); 
    }

    // CONSULTA PARA OBTENER LOS DATOS DE NUESTRA TABLA TEMPORAL DE MASIVOS
    function make_datatables()
    {
        $this->make_query();
        if($_POST["length"] != -1)
        {
            $this->db->limit($_POST['length'], $_POST['start']);
        }        
        $query = $this->db->get();
        return $query->result();
    }
  

    function make_query()
    {  
        $this->db->select(' TRIM(list_id) AS list_id,
                            TRIM(dni) AS dni,
                            TRIM(operador) AS operador,
                            TRIM(telefono) AS telefono,
                            TRIM(mensaje) AS mensaje');

        $this->db->from('BBDD_COBRANZA.tb_temp_masivos');
//$this->db->group_By('estado');
        //$this->db->group_By('date(fecha_envio)');
     /* if(isset($_POST["search"]["value"]))
            {
                $busc = $_POST["search"]["value"];
                $this->db->where("(fecha_de_registro LIKE '%".$busc."%')", NULL, FALSE);
            }    */           
    }  

    function get_all_data()
        {
             $this->db->select('*');
                            
            $this->db->from('BBDD_COBRANZA.tb_temp_masivos');
            return $this->db->count_all_results();
        }

        function get_filtered()
        {
            $this->make_query();
            $query = $this->db->get();
            return $query->num_rows();
        }  

    // FIN DE CONSULTA PARA OBTENER LOS DATOS DE NUESTRA TABLA TEMPORAL DE MASIVOS
   
   
}
