<?php
namespace App\Backend\Servicios;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class SubCategorias extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $servicios_subcategorias;

		$content['v_ser'] = $content['v_ser_3']  = 'active';

		$content['modulo'] = "Sub-Categorias";

		$content['sector'] = "Sub-Categorias";
		$content['back'] = _HOST_.'/admin/servicios/subcategorias';

		$content['sector2'] = "Servicios";
		$content['back2'] = _HOST_.'/admin/servicios';

		$content['title'] = "Sub-Categorias";
		$content['cabezado'] = "Listado";

		$cservicios = file_get_contents(_DATA_ . '/servicios.json');
		$cservicios = json_decode($cservicios, true);
		
		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $servicios_subcategorias->tabla($requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $servicios_subcategorias->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/subcategorias\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/servicios/subcategorias.twig', ['content' => $content, 'cservicios' => $cservicios, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $servicios_subcategorias, $servicios_categorias, $functions;

		$content['v_ser'] = $content['v_ser_3']  = 'active';

		$content['modulo'] = "Sub-Categorias";
		$content['sector'] = "Sub-Categorias";
		$content['back'] = _HOST_.'/admin/servicios/subcategorias';

		$content['sector2'] = "Servicios";
		$content['back2'] = _HOST_.'/admin/servicios';

		$content['title'] = "Sub-Categorias";
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$cservicios = file_get_contents(_DATA_ . '/servicios.json');
		$cservicios = json_decode($cservicios, true);
		
		$return_data = null;

		if(isset($_GET['title'])){
			if (isset($_POST['json'])) {
				$json = (isset($_POST['json'])) ? trim($_POST['json']) : '';
				echo $functions->seo($json);
				return $response;
			}
		}

		if(isset($_POST['btn-save'])){

			$name_subcategorias = trim($_POST['name_subcategorias']);
			$seo_subcategorias = (isset($_POST['seo_subcategorias'])) ? trim($_POST['seo_subcategorias']) : '';
			$active_subcategorias = trim($_POST['active_subcategorias']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_subcategorias = (isset($_POST['photo_subcategorias'])) ? trim($_POST['photo_subcategorias']) : '';
			$id_categorias = (isset($_POST['id_categorias'])) ? trim($_POST['id_categorias']) : 0;

			$functions->msje = '';

			if(isset($_POST['photo_subcategorias']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cservicios['categorias']['size'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = 300;
				$max[1]['path'] = 'small/';
				$nombre = $name_subcategorias;
				$path = _HOSTDIR_."/uploads/servicios/subcategorias/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_subcategorias_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_subcategorias;
				if($functions->imagen($fotos, $max, $photo_subcategorias_name, $path, $actual)){
					$photo_subcategorias = $photo_subcategorias_name;
				}
			}


			if($servicios_subcategorias->add($name_subcategorias, $seo_subcategorias, $active_subcategorias, $photo_subcategorias, $id_categorias, $extra)){
				$this->functions->redirect(_HOST_."/admin/servicios/subcategorias?n");
				return $response;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/servicios/subcategorias.twig', ['content' => $content, 'cservicios' => $cservicios, 'args' => $args, 'return_data' => $return_data, 'servicios_categorias' => $servicios_categorias]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $servicios_subcategorias, $servicios_categorias, $functions;

		$content['v_ser'] = $content['v_ser_3']  = 'active';

		$content['modulo'] = "Sub-Categorias";
		$content['sector'] = "Sub-Categorias";
		$content['back'] = _HOST_.'/admin/servicios/subcategorias';

		$content['sector2'] = "Servicios";
		$content['back2'] = _HOST_.'/admin/servicios';

		$content['title'] = "Sub-Categorias";
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$cservicios = file_get_contents(_DATA_ . '/servicios.json');
		$cservicios = json_decode($cservicios, true);
		
		$return_data = null;

		if(isset($_GET['title'])){
			if (isset($_POST['json'])) {
				$json = (isset($_POST['json'])) ? trim($_POST['json']) : '';
				echo $functions->seo($json);
				return $response;
			}
		}


		if(isset($_POST['btn-save'])){

			$name_subcategorias = trim($_POST['name_subcategorias']);
			$seo_subcategorias = (isset($_POST['seo_subcategorias'])) ? trim($_POST['seo_subcategorias']) : '';
			$active_subcategorias = trim($_POST['active_subcategorias']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_subcategorias = (isset($_POST['photo_subcategorias'])) ? trim($_POST['photo_subcategorias']) : '';
			$id_categorias = (isset($_POST['id_categorias'])) ? trim($_POST['id_categorias']) : 0;

			$functions->msje = '';

			if(isset($_POST['photo_subcategorias']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cservicios['categorias']['size'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = 300;
				$max[1]['path'] = 'small/';
				$nombre = $name_subcategorias;
				$path = _HOSTDIR_."/uploads/servicios/subcategorias/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_subcategorias_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_subcategorias;
				if($functions->imagen($fotos, $max, $photo_subcategorias_name, $path, $actual)){
					$photo_subcategorias = $photo_subcategorias_name;
				}
			}

			if($servicios_subcategorias->update($args['id'], $name_subcategorias, $seo_subcategorias, $active_subcategorias, $photo_subcategorias, $id_categorias, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$servicios_subcategorias->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/servicios/subcategorias.twig', ['content' => $content, 'cservicios' => $cservicios, 'args' => $args, 'return_data' => $return_data, 'servicios_subcategorias' => $servicios_subcategorias, 'servicios_categorias' => $servicios_categorias]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $servicios_subcategorias, $servicios_categorias, $functions;

		$content['v_ser'] = $content['v_ser_3']  = 'active';

		$content['modulo'] = "Sub-Categorias";
		$content['sector'] = "Sub-Categorias";
		$content['back'] = _HOST_.'/admin/servicios/subcategorias';

		$content['sector2'] = "Servicios";
		$content['back2'] = _HOST_.'/admin/servicios';

		$content['title'] = "Sub-Categorias";
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$cservicios = file_get_contents(_DATA_ . '/servicios.json');
		$cservicios = json_decode($cservicios, true);
		
		$return_data = null;

		if(isset($_POST['btn-save'])){
			$orden = json_decode($_POST['orden'], true);
			if (count($orden) > 0) {
				foreach ($orden as $key => $value) {
					$servicios_subcategorias->orden($value['id'], $key);
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/servicios/subcategorias.twig', ['content' => $content, 'cservicios' => $cservicios, 'args' => $args, 'return_data' => $return_data, 'servicios_subcategorias' => $servicios_subcategorias, 'servicios_categorias' => $servicios_categorias]);
		return $response;

	}

}