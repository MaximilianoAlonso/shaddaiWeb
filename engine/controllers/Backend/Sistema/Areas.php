<?php
namespace App\Backend\Sistema;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Areas extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $areas;

		$content['v_s']  = $content['v_s_2']  = 'active';

		$content['modulo'] = "Areas";
		$content['sector'] = "Areas";
		$content['back'] = _HOST_.'/admin/sistema/areas';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/sistema';

		$content['title'] = "Areas";
		$content['cabezado'] = "Listado";

		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $areas->tabla($requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}
		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $areas->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/sistema\/areas\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/sistema/areas.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $areas, $functions;

		$content['v_s']  = $content['v_s_2']  = 'active';

		$content['modulo'] = "Areas";
		$content['sector'] = "Areas";
		$content['back'] = _HOST_.'/admin/sistema/areas';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/sistema';

		$content['title'] = "Areas";
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$return_data = null;

		if(isset($_POST['btn-save'])){

			$name_area = trim($_POST['name_area']);

			if($areas->add($name_area)){
				$this->functions->redirect(_HOST_."/admin/sistema/areas?n");
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ';
			}

		}

		$response = $this->ci->view->render($response, 'backend/sistema/areas.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $areas, $functions;

		$content['v_s']  = $content['v_s_2']  = 'active';

		$content['modulo'] = "Areas";
		$content['sector'] = "Areas";
		$content['back'] = _HOST_.'/admin/sistema/areas';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/sistema';

		$content['title'] = "Areas";
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$return_data = null;


		if(isset($_POST['btn-save'])){

			$name_area = trim($_POST['name_area']);

			if($areas->update($args['id'], $name_area)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$areas->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/sistema/areas.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'areas' => $areas]);
		return $response;
	}

}