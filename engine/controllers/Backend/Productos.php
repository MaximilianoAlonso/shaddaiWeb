<?php
namespace App\Backend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Productos extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $productos;

		$content['v_p'] = $content['v_p_4']  = 'active';

		$content['modulo'] = "Productos";

		$content['sector'] = "Productos";
		$content['back'] = _HOST_.'/admin/productos';

		$content['title'] = "Productos";
		$content['cabezado'] = "Listado";

		$cproductos = file_get_contents(_DATA_ . '/productos.json');
		$cproductos = json_decode($cproductos, true);
		
		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $productos->tabla($requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $productos->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/productos\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/productos/productos.twig', ['content' => $content, 'cproductos' => $cproductos, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $productos, $productos_lineas, $productos_categorias, $productos_subcategorias, $functions;

		$content['v_p'] = $content['v_p_4']  = 'active';

		$content['modulo'] = "Productos";
		$content['sector'] = "Productos";
		$content['back'] = _HOST_.'/admin/productos';

		$content['title'] = "Productos";
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$cproductos = file_get_contents(_DATA_ . '/productos.json');
		$cproductos = json_decode($cproductos, true);
		
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
					$return_data['data'] = $productos_categorias->select(null, $lineas);
				}else if($form == "categorias"){
					$categorias = trim($_POST['categorias']);
					$return_data['type'] = 'success';
					$return_data['data'] = $productos_subcategorias->select(null, $categorias);
				}else{
					$return_data['type'] = 'error';
					$return_data['msje'] = 'Error no se pudo consultar en la base de datos. Intente de nuevo.';
				}
				echo json_encode($return_data);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_POST['btn-save'])){

			$name_productos = trim($_POST['name_productos']);
			$seo_productos = (isset($_POST['seo_productos'])) ? trim($_POST['seo_productos']) : '';
			$active_productos = trim($_POST['active_productos']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_productos = (isset($_POST['photo_productos'])) ? trim($_POST['photo_productos']) : '';
			$id_lineas = (isset($_POST['id_lineas'])) ? trim($_POST['id_lineas']) : 0;
			$id_categorias = (isset($_POST['id_categorias'])) ? trim($_POST['id_categorias']) : 0;
			$id_subcategorias = (isset($_POST['id_subcategorias'])) ? trim($_POST['id_subcategorias']) : 0;

			$functions->msje = '';

			if(isset($_POST['photo_productos']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cproductos['productos']['size']['max'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = $cproductos['productos']['size']['min'];
				$max[1]['path'] = 'small/';
				$nombre = $name_productos;
				$path = _HOSTDIR_."/uploads/productos/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_productos_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_productos;
				if($functions->imagen($fotos, $max, $photo_productos_name, $path, $actual)){
					$photo_productos = $photo_productos_name;
				}
			}


			if($productos->add($name_productos, $seo_productos, $active_productos, $photo_productos, $id_lineas, $id_categorias, $id_subcategorias, $extra)){
				$this->functions->redirect(_HOST_."/admin/productos?n");
				return $response;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/productos/productos.twig', ['content' => $content, 'cproductos' => $cproductos, 'args' => $args, 'return_data' => $return_data, 'productos_lineas' => $productos_lineas, 'productos_categorias' => $productos_categorias, 'productos_subcategorias' => $productos_subcategorias]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $productos, $productos_lineas, $productos_categorias, $productos_subcategorias, $functions;

		$content['v_p'] = $content['v_p_4']  = 'active';

		$content['modulo'] = "Productos";
		$content['sector'] = "Productos";
		$content['back'] = _HOST_.'/admin/productos';

		$content['title'] = "Productos";
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$cproductos = file_get_contents(_DATA_ . '/productos.json');
		$cproductos = json_decode($cproductos, true);
		
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
					$return_data['data'] = $productos_categorias->select(null, $lineas);
				}else if($form == "categorias"){
					$categorias = trim($_POST['categorias']);
					$return_data['type'] = 'success';
					$return_data['data'] = $productos_subcategorias->select(null, $categorias);
				}else{
					$return_data['type'] = 'error';
					$return_data['msje'] = 'Error no se pudo consultar en la base de datos. Intente de nuevo.';
				}
				echo json_encode($return_data);
				return $response->withHeader('Content-type', 'application/json');
			}
		}


		if(isset($_POST['btn-save'])){

			$name_productos = trim($_POST['name_productos']);
			$seo_productos = (isset($_POST['seo_productos'])) ? trim($_POST['seo_productos']) : '';
			$active_productos = trim($_POST['active_productos']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_productos = (isset($_POST['photo_productos'])) ? trim($_POST['photo_productos']) : '';
			$id_lineas = (isset($_POST['id_lineas'])) ? trim($_POST['id_lineas']) : 0;
			$id_categorias = (isset($_POST['id_categorias'])) ? trim($_POST['id_categorias']) : 0;
			$id_subcategorias = (isset($_POST['id_subcategorias'])) ? trim($_POST['id_subcategorias']) : 0;

			$functions->msje = '';

			if(isset($_POST['photo_productos']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cproductos['productos']['size']['max'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = $cproductos['productos']['size']['min'];
				$max[1]['path'] = 'small/';
				$nombre = $name_productos;
				$path = _HOSTDIR_."/uploads/productos/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_productos_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_productos;
				if($functions->imagen($fotos, $max, $photo_productos_name, $path, $actual)){
					$photo_productos = $photo_productos_name;
				}
			}

			if($productos->update($args['id'], $name_productos, $seo_productos, $active_productos, $photo_productos, $id_lineas, $id_categorias, $id_subcategorias, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$productos->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/productos/productos.twig', ['content' => $content, 'cproductos' => $cproductos, 'args' => $args, 'return_data' => $return_data, 'productos' => $productos, 'productos_lineas' => $productos_lineas, 'productos_categorias' => $productos_categorias, 'productos_subcategorias' => $productos_subcategorias]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $productos, $productos_lineas, $productos_categorias, $productos_subcategorias, $functions;

		$content['v_p'] = $content['v_p_4']  = 'active';

		$content['modulo'] = "Productos";
		$content['sector'] = "Productos";
		$content['back'] = _HOST_.'/admin/productos';

		$content['title'] = "Productos";
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$cproductos = file_get_contents(_DATA_ . '/productos.json');
		$cproductos = json_decode($cproductos, true);
		
		$return_data = null;

		if(isset($_POST['btn-save'])){
			$orden = json_decode($_POST['orden'], true);
			if (count($orden) > 0) {
				foreach ($orden as $key => $value) {
					$productos->orden($value['id'], $key);
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/productos/productos.twig', ['content' => $content, 'cproductos' => $cproductos, 'args' => $args, 'return_data' => $return_data, 'productos' => $productos, 'productos_lineas' => $productos_lineas, 'productos_categorias' => $productos_categorias, 'productos_subcategorias' => $productos_subcategorias]);
		return $response;

	}

}