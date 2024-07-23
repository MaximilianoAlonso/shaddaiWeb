<?php
namespace App\Backend\Mantenimientos;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Galeria extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		$content['v_m']  = $content['v_m_6']  = 'active';

		$content['modulo'] = "Galeria";
		$content['sector'] = "Galeria";
		$content['back'] = _HOST_.'/admin/mantenimientos/galeria';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/mantenimientos';

		$content['title'] = "Galeria";
		$content['cabezado'] = "Galeria";

		$return_data = null;

		$cgaleria = file_get_contents(_DATA_ . '/galeria.json');
		$cgaleria = json_decode($cgaleria, true);


		if(isset($_POST['btn-save'])){

			$cgaleria = $_POST['json'];
			$encode = json_encode($cgaleria);
			$add = _DATA_."/galeria.json";
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

		$response = $this->ci->view->render($response, 'backend/mantenimientos/galeria.twig', ['content' => $content, 'cgaleria' => $cgaleria, 'args' => $args, 'return_data' => $return_data, 'json' => $cgaleria]);
		return $response;

	}

}