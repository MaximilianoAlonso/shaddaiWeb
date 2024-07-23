<?php
namespace App\Backend\Preguntas;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Respuestas extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $preguntas_respuestas, $preguntas;

		$content['v_pre']  = 'active';

		if(!$preguntas->edit($args['preguntas'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['modulo'] = "Respuestas";
		$content['sector'] = "Respuestas";
		$content['back'] = _HOST_.'/admin/preguntas/'.$args['preguntas'].'/respuestas';
		$content['sector2'] = "Preguntas Frecuentes";
		$content['back2'] = _HOST_.'/admin/preguntas';

		$content['title'] = "Respuestas: ".$preguntas->name_preguntas;
		$content['cabezado'] = "Listado";

		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				$preguntas_respuestas->tabla($args['preguntas'], $requestData, $content['back']);
			}
		}
		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				$preguntas->delete($_POST['del_id']);
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('\/preguntas\/'.$args['preguntas'].'\/respuestas\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/preguntas/respuestas.twig', ['content' => $content, 'args' => $args, 'preguntas' => $preguntas, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $preguntas_respuestas, $preguntas, $functions;

		$content['v_pre']  = 'active';

		if(!$preguntas->edit($args['preguntas'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['modulo'] = "Respuestas";
		$content['sector'] = "Respuestas";
		$content['back'] = _HOST_.'/admin/preguntas/'.$args['preguntas'].'/respuestas';
		$content['sector2'] = "Preguntas Frecuentes";
		$content['back2'] = _HOST_.'/admin/preguntas';

		$content['title'] = "Respuestas: ".$preguntas->name_preguntas;
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$return_data = null;

		if(isset($_POST['btn-save'])){

			$name_respuestas = trim($_POST['name_respuestas']);
			$activo_respuestas = trim($_POST['activo_respuestas']);
			$extra = json_encode($_POST['extra']);

			if($preguntas_respuestas->add($args['preguntas'], $name_respuestas, $activo_respuestas, $extra)){
				$this->functions->redirect(_HOST_."/admin/preguntas/".$args['preguntas']."/respuestas?n");
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ';
			}

		}

		$response = $this->ci->view->render($response, 'backend/preguntas/respuestas.twig', ['content' => $content, 'args' => $args, 'preguntas' => $preguntas, 'return_data' => $return_data]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $preguntas_respuestas, $preguntas, $functions;

		$content['v_pre']  = 'active';

		if(!$preguntas->edit($args['preguntas'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['modulo'] = "Respuestas";
		$content['sector'] = "Respuestas";
		$content['back'] = _HOST_.'/admin/preguntas/'.$args['preguntas'].'/respuestas';
		$content['sector2'] = "Preguntas Frecuentes";
		$content['back2'] = _HOST_.'/admin/preguntas';

		$content['title'] = "Respuestas: ".$preguntas->name_preguntas;
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$return_data = null;


		if(isset($_POST['btn-save'])){

			$name_respuestas = trim($_POST['name_respuestas']);
			$activo_respuestas = trim($_POST['activo_respuestas']);
			$extra = json_encode($_POST['extra']);

			if($preguntas_respuestas->update($args['id'], $name_respuestas, $activo_respuestas, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$preguntas_respuestas->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/preguntas/respuestas.twig', ['content' => $content, 'args' => $args, 'preguntas' => $preguntas, 'return_data' => $return_data, 'preguntas_respuestas' => $preguntas_respuestas]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $preguntas_respuestas, $preguntas, $functions;

		$content['v_pre']  = 'active';

		if(!$preguntas->edit($args['preguntas'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['modulo'] = "Respuestas";
		$content['sector'] = "Respuestas";
		$content['back'] = _HOST_.'/admin/preguntas/'.$args['preguntas'].'/respuestas';
		$content['sector2'] = "Preguntas Frecuentes";
		$content['back2'] = _HOST_.'/admin/preguntas';

		$content['title'] = "Respuestas: ".$preguntas->name_preguntas;
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$return_data = null;

		if(isset($_POST['btn-save'])){
			$data = json_decode($_POST['respuestas'], true);
			if (count($data) > 0) {
				$i = 1;
				foreach ($data as $key => $value) {
					$preguntas_respuestas->orden($value['id'], $i);
					$i++;
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}
		}

		$response = $this->ci->view->render($response, 'backend/preguntas/respuestas.twig', ['content' => $content, 'args' => $args, 'preguntas' => $preguntas, 'return_data' => $return_data, 'preguntas_respuestas' => $preguntas_respuestas]);
		return $response;

	}

}