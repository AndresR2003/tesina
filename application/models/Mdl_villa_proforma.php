<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Mdl_villa_proforma extends CI_Model
    {
        function get_proforma()
        {  
            $this->db->select('a.*');
            $this->db->from('tinfo_proforma as a');
            $this->db->where('a.estado',0);
            $this->db->order_by('descripcion','asc');
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result(); 
            }else{
                return 'error';
            } 
        }
    }
    
?>