<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Mdl_villa_cotizacion extends CI_Model
    {
        function get_existe_cliente($nro)
        {  
            $this->db->select('a.*');
            $this->db->from('tinfo_clientes as a');
            $this->db->where('a.nro_documento',$nro);
            $query = $this->db->get();
            return $query->num_rows();
        }

        function insert_batch($array){
            return $this->db->insert_batch('tinfo_cotizacion',$array);
        }

        function delete($id){
            $this->db->where('id',$id);
            return $this->db->delete('temp_cotizacion');
        }

        function delete_x_id_cotizacion($id){
            $this->db->where('id',$id);
            return $this->db->delete('tinfo_cotizacion');
        }

        function insert($table,$array){
            return $this->db->insert($table,$array);
        }

        function get_data_x_key($id_key)
        {  
            $this->db->select('a.*');
            $this->db->from('temp_cotizacion as a');
            $this->db->where('a.id_key',$id_key);
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result(); 
            }else{
                return 'error';
            } 
        }

        function get_temp_cotizacion($id_key)
        {  
            $this->db->select('a.*,b.nombre,b.precio');
            $this->db->from('temp_cotizacion as a');
            $this->db->join('tb_producto b','a.id_producto=b.id','inner');
            $this->db->where('a.id_key',$id_key);
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result(); 
            }else{
                return 'error';
            } 
        }

        function get_cotizacion($id)
        {  
            $this->db->select('a.*,b.nombre,b.precio');
            $this->db->from('tinfo_cotizacion as a');
            $this->db->join('tb_producto b','a.id_producto=b.id','inner');
            $this->db->where('a.id_evento',$id);
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result(); 
            }else{
                return 'error';
            } 
        }
    }
    
?>