<?php
namespace App\Frondend\Api;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Formulario extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){
		global $contacto;
		if (isset($_POST['btn-save'])) {

			$data = $_POST;

			$url = explode('?', $data['url']);

			$data['url'] = $url[0];

			//$this->crm($data);

			if (!$contacto->send($data)) {
				$path = $request->getUri()->getPath();
				$response = $this->ci->view->render($response->withStatus(405), 'errors/405.twig', ['path' => $path]);
				return $response;
			}


			$data['url'] = $data['url'] .'/';

			$data['url'] = str_replace('/', '/', $data['url']);
			switch ($data['sector']) {
				case 'Contacto':
				$response = $response->withRedirect($data['url'] .'thanks');
				return $response;
				break;
				default:
				$response = $response->withRedirect($data['url'] .'thanks');
				return $response;

			}

		}
		$path = $request->getUri()->getPath();
		$response = $this->ci->view->render($response->withStatus(405), 'errors/405.twig', ['path' => $path]);
		return $response;
	}


	public function crm($data){

		global $crm;

		$array = array();
		$array['name'] = (isset($data['nombre'])) ? trim($data['nombre']) : '';
		$array['email'] = (isset($data['correo'])) ? trim($data['correo']) : '';
		$array['phone'] = (isset($data['telefono'])) ? trim($data['telefono']) : '';
		$array['estatus'] = 1;
		$array['url'] = (isset($data['url'])) ? trim($data['url']) : '';
		$array['message'] = (isset($data['mensaje'])) ? trim($data['mensaje']) : '';
		$array['horario'] = (isset($data['horario'])) ? trim($data['horario']) : '';
		$array['extra'] = array();
		$array['intereses'] = (isset($data['sector'])) ? trim($data['sector']) : '';
		$array['referencia'] = (isset($data['referencia'])) ? trim($data['referencia']) : '';

		return $crm->add($array);

	}


}