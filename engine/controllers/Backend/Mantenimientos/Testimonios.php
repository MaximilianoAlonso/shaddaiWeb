<?php
namespace App\Backend\Mantenimientos;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Testimonios extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		$content['v_m']  = $content['v_m_3']  = 'active';

		$content['modulo'] = "Testimonios";
		$content['sector'] = "Testimonios";
		$content['back'] = _HOST_.'/admin/mantenimientos/testimonios';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/mantenimientos';

		$content['title'] = "Testimonios";
		$content['cabezado'] = "Testimonios";

		$return_data = null;

		$ctestimonios = file_get_contents(_DATA_ . '/testimonios.json');
		$ctestimonios = json_decode($ctestimonios, true);


		if(isset($_POST['btn-save'])){

			$ctestimonios = $_POST['json'];
			$encode = json_encode($ctestimonios);
			$add = _DATA_."/testimonios.json";
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

		$response = $this->ci->view->render($response, 'backend/mantenimientos/testimonios.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'json' => $ctestimonios]);
		return $response;

	}

}