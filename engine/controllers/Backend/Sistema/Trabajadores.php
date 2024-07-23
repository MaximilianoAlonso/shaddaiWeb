<?php
namespace App\Backend\Sistema;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Trabajadores extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $trabajadores;

		$content['v_s']  = $content['v_s_3']  = 'active';

		$content['modulo'] = "Trabajadores";
		$content['sector'] = "Trabajadores";
		$content['back'] = _HOST_.'/admin/sistema/trabajadores';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/sistema';

		$content['title'] = "Trabajadores";
		$content['cabezado'] = "Listado";

		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				$trabajadores->tabla($requestData, $content['back']);
			}
		}
		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				$trabajadores->delete($_POST['del_id']);
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/sistema\/trabajadores\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/sistema/trabajadores.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $trabajadores, $functions, $areas;

		$content['v_s']  = $content['v_s_3']  = 'active';

		$content['modulo'] = "Trabajadores";
		$content['sector'] = "Trabajadores";
		$content['back'] = _HOST_.'/admin/sistema/trabajadores';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/sistema';

		$content['title'] = "Trabajadores";
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$return_data = null;

		if(isset($_POST['btn-save'])){

			$functions->msje = '';
			$worker_dni = trim($_POST['worker_dni']);
			if($_FILES['fotos']['name'] != ""){
				$max[0]['size'] = 90;
				$max[0]['path'] = '';
				$path = _HOSTDIR_."/uploads/workers/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$foto = $worker_dni .".".$extension;
				$functions->imagen($fotos, $max, $foto, $path, $foto);
			}
			$nombre = trim($_POST['nombre']);
			$apellidos = trim($_POST['apellidos']);
			$id_area = trim($_POST['id_area']);
			$email = trim($_POST['email']);
			$cellphone = trim($_POST['cellphone']);
			$vehiculo = trim($_POST['vehiculo']);
			$licencia = trim($_POST['licencia']);
			$address = trim($_POST['address']);

			if($trabajadores->add($worker_dni, $nombre, $apellidos, $id_area, $email, $cellphone, $vehiculo, $licencia, $address)){
				$this->functions->redirect(_HOST_."/admin/sistema/trabajadores?n");
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ' .$functions->msje;
			}

		}

		$trabajadores->thumbs = _HOST_."/uploads/no-disponible.jpg";

		$response = $this->ci->view->render($response, 'backend/sistema/trabajadores.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'trabajadores' => $trabajadores, 'areas' => $areas]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $trabajadores, $functions, $areas;

		$content['v_s']  = $content['v_s_3']  = 'active';

		$content['modulo'] = "Trabajadores";
		$content['sector'] = "Trabajadores";
		$content['back'] = _HOST_.'/admin/sistema/trabajadores';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/sistema';

		$content['title'] = "Trabajadores";
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$return_data = null;


		if(isset($_POST['btn-save'])){

			$functions->msje = '';
			$worker_dni = trim($_POST['worker_dni']);
			if($_FILES['fotos']['name'] != ""){
				$max[0]['size'] = 90;
				$max[0]['path'] = '';
				$path = _HOSTDIR_."/uploads/workers/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$foto = $worker_dni .".".$extension;
				$functions->imagen($fotos, $max, $foto, $path, $foto);
			}
			$nombre = trim($_POST['nombre']);
			$apellidos = trim($_POST['apellidos']);
			$id_area = trim($_POST['id_area']);
			$email = trim($_POST['email']);
			$cellphone = trim($_POST['cellphone']);
			$vehiculo = trim($_POST['vehiculo']);
			$licencia = trim($_POST['licencia']);
			$address = trim($_POST['address']);

			if($trabajadores->update($worker_dni, $nombre, $apellidos, $id_area, $email, $cellphone, $vehiculo, $licencia, $address)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente. '.$functions->msje;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. '.$functions->msje;
			}

		}

		if(!$trabajadores->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}


		$dis = "readonly";
		$response = $this->ci->view->render($response, 'backend/sistema/trabajadores.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'trabajadores' => $trabajadores, 'areas' => $areas, 'dis' => $dis]);
		return $response;
	}

}