<?php
namespace App\Frondend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Contacto extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){
		global  $internas, $contacto, $servicios_categorias;
		$id = 3;

		if(!$internas->edit($id)){
			$path = $request->getUri()->getPath();
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$args['nav']['contacto'] = 'active';

		if (isset($_POST['name'])) {

			$args['name'] = trim($_POST['name']);
			$args['email'] = trim($_POST['email']);
			$args['phone'] = trim($_POST['phone']);
			$args['company'] = trim($_POST['company']);
			$args['message'] = trim($_POST['message']);

			if ($contacto->send($args)) {
				$response = $this->ci->view->render($response, 'frondend/'.$this->config['frondend'].'/gracias.twig', ['args' => $args, 'internas' => $internas]);
			}
			return $response;
		}

		$args['configuration'] = array();
		$args['configuration']['zoom'] = $internas->extra_internas['zoom'];
		$args['configuration']['lat'] =  $internas->extra_internas['lat'];
		$args['configuration']['lng'] =  $internas->extra_internas['lng'];
		$args['configuration']['icon'] = _HOST_.'/uploads/mapalogo.png';

		$response = $this->ci->view->render($response, 'frondend/'.$this->config['frondend'].'/contacto.twig', ['args' => $args,'servicios_categorias' => $servicios_categorias, 'internas' => $internas]);
		return $response;
	}


	public function gracias(Request $request, Response $response, $args){
		global  $internas, $contacto;
		$id = 3;

		if(!$internas->edit($id)){
			$path = $request->getUri()->getPath();
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$args['nav']['contacto'] = 'active';

		$args['configuration'] = array();
		$args['configuration']['zoom'] = $internas->extra_internas['zoom'];
		$args['configuration']['lat'] =  $internas->extra_internas['lat'];
		$args['configuration']['lng'] =  $internas->extra_internas['lng'];
		$args['configuration']['icon'] = _HOST_.'/uploads/mapalogo.png';

		$response = $this->ci->view->render($response, 'frondend/'.$this->config['frondend'].'/gracias.twig', ['args' => $args, 'servicios_categorias' => $servicios_categorias, 'internas' => $internas]);
		return $response;
	}

	public function mailing(Request $request, Response $response, $args){
		$args['name'] = (isset($args['name'])) ? trim($args['name']) : 'Jorge';
		$args['email'] = (isset($args['email'])) ? trim($args['email']) : 'jorge@ibo.pe';
		$args['phone'] = (isset($args['phone'])) ? trim($args['phone']) : '999078983';
		$args['company'] = (isset($args['company'])) ? trim($args['company']) : 'Ibo';
		$args['message'] = (isset($args['message'])) ? trim($args['message']) : 'Enviar Mensaje de Prueba';
		$response = $this->ci->view->render($response, 'mailing/contactenos.twig', ['args' => $args]);
		return $response;
	}

}