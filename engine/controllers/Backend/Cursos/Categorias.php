<?php
namespace App\Backend\Cursos;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Categorias extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $cursos_categorias;

		$content['v_cursos'] = $content['v_cursos_2']  = 'active';

		$content['modulo'] = "Categorias";

		$content['sector'] = "Categorias";
		$content['back'] = _HOST_.'/admin/cursos/categorias';

		$content['sector2'] = "Cursos";
		$content['back2'] = _HOST_.'/admin/cursos';

		$content['title'] = "Categorias";
		$content['cabezado'] = "Listado";

		$ccursos = file_get_contents(_DATA_ . '/cursos.json');
		$ccursos = json_decode($ccursos, true);
		
		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $cursos_categorias->tabla($requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $cursos_categorias->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/categorias\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/cursos/categorias.twig', ['content' => $content, 'ccursos' => $ccursos, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $cursos_categorias, $cursos_lineas, $functions;

		$content['v_cursos'] = $content['v_cursos_2']  = 'active';

		$content['modulo'] = "Categorias";
		$content['sector'] = "Categorias";
		$content['back'] = _HOST_.'/admin/cursos/categorias';

		$content['sector2'] = "Cursos";
		$content['back2'] = _HOST_.'/admin/cursos';

		$content['title'] = "Categorias";
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$ccursos = file_get_contents(_DATA_ . '/cursos.json');
		$ccursos = json_decode($ccursos, true);
		
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
			$id_lineas = (isset($_POST['id_lineas'])) ? trim($_POST['id_lineas']) : 0;

			$functions->msje = '';

			//envio de nombre de imagenes de la db actual
			$photo = (isset($_POST['photo'])) ? $_POST['photo'] : array();

			//envio de archivos
			$photo_send = (isset($_FILES['photo_send'])) ? $_FILES['photo_send'] : array();

			//Aqui para probar lo que se envia
			// print_r($photo);
			// print_r($photo_send);
			// print_r($ccursos);
			// exit();

			$functions->msje = '';


			//Agregar imagenes actuales
			$photo_categorias = $photo;

			//Verificar data de imagenes
			if (count($photo_send) > 0) {

				$files = array();
				//Verificar cantidad de imagenes
				foreach ($photo_send['name'] as $key => $value) {
					$files[] = $key;
				}

				if (count($files) > 0) {
					foreach ($files as $key => $value) {


						if($photo_send['name'][$value] != ""){

							//Nombre de variable $value ejemplo "fondo"

							//Independizar Imagen
							$fotos = array();
							$fotos['name'] = $photo_send['name'][$value];
							$fotos['size'] = $photo_send['size'][$value];
							$fotos['tmp_name'] = $photo_send['tmp_name'][$value];

							$max[0]['size'] = $ccursos[$value]['size'];
							$max[0]['path'] = $value . '/big/';
							$max[1]['size'] = 300;
							$max[1]['path'] = $value . '/small/';

							$nombre = $name_categorias;

							$path = _HOSTDIR_."/uploads/cursos/categorias/";


							$ext = explode(".", $fotos['name']);
							$extension = end($ext);
							$photo_categorias_name = $functions->seo(trim($nombre)) .".".$extension;
							$actual = $photo[$value];


							if($functions->imagen($fotos, $max, $photo_categorias_name, $path, $actual)){
								$photo_categorias[$value] = $photo_categorias_name;
							}
						}
					}
				}

			}

			//Guardar imagenes
			$photo_categorias = json_encode($photo_categorias);


			if($cursos_categorias->add($name_categorias, $seo_categorias, $active_categorias, $photo_categorias, $id_lineas, $extra)){
				$this->functions->redirect(_HOST_."/admin/cursos/categorias?n");
				return $response;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/cursos/categorias.twig', ['content' => $content, 'ccursos' => $ccursos, 'args' => $args, 'return_data' => $return_data, 'cursos_lineas' => $cursos_lineas]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $cursos_categorias, $cursos_lineas, $functions;

		$content['v_cursos'] = $content['v_cursos_2']  = 'active';

		$content['modulo'] = "Categorias";
		$content['sector'] = "Categorias";
		$content['back'] = _HOST_.'/admin/cursos/categorias';

		$content['sector2'] = "Cursos";
		$content['back2'] = _HOST_.'/admin/cursos';

		$content['title'] = "Categorias";
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$ccursos = file_get_contents(_DATA_ . '/cursos.json');
		$ccursos = json_decode($ccursos, true);
		
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
			$id_lineas = (isset($_POST['id_lineas'])) ? trim($_POST['id_lineas']) : 0;

			$functions->msje = '';

			//envio de nombre de imagenes de la db actual
			$photo = (isset($_POST['photo'])) ? $_POST['photo'] : array();

			//envio de archivos
			$photo_send = (isset($_FILES['photo_send'])) ? $_FILES['photo_send'] : array();

			//Aqui para probar lo que se envia
			// print_r($photo);
			// print_r($photo_send);
			// print_r($ccursos);
			// exit();

			$functions->msje = '';


			//Agregar imagenes actuales
			$photo_categorias = $photo;

			//Verificar data de imagenes
			if (count($photo_send) > 0) {

				$files = array();
				//Verificar cantidad de imagenes
				foreach ($photo_send['name'] as $key => $value) {
					$files[] = $key;
				}

				if (count($files) > 0) {
					foreach ($files as $key => $value) {


						if($photo_send['name'][$value] != ""){

							//Nombre de variable $value ejemplo "fondo"

							//Independizar Imagen
							$fotos = array();
							$fotos['name'] = $photo_send['name'][$value];
							$fotos['size'] = $photo_send['size'][$value];
							$fotos['tmp_name'] = $photo_send['tmp_name'][$value];

							$max[0]['size'] = $ccursos[$value]['size'];
							$max[0]['path'] = $value . '/big/';
							$max[1]['size'] = 300;
							$max[1]['path'] = $value . '/small/';

							$nombre = $name_categorias;

							$path = _HOSTDIR_."/uploads/cursos/categorias/";


							$ext = explode(".", $fotos['name']);
							$extension = end($ext);
							$photo_categorias_name = $functions->seo(trim($nombre)) .".".$extension;
							$actual = $photo[$value];


							if($functions->imagen($fotos, $max, $photo_categorias_name, $path, $actual)){
								$photo_categorias[$value] = $photo_categorias_name;
							}
						}
					}
				}

			}

			//Guardar imagenes
			$photo_categorias = json_encode($photo_categorias);

			if($cursos_categorias->update($args['id'], $name_categorias, $seo_categorias, $active_categorias, $photo_categorias, $id_lineas, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$cursos_categorias->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/cursos/categorias.twig', ['content' => $content, 'ccursos' => $ccursos, 'args' => $args, 'return_data' => $return_data, 'cursos_categorias' => $cursos_categorias, 'cursos_lineas' => $cursos_lineas]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $cursos_categorias, $cursos_lineas, $functions;

		$content['v_cursos'] = $content['v_cursos_2']  = 'active';

		$content['modulo'] = "Categorias";
		$content['sector'] = "Categorias";
		$content['back'] = _HOST_.'/admin/cursos/categorias';

		$content['sector2'] = "Cursos";
		$content['back2'] = _HOST_.'/admin/cursos';

		$content['title'] = "Categorias";
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$ccursos = file_get_contents(_DATA_ . '/cursos.json');
		$ccursos = json_decode($ccursos, true);
		
		$return_data = null;

		if(isset($_POST['btn-save'])){
			$orden = json_decode($_POST['orden'], true);
			if (count($orden) > 0) {
				foreach ($orden as $key => $value) {
					$cursos_categorias->orden($value['id'], $key);
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/cursos/categorias.twig', ['content' => $content, 'ccursos' => $ccursos, 'args' => $args, 'return_data' => $return_data, 'cursos_categorias' => $cursos_categorias, 'cursos_lineas' => $cursos_lineas]);
		return $response;

	}

}