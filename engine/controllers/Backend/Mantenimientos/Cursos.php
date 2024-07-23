<?php
namespace App\Backend\Mantenimientos;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Cursos extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		$content['v_m']  = $content['v_m_8']  = 'active';

		$content['modulo'] = "Cursos";
		$content['sector'] = "Cursos";
		$content['back'] = _HOST_.'/admin/mantenimientos/cursos';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/mantenimientos';

		$content['title'] = "Cursos";
		$content['cabezado'] = "Cursos";

		$return_data = null;

		$ccursos = file_get_contents(_DATA_ . '/cursos.json');
		$ccursos = json_decode($ccursos, true);


		if(isset($_POST['btn-save'])){

			$ccursos = $_POST['json'];
			$encode = json_encode($ccursos);
			$add = _DATA_."/cursos.json";
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

		$response = $this->ci->view->render($response, 'backend/mantenimientos/cursos.twig', ['content' => $content, 'ccursos' => $ccursos, 'args' => $args, 'return_data' => $return_data, 'json' => $ccursos]);
		return $response;

	}

}