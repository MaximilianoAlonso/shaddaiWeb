<?php
namespace App\Backend\Galeria;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Lineas extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $galeria_lineas;

		$content['v_g'] = $content['v_g_1']  = 'active';

		$content['modulo'] = "Lineas";
		$content['sector'] = "Lineas";
		$content['back'] = _HOST_.'/admin/galeria/lineas';

		$content['sector2'] = "Galeria";
		$content['back2'] = _HOST_.'/admin/galeria';

		$content['title'] = "Lineas";
		$content['cabezado'] = "Listado";

		$cgaleria = file_get_contents(_DATA_ . '/galeria.json');
		$cgaleria = json_decode($cgaleria, true);
		
		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $galeria_lineas->tabla($requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $galeria_lineas->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/lineas\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/galeria/lineas.twig', ['content' => $content, 'cgaleria' => $cgaleria, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $galeria_lineas, $functions;

		$cgaleria = file_get_contents(_DATA_ . '/galeria.json');
		$cgaleria = json_decode($cgaleria, true);

		$content['v_g'] = $content['v_g_1']  = 'active';

		$content['modulo'] = "Lineas";
		$content['sector'] = "Lineas";
		$content['back'] = _HOST_.'/admin/galeria/lineas';

		$content['sector2'] = "Galeria";
		$content['back2'] = _HOST_.'/admin/galeria';

		$content['title'] = "Lineas";
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

			$name_lineas = trim($_POST['name_lineas']);
			$seo_lineas = (isset($_POST['seo_lineas'])) ? trim($_POST['seo_lineas']) : '';
			$active_lineas = trim($_POST['active_lineas']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_lineas = (isset($_POST['photo_lineas'])) ? trim($_POST['photo_lineas']) : '';

			$functions->msje = '';

			if(isset($_POST['photo_lineas']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cgaleria['lineas']['size'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = 300;
				$max[1]['path'] = 'small/';
				$nombre = $name_lineas;
				$path = _HOSTDIR_."/uploads/galeria/lineas/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_lineas_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_lineas;
				if($functions->imagen($fotos, $max, $photo_lineas_name, $path, $actual)){
					$photo_lineas = $photo_lineas_name;
				}
			}


			if($galeria_lineas->add($name_lineas, $seo_lineas, $active_lineas, $photo_lineas, $extra)){
				$this->functions->redirect(_HOST_."/admin/galeria/lineas?n");
				return $response;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/galeria/lineas.twig', ['content' => $content, 'cgaleria' => $cgaleria, 'args' => $args, 'return_data' => $return_data, 'cgaleria' => $cgaleria]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $galeria_lineas, $functions;

		$cgaleria = file_get_contents(_DATA_ . '/galeria.json');
		$cgaleria = json_decode($cgaleria, true);

		$content['v_g'] = $content['v_g_1']  = 'active';

		$content['modulo'] = "Lineas";
		$content['sector'] = "Lineas";
		$content['back'] = _HOST_.'/admin/galeria/lineas';

		$content['title'] = "Lineas";
		$content['cabezado'] = "Editar";

		$content['sector2'] = "Galeria";
		$content['back2'] = _HOST_.'/admin/galeria';

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

			$name_lineas = trim($_POST['name_lineas']);
			$seo_lineas = (isset($_POST['seo_lineas'])) ? trim($_POST['seo_lineas']) : '';
			$active_lineas = trim($_POST['active_lineas']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_lineas = (isset($_POST['photo_lineas'])) ? trim($_POST['photo_lineas']) : '';

			$functions->msje = '';

			if(isset($_POST['photo_lineas']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cgaleria['lineas']['size'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = 300;
				$max[1]['path'] = 'small/';
				$nombre = $name_lineas;
				$path = _HOSTDIR_."/uploads/galeria/lineas/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_lineas_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_lineas;
				if($functions->imagen($fotos, $max, $photo_lineas_name, $path, $actual)){
					$photo_lineas = $photo_lineas_name;
				}
			}

			if($galeria_lineas->update($args['id'], $name_lineas, $seo_lineas, $active_lineas, $photo_lineas, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$galeria_lineas->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/galeria/lineas.twig', ['content' => $content, 'cgaleria' => $cgaleria, 'args' => $args, 'return_data' => $return_data, 'galeria_lineas' => $galeria_lineas, 'cgaleria' => $cgaleria]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $galeria_lineas, $functions;

		$cgaleria = file_get_contents(_DATA_ . '/galeria.json');
		$cgaleria = json_decode($cgaleria, true);

		$content['v_g'] = $content['v_g_1']  = 'active';

		$content['modulo'] = "Lineas";
		$content['sector'] = "Lineas";
		$content['back'] = _HOST_.'/admin/galeria/lineas';

		$content['sector2'] = "Galeria";
		$content['back2'] = _HOST_.'/admin/galeria';

		$content['title'] = "Lineas";
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$cgaleria = file_get_contents(_DATA_ . '/galeria.json');
		$cgaleria = json_decode($cgaleria, true);
		
		$return_data = null;

		if(isset($_POST['btn-save'])){
			$orden = json_decode($_POST['orden'], true);
			if (count($orden) > 0) {
				foreach ($orden as $key => $value) {
					$galeria_lineas->orden($value['id'], $key);
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/galeria/lineas.twig', ['content' => $content, 'cgaleria' => $cgaleria, 'args' => $args, 'return_data' => $return_data, 'galeria_lineas' => $galeria_lineas, 'cgaleria' => $cgaleria]);
		return $response;

	}

}