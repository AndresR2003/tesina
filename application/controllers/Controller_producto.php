<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Controller_producto extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->library('image_lib');
            $this->load->model('Mdl_compartido');
            $this->load->model('Modelo_producto');
            date_default_timezone_set('America/Lima');
        }

        public function index(){
            /*
            $permiso = $this->Mdl_compartido->permisos_controlador('actividad');
            if (!$permiso)
                redirect('');
            
            if(!isset($_SESSION['_SESSIONUSER'])){
                redirect('login');
            }
            $header['menu'] = $this->Mdl_compartido->permisos_menu();
            */
            $header['menu_activo'] = 'product_list';
            $this->desactivar_filtros();

            $data['datos']='';
            $header['datos_header']='';
            $header['lang']='en';

            $this->load->view('layouts/v_head',$header);
            $this->load->view('layouts/header',$header);
            $this->load->view('vista_producto', $data);
            $this->load->view('layouts/v_footer');

        }

        public function listar()
        {
            if (!empty($_POST))
            {
                $fetch_data = $this->Modelo_producto->make_datatables('tb_producto  a');
                $data = array();
                $contador=0; 
                foreach($fetch_data as $row)
                {
                    $contador++; 
                    $sub_array = array();
                    $sub_array[] = $contador;
                    $sub_array[] = $row->nombre;
                    if($row->estado){
                        //badges bg-lightred
                        $sub_array[]='<span class="badges bg-lightred">Inactivo</span>';
                    }else{
                        $sub_array[]='<span class="badges bg-lightgreen">Activo</span>';
                    }
                    $sub_array[] = $row->sku;
                    $sub_array[] = $row->categoria;
                    $sub_array[] = $row->marca;
                    $sub_array[] = $row->subcategoria;
                    $sub_array[] = $row->precio;
                    $sub_array[] = $row->unidad;
                    $sub_array[] = $row->cantidad;
                    $sub_array[] = $row->usuario;
                    $sub_array[] = '
                        <!--<a class="me-3" href="'.base_url().'product_detail/'.$row->id.'">
                            <img src="'.base_url().'public/assets/img/icons/eye.svg" alt="img">
                        </a>-->
                        <a class="me-3" href="'.base_url().'product_edit/'.$row->id.'">
                            <img src="'.base_url().'public/assets/img/icons/edit.svg" alt="img">
                        </a>
                        <!--<a class="confirm-text" href="javascript:void(0);">
                            <img src="'.base_url().'public/assets/img/icons/delete.svg" alt="img">
                        </a>--> 
                    ';
                    $data[] = $sub_array;
                }
                $output = array(
                    "draw"                    =>     intval($_POST["draw"]),
                    "recordsTotal"          =>      $this->Modelo_producto->get_all_data('tb_producto a'),
                    "recordsFiltered"     =>     $this->Modelo_producto->get_filtered_data('tb_producto a'),
                    "data"                    =>     $data
                );
                echo json_encode($output);
            }
        }

        public function add_product(){
            $data['lst_marca']       = $this->Modelo_producto->get_data_table('tb_marca',array('estado'=>0));
            $data['lst_categoria']   = $this->Modelo_producto->get_data_table('tb_categoria',array('estado'=>0));
            $data['lst_subcategoria']= $this->Modelo_producto->get_data_table('tb_subcategoria',array('estado'=>0));

            $data['datos']='';
            $header['datos_header']='';
            $header['lang']='en';
            $header['menu_activo'] = 'product_add';

            $this->load->view('layouts/v_head',$header);
            $this->load->view('layouts/header',$header);
            $this->load->view('vista_add_producto',$data);
            $this->load->view('layouts/v_footer');

        }
		function buscar_persona_fail(){
			$dni = trim($this->input->post('dni',true));

			$token = 'apis-token-5646.ij9ASB5p2qbiX-B-plDDGSEhtySFj0EJ';
			//$dni = '46027897';

			
			$curl = curl_init();

			
			curl_setopt_array($curl, array(
			
			CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero='.$dni,
			
			
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 2,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Referer: https://apis.net.pe/consulta-dni-api',
				'Authorization: Bearer ' . $token
			),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			
			$persona = json_decode($response);
			var_dump($persona); 
        }
		public function buscar_persona() {

			$dni = trim($this->input->post('dni', true));		
			// URL de la API con el número de DNI y el token
			$api_url = "https://dniruc.apisperu.com/api/v1/dni/{$dni}?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImFuZHJlc21hdHRvczIwMDNAZ21haWwuY29tIn0.CeRKicE11PxRIUGeHhWLwcL3xDi13idwwx2ljO3pDd8";
		
			
			$curl = curl_init();			
			
			curl_setopt_array($curl, array(
				CURLOPT_URL => $api_url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_SSL_VERIFYPEER => false, 
			));			
			
			$response = curl_exec($curl);		
			// Verificar si hubo errores en la llamada a la API
			if (curl_errno($curl)) {
				// Manejo de errores, por ejemplo, mostrar un mensaje de error o registrar el error en el registro de errores
				echo 'Error en la llamada a la API: ' . curl_error($curl);
			} else {
				// Procesar la respuesta de la API
				$persona = json_decode($response);				
				// Devolver la respuesta como JSON (puedes personalizar esto según tus necesidades)
				header('Content-Type: application/json');
				echo json_encode($persona);
			}			
			// Cerrar la sesión cURL
			curl_close($curl);
			$datos_insertar = array(
				'nombre' => $persona->nombres,
				'ape_pat' => $persona->apellidoPaterno,
				'ape_mat' => $persona->apellidoMaterno,
				'dni' => $persona->dni,
				'codigo_verificacion' =>$persona->codVerifica,
				'fecha_busqueda' => date('Y-m-d H:m:s')				
			);
			
			$result = $this->Modelo_producto->insert('historial_busqueda', $datos_insertar);
		}

		public function buscar_ruc() {

			$ruc = trim($this->input->post('ruc', true));		
			// URL de la API con el número de DNI y el token
			$api_url = "https://dniruc.apisperu.com/api/v1/ruc/{$ruc}?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImFuZHJlc21hdHRvczIwMDNAZ21haWwuY29tIn0.CeRKicE11PxRIUGeHhWLwcL3xDi13idwwx2ljO3pDd8";
		
			// Iniciar la llamada a la API utilizando cURL
			$curl = curl_init();
			
			// Configurar opciones de cURL
			curl_setopt_array($curl, array(
				CURLOPT_URL => $api_url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_SSL_VERIFYPEER => false, // Esto desactiva la verificación SSL, ten cuidado en producción
			));
			
			// Ejecutar la llamada a la API y obtener la respuesta
			$response = curl_exec($curl);
		
			// Verificar si hubo errores en la llamada a la API
			if (curl_errno($curl)) {
				// Manejo de errores, por ejemplo, mostrar un mensaje de error o registrar el error en el registro de errores
				echo 'Error en la llamada a la API: ' . curl_error($curl);
			} else {
				// Procesar la respuesta de la API
				$persona = json_decode($response);				
				// Devolver la respuesta como JSON (puedes personalizar esto según tus necesidades)
				header('Content-Type: application/json');
				echo json_encode($persona);
			}
			
			
			// Cerrar la sesión cURL
			curl_close($curl);
			/* $datos_insertar = array(
				'nombre' => $persona->nombres,
				'ape_pat' => $persona->apellidoPaterno,
				'ape_mat' => $persona->apellidoMaterno,
				'dni' => $persona->dni,
				'codigo_verificacion' =>$persona->codVerifica,
				'fecha_busqueda' => date('Y-m-d H:m:s')
				
			);
			
			$result = $this->Modelo_producto->insert('historial_busqueda', $datos_insertar); */
		}

        function insert_product(){
            $input_nombre = trim($this->input->post('input_nombre',true));
            $select_categoria = trim($this->input->post('select_categoria',true));
            $select_subcategoria = trim($this->input->post('select_subcategoria',true));
            $select_marca = trim($this->input->post('select_marca',true));
            $select_unidad = trim($this->input->post('select_unidad',true));
            $input_sku = trim($this->input->post('input_sku',true));
            $input_cantidad = trim($this->input->post('input_cantidad',true));
            $input_descripcion = trim($this->input->post('input_descripcion',true));
            $input_precio = trim($this->input->post('input_precio',true));
            $select_estado = trim($this->input->post('select_estado',true));
            $valida = $this->Modelo_producto->validar('tb_producto',true);
            if($valida<=0){
                $array = array(
                    'nombre' =>$input_nombre,
                    'sku' =>$input_sku,
                    'id_marca' =>$select_marca,
                    'id_categoria' =>$select_categoria,
                    'id_subcategoria' =>$select_subcategoria,
                    'estado' =>$select_estado,
                    'precio' =>$input_precio,
                    'cantidad' =>$input_cantidad,
                    'user_registro' =>150,
                    'descripcion' =>$input_descripcion,
                    'id_unidad' =>$select_unidad,
                    'f_registro'=>date('Y-m-d H:m:s')
                );
        
                $result = $this->Modelo_producto->insert('tb_producto',$array);
                echo $result;
            }else{
                echo 'duplicado';
            }
        }

        public function detail_product($id){
            $data['lst_data']= $this->Modelo_producto->get_data_product_detail($id);
            $header['datos_header']='';
            $header['lang']='en';
            $this->load->view('layouts/v_head',$header);
            $this->load->view('layouts/header',$header);
            $this->load->view('vista_detail_product',$data);
            $this->load->view('layouts/v_footer');
        }

        public function product_edit($id){
            $data['lst_marca']       = $this->Modelo_producto->get_data_table('tb_marca',array('estado'=>0));
            $data['lst_categoria']   = $this->Modelo_producto->get_data_table('tb_categoria',array('estado'=>0));
            $data['lst_subcategoria']= $this->Modelo_producto->get_data_table('tb_subcategoria',array('estado'=>0));
            $data['lst_unidad']= $this->Modelo_producto->get_data_table('tb_unidad',array('estado'=>0));

            $data['lst_data']= $this->Modelo_producto->get_data_product_detail($id);
            $header['datos_header']='';
            $header['lang']='en';
            $this->load->view('layouts/v_head',$header);
            $this->load->view('layouts/header',$header);
            $this->load->view('vista_edit_product',$data);
            $this->load->view('layouts/v_footer');
        }

        public function update(){
            $id = trim($this->input->post('id',true));
            $input_nombre = trim($this->input->post('input_nombre',true));
            $select_marca = trim($this->input->post('select_marca',true));
            $select_categoria = trim($this->input->post('select_categoria',true));
            $select_subcategoria = trim($this->input->post('select_subcategoria',true));
            $select_unidad = trim($this->input->post('select_unidad',true));
            $input_sku = trim($this->input->post('input_sku',true));
            $input_cantidad = trim($this->input->post('input_cantidad',true));
            $input_descripcion = trim($this->input->post('input_descripcion',true));
            $input_precio = trim($this->input->post('input_precio',true));
            $select_estado = trim($this->input->post('select_estado',true));

            $arr = array(
                'nombre'=>$input_nombre,
                'id_marca'=>$select_marca,
                'id_categoria'=>$select_categoria,
                'id_subcategoria'=>$select_subcategoria,
                'id_unidad'=>$select_unidad,
                'sku'=>$input_sku,
                'cantidad'=>$input_cantidad,
                'descripcion'=>$input_descripcion,
                'precio'=>$input_precio,
                'estado'=>$select_estado
            );

            $res = $this->Modelo_producto->update('tb_producto',$arr,$id,'id');
            echo $res;
        }

        public function desactivar_filtros(){
            unset($_SESSION['SESSION_CATEGORIA']);
            unset($_SESSION['SESSION_SUBCATEGORIA']);
            unset($_SESSION['SESSION_MARCA']);
            unset($_SESSION['SESSION_UNIDAD']);
        }
    }

?>
