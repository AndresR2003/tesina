<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_cargar_base extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib'); 
        $this->load->model('Mdl_compartido');         
        $this->load->model('M_cargar_base');       	
		$this->load->helper('download');	
        date_default_timezone_set('America/Lima');
    }

    public function index(){

		$header['menu_activo'] = 'v_cargar_base';
           // $this->desactivar_filtros();

            $data['datos']='';
            $header['datos_header']='';
            $header['lang']='en';

            $this->load->view('layouts/v_head',$header);
            $this->load->view('layouts/header',$header);
            $this->load->view('v_cargar_base', $data);
            $this->load->view('layouts/v_footer');

		

    }
	public function analizarTexto() {
		// Tu lógica para obtener el texto que deseas analizar
		$api_key = 'AIzaSyCfdWcxaggTV-D6Zdt4jgq8yTfbJN9M1I0';
		$texto = 'Este es un texto de prueba. Google Cloud es genial.';
		
		// URL de la API de Google Cloud Natural Language
		$url = 'https://language.googleapis.com/v1/documents:analyzeSentiment?key=' . $api_key;
	
		// Datos que se enviarán en el cuerpo de la solicitud
		$datos = json_encode([
			'document' => [
				'content' => $texto,
				'type' => 'PLAIN_TEXT'
			]
		]);
	
		// Configurar una solicitud cURL
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $datos);
	
		// Realizar la solicitud POST
		$respuesta = curl_exec($ch);
	
		// Comprobar si la solicitud fue exitosa
		if ($respuesta === false) {
			echo 'Error en la solicitud cURL: ' . curl_error($ch);
		} else {
			$datos = json_decode($respuesta, true);
	
			// Comprobar si se obtuvo una respuesta válida
			if ($datos !== null && isset($datos['documentSentiment'])) {
				$sentimiento = $datos['documentSentiment'];
	
				// Ahora puedes utilizar $sentimiento en tu vista o realizar otras operaciones
				echo 'Puntuación de sentimiento: ' . $sentimiento['score'];
				echo 'Magnitud del sentimiento: ' . $sentimiento['magnitude'];
			} else {
				echo 'No se pudo obtener una respuesta válida de la API.';
			}
		}
	
		// Cerrar la sesión cURL
		curl_close($ch);
	}
	
	
	
	

     public function exportar_plantilla(){
        $datas = $this->diseño_exportar(); 
        $datos['export'] =  $datas;
        $fecha= date('YmdHi');
        $datos['nombre'] =  'Plantilla_masivos_'.$fecha;
        $this->load->view('templates/export',$datos); 
    }

    public function diseño_exportar(){
        

    }

	public function cargar_datos_temporal_masivos() {
		$upload_path = './uploads/';
	
		if ($_FILES['file']['name']) {
			$inputFileName = $upload_path . $_FILES['file']['name'];
	
			// Mover el archivo a la ubicación deseada
			move_uploaded_file($_FILES['file']['tmp_name'], $inputFileName);
	
			// Cargar la biblioteca PhpSpreadsheet
			require_once FCPATH . 'vendor/autoload.php';
	
			// Comprueba si la carga de la librería fue exitosa
			if (!class_exists('PhpOffice\PhpSpreadsheet\IOFactory')) {
				echo 'La librería PhpSpreadsheet no se cargó correctamente. Verifica la ubicación del archivo autoload.php.';
				return;
			}
	
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
			$worksheet = $spreadsheet->getActiveSheet();
			$data = [];
	
			// Procesa las cabeceras (nombres de columna) desde la primera fila
			$header = [];
			$firstRow = true;
			foreach ($worksheet->getRowIterator() as $row) {
				foreach ($row->getCellIterator() as $cell) {
					if ($firstRow) {
						$header[] = $cell->getValue();
					}
				}
				if ($firstRow) {
					$firstRow = false;
				} else {
					$data_row = [];
					foreach ($row->getCellIterator() as $cell) {
						$data_row[] = (string)$cell->getValue(); // Convierte a cadena (VARCHAR)
					}
					$table_name = 'nueva_tabla_' . date('Y_m_d_H_i_s');
					$this->load->dbforge();
					$fields = [];
					foreach ($header as $column_name) {
						$fields[$column_name] = ['type' => 'VARCHAR(255)']; // Define el tipo de columna según tus necesidades
					}
					$this->dbforge->add_field($fields);
					$this->dbforge->create_table($table_name, TRUE);
					$this->db->insert($table_name, array_combine($header, $data_row));
				}
			}
	
			echo 'Datos cargados en la nueva tabla.';
		} else {
			echo 'error'; // En caso de que no se haya seleccionado un archivo
		}
	}
	
	
	

	public function exportar_inf_logo() {
		
		$file_path = FCPATH . 'public/plantilla/carga_caja.xlsx';
	
		if (file_exists($file_path)) {
			
			force_download('carga_caja.xlsx', file_get_contents($file_path));
		} else {			
			show_404();
		}
	}
	

    public function listar_temporal_masivo()
    {
        if (!empty($_POST))
        {
            $fetch_data = $this->M_cargar_base->make_datatables();
            $data = array();
            foreach($fetch_data as $row)
            {
               $sub_array = array();                         
               $sub_array[] = $row->list_id;  
               $sub_array[] = $row->dni; 
               $sub_array[] = $row->telefono; 
               $sub_array[] = $row->operador; 
               $sub_array[] = $row->mensaje; 
                
               //$sub_array[] = $row->mensaje;                

               $data[] = $sub_array;

                $output = array(
                    "draw"                =>     intval($_POST["draw"]),
                    "recordsTotal"        =>     $this->M_cargar_base->get_all_data(),
                    "recordsFiltered"     =>     $this->M_cargar_base->get_filtered(),
                    "data"                =>     $data
                );
                
            }   
            echo json_encode($output);
        } 
   }

   
    
 


}

?>
