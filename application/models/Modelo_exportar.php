<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    require_once("file_all/pdf/dompdf/autoload.inc.php");
    use Dompdf\Dompdf;
    use Dompdf\Options;

    class Modelo_exportar extends CI_Model
    {
        function pdf_create($html)
        {
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $options = new Options();
            $options->setIsRemoteEnabled(true);
            $options->setIsHtml5ParserEnabled(true);
            $options->setDefaultPaperSize('a4');
            $options->setDefaultMediaType('print');
    
            $dompdf->setOptions($options);
            $dompdf->render();
            return $dompdf->output();
        }
        
        function exportar_producto(){
            $n=20;
            date_default_timezone_set('America/Lima');
            $string = '
                <table>
                    <tr align="" style="">';
                        $string .= '<td style="" rowspan="1">Nro</td>';
                        $string .= '<td style="" rowspan="1">Producto</td>';
                        $string .= '<td style="" rowspan="1">SKU</td>';
                        $string .= '<td style="" rowspan="1">'.utf8_decode("Categoría").'</td>';
                        $string .= '<td style="" rowspan="1">Marca</td>';
                        $string .= '<td style="" rowspan="1">'.utf8_decode("SubCategoría").'</td>';
                        $string .= '<td style="" rowspan="1">Precio</td>';
                        $string .= '<td style="" rowspan="1">Unidad</td>';
                        $string .= '<td style="" rowspan="1">Cantidad</td>';
                        $string .= '<td style="" rowspan="1">Usuario Registro</td>';
            $string .= '</tr>';
    
            $string .= '
                    </tr>
                    ';
            
                    $this->db->select('a.*,b.nombre as categoria,c.descripcion as marca,d.descripcion as subcategoria,e.descripcion as unidad,f.usuario');
                    $this->db->from('tb_producto as a');
                    $this->db->join('tb_categoria b','a.id_categoria=b.id','inner');
                    $this->db->join('tb_marca c','a.id_marca=c.id','inner');
                    $this->db->join('tb_subcategoria d','d.id=a.id_subcategoria','inner');
                    $this->db->join('tb_unidad e','e.id=a.id_unidad','inner');
                    $this->db->join('tb_usuarios2 f','f.coduser=a.user_registro','inner');
        
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
                    $this->db->order_by('a.f_registro asc');

                    $query = $this->db->get();
                    $contador=0;
                    foreach($query->result() as $item){
                        $contador++;
                        $string .= '<tr align="">';
                        $string .= '<td style="">'.utf8_decode($contador).'</td>'; //cod_id
                        $string .= '<td style="">'.utf8_decode($item->nombre).'</td>'; //cod_id
                        $string .= '<td style="">'.utf8_decode($item->sku).'</td>'; //alta_f
                        $string .= '<td style="">'.utf8_decode($item->categoria).'</td>'; //nrobase            
                        $string .= '<td style="">'.utf8_decode($item->marca).'</td>'; //nrobase            
                        $string .= '<td style="">'.utf8_decode($item->subcategoria).'</td>'; //nrobase            
                        $string .= '<td style="">'.utf8_decode($item->precio).'</td>'; //nrobase            
                        $string .= '<td style="">'.utf8_decode($item->unidad).'</td>'; //nrobase            
                        $string .= '<td style="">'.utf8_decode($item->cantidad).'</td>'; //nrobase            
                        $string .= '<td style="">'.utf8_decode($item->usuario).'</td>'; //nrobase            
                        $string .= '</tr>';
                    }
                    $string .= '</table>';
                    return $string;        
        }

        function exportar_category(){
            $n=20;
            date_default_timezone_set('America/Lima');
            $string = '
                <table>
                    <tr align="" style="">';
                        $string .= '<td style="" rowspan="1">Nro</td>';
                        $string .= '<td style="" rowspan="1">'.utf8_decode("Categoría").'</td>';
                        $string .= '<td style="" rowspan="1">'.utf8_decode("Descripción").'</td>';
            $string .= '</tr>';
    
            $string .= '
                    </tr>
                    ';
            
                    $this->db->select('a.*');
                    $this->db->from('tb_categoria as a');
                    $this->db->order_by('a.f_registro asc');
                    $query = $this->db->get();
                    $contador=0;
                    foreach($query->result() as $item){
                        $contador++;
                        $string .= '<tr align="">';
                        $string .= '<td style="">'.utf8_decode($contador).'</td>'; //cod_id
                        $string .= '<td style="">'.utf8_decode($item->nombre).'</td>'; //cod_id
                        $string .= '<td style="">'.utf8_decode($item->descripcion).'</td>'; //nrobase            
                        $string .= '</tr>';
                    }
                    $string .= '</table>';
                    return $string;        
        }

        function exportar_subcategory(){
            $n=20;
            date_default_timezone_set('America/Lima');
            $string = '
                <table>
                    <tr align="" style="">';
                        $string .= '<td style="" rowspan="1">Nro</td>';
                        $string .= '<td style="" rowspan="1">'.utf8_decode("Sub-Categoría").'</td>';
            $string .= '</tr>';
    
            $string .= '
                    </tr>
                    ';
            
                    $this->db->select('a.*');
                    $this->db->from('tb_subcategoria as a');
                    $this->db->order_by('a.f_registro asc');
                    $query = $this->db->get();
                    $contador=0;
                    foreach($query->result() as $item){
                        $contador++;
                        $string .= '<tr align="">';
                        $string .= '<td style="">'.utf8_decode($contador).'</td>'; //cod_id
                        $string .= '<td style="">'.utf8_decode($item->descripcion).'</td>'; //cod_id
                        $string .= '</tr>';
                    }
                    $string .= '</table>';
                    return $string;        
        }

        function exportar_brand(){
            $n=20;
            date_default_timezone_set('America/Lima');
            $string = '
                <table>
                    <tr align="" style="">';
                        $string .= '<td style="" rowspan="1">Nro</td>';
                        $string .= '<td style="" rowspan="1">'.utf8_decode("Marca").'</td>';
            $string .= '</tr>';
    
            $string .= '
                    </tr>
                    ';
            
                    $this->db->select('a.*');
                    $this->db->from('tb_marca as a');
                    $this->db->order_by('a.f_registro asc');
                    $query = $this->db->get();
                    $contador=0;
                    foreach($query->result() as $item){
                        $contador++;
                        $string .= '<tr align="">';
                        $string .= '<td style="">'.utf8_decode($contador).'</td>'; //cod_id
                        $string .= '<td style="">'.utf8_decode($item->descripcion).'</td>'; //cod_id
                        $string .= '</tr>';
                    }
                    $string .= '</table>';
                    return $string;        
        }
    }
?>