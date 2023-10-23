<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_villa_estados_proveedores extends CI_Model
{
    public function get_data()
    {
        $this->db->select('*');
        $this->db->from('tinfo_estados_proveedor');
        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 'error';
        }
    }
}
