<?php
namespace App\Backend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Servicios extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $servicios;

		$content['v_ser'] = $content['v_ser_4']  = 'active';

		$content['modulo'] = "Servicios";

		$content['sector'] = "Servicios";
		$content['back'] = _HOST_.'/admin/servicios';

		$content['title'] = "Servicios";
		$content['cabezado'] = "Listado";

		$cservicios = file_get_contents(_DATA_ . '/servicios.json');
		$cservicios = json_decode($cservicios, true);
		
		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $servicios->tabla($requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $servicios->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/servicios\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/servicios/servicios.twig', ['content' => $content, 'cservicios' => $cservicios, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $servicios, $servicios_lineas, $servicios_categorias, $servicios_subcategorias, $functions;

		$content['v_ser'] = $content['v_ser_4']  = 'active';

		$content['modulo'] = "Servicios";
		$content['sector'] = "Servicios";
		$content['back'] = _HOST_.'/admin/servicios';

		$content['title'] = "Servicios";
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$cservicios = file_get_contents(_DATA_ . '/servicios.json');
		$cservicios = json_decode($cservicios, true);
		
		$return_data = null;

		if(isset($_GET['title'])){
			if (isset($_POST['json'])) {
				$json = (isset($_POST['json'])) ? trim($_POST['json']) : '';
				echo $functions->seo($json);
				return $response;
			}
		}

		if(isset($_GET['json'])){

			if(isset($_POST['form'])){
				$form = trim($_POST['form']);
				if($form == "lineas"){
					$lineas = trim($_POST['lineas']);
					$return_data['type'] = 'success';
					$return_data['data'] = $servicios_categorias->select(null, $lineas);
				}else if($form == "categorias"){
					$categorias = trim($_POST['categorias']);
					$return_data['type'] = 'success';
					$return_data['data'] = $servicios_subcategorias->select(null, $categorias);
				}else{
					$return_data['type'] = 'error';
					$return_data['msje'] = 'Error no se pudo consultar en la base de datos. Intente de nuevo.';
				}
				echo json_encode($return_data);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_POST['btn-save'])){

			$name_servicios = trim($_POST['name_servicios']);
			$seo_servicios = (isset($_POST['seo_servicios'])) ? trim($_POST['seo_servicios']) : '';
			$active_servicios = trim($_POST['active_servicios']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$id_lineas = (isset($_POST['id_lineas'])) ? trim($_POST['id_lineas']) : 0;
			$id_categorias = (isset($_POST['id_categorias'])) ? trim($_POST['id_categorias']) : 0;
			$id_subcategorias = (isset($_POST['id_subcategorias'])) ? trim($_POST['id_subcategorias']) : 0;


			//envio de nombre de imagenes de la db actual
			$photo = (isset($_POST['photo'])) ? $_POST['photo'] : array();

			//envio de archivos
			$photo_send = (isset($_FILES['photo_send'])) ? $_FILES['photo_send'] : array();

			//Aqui para probar lo que se envia
			// print_r($photo);
			// print_r($photo_send);
			// print_r($cservicios);
			// exit();

			$functions->msje = '';


			//Agregar imagenes actuales
			$photo_servicios = $photo;

			//Verificar data de imagenes
			if (count($photo_send) > 0) {

				$files = array();
				//Verificar cantidad de imagenes
				foreach ($photo_send['name'] as $key => $value) {
					$files[] = $key;
				}

				if (count($files) > 0) {
					foreach ($files as $key => $value) {


						if($photo_send['name'][$value] != ""){

							//Nombre de variable $value ejemplo "fondo"

							//Independizar Imagen
							$fotos = array();
							$fotos['name'] = $photo_send['name'][$value];
							$fotos['size'] = $photo_send['size'][$value];
							$fotos['tmp_name'] = $photo_send['tmp_name'][$value];

							$max[0]['size'] = $cservicios[$value]['size'];
							$max[0]['path'] = $value . '/big/';
							$max[1]['size'] = 300;
							$max[1]['path'] = $value . '/small/';

							$nombre = $name_servicios;

							$path = _HOSTDIR_."/uploads/servicios/";


							$ext = explode(".", $fotos['name']);
							$extension = end($ext);
							$photo_servicios_name = $functions->seo(trim($nombre)) .".".$extension;
							$actual = $photo[$value];


							if($functions->imagen($fotos, $max, $photo_servicios_name, $path, $actual)){
								$photo_servicios[$value] = $photo_servicios_name;
							}
						}
					}
				}

			}

			//Guardar imagenes
			$photo_servicios = json_encode($photo_servicios);


			if($servicios->add($name_servicios, $seo_servicios, $active_servicios, $photo_servicios, $id_lineas, $id_categorias, $id_subcategorias, $extra)){
				$this->functions->redirect(_HOST_."/admin/servicios?n");
				return $response;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/servicios/servicios.twig', ['content' => $content, 'cservicios' => $cservicios, 'args' => $args, 'return_data' => $return_data, 'servicios_lineas' => $servicios_lineas, 'servicios_categorias' => $servicios_categorias, 'servicios_subcategorias' => $servicios_subcategorias]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $servicios, $servicios_lineas, $servicios_categorias, $servicios_subcategorias, $functions;

		$content['v_ser'] = $content['v_ser_4']  = 'active';

		$content['modulo'] = "Servicios";
		$content['sector'] = "Servicios";
		$content['back'] = _HOST_.'/admin/servicios';

		$content['title'] = "Servicios";
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$cservicios = file_get_contents(_DATA_ . '/servicios.json');
		$cservicios = json_decode($cservicios, true);
		
		$return_data = null;

		if(isset($_GET['title'])){
			if (isset($_POST['json'])) {
				$json = (isset($_POST['json'])) ? trim($_POST['json']) : '';
				echo $functions->seo($json);
				return $response;
			}
		}

		if(isset($_GET['json'])){

			if(isset($_POST['form'])){
				$form = trim($_POST['form']);
				if($form == "lineas"){
					$lineas = trim($_POST['lineas']);
					$return_data['type'] = 'success';
					$return_data['data'] = $servicios_categorias->select(null, $lineas);
				}else if($form == "categorias"){
					$categorias = trim($_POST['categorias']);
					$return_data['type'] = 'success';
					$return_data['data'] = $servicios_subcategorias->select(null, $categorias);
				}else{
					$return_data['type'] = 'error';
					$return_data['msje'] = 'Error no se pudo consultar en la base de datos. Intente de nuevo.';
				}
				echo json_encode($return_data);
				return $response->withHeader('Content-type', 'application/json');
			}
		}


		if(isset($_POST['btn-save'])){

			$name_servicios = trim($_POST['name_servicios']);
			$seo_servicios = (isset($_POST['seo_servicios'])) ? trim($_POST['seo_servicios']) : '';
			$active_servicios = trim($_POST['active_servicios']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$id_lineas = (isset($_POST['id_lineas'])) ? trim($_POST['id_lineas']) : 0;
			$id_categorias = (isset($_POST['id_categorias'])) ? trim($_POST['id_categorias']) : 0;
			$id_subcategorias = (isset($_POST['id_subcategorias'])) ? trim($_POST['id_subcategorias']) : 0;

			//envio de nombre de imagenes de la db actual
			$photo = (isset($_POST['photo'])) ? $_POST['photo'] : array();

			//envio de archivos
			$photo_send = (isset($_FILES['photo_send'])) ? $_FILES['photo_send'] : array();

			//Aqui para probar lo que se envia
			// print_r($photo);
			// print_r($photo_send);
			// print_r($cservicios);
			// exit();

			$functions->msje = '';


			//Agregar imagenes actuales
			$photo_servicios = $photo;

			//Verificar data de imagenes
			if (count($photo_send) > 0) {

				$files = array();
				//Verificar cantidad de imagenes
				foreach ($photo_send['name'] as $key => $value) {
					$files[] = $key;
				}

				if (count($files) > 0) {
					foreach ($files as $key => $value) {


						if($photo_send['name'][$value] != ""){

							//Nombre de variable $value ejemplo "fondo"

							//Independizar Imagen
							$fotos = array();
							$fotos['name'] = $photo_send['name'][$value];
							$fotos['size'] = $photo_send['size'][$value];
							$fotos['tmp_name'] = $photo_send['tmp_name'][$value];

							$max[0]['size'] = $cservicios[$value]['size'];
							$max[0]['path'] = $value . '/big/';
							$max[1]['size'] = 300;
							$max[1]['path'] = $value . '/small/';

							$nombre = $name_servicios;

							$path = _HOSTDIR_."/uploads/servicios/";


							$ext = explode(".", $fotos['name']);
							$extension = end($ext);
							$photo_servicios_name = $functions->seo(trim($nombre)) .".".$extension;
							$actual = $photo[$value];


							if($functions->imagen($fotos, $max, $photo_servicios_name, $path, $actual)){
								$photo_servicios[$value] = $photo_servicios_name;
							}
						}
					}
				}

			}

			//Guardar imagenes
			$photo_servicios = json_encode($photo_servicios);

			if($servicios->update($args['id'], $name_servicios, $seo_servicios, $active_servicios, $photo_servicios, $id_lineas, $id_categorias, $id_subcategorias, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$servicios->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/servicios/servicios.twig', ['content' => $content, 'cservicios' => $cservicios, 'args' => $args, 'return_data' => $return_data, 'servicios' => $servicios, 'servicios_lineas' => $servicios_lineas, 'servicios_categorias' => $servicios_categorias, 'servicios_subcategorias' => $servicios_subcategorias]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $servicios, $servicios_lineas, $servicios_categorias, $servicios_subcategorias, $functions;

		$content['v_ser'] = $content['v_ser_4']  = 'active';

		$content['modulo'] = "Servicios";
		$content['sector'] = "Servicios";
		$content['back'] = _HOST_.'/admin/servicios';

		$content['title'] = "Servicios";
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$cservicios = file_get_contents(_DATA_ . '/servicios.json');
		$cservicios = json_decode($cservicios, true);
		
		$return_data = null;

		if(isset($_POST['btn-save'])){
			$orden = json_decode($_POST['orden'], true);
			if (count($orden) > 0) {
				foreach ($orden as $key => $value) {
					$servicios->orden($value['id'], $key);
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/servicios/servicios.twig', ['content' => $content, 'cservicios' => $cservicios, 'args' => $args, 'return_data' => $return_data, 'servicios' => $servicios, 'servicios_lineas' => $servicios_lineas, 'servicios_categorias' => $servicios_categorias, 'servicios_subcategorias' => $servicios_subcategorias]);
		return $response;

	}

}