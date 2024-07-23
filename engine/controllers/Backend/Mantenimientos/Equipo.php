<?php
namespace App\Backend\Mantenimientos;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Equipo extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		$content['v_m']  = $content['v_m_11']  = 'active';

		$content['modulo'] = "Equipo";
		$content['sector'] = "Equipo";
		$content['back'] = _HOST_.'/admin/mantenimientos/equipo';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/mantenimientos';

		$content['title'] = "Equipo";
		$content['cabezado'] = "Equipo";

		$return_data = null;

		$cequipo = file_get_contents(_DATA_ . '/equipo.json');
		$cequipo = json_decode($cequipo, true);


		if(isset($_POST['btn-save'])){

			$cequipo = $_POST['json'];
			$encode = json_encode($cequipo);
			$add = _DATA_."/equipo.json";
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

		$response = $this->ci->view->render($response, 'backend/mantenimientos/equipo.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'json' => $cequipo]);
		return $response;

	}

}