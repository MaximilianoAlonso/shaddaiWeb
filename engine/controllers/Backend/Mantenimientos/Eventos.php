<?php
namespace App\Backend\Mantenimientos;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Eventos extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		$content['v_m']  = $content['v_m_7']  = 'active';

		$content['modulo'] = "Eventos";
		$content['sector'] = "Eventos";
		$content['back'] = _HOST_.'/admin/mantenimientos/eventos';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/mantenimientos';

		$content['title'] = "Eventos";
		$content['cabezado'] = "Eventos";

		$return_data = null;

		$ceventos = file_get_contents(_DATA_ . '/eventos.json');
		$ceventos = json_decode($ceventos, true);


		if(isset($_POST['btn-save'])){

			$ceventos = $_POST['json'];
			$encode = json_encode($ceventos);
			$add = _DATA_."/eventos.json";
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

		$response = $this->ci->view->render($response, 'backend/mantenimientos/eventos.twig', ['content' => $content, 'ceventos' => $ceventos; 'args' => $args, 'return_data' => $return_data, 'json' => $ceventos]);
		return $response;

	}

}