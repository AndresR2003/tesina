<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    require_once("file_all/pdf/dompdf/autoload.inc.php");
    use Dompdf\Dompdf;
    use Dompdf\Options;

    class Controller_exportar extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('Modelo_exportar');
            date_default_timezone_set('America/Lima');
        }

        public function exportar_producto(){
            //$usuarios = $this->Mdl_recojo->obtener_usuarios();
            //$fecha = $this->input->post('txt_fecha',true);
            $datas = $this->Modelo_exportar->exportar_producto();
            $datos['export'] =  $datas;
            $fecha= date('Y_m_d_H_i');
            $datos['nombre'] =  'lista_productos_'.$fecha;
            $this->load->view('templates/export',$datos); 
        }

        public function exportar_category(){
            //$usuarios = $this->Mdl_recojo->obtener_usuarios();
            //$fecha = $this->input->post('txt_fecha',true);
            $datas = $this->Modelo_exportar->exportar_category();
            $datos['export'] =  $datas;
            $fecha= date('Y_m_d_H_i');
            $datos['nombre'] =  'lista_categorias_'.$fecha;
            $this->load->view('templates/export',$datos); 
        }

        public function exportar_subcategory(){
            //$usuarios = $this->Mdl_recojo->obtener_usuarios();
            //$fecha = $this->input->post('txt_fecha',true);
            $datas = $this->Modelo_exportar->exportar_subcategory();
            $datos['export'] =  $datas;
            $fecha= date('Y_m_d_H_i');
            $datos['nombre'] =  'lista_subcategorias_'.$fecha;
            $this->load->view('templates/export',$datos); 
        }

        public function exportar_brand(){
            //$usuarios = $this->Mdl_recojo->obtener_usuarios();
            //$fecha = $this->input->post('txt_fecha',true);
            $datas = $this->Modelo_exportar->exportar_brand();
            $datos['export'] =  $datas;
            $fecha= date('Y_m_d_H_i');
            $datos['nombre'] =  'lista_marcas_'.$fecha;
            $this->load->view('templates/export',$datos); 
        }

        /*public function exportar_producto_pdf(){
            $html = $this->Modelo_exportar->exportar_producto();
            //echo $html;
            $this->Modelo_exportar->pdf_create($html);
        }*/

        public function exportar_producto_pdf(){
            $html = $this->Modelo_exportar->exportar_producto();
            //$html ='<h1>Hola mundo</h1>'; 
            $pdf = new Dompdf();
            $pdf->set_paper("A4", "portrait");
            $pdf->load_html(utf8_encode($html));
            $pdf->render();
            $pdf->stream('Lista_producto_.pdf');
        }

        public function exportar_category_pdf(){
            $html = $this->Modelo_exportar->exportar_category();
            //$html ='<h1>Hola mundo</h1>'; 
            $pdf = new Dompdf();
            $pdf->set_paper("A4", "portrait");
            $pdf->load_html(utf8_encode($html));
            $pdf->render();
            $pdf->stream('Lista_categorias_.pdf');
        }


        public function exportar_subcategory_pdf(){
            $html = $this->Modelo_exportar->exportar_subcategory();
            //$html ='<h1>Hola mundo</h1>'; 
            $pdf = new Dompdf();
            $pdf->set_paper("A4", "portrait");
            $pdf->load_html(utf8_encode($html));
            $pdf->render();
            $pdf->stream('Lista_subcategorias_.pdf');
        }

        public function exportar_brand_pdf(){
            $html = $this->Modelo_exportar->exportar_brand();
            //$html ='<h1>Hola mundo</h1>'; 
            $pdf = new Dompdf();
            $pdf->set_paper("A4", "portrait");
            $pdf->load_html(utf8_encode($html));
            $pdf->render();
            $pdf->stream('Lista_marcas_.pdf');
        }

    }

?>
