<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Mdl_villa_eventos extends CI_Model
    {
        function make_datatables(){
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
            $this->db->select('a.fecha_registro,a.id as id_evento,a.id as id_tipo_evento,a.id as id_cliente,d.usuario as usuario_registro,b.nombres as nombre_cliente,b.apellidos,b.celular_1,b.celular_2,b.nro_documento,c.descripcion as tipo_evento,e.descripcion as estado_evento,e.class');
            $this->db->from('tinfo_eventos a');
            $this->db->join('tinfo_clientes b','a.id_cliente=b.id','inner');
            $this->db->join('tinfo_tipo_evento c','a.id_tipo_evento=c.id','inner');
            $this->db->join('tb_usuarios2 d','a.usuario_registro=d.coduser','inner');
            $this->db->join('tinfo_estados_evento e','a.id_estado_evento=e.id','inner');

            if(isset($_SESSION['SESSION_ESTADO_EVENTO'])){
                $this->db->where('a.id_estado_evento',$_SESSION['SESSION_ESTADO_EVENTO']);
            }

            if(isset($_SESSION['SESSION_TIPO_EVENTO'])){
                $this->db->where('a.id_tipo_evento',$_SESSION['SESSION_TIPO_EVENTO']);
            }
            /*
            if(isset($_SESSION['SESSION_TIPO_DOCUMENTO'])){
                $this->db->where('a.id_tipo_documento',$_SESSION['SESSION_TIPO_DOCUMENTO']);
            }*/

            if(isset($_POST["search"]["value"]))
            {
                $busc = $_POST["search"]["value"];
                $this->db->where("(b.nombres LIKE '%".$busc."%' or d.usuario LIKE '%".$busc."%'  or b.nro_documento LIKE '%".$busc."%' )", NULL, FALSE);
            }            
            $this->db->order_by('a.fecha_registro desc');
        }

        function get_all_data()
        {
            $this->db->select('*');
            $this->db->from('tinfo_eventos a');
            return $this->db->count_all_results();
        }  
        
        function get_filtered_data(){
            $this->make_query();
            $query = $this->db->get();
            return $query->num_rows();
        }    

        function get_data_nro_documento($nro_documento)
        {  
            $this->db->select('a.*,b.descripcion as local,c.descripcion as tipo_documento,b.id as id_local,c.id as id_tipo_documento');
            $this->db->from('tinfo_clientes as a');
            $this->db->join('tinfo_locales b','a.id_sector=b.id','inner');
            $this->db->join('tinfo_tipo_documento c','a.id_tipo_documento=c.id','inner');
            $this->db->where('a.nro_documento',$nro_documento);
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
            $this->db->from('tinfo_eventos');
            $this->db->where('id',$id);
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result(); 
            }else{
                return 'error';
            } 
        }
        function update_estado_evento($array,$id_evento){
            $this->db->where('id',$id_evento);
            return $this->db->update('tinfo_eventos',$array);
        }
    }
    
?>