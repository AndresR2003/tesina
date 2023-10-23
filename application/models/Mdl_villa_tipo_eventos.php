<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Mdl_villa_tipo_eventos extends CI_Model
    {
        function get_data(){
            $this->db->select('*');
            $this->db->from('tinfo_tipo_evento');
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result(); 
            }else{
                return 'error';
            } 
        }
    
    }
    
?>