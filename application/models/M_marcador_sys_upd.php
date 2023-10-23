<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_marcador_sys_upd extends CI_Model
{   
    function get_selects($table,$campo,$dato){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($campo,$dato);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }
    
    function get_total_table($table,$lead_id){
        $this->db->select('*');
        $this->db->from($table.' as a');
        $this->db->where('lead_id',$lead_id);
        $this->db->where('delete',0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function valida_registro_doble_campo($table,$campo1,$dato1,$campo2,$dato2){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('delete',0);
        $this->db->where($campo1,$dato1);
        $this->db->where($campo2,$dato2);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function existe_registro($dato,$table,$campo){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($campo,$dato);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function insert_registros($table,$array){
        return $this->db->insert($table,$array);
    }

    function grabar_nuevo_numero($array){
        return $this->db->insert('asterisk.vicidial_list',$array);
    }
    
    function get_existe_phone_number($phone_number){
        $this->db->select('phone_number');
        $this->db->from('asterisk.vicidial_list');
        $this->db->where('list_id',$_SESSION['_SESSION_LIST_ID']);
        $this->db->where('phone_number',$phone_number);
        $this->db->where('vendor_lead_code',$_SESSION['_SESSION_VENDOR_LEAD_CODE']);
        $query = $this->db->get();
        return $query->num_rows();  
    }

    function get_data_vicidial_list(){
        $this->db->select('*');
        $this->db->from('asterisk.vicidial_list'); 
        $this->db->where('list_id',$_SESSION['_SESSION_LIST_ID']);
        $this->db->where('vendor_lead_code',$_SESSION['_SESSION_VENDOR_LEAD_CODE']);
        $this->db->order_by('rank','desc');
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return 'error';
        }
    }

    /*
        Para paginación
    */
    function get_total_registros_pag($table,$id_cuenta){
        $this->db->select('*');
        $this->db->from($table);
        if(isset($_SESSION['SESSION_SOL_ESTADO'])){
            $this->db->where('id_estado_solicitud',$_SESSION['SESSION_SOL_ESTADO']);
        }
        if(isset($_SESSION['SESSION_SOL_CONTRATO'])){
            $this->db->where('id_tipo_contrato',$_SESSION['SESSION_SOL_CONTRATO']);
        }
        if(isset($_SESSION['SESSION_SOL_FRECUENCIA'])){
            $this->db->where('id_frecuencia',$_SESSION['SESSION_SOL_FRECUENCIA']);
        } 
        if(isset($_SESSION['SESSION_SOL_MES'])){
            $this->db->where('month(date(f_registro))',$_SESSION['SESSION_SOL_MES']);
        }   
        $this->db->where('id_cuenta',$id_cuenta);
        $this->db->where('del=0');
        $query = $this->db->get();
        return $query->num_rows(); 
    }

    /*
        Get Indicadores
    */
    function get_totales_indicador($table,$id_cuenta){
        $this->db->select('a.insert as id_estado_solicitud,count(a.insert) as total');
        $this->db->from($table.' as a');
        $this->db->where('a.del=0');
        $this->db->where('a.id_cuenta',$id_cuenta);
        $this->db->group_by('a.insert');
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }

    function eliminar($table,$id)
    {
        return $this->db->delete($table, array('id' => $id));
    }  

    /*
        detalle
    */
    function update($table,$array,$id,$campo,$dato2,$campo2){
        $this->db->where($campo,$id);
        $this->db->where($campo2,$dato2);
        return $this->db->update($table,$array);
    }

    function update_datos($table,$array,$id,$campo){
        $this->db->where($campo,$id);
        return $this->db->update($table,$array);
    }
    
    function insert($table,$array){
        return $this->db->insert($table,$array);
    }

    function get_select($table,$id_cuenta=null){
        $this->db->select('*');
        $this->db->from($table);
        if($id_cuenta!=null)
        $this->db->where('id_cuenta',$id_cuenta);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }

    function get_select_x_id($table,$id,$campo){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($campo,$id);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }

    
    /*
        OBTENER SOLICITUDES
    */
    function get_registros_simple($table,$lead_id){
        $this->db->select('*');
        $this->db->from($table.' as a');
        $this->db->where('a.lead_id',$lead_id);
        $this->db->where('a.delete',0);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }

    function get_registros($table,$lead_id,$table2,$on){
        $this->db->select('a.*,b.descripcion as texto');
        $this->db->from($table.' as a');
        $this->db->join($table2.' as b',$on,'inner');
        $this->db->where('lead_id',$lead_id);
        $this->db->where('delete',0);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }

    function get_filtro_mes($table){
        $this->db->select('
            month(date(f_registro)) as mes
            ,CASE
                WHEN month(date(f_registro))= 1 THEN "ENERO"
                WHEN month(date(f_registro))= 2 THEN "FEBRERO"
                WHEN month(date(f_registro))= 3 THEN "MARZO"
                WHEN month(date(f_registro))= 4 THEN "ABRIL"
                WHEN month(date(f_registro))= 5 THEN "MAYO"
                WHEN month(date(f_registro))= 6 THEN "JUNIO"
                WHEN month(date(f_registro))= 7 THEN "JULIO"
                WHEN month(date(f_registro))= 8 THEN "AGOSTO"
                WHEN month(date(f_registro))= 9 THEN "SEPTIEMBRE"
                WHEN month(date(f_registro))= 10 THEN "OCTUBRE"
                WHEN month(date(f_registro))= 11 THEN "NOVIEMBRE"
                WHEN month(date(f_registro))= 12 THEN "DICIEMBRE"
                ELSE ""
            END AS descripcion
        ');
        $this->db->from($table);
        $this->db->where('del',0);
        $this->db->group_by('month(date(f_registro))');
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }













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
        $this->db->select('a.*,b.descripcion as tipo_servicio');
        $this->db->from($table.' as a');
        $this->db->join('tb_tipo_servicio as b','a.id_tipo_servicio=b.id','inner');
        if(isset($_POST["search"]["value"]))
        {
            $busc = $_POST["search"]["value"];
            $this->db->where("(a.descripcion LIKE '%".$busc."%')", NULL, FALSE);
        }            
        $this->db->order_by('a.f_registro asc');
    }

    function get_all_data($table)
    {
        $this->db->select('a.*,b.descripcion as tipo_servicio');
        $this->db->from($table.' as a');
        $this->db->join('tb_tipo_servicio as b','a.id_tipo_servicio=b.id','inner');
        return $this->db->count_all_results();
    }  
      
    function get_filtered_data($table){
        $this->make_query($table);
        $query = $this->db->get();
        return $query->num_rows();
    }      
    /**/

    function list($table,$table2=null){
        $this->db->select('a.*,b.descripcion as tipo_servicio');
        $this->db->from($table.' as a');
        $this->db->join($table2.' as b','a.id_tipo_servicio=b.id','inner');
        $this->db->order_by('tipo_servicio desc');
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'ok';
        } 
    }

    function validar($table,$dato,$id)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id!=',$id);
        $this->db->where('descripcion',$dato);
        return $this->db->count_all_results();
    }  

    function validar_x_id($table,$dato)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id',$dato);
        return $this->db->count_all_results();
    }  

    function get_data_x_id($table,$id){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id',$id);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }
    




    function get_datos($table,$id){
        $this->db->select('a.*,b.descripcion as puesto,b.descripcion as area');
        $this->db->from($table.' as a');
        $this->db->join('tb_tipouser as b','a.tipo_user=b.id','inner');
        $this->db->where('a.coduser',$id);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }
}