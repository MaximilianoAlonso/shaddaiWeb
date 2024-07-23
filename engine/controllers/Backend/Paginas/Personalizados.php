<?php
namespace App\Backend\Paginas;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Personalizados extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $personalizados;

		$content['v_pa']  = $content['v_pa_4']  = 'active';

		$content['modulo'] = "Personalizados";
		$content['sector'] = "Personalizados";
		$content['back'] = _HOST_.'/admin/paginas/personalizados';
		$content['sector2'] = "Páginas";
		$content['back2'] = _HOST_.'/admin/paginas';

		$content['title'] = "Personalizados";
		$content['cabezado'] = "Listado";

		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				$personalizados->tabla($requestData, $content['back']);
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				$personalizados->delete($_POST['del_id']);
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/paginas\/personalizados\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/paginas/personalizados.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $personalizados, $functions;

		$content['v_pa']  = $content['v_pa_4']  = 'active';

		$content['modulo'] = "Personalizados";
		$content['sector'] = "Personalizados";
		$content['back'] = _HOST_.'/admin/paginas/personalizados';
		$content['sector2'] = "Páginas";
		$content['back2'] = _HOST_.'/admin/paginas';

		$content['title'] = "Personalizados";
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$return_data = null;

		if(isset($_POST['btn-save'])){

			$name_personalizados = trim($_POST['name_personalizados']);
			$seo_personalizados = trim($_POST['seo_personalizados']);
			$contenidos_personalizados = trim($_POST['contenidos_personalizados']);
			$titulo_personalizados = trim($_POST['titulo_personalizados']);
			$descripcion_personalizados = trim($_POST['descripcion_personalizados']);
			$keywords_personalizados = trim($_POST['keywords_personalizados']);
			$activo_personalizados = trim($_POST['activo_personalizados']);


			if($personalizados->add($name_personalizados, $seo_personalizados, $contenidos_personalizados, $titulo_personalizados, $descripcion_personalizados, $keywords_personalizados, $activo_personalizados)){
				$this->functions->redirect(_HOST_."/admin/paginas/personalizados?n");
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/paginas/personalizados.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $personalizados, $functions;

		$content['v_pa']  = $content['v_pa_4']  = 'active';

		$content['modulo'] = "Personalizados";
		$content['sector'] = "Personalizados";
		$content['back'] = _HOST_.'/admin/paginas/personalizados';
		$content['sector2'] = "Páginas";
		$content['back2'] = _HOST_.'/admin/paginas';

		$content['title'] = "Personalizados";
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$return_data = null;


		if(isset($_POST['btn-save'])){

			$name_personalizados = trim($_POST['name_personalizados']);
			$seo_personalizados = trim($_POST['seo_personalizados']);
			$contenidos_personalizados = trim($_POST['contenidos_personalizados']);
			$titulo_personalizados = trim($_POST['titulo_personalizados']);
			$descripcion_personalizados = trim($_POST['descripcion_personalizados']);
			$keywords_personalizados = trim($_POST['keywords_personalizados']);
			$activo_personalizados = trim($_POST['activo_personalizados']);

			if($personalizados->update($args['id'], $name_personalizados, $seo_personalizados, $contenidos_personalizados, $titulo_personalizados, $descripcion_personalizados, $keywords_personalizados, $activo_personalizados)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ' . $functions->msje;
			}

		}

		if(!$personalizados->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/paginas/personalizados.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'personalizados' => $personalizados]);
		return $response;
	}

}