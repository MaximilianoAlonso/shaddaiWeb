<?php
namespace App\Backend\Galeria;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Imagenes extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $galeria_imagenes, $galeria;

		if(!$galeria->edit($args['galeria'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_g'] = $content['v_g_4']  = 'active';

		$content['modulo'] = "Imagenes";

		$content['sector'] = "Imagenes";
		$content['back'] = _HOST_.'/admin/galeria/imagenes/'.$args['galeria'];

		$content['sector2'] = "Galeria";
		$content['back2'] = _HOST_.'/admin/galeria';

		$content['title'] = "Imagenes - " . $galeria->name_galeria;
		$content['cabezado'] = "Listado";

		$cgaleria = file_get_contents(_DATA_ . '/galeria.json');
		$cgaleria = json_decode($cgaleria, true);

		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $galeria_imagenes->tabla($galeria->id_galeria, $requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $galeria_imagenes->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/imagenes\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/galeria/imagenes.twig', ['content' => $content, 'cgaleria' => $cgaleria, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $galeria_imagenes, $galeria, $functions;

		if(!$galeria->edit($args['galeria'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_g'] = $content['v_g_4']  = 'active';

		$content['modulo'] = "Imagenes";
		$content['sector'] = "Imagenes";
		$content['back'] = _HOST_.'/admin/galeria/imagenes/'.$args['galeria'];

		$content['sector2'] = "Galeria";
		$content['back2'] = _HOST_.'/admin/galeria';

		$content['title'] = "Imagenes - " . $galeria->name_galeria;
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$cgaleria = file_get_contents(_DATA_ . '/galeria.json');
		$cgaleria = json_decode($cgaleria, true);

		$return_data = null;

		if(isset($_POST['btn-save'])){

			$name_imagenes = trim($_POST['name_imagenes']);
			$active_imagenes = trim($_POST['active_imagenes']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_imagenes = (isset($_POST['photo_imagenes'])) ? trim($_POST['photo_imagenes']) : '';
			$id_galeria = $args['galeria'];

			$functions->msje = '';

			if(isset($_POST['photo_imagenes']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cgaleria['galeria']['size']['max'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = $cgaleria['galeria']['size']['min'];
				$max[1]['path'] = 'small/';
				$nombre = $name_imagenes;
				$path = _HOSTDIR_."/uploads/galeria/imagenes/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_imagenes_name = $galeria->seo_galeria."-".$functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_imagenes;
				if($functions->imagen($fotos, $max, $photo_imagenes_name, $path, $actual)){
					$photo_imagenes = $photo_imagenes_name;
				}
			}


			if($galeria_imagenes->add($name_imagenes, $active_imagenes, $photo_imagenes, $id_galeria, $extra)){
				$this->functions->redirect(_HOST_."/admin/galeria/imagenes/".$args['galeria']."?n");
				return $response;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/galeria/imagenes.twig', ['content' => $content, 'cgaleria' => $cgaleria, 'args' => $args, 'return_data' => $return_data, 'galeria' => $galeria]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $galeria_imagenes, $galeria, $functions;

		if(!$galeria->edit($args['galeria'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_g'] = $content['v_g_4']  = 'active';

		$content['modulo'] = "Imagenes";
		$content['sector'] = "Imagenes";
		$content['back'] = _HOST_.'/admin/galeria/imagenes/'.$args['galeria'];

		$content['sector2'] = "Galeria";
		$content['back2'] = _HOST_.'/admin/galeria';

		$content['title'] = "Imagenes - " . $galeria->name_galeria;
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$cgaleria = file_get_contents(_DATA_ . '/galeria.json');
		$cgaleria = json_decode($cgaleria, true);

		$return_data = null;


		if(isset($_POST['btn-save'])){

			$name_imagenes = trim($_POST['name_imagenes']);
			$active_imagenes = trim($_POST['active_imagenes']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_imagenes = (isset($_POST['photo_imagenes'])) ? trim($_POST['photo_imagenes']) : '';
			$id_galeria = $args['galeria'];

			$functions->msje = '';

			if(isset($_POST['photo_imagenes']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cgaleria['galeria']['size']['max'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = $cgaleria['galeria']['size']['min'];
				$max[1]['path'] = 'small/';
				$nombre = $name_imagenes;
				$path = _HOSTDIR_."/uploads/galeria/imagenes/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_imagenes_name = $galeria->seo_galeria."-".$functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_imagenes;
				if($functions->imagen($fotos, $max, $photo_imagenes_name, $path, $actual)){
					$photo_imagenes = $photo_imagenes_name;
				}
			}

			

			if($galeria_imagenes->update($args['id'], $name_imagenes, $active_imagenes, $photo_imagenes, $id_galeria, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$galeria_imagenes->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/galeria/imagenes.twig', ['content' => $content, 'cgaleria' => $cgaleria, 'args' => $args, 'return_data' => $return_data, 'galeria_imagenes' => $galeria_imagenes, 'galeria' => $galeria]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $galeria_imagenes, $galeria, $functions;

		if(!$galeria->edit($args['galeria'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_g'] = $content['v_g_4']  = 'active';

		$content['modulo'] = "Imagenes";
		$content['sector'] = "Imagenes";
		$content['back'] = _HOST_.'/admin/galeria/imagenes/'.$args['galeria'];

		$content['sector2'] = "Galeria";
		$content['back2'] = _HOST_.'/admin/galeria';

		$content['title'] = "Imagenes - " . $galeria->name_galeria;
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$cgaleria = file_get_contents(_DATA_ . '/galeria.json');
		$cgaleria = json_decode($cgaleria, true);

		$return_data = null;

		if(isset($_POST['btn-save'])){
			$orden = json_decode($_POST['orden'], true);
			if (count($orden) > 0) {
				foreach ($orden as $key => $value) {
					$galeria_imagenes->orden($value['id'], $key);
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/galeria/imagenes.twig', ['content' => $content, 'cgaleria' => $cgaleria, 'args' => $args, 'return_data' => $return_data, 'galeria_imagenes' => $galeria_imagenes, 'galeria' => $galeria]);
		return $response;

	}

}