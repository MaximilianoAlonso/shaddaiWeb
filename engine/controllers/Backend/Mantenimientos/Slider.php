<?php
namespace App\Backend\Mantenimientos;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Slider extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		$content['v_m']  = $content['v_m_1']  = 'active';

		$content['modulo'] = "Slider";
		$content['sector'] = "Slider";
		$content['back'] = _HOST_.'/admin/mantenimientos/slider';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/mantenimientos';

		$content['title'] = "Slider";
		$content['cabezado'] = "Slider";

		$return_data = null;

		$cslider = file_get_contents(_DATA_ . '/slider.json');
		$cslider = json_decode($cslider, true);


		if(isset($_POST['btn-save'])){

			$cslider = $_POST['json'];
			$encode = json_encode($cslider);
			$add = _DATA_."/slider.json";
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

		$response = $this->ci->view->render($response, 'backend/mantenimientos/slider.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'json' => $cslider]);
		return $response;

	}

}