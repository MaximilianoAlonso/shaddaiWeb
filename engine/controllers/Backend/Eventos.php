<?php
namespace App\Backend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Eventos extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $eventos;

		$content['v_e'] = $content['v_e_4']  = 'active';

		$content['modulo'] = "Eventos";

		$content['sector'] = "Eventos";
		$content['back'] = _HOST_.'/admin/eventos';

		$content['title'] = "Eventos";
		$content['cabezado'] = "Listado";

		$ceventos = file_get_contents(_DATA_ . '/eventos.json');
		$ceventos = json_decode($ceventos, true);
		
		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $eventos->tabla($requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $eventos->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/eventos\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/eventos/eventos.twig', ['content' => $content, 'ceventos' => $ceventos, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $eventos, $eventos_lineas, $eventos_categorias, $eventos_subcategorias, $functions;

		$content['v_e'] = $content['v_e_4']  = 'active';

		$content['modulo'] = "Eventos";
		$content['sector'] = "Eventos";
		$content['back'] = _HOST_.'/admin/eventos';

		$content['title'] = "Eventos";
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$ceventos = file_get_contents(_DATA_ . '/eventos.json');
		$ceventos = json_decode($ceventos, true);
		
		$return_data = null;

		if(isset($_POST['btn-save'])){

			$name_eventos = trim($_POST['name_eventos']);
			$seo_eventos = (isset($_POST['seo_eventos'])) ? trim($_POST['seo_eventos']) : '';
			$active_eventos = trim($_POST['active_eventos']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_eventos = (isset($_POST['photo_eventos'])) ? trim($_POST['photo_eventos']) : '';
			$id_lineas = (isset($_POST['id_lineas'])) ? trim($_POST['id_lineas']) : 0;
			$id_categorias = (isset($_POST['id_categorias'])) ? trim($_POST['id_categorias']) : 0;
			$id_subcategorias = (isset($_POST['id_subcategorias'])) ? trim($_POST['id_subcategorias']) : 0;

			$functions->msje = '';

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
						$return_data['data'] = $eventos_categorias->select(null, $lineas);
					}else if($form == "categorias"){
						$categorias = trim($_POST['categorias']);
						$return_data['type'] = 'success';
						$return_data['data'] = $eventos_subcategorias->select(null, $categorias);
					}else{
						$return_data['type'] = 'error';
						$return_data['msje'] = 'Error no se pudo consultar en la base de datos. Intente de nuevo.';
					}
					echo json_encode($return_data);
					return $response->withHeader('Content-type', 'application/json');
				}
			}


			if(isset($_POST['photo_eventos']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $ceventos['eventos']['size']['max'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = $ceventos['eventos']['size']['min'];
				$max[1]['path'] = 'small/';
				$nombre = $name_eventos;
				$path = _HOSTDIR_."/uploads/eventos/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_eventos_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_eventos;
				if($functions->imagen($fotos, $max, $photo_eventos_name, $path, $actual)){
					$photo_eventos = $photo_eventos_name;
				}
			}


			if($eventos->add($name_eventos, $seo_eventos, $active_eventos, $photo_eventos, $id_lineas, $id_categorias, $id_subcategorias, $extra)){
				$this->functions->redirect(_HOST_."/admin/eventos?n");
				return $response;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/eventos/eventos.twig', ['content' => $content, 'ceventos' => $ceventos, 'args' => $args, 'return_data' => $return_data, 'eventos_lineas' => $eventos_lineas, 'eventos_categorias' => $eventos_categorias, 'eventos_subcategorias' => $eventos_subcategorias]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $eventos, $eventos_lineas, $eventos_categorias, $eventos_subcategorias, $functions;

		$content['v_e'] = $content['v_e_4']  = 'active';

		$content['modulo'] = "Eventos";
		$content['sector'] = "Eventos";
		$content['back'] = _HOST_.'/admin/eventos';

		$content['title'] = "Eventos";
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$ceventos = file_get_contents(_DATA_ . '/eventos.json');
		$ceventos = json_decode($ceventos, true);
		
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
					$return_data['data'] = $eventos_categorias->select(null, $lineas);
				}else if($form == "categorias"){
					$categorias = trim($_POST['categorias']);
					$return_data['type'] = 'success';
					$return_data['data'] = $eventos_subcategorias->select(null, $categorias);
				}else{
					$return_data['type'] = 'error';
					$return_data['msje'] = 'Error no se pudo consultar en la base de datos. Intente de nuevo.';
				}
				echo json_encode($return_data);
				return $response->withHeader('Content-type', 'application/json');
			}
		}


		if(isset($_POST['btn-save'])){

			$name_eventos = trim($_POST['name_eventos']);
			$seo_eventos = (isset($_POST['seo_eventos'])) ? trim($_POST['seo_eventos']) : '';
			$active_eventos = trim($_POST['active_eventos']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			$photo_eventos = (isset($_POST['photo_eventos'])) ? trim($_POST['photo_eventos']) : '';
			$id_lineas = (isset($_POST['id_lineas'])) ? trim($_POST['id_lineas']) : 0;
			$id_categorias = (isset($_POST['id_categorias'])) ? trim($_POST['id_categorias']) : 0;
			$id_subcategorias = (isset($_POST['id_subcategorias'])) ? trim($_POST['id_subcategorias']) : 0;

			$functions->msje = '';

			if(isset($_POST['photo_eventos']) && $_FILES['fotos']['name'] != ""){
				$max[0]['size'] = $ceventos['eventos']['size']['max'];
				$max[0]['path'] = 'big/';
				$max[1]['size'] = $ceventos['eventos']['size']['min'];
				$max[1]['path'] = 'small/';
				$nombre = $name_eventos;
				$path = _HOSTDIR_."/uploads/eventos/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$photo_eventos_name = $functions->seo(trim($nombre)) .".".$extension;
				$actual = $photo_eventos;
				if($functions->imagen($fotos, $max, $photo_eventos_name, $path, $actual)){
					$photo_eventos = $photo_eventos_name;
				}
			}

			if($eventos->update($args['id'], $name_eventos, $seo_eventos, $active_eventos, $photo_eventos, $id_lineas, $id_categorias, $id_subcategorias, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$eventos->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/eventos/eventos.twig', ['content' => $content, 'ceventos' => $ceventos, 'args' => $args, 'return_data' => $return_data, 'eventos' => $eventos, 'eventos_lineas' => $eventos_lineas, 'eventos_categorias' => $eventos_categorias, 'eventos_subcategorias' => $eventos_subcategorias]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $eventos, $eventos_lineas, $eventos_categorias, $eventos_subcategorias, $functions;

		$content['v_e'] = $content['v_e_4']  = 'active';

		$content['modulo'] = "Eventos";
		$content['sector'] = "Eventos";
		$content['back'] = _HOST_.'/admin/eventos';

		$content['title'] = "Eventos";
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$ceventos = file_get_contents(_DATA_ . '/eventos.json');
		$ceventos = json_decode($ceventos, true);
		
		$return_data = null;

		if(isset($_POST['btn-save'])){
			$orden = json_decode($_POST['orden'], true);
			if (count($orden) > 0) {
				foreach ($orden as $key => $value) {
					$eventos->orden($value['id'], $key);
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/eventos/eventos.twig', ['content' => $content, 'ceventos' => $ceventos, 'args' => $args, 'return_data' => $return_data, 'eventos' => $eventos, 'eventos_lineas' => $eventos_lineas, 'eventos_categorias' => $eventos_categorias, 'eventos_subcategorias' => $eventos_subcategorias]);
		return $response;

	}

}