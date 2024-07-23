<?php
namespace App\Backend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Galeria extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $galeria;

		$content['v_g'] = $content['v_g_4']  = 'active';

		$content['modulo'] = "Galeria";

		$content['sector'] = "Galeria";
		$content['back'] = _HOST_.'/admin/galeria';

		$content['title'] = "Galeria";
		$content['cabezado'] = "Listado";

		$cgaleria = file_get_contents(_DATA_ . '/galeria.json');
		$cgaleria = json_decode($cgaleria, true);
		
		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $galeria->tabla($requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $galeria->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/galeria\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/galeria/galeria.twig', ['content' => $content, 'cgaleria' => $cgaleria, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $galeria, $galeria_lineas, $galeria_categorias, $galeria_subcategorias, $functions;

		$content['v_g'] = $content['v_g_4']  = 'active';

		$content['modulo'] = "Galeria";
		$content['sector'] = "Galeria";
		$content['back'] = _HOST_.'/admin/galeria';

		$content['title'] = "Galeria";
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$cgaleria = file_get_contents(_DATA_ . '/galeria.json');
		$cgaleria = json_decode($cgaleria, true);
		
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
					$return_data['data'] = $galeria_categorias->select(null, $lineas);
				}else if($form == "categorias"){
					$categorias = trim($_POST['categorias']);
					$return_data['type'] = 'success';
					$return_data['data'] = $galeria_subcategorias->select(null, $categorias);
				}else{
					$return_data['type'] = 'error';
					$return_data['msje'] = 'Error no se pudo consultar en la base de datos. Intente de nuevo.';
				}
				echo json_encode($return_data);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_POST['btn-save'])){

			$name_galeria = trim($_POST['name_galeria']);
			$seo_galeria = (isset($_POST['seo_galeria'])) ? trim($_POST['seo_galeria']) : '';
			$active_galeria = trim($_POST['active_galeria']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_galeria = (isset($_POST['photo_galeria'])) ? trim($_POST['photo_galeria']) : '';
			$id_lineas = (isset($_POST['id_lineas'])) ? trim($_POST['id_lineas']) : 0;
			$id_categorias = (isset($_POST['id_categorias'])) ? trim($_POST['id_categorias']) : 0;
			$id_subcategorias = (isset($_POST['id_subcategorias'])) ? trim($_POST['id_subcategorias']) : 0;

			$functions->msje = '';

			if(isset($_POST['photo_galeria']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cgaleria['galeria']['size']['max'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = $cgaleria['galeria']['size']['min'];
				$max[1]['path'] = 'small/';
				$nombre = $name_galeria;
				$path = _HOSTDIR_."/uploads/galeria/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_galeria_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_galeria;
				if($functions->imagen($fotos, $max, $photo_galeria_name, $path, $actual)){
					$photo_galeria = $photo_galeria_name;
				}
			}


			if($galeria->add($name_galeria, $seo_galeria, $active_galeria, $photo_galeria, $id_lineas, $id_categorias, $id_subcategorias, $extra)){
				$this->functions->redirect(_HOST_."/admin/galeria?n");
				return $response;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/galeria/galeria.twig', ['content' => $content, 'cgaleria' => $cgaleria, 'args' => $args, 'return_data' => $return_data, 'galeria_lineas' => $galeria_lineas, 'galeria_categorias' => $galeria_categorias, 'galeria_subcategorias' => $galeria_subcategorias]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $galeria, $galeria_lineas, $galeria_categorias, $galeria_subcategorias, $functions;

		$content['v_g'] = $content['v_g_4']  = 'active';

		$content['modulo'] = "Galeria";
		$content['sector'] = "Galeria";
		$content['back'] = _HOST_.'/admin/galeria';

		$content['title'] = "Galeria";
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$cgaleria = file_get_contents(_DATA_ . '/galeria.json');
		$cgaleria = json_decode($cgaleria, true);
		
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
					$return_data['data'] = $galeria_categorias->select(null, $lineas);
				}else if($form == "categorias"){
					$categorias = trim($_POST['categorias']);
					$return_data['type'] = 'success';
					$return_data['data'] = $galeria_subcategorias->select(null, $categorias);
				}else{
					$return_data['type'] = 'error';
					$return_data['msje'] = 'Error no se pudo consultar en la base de datos. Intente de nuevo.';
				}
				echo json_encode($return_data);
				return $response->withHeader('Content-type', 'application/json');
			}
		}


		if(isset($_POST['btn-save'])){

			$name_galeria = trim($_POST['name_galeria']);
			$seo_galeria = (isset($_POST['seo_galeria'])) ? trim($_POST['seo_galeria']) : '';
			$active_galeria = trim($_POST['active_galeria']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_galeria = (isset($_POST['photo_galeria'])) ? trim($_POST['photo_galeria']) : '';
			$id_lineas = (isset($_POST['id_lineas'])) ? trim($_POST['id_lineas']) : 0;
			$id_categorias = (isset($_POST['id_categorias'])) ? trim($_POST['id_categorias']) : 0;
			$id_subcategorias = (isset($_POST['id_subcategorias'])) ? trim($_POST['id_subcategorias']) : 0;

			$functions->msje = '';

			if(isset($_POST['photo_galeria']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cgaleria['galeria']['size']['max'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = $cgaleria['galeria']['size']['min'];
				$max[1]['path'] = 'small/';
				$nombre = $name_galeria;
				$path = _HOSTDIR_."/uploads/galeria/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_galeria_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_galeria;
				if($functions->imagen($fotos, $max, $photo_galeria_name, $path, $actual)){
					$photo_galeria = $photo_galeria_name;
				}
			}

			if($galeria->update($args['id'], $name_galeria, $seo_galeria, $active_galeria, $photo_galeria, $id_lineas, $id_categorias, $id_subcategorias, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$galeria->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/galeria/galeria.twig', ['content' => $content, 'cgaleria' => $cgaleria, 'args' => $args, 'return_data' => $return_data, 'galeria' => $galeria, 'galeria_lineas' => $galeria_lineas, 'galeria_categorias' => $galeria_categorias, 'galeria_subcategorias' => $galeria_subcategorias]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $galeria, $galeria_lineas, $galeria_categorias, $galeria_subcategorias, $functions;

		$content['v_g'] = $content['v_g_4']  = 'active';

		$content['modulo'] = "Galeria";
		$content['sector'] = "Galeria";
		$content['back'] = _HOST_.'/admin/galeria';

		$content['title'] = "Galeria";
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$cgaleria = file_get_contents(_DATA_ . '/galeria.json');
		$cgaleria = json_decode($cgaleria, true);
		
		$return_data = null;

		if(isset($_POST['btn-save'])){
			$orden = json_decode($_POST['orden'], true);
			if (count($orden) > 0) {
				foreach ($orden as $key => $value) {
					$galeria->orden($value['id'], $key);
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/galeria/galeria.twig', ['content' => $content, 'cgaleria' => $cgaleria, 'args' => $args, 'return_data' => $return_data, 'galeria' => $galeria, 'galeria_lineas' => $galeria_lineas, 'galeria_categorias' => $galeria_categorias, 'galeria_subcategorias' => $galeria_subcategorias]);
		return $response;

	}

}