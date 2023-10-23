<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Modelo_producto extends CI_Model
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
            $this->db->select('a.*,b.nombre as categoria,c.descripcion as marca,d.descripcion as subcategoria,e.descripcion as unidad,f.usuario');
            $this->db->from($table);
            $this->db->join('tb_categoria b','a.id_categoria=b.id','inner');
            $this->db->join('tb_marca c','a.id_marca=c.id','inner');
            $this->db->join('tb_subcategoria d','d.id=a.id_subcategoria','inner');
            $this->db->join('tb_unidad e','e.id=a.id_unidad','inner');
            $this->db->join('tb_usuarios2 f','f.coduser=a.user_registro','inner');

            if(isset($_SESSION['SESSION_ESTADO'])){
                $this->db->where('a.estado',$_SESSION['SESSION_ESTADO']);
            }

            
            if(isset($_SESSION['SESSION_CATEGORIA'])){
                $this->db->where('a.id_categoria',$_SESSION['SESSION_CATEGORIA']);
            }
            if(isset($_SESSION['SESSION_SUBCATEGORIA'])){
                $this->db->where('a.id_subcategoria',$_SESSION['SESSION_SUBCATEGORIA']);
            }
            if(isset($_SESSION['SESSION_MARCA'])){
                $this->db->where('a.id_marca',$_SESSION['SESSION_MARCA']);
            }
            if(isset($_SESSION['SESSION_UNIDAD'])){
                $this->db->where('a.id_unidad',$_SESSION['SESSION_UNIDAD']);
            }

            if(isset($_POST["search"]["value"]))
            {
                $busc = $_POST["search"]["value"];
                $this->db->where("(a.nombre LIKE '%".$busc."%')", NULL, FALSE);
            }            
            $this->db->order_by('a.f_registro asc');
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
            $this->db->where('nombre',$dato);
            return $this->db->count_all_results();
        }  

        function insert($table,$array){
            return $this->db->insert($table,$array);
        }

        function get_data_product_detail($id)
        {  
            $this->db->select('a.*,b.nombre as categoria,c.descripcion as marca,d.descripcion as subcategoria,e.descripcion as unidad,f.usuario');
            $this->db->from('tb_producto a');
            $this->db->join('tb_categoria b','a.id_categoria=b.id','inner');
            $this->db->join('tb_marca c','a.id_marca=c.id','inner');
            $this->db->join('tb_subcategoria d','d.id=a.id_subcategoria','inner');
            $this->db->join('tb_unidad e','e.id=a.id_unidad','inner');
            $this->db->join('tb_usuarios2 f','f.coduser=a.user_registro','inner');
            $this->db->where('a.id',$id);
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result(); 
            }else{
                return 'error';
            } 
        }


        function get_data_productos()
        {  
            $this->db->select('a.*,b.nombre as categoria,c.descripcion as marca,d.descripcion as subcategoria,e.descripcion as unidad');
            $this->db->from('tb_producto a');
            $this->db->join('tb_categoria b','a.id_categoria=b.id','inner');
            $this->db->join('tb_marca c','a.id_marca=c.id','inner');
            $this->db->join('tb_subcategoria d','d.id=a.id_subcategoria','inner');
            $this->db->join('tb_unidad e','e.id=a.id_unidad','inner');
            $this->db->where('a.estado',0);
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