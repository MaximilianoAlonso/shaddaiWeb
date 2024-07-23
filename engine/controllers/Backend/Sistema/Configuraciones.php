<?php
namespace App\Backend\Sistema;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Configuraciones extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $config;

		$content['v_s']  = $content['v_s_1']  = 'active';

		$content['modulo'] = "Configuraciones";
		$content['sector'] = "Configuraciones";
		$content['back'] = _HOST_.'/admin/sistema/config';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/sistema';

		$content['title'] = "Configuraciones";
		$content['cabezado'] = "Configuraciones";

		$return_data = null;


		if(isset($_POST['btn-save'])){

			$config = $_POST['config'];
			if($config['displayErrorDetails'] == 1){
				$config['displayErrorDetails'] = true;
			}else{
				$config['displayErrorDetails'] = false;
			}
			$config['facebook_banner'] = _HOST_.'/uploads/facebook.jpg';
			$config['favicon'] = _HOST_.'/uploads/favicon.png';
			$encode = json_encode($config);

			$add = _DATA_."/config.json";

			$archivo = fopen($add, 'w');

			$error = 0;
			if (!isset($archivo)) {
				$error = 1;
				$return_data['type'] = 'error';
				$return_data['msje'] = 'No se ha podido crear/abrir el archivo.';
			}elseif (!fwrite($archivo, $encode)) {
				$error = 1;
				$return_data['type'] = 'error';
				$return_data['msje'] = 'No se ha podido escribir en el archivo.';
			}

			fclose($archivo);
			if ($error == 0) {
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}
		}

		$response = $this->ci->view->render($response, 'backend/sistema/config.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

}