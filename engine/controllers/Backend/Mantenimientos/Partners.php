<?php
namespace App\Backend\Mantenimientos;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Partners extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		$content['v_m']  = $content['v_m_4']  = 'active';

		$content['modulo'] = "Partners";
		$content['sector'] = "Partners";
		$content['back'] = _HOST_.'/admin/mantenimientos/partners';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/mantenimientos';

		$content['title'] = "Partners";
		$content['cabezado'] = "Partners";

		$return_data = null;

		$cpartners = file_get_contents(_DATA_ . '/partners.json');
		$cpartners = json_decode($cpartners, true);


		if(isset($_POST['btn-save'])){

			$cpartners = $_POST['json'];
			$encode = json_encode($cpartners);
			$add = _DATA_."/partners.json";
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

		$response = $this->ci->view->render($response, 'backend/mantenimientos/partners.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'json' => $cpartners]);
		return $response;

	}

}