<?php
namespace App\Backend\Eventos;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Imagenes extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $eventos_imagenes, $eventos;

		if(!$eventos->edit($args['eventos'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_e'] = $content['v_e_4']  = 'active';

		$content['modulo'] = "Imagenes";

		$content['sector'] = "Imagenes";
		$content['back'] = _HOST_.'/admin/eventos/imagenes/'.$args['eventos'];

		$content['sector2'] = "Eventos";
		$content['back2'] = _HOST_.'/admin/eventos';

		$content['title'] = "Imagenes - " . $eventos->name_eventos;
		$content['cabezado'] = "Listado";

		$ceventos = file_get_contents(_DATA_ . '/eventos.json');
		$ceventos = json_decode($ceventos, true);

		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $eventos_imagenes->tabla($eventos->id_eventos, $requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $eventos_imagenes->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/imagenes\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/eventos/imagenes.twig', ['content' => $content, 'ceventos' => $ceventos, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $eventos_imagenes, $eventos, $functions;

		if(!$eventos->edit($args['eventos'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_e'] = $content['v_e_4']  = 'active';

		$content['modulo'] = "Imagenes";
		$content['sector'] = "Imagenes";
		$content['back'] = _HOST_.'/admin/eventos/imagenes/'.$args['eventos'];

		$content['sector2'] = "Eventos";
		$content['back2'] = _HOST_.'/admin/eventos';

		$content['title'] = "Imagenes - " . $eventos->name_eventos;
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$ceventos = file_get_contents(_DATA_ . '/eventos.json');
		$ceventos = json_decode($ceventos, true);

		$return_data = null;

		if(isset($_POST['btn-save'])){

			$name_imagenes = trim($_POST['name_imagenes']);
			$active_imagenes = trim($_POST['active_imagenes']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_imagenes = (isset($_POST['photo_imagenes'])) ? trim($_POST['photo_imagenes']) : '';
			$id_eventos = $args['eventos'];

			$functions->msje = '';

			if(isset($_POST['photo_imagenes']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $ceventos['eventos']['size']['max'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = $ceventos['eventos']['size']['min'];
				$max[1]['path'] = 'small/';
				$nombre = $name_imagenes;
				$path = _HOSTDIR_."/uploads/eventos/imagenes/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_imagenes_name = $eventos->seo_eventos."-".$functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_imagenes;
				if($functions->imagen($fotos, $max, $photo_imagenes_name, $path, $actual)){
					$photo_imagenes = $photo_imagenes_name;
				}
			}


			if($eventos_imagenes->add($name_imagenes, $active_imagenes, $photo_imagenes, $id_eventos, $extra)){
				$this->functions->redirect(_HOST_."/admin/eventos/imagenes/".$args['eventos']."?n");
				return $response;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/eventos/imagenes.twig', ['content' => $content, 'ceventos' => $ceventos, 'args' => $args, 'return_data' => $return_data, 'eventos' => $eventos]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $eventos_imagenes, $eventos, $functions;

		if(!$eventos->edit($args['eventos'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_e'] = $content['v_e_4']  = 'active';

		$content['modulo'] = "Imagenes";
		$content['sector'] = "Imagenes";
		$content['back'] = _HOST_.'/admin/eventos/imagenes/'.$args['eventos'];

		$content['sector2'] = "Eventos";
		$content['back2'] = _HOST_.'/admin/eventos';

		$content['title'] = "Imagenes - " . $eventos->name_eventos;
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$ceventos = file_get_contents(_DATA_ . '/eventos.json');
		$ceventos = json_decode($ceventos, true);

		$return_data = null;


		if(isset($_POST['btn-save'])){

			$name_imagenes = trim($_POST['name_imagenes']);
			$active_imagenes = trim($_POST['active_imagenes']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_imagenes = (isset($_POST['photo_imagenes'])) ? trim($_POST['photo_imagenes']) : '';
			$id_eventos = $args['eventos'];

			$functions->msje = '';

			if(isset($_POST['photo_imagenes']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $ceventos['eventos']['size']['max'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = $ceventos['eventos']['size']['min'];
				$max[1]['path'] = 'small/';
				$nombre = $name_imagenes;
				$path = _HOSTDIR_."/uploads/eventos/imagenes/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_imagenes_name = $eventos->seo_eventos."-".$functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_imagenes;
				if($functions->imagen($fotos, $max, $photo_imagenes_name, $path, $actual)){
					$photo_imagenes = $photo_imagenes_name;
				}
			}

			

			if($eventos_imagenes->update($args['id'], $name_imagenes, $active_imagenes, $photo_imagenes, $id_eventos, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$eventos_imagenes->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/eventos/imagenes.twig', ['content' => $content, 'ceventos' => $ceventos, 'args' => $args, 'return_data' => $return_data, 'eventos_imagenes' => $eventos_imagenes, 'eventos' => $eventos]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $eventos_imagenes, $eventos, $functions;

		if(!$eventos->edit($args['eventos'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_e'] = $content['v_e_4']  = 'active';

		$content['modulo'] = "Imagenes";
		$content['sector'] = "Imagenes";
		$content['back'] = _HOST_.'/admin/eventos/imagenes/'.$args['eventos'];

		$content['sector2'] = "Eventos";
		$content['back2'] = _HOST_.'/admin/eventos';

		$content['title'] = "Imagenes - " . $eventos->name_eventos;
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$ceventos = file_get_contents(_DATA_ . '/eventos.json');
		$ceventos = json_decode($ceventos, true);

		$return_data = null;

		if(isset($_POST['btn-save'])){
			$orden = json_decode($_POST['orden'], true);
			if (count($orden) > 0) {
				foreach ($orden as $key => $value) {
					$eventos_imagenes->orden($value['id'], $key);
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/eventos/imagenes.twig', ['content' => $content, 'ceventos' => $ceventos, 'args' => $args, 'return_data' => $return_data, 'eventos_imagenes' => $eventos_imagenes, 'eventos' => $eventos]);
		return $response;

	}

}