<?php
namespace App\Backend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Preguntas extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $preguntas;

		$content['v_pre']  = 'active';

		$content['modulo'] = "Preguntas Frecuentes";
		$content['sector'] = "Preguntas Frecuentes";
		$content['back'] = _HOST_.'/admin/preguntas';

		$content['title'] = "Preguntas Frecuentes";
		$content['cabezado'] = "Listado";

		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				$preguntas->tabla($requestData, $content['back']);
			}
		}
		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				$preguntas->delete($_POST['del_id']);
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('\/preguntas\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/preguntas/preguntas.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $preguntas, $functions;

		$content['v_pre']  = 'active';

		$content['modulo'] = "Preguntas Frecuentes";
		$content['sector'] = "Preguntas Frecuentes";
		$content['back'] = _HOST_.'/admin/preguntas';

		$content['title'] = "Preguntas Frecuentes";
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$return_data = null;

		if(isset($_POST['btn-save'])){

			$name_preguntas = trim($_POST['name_preguntas']);
			$activo_preguntas = trim($_POST['activo_preguntas']);

			if($preguntas->add($name_preguntas, $activo_preguntas)){
				$this->functions->redirect(_HOST_."/admin/preguntas?n");
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ';
			}

		}

		$response = $this->ci->view->render($response, 'backend/preguntas/preguntas.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $preguntas, $functions;

		$content['v_pre']  = 'active';

		$content['modulo'] = "Preguntas Frecuentes";
		$content['sector'] = "Preguntas Frecuentes";
		$content['back'] = _HOST_.'/admin/preguntas';

		$content['title'] = "Preguntas Frecuentes";
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$return_data = null;


		if(isset($_POST['btn-save'])){

			$name_preguntas = trim($_POST['name_preguntas']);
			$activo_preguntas = trim($_POST['activo_preguntas']);

			if($preguntas->update($args['id'], $name_preguntas, $activo_preguntas)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$preguntas->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/preguntas/preguntas.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'preguntas' => $preguntas]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $preguntas, $functions;

		$content['v_pre']  = 'active';

		$content['modulo'] = "Preguntas Frecuentes";
		$content['sector'] = "Preguntas Frecuentes";
		$content['back'] = _HOST_.'/admin/preguntas';

		$content['title'] = "Preguntas Frecuentes";
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$return_data = null;

		if(isset($_POST['btn-save'])){
			$data = json_decode($_POST['preguntas'], true);
			if (count($data) > 0) {
				$i = 1;
				foreach ($data as $key => $value) {
					$preguntas->orden($value['id'], $i);
					$i++;
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}
		}

		$response = $this->ci->view->render($response, 'backend/preguntas/preguntas.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'preguntas' => $preguntas]);
		return $response;

	}

}