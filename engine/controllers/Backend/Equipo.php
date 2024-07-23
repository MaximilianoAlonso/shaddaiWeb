<?php
namespace App\Backend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Equipo extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $equipo;

		$content['v_equipo']  = 'active';

		$content['modulo'] = "Equipo";
		$content['sector'] = "Equipo";
		$content['back'] = _HOST_.'/admin/equipo';

		$content['title'] = "Equipo";
		$content['cabezado'] = "Listado";

		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $equipo->tabla($requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $equipo->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/equipo\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/equipo/equipo.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $equipo, $functions;

		$cequipo = file_get_contents(_DATA_ . '/equipo.json');
		$cequipo = json_decode($cequipo, true);

		$content['v_equipo']  = 'active';

		$content['modulo'] = "Equipo";
		$content['sector'] = "Equipo";
		$content['back'] = _HOST_.'/admin/equipo';

		$content['title'] = "Equipo";
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$return_data = null;

		if(isset($_POST['btn-save'])){

			$name_equipo = trim($_POST['name_equipo']);
			$active_equipo = trim($_POST['active_equipo']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_equipo = trim($_POST['photo_equipo']);

			$functions->msje = '';

			if($_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cequipo['size'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = 300;
				$max[1]['path'] = 'small/';
				$nombre = $name_equipo;
				$path = _HOSTDIR_."/uploads/equipo/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_equipo_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_equipo;
				if($functions->imagen($fotos, $max, $photo_equipo_name, $path, $actual)){
					$photo_equipo = $photo_equipo_name;
				}
			}


			if($equipo->add($name_equipo, $active_equipo, $photo_equipo, $extra)){
				$this->functions->redirect(_HOST_."/admin/equipo?n");
				return $response;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/equipo/equipo.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'cequipo' => $cequipo]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $equipo, $functions;

		$cequipo = file_get_contents(_DATA_ . '/equipo.json');
		$cequipo = json_decode($cequipo, true);

		$content['v_equipo']  = 'active';

		$content['modulo'] = "Equipo";
		$content['sector'] = "Equipo";
		$content['back'] = _HOST_.'/admin/equipo';

		$content['title'] = "Equipo";
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$return_data = null;


		if(isset($_POST['btn-save'])){

			$name_equipo = trim($_POST['name_equipo']);
			$active_equipo = trim($_POST['active_equipo']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_equipo = trim($_POST['photo_equipo']);

			$functions->msje = '';

			if($_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cequipo['size'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = 300;
				$max[1]['path'] = 'small/';
				$nombre = $name_equipo;
				$path = _HOSTDIR_."/uploads/equipo/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_equipo_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_equipo;
				if($functions->imagen($fotos, $max, $photo_equipo_name, $path, $actual)){
					$photo_equipo = $photo_equipo_name;
				}
			}

			if($equipo->update($args['id'], $name_equipo, $active_equipo, $photo_equipo, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$equipo->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/equipo/equipo.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'equipo' => $equipo, 'cequipo' => $cequipo]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $equipo, $functions;

		$cequipo = file_get_contents(_DATA_ . '/equipo.json');
		$cequipo = json_decode($cequipo, true);

		$content['v_equipo']  = 'active';

		$content['modulo'] = "Equipo";
		$content['sector'] = "Equipo";
		$content['back'] = _HOST_.'/admin/equipo';

		$content['title'] = "Equipo";
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$return_data = null;

		if(isset($_POST['btn-save'])){
			$orden = json_decode($_POST['orden'], true);
			if (count($orden) > 0) {
				foreach ($orden as $key => $value) {
					$equipo->orden($value['id'], $key);
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/equipo/equipo.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'equipo' => $equipo, 'cequipo' => $cequipo]);
		return $response;

	}

}