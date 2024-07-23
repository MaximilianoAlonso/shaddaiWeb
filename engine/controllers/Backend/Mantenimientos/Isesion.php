<?php
namespace App\Backend\Mantenimientos;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Isesion extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		$content['v_m']  = $content['v_m_10']  = 'active';

		$content['modulo'] = "Clientes";
		$content['sector'] = "Clientes";
		$content['back'] = _HOST_.'/admin/mantenimientos/isesion';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/mantenimientos';

		$content['title'] = "Clientes";
		$content['cabezado'] = "Clientes";

		$return_data = null;

		$cisesion = file_get_contents(_DATA_ . '/isesion.json');
		$cisesion = json_decode($cisesion, true);


		if(isset($_POST['btn-save'])){

			$cisesion = $_POST['json'];
			$encode = json_encode($cisesion);
			$add = _DATA_."/isesion.json";
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

		$response = $this->ci->view->render($response, 'backend/mantenimientos/isesion.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'json' => $cisesion]);
		return $response;

	}

}