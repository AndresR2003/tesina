<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_candidato extends CI_Model
{   
    function update($table,$array,$id,$campo){
        $this->db->where($campo,$id);
        return $this->db->update($table,$array);
    }
    
    function insert_id($table,$array){
        $this->db->insert($table,$array);
        return $this->db->insert_id();
    }

    function get_solicitud_activa(){
        $this->db->select('a.id,b.descripcion as cargo,c.descripcion as area');
        $this->db->from('solicitud a');
        $this->db->join('cargo as b','a.id_cargo=b.id','inner');
        $this->db->join('area as c','a.id_area=c.id','inner');
        $this->db->where('id_estado_solicitud',1);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        }
    }

    function get_solicitud_x_candidato($id_candidato){
        $this->db->select('a.id,a.id_solicitud,b.descripcion as cargo,c.descripcion as area,a.f_registro');
        $this->db->from('candidatoxsolicitud a');
        $this->db->join('solicitud as d','a.id_solicitud=d.id','inner');
        $this->db->join('cargo as b','d.id_cargo=b.id','inner');
        $this->db->join('area as c','d.id_area=c.id','inner');
        $this->db->where('id_estado_solicitud',1);
        $this->db->where('a.id_candidato',$id_candidato);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        }
    }
}