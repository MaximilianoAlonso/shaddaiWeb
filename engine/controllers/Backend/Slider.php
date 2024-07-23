<?php
namespace App\Backend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Slider extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $slider;

		$content['v_b']  = 'active';

		$content['modulo'] = "Slider";
		$content['sector'] = "Slider";
		$content['back'] = _HOST_.'/admin/slider';

		$content['title'] = "Slider";
		$content['cabezado'] = "Listado";

		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $slider->tabla($requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $slider->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/slider\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/slider/slider.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $slider, $functions;

		$cslider = file_get_contents(_DATA_ . '/slider.json');
		$cslider = json_decode($cslider, true);

		$content['v_b']  = 'active';

		$content['modulo'] = "Slider";
		$content['sector'] = "Slider";
		$content['back'] = _HOST_.'/admin/slider';

		$content['title'] = "Slider";
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$return_data = null;

		if(isset($_POST['btn-save'])){

			$name_slider = trim($_POST['name_slider']);
			$active_slider = trim($_POST['active_slider']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_slider = trim($_POST['photo_slider']);

			$functions->msje = '';

			if($_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cslider['size'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = 300;
				$max[1]['path'] = 'small/';
				$nombre = $name_slider;
				$path = _HOSTDIR_."/uploads/slider/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_slider_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_slider;
				if($functions->imagen($fotos, $max, $photo_slider_name, $path, $actual)){
					$photo_slider = $photo_slider_name;
				}
			}


			if($slider->add($name_slider, $active_slider, $photo_slider, $extra)){
				$this->functions->redirect(_HOST_."/admin/slider?n");
				return $response;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/slider/slider.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'cslider' => $cslider]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $slider, $functions;

		$cslider = file_get_contents(_DATA_ . '/slider.json');
		$cslider = json_decode($cslider, true);

		$content['v_b']  = 'active';

		$content['modulo'] = "Slider";
		$content['sector'] = "Slider";
		$content['back'] = _HOST_.'/admin/slider';

		$content['title'] = "Slider";
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$return_data = null;


		if(isset($_POST['btn-save'])){

			$name_slider = trim($_POST['name_slider']);
			$active_slider = trim($_POST['active_slider']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_slider = trim($_POST['photo_slider']);

			$functions->msje = '';

			if($_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $cslider['size'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = 300;
				$max[1]['path'] = 'small/';
				$nombre = $name_slider;
				$path = _HOSTDIR_."/uploads/slider/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_slider_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_slider;
				if($functions->imagen($fotos, $max, $photo_slider_name, $path, $actual)){
					$photo_slider = $photo_slider_name;
				}
			}

			if($slider->update($args['id'], $name_slider, $active_slider, $photo_slider, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$slider->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/slider/slider.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'slider' => $slider, 'cslider' => $cslider]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $slider, $functions;

		$cslider = file_get_contents(_DATA_ . '/slider.json');
		$cslider = json_decode($cslider, true);

		$content['v_b']  = 'active';

		$content['modulo'] = "Slider";
		$content['sector'] = "Slider";
		$content['back'] = _HOST_.'/admin/slider';

		$content['title'] = "Slider";
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$return_data = null;

		if(isset($_POST['btn-save'])){
			$orden = json_decode($_POST['orden'], true);
			if (count($orden) > 0) {
				foreach ($orden as $key => $value) {
					$slider->orden($value['id'], $key);
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/slider/slider.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'slider' => $slider, 'cslider' => $cslider]);
		return $response;

	}

}