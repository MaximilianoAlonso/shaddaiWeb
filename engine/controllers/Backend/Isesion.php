<?php
namespace App\Backend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Isesion extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $isesion;

		$content['v_isesion']  = 'active';

		$content['modulo'] = "Clientes";
		$content['sector'] = "Clientes";
		$content['back'] = _HOST_.'/admin/isesion';

		$content['title'] = "Clientes";
		$content['cabezado'] = "Listado";

		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $isesion->tabla($requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $isesion->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/isesion\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/isesion/isesion.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $isesion, $functions;

		$cisesion = file_get_contents(_DATA_ . '/isesion.json');
		$cisesion = json_decode($cisesion, true);

		$content['v_isesion']  = 'active';

		$content['modulo'] = "Clientes";
		$content['sector'] = "Clientes";
		$content['back'] = _HOST_.'/admin/isesion';

		$content['title'] = "Clientes";
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$return_data = null;

		if(isset($_POST['btn-save'])){

			$name_isesion = trim($_POST['name_isesion']);
			$active_isesion = trim($_POST['active_isesion']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_isesion = trim($_POST['photo_isesion']);

			$functions->msje = '';

			if($_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cisesion['size'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = 300;
				$max[1]['path'] = 'small/';
				$nombre = $name_isesion;
				$path = _HOSTDIR_."/uploads/isesion/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_isesion_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_isesion;
				if($functions->imagen($fotos, $max, $photo_isesion_name, $path, $actual)){
					$photo_isesion = $photo_isesion_name;
				}
			}


			if($isesion->add($name_isesion, $active_isesion, $photo_isesion, $extra)){
				$this->functions->redirect(_HOST_."/admin/isesion?n");
				return $response;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/isesion/isesion.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'cisesion' => $cisesion]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $isesion, $functions;

		$cisesion = file_get_contents(_DATA_ . '/isesion.json');
		$cisesion = json_decode($cisesion, true);

		$content['v_isesion']  = 'active';

		$content['modulo'] = "Clientes";
		$content['sector'] = "Clientes";
		$content['back'] = _HOST_.'/admin/isesion';

		$content['title'] = "Clientes";
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$return_data = null;


		if(isset($_POST['btn-save'])){

			$name_isesion = trim($_POST['name_isesion']);
			$active_isesion = trim($_POST['active_isesion']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_isesion = trim($_POST['photo_isesion']);

			$functions->msje = '';

			if($_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cisesion['size'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = 300;
				$max[1]['path'] = 'small/';
				$nombre = $name_isesion;
				$path = _HOSTDIR_."/uploads/isesion/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_isesion_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_isesion;
				if($functions->imagen($fotos, $max, $photo_isesion_name, $path, $actual)){
					$photo_isesion = $photo_isesion_name;
				}
			}

			if($isesion->update($args['id'], $name_isesion, $active_isesion, $photo_isesion, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$isesion->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/isesion/isesion.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'isesion' => $isesion, 'cisesion' => $cisesion]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $isesion, $functions;

		$cisesion = file_get_contents(_DATA_ . '/isesion.json');
		$cisesion = json_decode($cisesion, true);

		$content['v_isesion']  = 'active';

		$content['modulo'] = "Clientes";
		$content['sector'] = "Clientes";
		$content['back'] = _HOST_.'/admin/isesion';

		$content['title'] = "Clientes";
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$return_data = null;

		if(isset($_POST['btn-save'])){
			$orden = json_decode($_POST['orden'], true);
			if (count($orden) > 0) {
				foreach ($orden as $key => $value) {
					$isesion->orden($value['id'], $key);
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/isesion/isesion.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'isesion' => $isesion, 'cisesion' => $cisesion]);
		return $response;

	}

}