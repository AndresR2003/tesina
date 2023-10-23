<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Modelo_subcategoria extends CI_Model
    {
                /**/
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
            $this->db->select('a.*,b.nombres');
            $this->db->from($table.' a');
            $this->db->join('tb_usuarios2 b','a.user_registro=b.coduser','inner');
            
            if(isset($_SESSION['SESSION_ESTADO'])){
                $this->db->where('a.estado',$_SESSION['SESSION_ESTADO']);
            }

            if(isset($_POST["search"]["value"]))
            {
                $busc = $_POST["search"]["value"];
                $this->db->where("(a.descripcion LIKE '%".$busc."%')", NULL, FALSE);
            }            
            $this->db->order_by('a.f_registro desc');
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
            $this->db->where('descripcion',$dato);
            return $this->db->count_all_results();
        }  

        function insert($table,$array){
            return $this->db->insert($table,$array);
        }

        function get_data_details($id)
        {  
            $this->db->select('*');
            $this->db->from('tb_subcategoria a');
            $this->db->where('a.id',$id);
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