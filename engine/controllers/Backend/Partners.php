<?php
namespace App\Backend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Partners extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $partners;

		$content['v_part']  = 'active';

		$content['modulo'] = "Partners";
		$content['sector'] = "Partners";
		$content['back'] = _HOST_.'/admin/partners';

		$content['title'] = "Partners";
		$content['cabezado'] = "Listado";

		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $partners->tabla($requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $partners->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/partners\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/partners/partners.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $partners, $functions;

		$cpartners = file_get_contents(_DATA_ . '/partners.json');
		$cpartners = json_decode($cpartners, true);

		$content['v_part']  = 'active';

		$content['modulo'] = "Partners";
		$content['sector'] = "Partners";
		$content['back'] = _HOST_.'/admin/partners';

		$content['title'] = "Partners";
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$return_data = null;

		if(isset($_POST['btn-save'])){

			$name_partners = trim($_POST['name_partners']);
			$active_partners = trim($_POST['active_partners']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_partners = trim($_POST['photo_partners']);

			$functions->msje = '';

			if($_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cpartners['size'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = 150;
				$max[1]['path'] = 'small/';
				$nombre = $name_partners;
				$path = _HOSTDIR_."/uploads/partners/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_partners_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_partners;
				if($functions->imagen($fotos, $max, $photo_partners_name, $path, $actual)){
					$photo_partners = $photo_partners_name;
				}
			}


			if($partners->add($name_partners, $active_partners, $photo_partners, $extra)){
				$this->functions->redirect(_HOST_."/admin/partners?n");
				return $response;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/partners/partners.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'cpartners' => $cpartners]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $partners, $functions;

		$cpartners = file_get_contents(_DATA_ . '/partners.json');
		$cpartners = json_decode($cpartners, true);

		$content['v_part']  = 'active';

		$content['modulo'] = "Partners";
		$content['sector'] = "Partners";
		$content['back'] = _HOST_.'/admin/partners';

		$content['title'] = "Partners";
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$return_data = null;


		if(isset($_POST['btn-save'])){

			$name_partners = trim($_POST['name_partners']);
			$active_partners = trim($_POST['active_partners']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_partners = trim($_POST['photo_partners']);

			$functions->msje = '';

			if($_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cpartners['size'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = 150;
				$max[1]['path'] = 'small/';
				$nombre = $name_partners;
				$path = _HOSTDIR_."/uploads/partners/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_partners_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_partners;
				if($functions->imagen($fotos, $max, $photo_partners_name, $path, $actual)){
					$photo_partners = $photo_partners_name;
				}
			}

			if($partners->update($args['id'], $name_partners, $active_partners, $photo_partners, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$partners->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/partners/partners.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'partners' => $partners, 'cpartners' => $cpartners]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $partners, $functions;

		$cpartners = file_get_contents(_DATA_ . '/partners.json');
		$cpartners = json_decode($cpartners, true);

		$content['v_part']  = 'active';

		$content['modulo'] = "Partners";
		$content['sector'] = "Partners";
		$content['back'] = _HOST_.'/admin/partners';

		$content['title'] = "Partners";
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$return_data = null;

		if(isset($_POST['btn-save'])){
			$orden = json_decode($_POST['orden'], true);
			if (count($orden) > 0) {
				foreach ($orden as $key => $value) {
					$partners->orden($value['id'], $key);
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/partners/partners.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'partners' => $partners, 'cpartners' => $cpartners]);
		return $response;

	}

}