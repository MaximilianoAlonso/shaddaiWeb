<?php
namespace App\Backend\Eventos;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Categorias extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $eventos_categorias;

		$content['v_e'] = $content['v_e_2']  = 'active';

		$content['modulo'] = "Categorias";

		$content['sector'] = "Categorias";
		$content['back'] = _HOST_.'/admin/eventos/categorias';

		$content['sector2'] = "Eventos";
		$content['back2'] = _HOST_.'/admin/eventos';

		$content['title'] = "Categorias";
		$content['cabezado'] = "Listado";

		$ceventos = file_get_contents(_DATA_ . '/eventos.json');
		$ceventos = json_decode($ceventos, true);
		
		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $eventos_categorias->tabla($requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $eventos_categorias->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/categorias\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/eventos/categorias.twig', ['content' => $content, 'ceventos' => $ceventos, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $eventos_categorias, $eventos_lineas, $functions;

		$content['v_e'] = $content['v_e_2']  = 'active';

		$content['modulo'] = "Categorias";
		$content['sector'] = "Categorias";
		$content['back'] = _HOST_.'/admin/eventos/categorias';

		$content['sector2'] = "Eventos";
		$content['back2'] = _HOST_.'/admin/eventos';

		$content['title'] = "Categorias";
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$ceventos = file_get_contents(_DATA_ . '/eventos.json');
		$ceventos = json_decode($ceventos, true);
		
		$return_data = null;

		if(isset($_GET['title'])){
			if (isset($_POST['json'])) {
				$json = (isset($_POST['json'])) ? trim($_POST['json']) : '';
				echo $functions->seo($json);
				return $response;
			}
		}

		if(isset($_POST['btn-save'])){

			$name_categorias = trim($_POST['name_categorias']);
			$seo_categorias = (isset($_POST['seo_categorias'])) ? trim($_POST['seo_categorias']) : '';
			$active_categorias = trim($_POST['active_categorias']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_categorias = (isset($_POST['photo_categorias'])) ? trim($_POST['photo_categorias']) : '';
			$id_lineas = (isset($_POST['id_lineas'])) ? trim($_POST['id_lineas']) : 0;

			$functions->msje = '';

			if(isset($_POST['photo_categorias']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $ceventos['categorias']['size'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = 300;
				$max[1]['path'] = 'small/';
				$nombre = $name_categorias;
				$path = _HOSTDIR_."/uploads/eventos/categorias/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_categorias_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_categorias;
				if($functions->imagen($fotos, $max, $photo_categorias_name, $path, $actual)){
					$photo_categorias = $photo_categorias_name;
				}
			}


			if($eventos_categorias->add($name_categorias, $seo_categorias, $active_categorias, $photo_categorias, $id_lineas, $extra)){
				$this->functions->redirect(_HOST_."/admin/eventos/categorias?n");
				return $response;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/eventos/categorias.twig', ['content' => $content, 'ceventos' => $ceventos, 'args' => $args, 'return_data' => $return_data, 'eventos_lineas' => $eventos_lineas]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $eventos_categorias, $eventos_lineas, $functions;

		$content['v_e'] = $content['v_e_2']  = 'active';

		$content['modulo'] = "Categorias";
		$content['sector'] = "Categorias";
		$content['back'] = _HOST_.'/admin/eventos/categorias';

		$content['sector2'] = "Eventos";
		$content['back2'] = _HOST_.'/admin/eventos';

		$content['title'] = "Categorias";
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$ceventos = file_get_contents(_DATA_ . '/eventos.json');
		$ceventos = json_decode($ceventos, true);
		
		$return_data = null;

		if(isset($_GET['title'])){
			if (isset($_POST['json'])) {
				$json = (isset($_POST['json'])) ? trim($_POST['json']) : '';
				echo $functions->seo($json);
				return $response;
			}
		}


		if(isset($_POST['btn-save'])){

			$name_categorias = trim($_POST['name_categorias']);
			$seo_categorias = (isset($_POST['seo_categorias'])) ? trim($_POST['seo_categorias']) : '';
			$active_categorias = trim($_POST['active_categorias']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_categorias = (isset($_POST['photo_categorias'])) ? trim($_POST['photo_categorias']) : '';
			$id_lineas = (isset($_POST['id_lineas'])) ? trim($_POST['id_lineas']) : 0;

			$functions->msje = '';

			if(isset($_POST['photo_categorias']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $ceventos['categorias']['size'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = 300;
				$max[1]['path'] = 'small/';
				$nombre = $name_categorias;
				$path = _HOSTDIR_."/uploads/eventos/categorias/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_categorias_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_categorias;
				if($functions->imagen($fotos, $max, $photo_categorias_name, $path, $actual)){
					$photo_categorias = $photo_categorias_name;
				}
			}

			if($eventos_categorias->update($args['id'], $name_categorias, $seo_categorias, $active_categorias, $photo_categorias, $id_lineas, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$eventos_categorias->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/eventos/categorias.twig', ['content' => $content, 'ceventos' => $ceventos, 'args' => $args, 'return_data' => $return_data, 'eventos_categorias' => $eventos_categorias, 'eventos_lineas' => $eventos_lineas]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $eventos_categorias, $eventos_lineas, $functions;

		$content['v_e'] = $content['v_e_2']  = 'active';

		$content['modulo'] = "Categorias";
		$content['sector'] = "Categorias";
		$content['back'] = _HOST_.'/admin/eventos/categorias';

		$content['sector2'] = "Eventos";
		$content['back2'] = _HOST_.'/admin/eventos';

		$content['title'] = "Categorias";
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$ceventos = file_get_contents(_DATA_ . '/eventos.json');
		$ceventos = json_decode($ceventos, true);
		
		$return_data = null;

		if(isset($_POST['btn-save'])){
			$orden = json_decode($_POST['orden'], true);
			if (count($orden) > 0) {
				foreach ($orden as $key => $value) {
					$eventos_categorias->orden($value['id'], $key);
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/eventos/categorias.twig', ['content' => $content, 'ceventos' => $ceventos, 'args' => $args, 'return_data' => $return_data, 'eventos_categorias' => $eventos_categorias, 'eventos_lineas' => $eventos_lineas]);
		return $response;

	}

}