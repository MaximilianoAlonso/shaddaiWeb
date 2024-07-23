<?php
namespace App\Backend\Productos;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Imagenes extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $productos_imagenes, $productos;

		if(!$productos->edit($args['productos'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_p'] = $content['v_p_4']  = 'active';

		$content['modulo'] = "Imagenes";

		$content['sector'] = "Imagenes";
		$content['back'] = _HOST_.'/admin/productos/imagenes/'.$args['productos'];

		$content['sector2'] = "Productos";
		$content['back2'] = _HOST_.'/admin/productos';

		$content['title'] = "Imagenes - " . $productos->name_productos;
		$content['cabezado'] = "Listado";

		$cproductos = file_get_contents(_DATA_ . '/productos.json');
		$cproductos = json_decode($cproductos, true);

		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $productos_imagenes->tabla($productos->id_productos, $requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $productos_imagenes->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/imagenes\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/productos/imagenes.twig', ['content' => $content, 'cproductos' => $cproductos, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $productos_imagenes, $productos, $functions;

		if(!$productos->edit($args['productos'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_p'] = $content['v_p_4']  = 'active';

		$content['modulo'] = "Imagenes";
		$content['sector'] = "Imagenes";
		$content['back'] = _HOST_.'/admin/productos/imagenes/'.$args['productos'];

		$content['sector2'] = "Productos";
		$content['back2'] = _HOST_.'/admin/productos';

		$content['title'] = "Imagenes - " . $productos->name_productos;
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$cproductos = file_get_contents(_DATA_ . '/productos.json');
		$cproductos = json_decode($cproductos, true);

		$return_data = null;

		if(isset($_POST['btn-save'])){

			$name_imagenes = trim($_POST['name_imagenes']);
			$active_imagenes = trim($_POST['active_imagenes']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_imagenes = (isset($_POST['photo_imagenes'])) ? trim($_POST['photo_imagenes']) : '';
			$id_productos = $args['productos'];

			$functions->msje = '';

			if(isset($_POST['photo_imagenes']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cproductos['productos']['size']['max'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = $cproductos['productos']['size']['min'];
				$max[1]['path'] = 'small/';
				$nombre = $name_imagenes;
				$path = _HOSTDIR_."/uploads/productos/imagenes/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_imagenes_name = $productos->seo_productos."-".$functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_imagenes;
				if($functions->imagen($fotos, $max, $photo_imagenes_name, $path, $actual)){
					$photo_imagenes = $photo_imagenes_name;
				}
			}


			if($productos_imagenes->add($name_imagenes, $active_imagenes, $photo_imagenes, $id_productos, $extra)){
				$this->functions->redirect(_HOST_."/admin/productos/imagenes/".$args['productos']."?n");
				return $response;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/productos/imagenes.twig', ['content' => $content, 'cproductos' => $cproductos, 'args' => $args, 'return_data' => $return_data, 'productos' => $productos]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $productos_imagenes, $productos, $functions;

		if(!$productos->edit($args['productos'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_p'] = $content['v_p_4']  = 'active';

		$content['modulo'] = "Imagenes";
		$content['sector'] = "Imagenes";
		$content['back'] = _HOST_.'/admin/productos/imagenes/'.$args['productos'];

		$content['sector2'] = "Productos";
		$content['back2'] = _HOST_.'/admin/productos';

		$content['title'] = "Imagenes - " . $productos->name_productos;
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$cproductos = file_get_contents(_DATA_ . '/productos.json');
		$cproductos = json_decode($cproductos, true);

		$return_data = null;


		if(isset($_POST['btn-save'])){

			$name_imagenes = trim($_POST['name_imagenes']);
			$active_imagenes = trim($_POST['active_imagenes']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_imagenes = (isset($_POST['photo_imagenes'])) ? trim($_POST['photo_imagenes']) : '';
			$id_productos = $args['productos'];

			$functions->msje = '';

			if(isset($_POST['photo_imagenes']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cproductos['productos']['size']['max'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = $cproductos['productos']['size']['min'];
				$max[1]['path'] = 'small/';
				$nombre = $name_imagenes;
				$path = _HOSTDIR_."/uploads/productos/imagenes/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_imagenes_name = $productos->seo_productos."-".$functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_imagenes;
				if($functions->imagen($fotos, $max, $photo_imagenes_name, $path, $actual)){
					$photo_imagenes = $photo_imagenes_name;
				}
			}

			

			if($productos_imagenes->update($args['id'], $name_imagenes, $active_imagenes, $photo_imagenes, $id_productos, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$productos_imagenes->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/productos/imagenes.twig', ['content' => $content, 'cproductos' => $cproductos, 'args' => $args, 'return_data' => $return_data, 'productos_imagenes' => $productos_imagenes, 'productos' => $productos]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $productos_imagenes, $productos, $functions;

		if(!$productos->edit($args['productos'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_p'] = $content['v_p_4']  = 'active';

		$content['modulo'] = "Imagenes";
		$content['sector'] = "Imagenes";
		$content['back'] = _HOST_.'/admin/productos/imagenes/'.$args['productos'];

		$content['sector2'] = "Productos";
		$content['back2'] = _HOST_.'/admin/productos';

		$content['title'] = "Imagenes - " . $productos->name_productos;
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$cproductos = file_get_contents(_DATA_ . '/productos.json');
		$cproductos = json_decode($cproductos, true);

		$return_data = null;

		if(isset($_POST['btn-save'])){
			$orden = json_decode($_POST['orden'], true);
			if (count($orden) > 0) {
				foreach ($orden as $key => $value) {
					$productos_imagenes->orden($value['id'], $key);
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/productos/imagenes.twig', ['content' => $content, 'cproductos' => $cproductos, 'args' => $args, 'return_data' => $return_data, 'productos_imagenes' => $productos_imagenes, 'productos' => $productos]);
		return $response;

	}

}