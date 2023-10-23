<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Mdl_villa_tipo_documento extends CI_Model
    {
        function get_data(){
            $this->db->select('*');
            $this->db->from('tinfo_tipo_documento');
            $this->db->where_not_in('id', array(4));
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result(); 
            }else{
                return 'error';
            } 
        }

        function get_data_proveedor(){
            $this->db->select('*');
            $this->db->from('tinfo_tipo_documento');
            $this->db->where_in('id', array(1, 4));
            $query = $this->db->get();           
            if($query->num_rows()>0){
                return $query->result(); 
            }else{
                return 'error';
            } 
        }
    
    }
    
?>