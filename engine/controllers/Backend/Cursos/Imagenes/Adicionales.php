<?php
namespace App\Backend\Cursos\Imagenes;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Adicionales extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $cursos_subimagenes, $cursos_imagenes, $cursos;

		if(!$cursos->edit($args['cursos'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		if(!$cursos_imagenes->edit($args['imagenes'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}


		$content['v_cursos'] = $content['v_cursos_4']  = 'active';

		$content['modulo'] = "Imagenes";

		$content['sector'] = "Imagenes";
		$content['back'] = _HOST_.'/admin/cursos/imagenes/'.$args['cursos'].'/adicionales/'.$args['imagenes'];

		$content['sector2'] = "Cursos";
		$content['back2'] = _HOST_.'/admin/cursos';

		$content['title'] = "Imagenes: ".$cursos_imagenes->name_imagenes. " - " . $cursos->name_cursos;
		$content['cabezado'] = "Listado";

		$ccursos = file_get_contents(_DATA_ . '/cursos.json');
		$ccursos = json_decode($ccursos, true);

		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $cursos_subimagenes->tabla($cursos->id_cursos, $cursos_imagenes->id_imagenes, $requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $cursos_subimagenes->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/imagenes\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/cursos/imagenes/adicionales.twig', ['content' => $content, 'ccursos' => $ccursos, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $cursos_subimagenes, $cursos_imagenes, $cursos, $functions;

		if(!$cursos->edit($args['cursos'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		if(!$cursos_imagenes->edit($args['imagenes'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}


		$content['v_cursos'] = $content['v_cursos_4']  = 'active';

		$content['modulo'] = "Imagenes";
		$content['sector'] = "Imagenes";
		$content['back'] = _HOST_.'/admin/cursos/imagenes/'.$args['cursos'].'/adicionales/'.$args['imagenes'];

		$content['sector2'] = "Cursos";
		$content['back2'] = _HOST_.'/admin/cursos';

		$content['title'] = "Imagenes: ".$cursos_imagenes->name_imagenes. " - " . $cursos->name_cursos;
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$ccursos = file_get_contents(_DATA_ . '/cursos.json');
		$ccursos = json_decode($ccursos, true);

		$return_data = null;

		if(isset($_POST['btn-save'])){

			$name_subimagenes = trim($_POST['name_subimagenes']);
			$active_subimagenes = trim($_POST['active_subimagenes']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_subimagenes = (isset($_POST['photo_subimagenes'])) ? trim($_POST['photo_subimagenes']) : '';
			$id_cursos = $args['cursos'];
			$id_imagenes = $args['imagenes'];

			$functions->msje = '';

			if(isset($_POST['photo_subimagenes']) && $_FILES['fotos']['name'] != ""){

				$max[0]['size'] = $ccursos['imagenes']['size'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = 500;
				$max[1]['path'] = 'small/';

				$nombre = $name_subimagenes;
				$path = _HOSTDIR_."/uploads/cursos/imagenes/adicionales/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_subimagenes_name = $cursos->seo_cursos."-".$functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_subimagenes;
				if($functions->imagen($fotos, $max, $photo_subimagenes_name, $path, $actual)){
					$photo_subimagenes = $photo_subimagenes_name;
				}
			}


			if($cursos_subimagenes->add($name_subimagenes, $active_subimagenes, $photo_subimagenes, $id_cursos, $id_imagenes, $extra)){
				$this->functions->redirect(_HOST_.'/admin/cursos/imagenes/'.$args['cursos'].'/adicionales/'.$args['imagenes']."?n");
				return $response;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/cursos/imagenes/adicionales.twig', ['content' => $content, 'ccursos' => $ccursos, 'args' => $args, 'return_data' => $return_data, 'cursos' => $cursos]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $cursos_subimagenes, $cursos_imagenes, $cursos, $functions;

		if(!$cursos->edit($args['cursos'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		if(!$cursos_imagenes->edit($args['imagenes'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}


		$content['v_cursos'] = $content['v_cursos_4']  = 'active';

		$content['modulo'] = "Imagenes";
		$content['sector'] = "Imagenes";
		$content['back'] = _HOST_.'/admin/cursos/imagenes/'.$args['cursos'].'/adicionales/'.$args['imagenes'];

		$content['sector2'] = "Cursos";
		$content['back2'] = _HOST_.'/admin/cursos';

		$content['title'] = "Imagenes: ".$cursos_imagenes->name_imagenes. " - " . $cursos->name_cursos;
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$ccursos = file_get_contents(_DATA_ . '/cursos.json');
		$ccursos = json_decode($ccursos, true);

		$return_data = null;


		if(isset($_POST['btn-save'])){

			$name_subimagenes = trim($_POST['name_subimagenes']);
			$active_subimagenes = trim($_POST['active_subimagenes']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_subimagenes = (isset($_POST['photo_subimagenes'])) ? trim($_POST['photo_subimagenes']) : '';
			$id_cursos = $args['cursos'];
			$id_imagenes = $args['imagenes'];

			$functions->msje = '';

			if(isset($_POST['photo_subimagenes']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $ccursos['imagenes']['size'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = 500;
				$max[1]['path'] = 'small/';
				$nombre = $name_subimagenes;
				$path = _HOSTDIR_."/uploads/cursos/imagenes/adicionales/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_subimagenes_name = $cursos->seo_cursos."-".$functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_subimagenes;
				if($functions->imagen($fotos, $max, $photo_subimagenes_name, $path, $actual)){
					$photo_subimagenes = $photo_subimagenes_name;
				}
			}

			if($cursos_subimagenes->update($args['id'], $name_subimagenes, $active_subimagenes, $photo_subimagenes, $id_cursos, $id_imagenes, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$cursos_subimagenes->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/cursos/imagenes/adicionales.twig', ['content' => $content, 'ccursos' => $ccursos, 'args' => $args, 'return_data' => $return_data, 'cursos_subimagenes' => $cursos_subimagenes, 'cursos' => $cursos]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $cursos_subimagenes, $cursos_imagenes, $cursos, $functions;

		if(!$cursos->edit($args['cursos'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		if(!$cursos_imagenes->edit($args['imagenes'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}


		$content['v_cursos'] = $content['v_cursos_4']  = 'active';

		$content['modulo'] = "Imagenes";
		$content['sector'] = "Imagenes";
		$content['back'] = _HOST_.'/admin/cursos/imagenes/'.$args['cursos'].'/adicionales/'.$args['imagenes'];

		$content['sector2'] = "Cursos";
		$content['back2'] = _HOST_.'/admin/cursos';

		$content['title'] = "Imagenes: ".$cursos_imagenes->name_imagenes. " - " . $cursos->name_cursos;
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$ccursos = file_get_contents(_DATA_ . '/cursos.json');
		$ccursos = json_decode($ccursos, true);

		$return_data = null;

		if(isset($_POST['btn-save'])){
			$orden = json_decode($_POST['orden'], true);
			if (count($orden) > 0) {
				foreach ($orden as $key => $value) {
					$cursos_subimagenes->orden($value['id'], $key);
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/cursos/imagenes/adicionales.twig', ['content' => $content, 'ccursos' => $ccursos, 'args' => $args, 'return_data' => $return_data, 'cursos_subimagenes' => $cursos_subimagenes, 'cursos' => $cursos]);
		return $response;

	}

}