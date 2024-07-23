<?php
namespace App\Backend\Galeria;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Categorias extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $galeria_categorias;

		$content['v_g'] = $content['v_g_2']  = 'active';

		$content['modulo'] = "Categorias";

		$content['sector'] = "Categorias";
		$content['back'] = _HOST_.'/admin/galeria/categorias';

		$content['sector2'] = "Galeria";
		$content['back2'] = _HOST_.'/admin/galeria';

		$content['title'] = "Categorias";
		$content['cabezado'] = "Listado";

		$cgaleria = file_get_contents(_DATA_ . '/galeria.json');
		$cgaleria = json_decode($cgaleria, true);
		
		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $galeria_categorias->tabla($requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $galeria_categorias->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/categorias\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/galeria/categorias.twig', ['content' => $content, 'cgaleria' => $cgaleria, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $galeria_categorias, $galeria_lineas, $functions;

		$content['v_g'] = $content['v_g_2']  = 'active';

		$content['modulo'] = "Categorias";
		$content['sector'] = "Categorias";
		$content['back'] = _HOST_.'/admin/galeria/categorias';

		$content['sector2'] = "Galeria";
		$content['back2'] = _HOST_.'/admin/galeria';

		$content['title'] = "Categorias";
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

		if(isset($_POST['btn-save'])){

			$name_categorias = trim($_POST['name_categorias']);
			$seo_categorias = (isset($_POST['seo_categorias'])) ? trim($_POST['seo_categorias']) : '';
			$active_categorias = trim($_POST['active_categorias']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_categorias = (isset($_POST['photo_categorias'])) ? trim($_POST['photo_categorias']) : '';
			$id_lineas = (isset($_POST['id_lineas'])) ? trim($_POST['id_lineas']) : 0;

			$functions->msje = '';

			if(isset($_POST['photo_categorias']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cgaleria['categorias']['size'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = 300;
				$max[1]['path'] = 'small/';
				$nombre = $name_categorias;
				$path = _HOSTDIR_."/uploads/galeria/categorias/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_categorias_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_categorias;
				if($functions->imagen($fotos, $max, $photo_categorias_name, $path, $actual)){
					$photo_categorias = $photo_categorias_name;
				}
			}


			if($galeria_categorias->add($name_categorias, $seo_categorias, $active_categorias, $photo_categorias, $id_lineas, $extra)){
				$this->functions->redirect(_HOST_."/admin/galeria/categorias?n");
				return $response;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/galeria/categorias.twig', ['content' => $content, 'cgaleria' => $cgaleria, 'args' => $args, 'return_data' => $return_data, 'galeria_lineas' => $galeria_lineas]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $galeria_categorias, $galeria_lineas, $functions;

		$content['v_g'] = $content['v_g_2']  = 'active';

		$content['modulo'] = "Categorias";
		$content['sector'] = "Categorias";
		$content['back'] = _HOST_.'/admin/galeria/categorias';

		$content['sector2'] = "Galeria";
		$content['back2'] = _HOST_.'/admin/galeria';

		$content['title'] = "Categorias";
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


		if(isset($_POST['btn-save'])){

			$name_categorias = trim($_POST['name_categorias']);
			$seo_categorias = (isset($_POST['seo_categorias'])) ? trim($_POST['seo_categorias']) : '';
			$active_categorias = trim($_POST['active_categorias']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_categorias = (isset($_POST['photo_categorias'])) ? trim($_POST['photo_categorias']) : '';
			$id_lineas = (isset($_POST['id_lineas'])) ? trim($_POST['id_lineas']) : 0;

			$functions->msje = '';

			if(isset($_POST['photo_categorias']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cgaleria['categorias']['size'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = 300;
				$max[1]['path'] = 'small/';
				$nombre = $name_categorias;
				$path = _HOSTDIR_."/uploads/galeria/categorias/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_categorias_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_categorias;
				if($functions->imagen($fotos, $max, $photo_categorias_name, $path, $actual)){
					$photo_categorias = $photo_categorias_name;
				}
			}

			if($galeria_categorias->update($args['id'], $name_categorias, $seo_categorias, $active_categorias, $photo_categorias, $id_lineas, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$galeria_categorias->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/galeria/categorias.twig', ['content' => $content, 'cgaleria' => $cgaleria, 'args' => $args, 'return_data' => $return_data, 'galeria_categorias' => $galeria_categorias, 'galeria_lineas' => $galeria_lineas]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $galeria_categorias, $galeria_lineas, $functions;

		$content['v_g'] = $content['v_g_2']  = 'active';

		$content['modulo'] = "Categorias";
		$content['sector'] = "Categorias";
		$content['back'] = _HOST_.'/admin/galeria/categorias';

		$content['sector2'] = "Galeria";
		$content['back2'] = _HOST_.'/admin/galeria';

		$content['title'] = "Categorias";
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$cgaleria = file_get_contents(_DATA_ . '/galeria.json');
		$cgaleria = json_decode($cgaleria, true);
		
		$return_data = null;

		if(isset($_POST['btn-save'])){
			$orden = json_decode($_POST['orden'], true);
			if (count($orden) > 0) {
				foreach ($orden as $key => $value) {
					$galeria_categorias->orden($value['id'], $key);
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/galeria/categorias.twig', ['content' => $content, 'cgaleria' => $cgaleria, 'args' => $args, 'return_data' => $return_data, 'galeria_categorias' => $galeria_categorias, 'galeria_lineas' => $galeria_lineas]);
		return $response;

	}

}