<?php
namespace App\Backend\Mantenimientos;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Servicios extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		$content['v_m']  = $content['v_m_5']  = 'active';

		$content['modulo'] = "Servicios";
		$content['sector'] = "Servicios";
		$content['back'] = _HOST_.'/admin/mantenimientos/servicios';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/mantenimientos';

		$content['title'] = "Servicios";
		$content['cabezado'] = "Servicios";

		$return_data = null;

		$cservicios = file_get_contents(_DATA_ . '/servicios.json');
		$cservicios = json_decode($cservicios, true);


		if(isset($_POST['btn-save'])){

			$cservicios = $_POST['json'];
			$encode = json_encode($cservicios);
			$add = _DATA_."/servicios.json";
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

		$response = $this->ci->view->render($response, 'backend/mantenimientos/servicios.twig', ['content' => $content, 'cservicios' => $cservicios, 'args' => $args, 'return_data' => $return_data, 'json' => $cservicios]);
		return $response;

	}

}