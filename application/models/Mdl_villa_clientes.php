<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Mdl_villa_clientes extends CI_Model
    {
        function make_datatables($table){
            $this->make_query($table);
            if($_POST["length"] != -1)
            {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
            $query = $this->db->get();
            return $query->result();
        }

        function make_query($table)
        {  
            $this->db->select('a.*,b.descripcion as local,c.descripcion as tipo_documento');
            $this->db->from($table);
            $this->db->join('tinfo_locales b','a.id_sector=b.id','inner');
            $this->db->join('tinfo_tipo_documento c','a.id_tipo_documento=c.id','inner');

            if(isset($_SESSION['SESSION_ESTADO'])){
                $this->db->where('a.estado',$_SESSION['SESSION_ESTADO']);
            }

            if(isset($_SESSION['SESSION_SECTOR'])){
                $this->db->where('a.id_sector',$_SESSION['SESSION_SECTOR']);
            }

            if(isset($_SESSION['SESSION_TIPO_DOCUMENTO'])){
                $this->db->where('a.id_tipo_documento',$_SESSION['SESSION_TIPO_DOCUMENTO']);
            }

            if(isset($_POST["search"]["value"]))
            {
                $busc = $_POST["search"]["value"];
                $this->db->where("(a.nombres LIKE '%".$busc."%' or a.nro_documento LIKE '%".$busc."%')", NULL, FALSE);
            }            
            $this->db->order_by('a.fecha_alta asc');
        }

        function get_all_data($table)
        {
            $this->db->select('*');
            $this->db->from($table);
            return $this->db->count_all_results();
        }  
        
        function get_filtered_data($table){
            $this->make_query($table);
            $query = $this->db->get();
            return $query->num_rows();
        }    

        function get_data_table($table,$array){
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
    
        function validar($table,$dato)
        {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where('nro_documento',$dato);
            return $this->db->count_all_results();
        }  

        function insert($table,$array){
            return $this->db->insert($table,$array);
        }

        function get_data_detail($id)
        {  
            $this->db->select('a.*,b.descripcion as local,c.descripcion as tipo_documento,b.id as id_local,c.id as id_tipo_documento');
            $this->db->from('tinfo_clientes as a');
            $this->db->join('tinfo_locales b','a.id_sector=b.id','inner');
            $this->db->join('tinfo_tipo_documento c','a.id_tipo_documento=c.id','inner');
            $this->db->where('a.id',$id);
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result(); 
            }else{
                return 'error';
            } 
        }

        function get_data_x_id($id)
        {  
            $this->db->select('*');
            $this->db->from('tinfo_clientes');
            $this->db->where('id',$id);
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result(); 
            }else{
                return 'error';
            } 
        }

        function update($table,$array,$id,$campo){
            $this->db->where($campo,$id);
            return $this->db->update($table,$array);
        }
    }
    
?>