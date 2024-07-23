<?php
namespace App\Backend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Testimonios extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $testimonios;

		$content['v_t']  = 'active';

		$content['modulo'] = "Testimonios";
		$content['sector'] = "Testimonios";
		$content['back'] = _HOST_.'/admin/testimonios';

		$content['title'] = "Testimonios";
		$content['cabezado'] = "Listado";

		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				echo $testimonios->tabla($requestData, $content['back']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				echo $testimonios->delete($_POST['del_id']);
				return $response->withHeader('Content-type', 'application/json');
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/testimonios\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/testimonios/testimonios.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $testimonios, $functions;

		$ctestimonios = file_get_contents(_DATA_ . '/testimonios.json');
		$ctestimonios = json_decode($ctestimonios, true);

		$content['v_t']  = 'active';

		$content['modulo'] = "Testimonios";
		$content['sector'] = "Testimonios";
		$content['back'] = _HOST_.'/admin/testimonios';

		$content['title'] = "Testimonios";
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$return_data = null;

		if(isset($_POST['btn-save'])){

			$name_testimonios = trim($_POST['name_testimonios']);
			$active_testimonios = trim($_POST['active_testimonios']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			//envio de nombre de imagenes de la db actual
			$photo = (isset($_POST['photo'])) ? $_POST['photo'] : array();

			//envio de archivos
			$photo_send = (isset($_FILES['photo_send'])) ? $_FILES['photo_send'] : array();

			//Aqui para probar lo que se envia
			// print_r($photo);
			// print_r($photo_send);
			// print_r($ctestimonios);
			// exit();

			$functions->msje = '';


			//Agregar imagenes actuales
			$photo_testimonios = $photo;

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

							$max[0]['size'] = $ctestimonios[$value]['size'];
							$max[0]['path'] = $value . '/big/';
							$max[1]['size'] = 300;
							$max[1]['path'] = $value . '/small/';

							$nombre = $name_testimonios;

							$path = _HOSTDIR_."/uploads/testimonios/";


							$ext = explode(".", $fotos['name']);
							$extension = end($ext);
							$photo_testimonios_name = $functions->seo(trim($nombre)) .".".$extension;
							$actual = $photo[$value];


							if($functions->imagen($fotos, $max, $photo_testimonios_name, $path, $actual)){
								$photo_testimonios[$value] = $photo_testimonios_name;
							}
						}
					}
				}

			}

			//Guardar imagenes
			$photo_testimonios = json_encode($photo_testimonios);



			if($testimonios->add($name_testimonios, $active_testimonios, $photo_testimonios, $extra)){
				$this->functions->redirect(_HOST_."/admin/testimonios?n");
				return $response;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' . $functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/testimonios/testimonios.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'ctestimonios' => $ctestimonios]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $testimonios, $functions;

		$ctestimonios = file_get_contents(_DATA_ . '/testimonios.json');
		$ctestimonios = json_decode($ctestimonios, true);

		$content['v_t']  = 'active';

		$content['modulo'] = "Testimonios";
		$content['sector'] = "Testimonios";
		$content['back'] = _HOST_.'/admin/testimonios';

		$content['title'] = "Testimonios";
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$return_data = null;


		if(isset($_POST['btn-save'])){

			$name_testimonios = trim($_POST['name_testimonios']);
			$active_testimonios = trim($_POST['active_testimonios']);
			$extra = (isset($_POST['extra'])) ? json_encode($_POST['extra']) : '[]';
			//envio de nombre de imagenes de la db actual
			$photo = (isset($_POST['photo'])) ? $_POST['photo'] : array();

			//envio de archivos
			$photo_send = (isset($_FILES['photo_send'])) ? $_FILES['photo_send'] : array();

			//Aqui para probar lo que se envia
			// print_r($photo);
			// print_r($photo_send);
			// print_r($ctestimonios);
			// exit();

			$functions->msje = '';


			//Agregar imagenes actuales
			$photo_testimonios = $photo;

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

							$max[0]['size'] = $ctestimonios[$value]['size'];
							$max[0]['path'] = $value . '/big/';
							$max[1]['size'] = 300;
							$max[1]['path'] = $value . '/small/';

							$nombre = $name_testimonios;

							$path = _HOSTDIR_."/uploads/testimonios/";


							$ext = explode(".", $fotos['name']);
							$extension = end($ext);
							$photo_testimonios_name = $functions->seo(trim($nombre)) .".".$extension;
							$actual = $photo[$value];


							if($functions->imagen($fotos, $max, $photo_testimonios_name, $path, $actual)){
								$photo_testimonios[$value] = $photo_testimonios_name;
							}
						}
					}
				}

			}

			//Guardar imagenes
			$photo_testimonios = json_encode($photo_testimonios);

			if($testimonios->update($args['id'], $name_testimonios, $active_testimonios, $photo_testimonios, $extra)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. ';
			}

		}

		if(!$testimonios->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$response = $this->ci->view->render($response, 'backend/testimonios/testimonios.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'testimonios' => $testimonios, 'ctestimonios' => $ctestimonios]);
		return $response;
	}

	public function orden(Request $request, Response $response, $args){

		global $testimonios, $functions;

		$ctestimonios = file_get_contents(_DATA_ . '/testimonios.json');
		$ctestimonios = json_decode($ctestimonios, true);

		$content['v_t']  = 'active';

		$content['modulo'] = "Testimonios";
		$content['sector'] = "Testimonios";
		$content['back'] = _HOST_.'/admin/testimonios';

		$content['title'] = "Testimonios";
		$content['cabezado'] = "Orden";

		$args['type'] = 'orden';

		$return_data = null;

		if(isset($_POST['btn-save'])){
			$orden = json_decode($_POST['orden'], true);
			if (count($orden) > 0) {
				foreach ($orden as $key => $value) {
					$testimonios->orden($value['id'], $key);
				}
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/testimonios/testimonios.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'testimonios' => $testimonios, 'ctestimonios' => $ctestimonios]);
		return $response;

	}

}