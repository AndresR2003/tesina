<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Mdl_locales extends CI_Model
    {
        function get_data(){
            $this->db->select('*');
            $this->db->from('tinfo_locales');
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result(); 
            }else{
                return 'error';
            } 
        }
    
    }
    
?>