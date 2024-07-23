<?php
namespace App\Frondend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Servicios extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){
		global $internas, $blog, $testimonios, $servicios, $servicios_categorias, $isesion, $contacto;
		$id = 3;

		if(!$internas->edit($id)){
			$path = $request->getUri()->getPath();
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}


		$args['configuration'] = array();
		$args['configuration']['zoom'] = $internas->extra_internas['zoom'];
		$args['configuration']['lat'] =  $internas->extra_internas['lat'];
		$args['configuration']['lng'] =  $internas->extra_internas['lng'];
		$args['configuration']['icon'] = _HOST_.'/uploads/mapalogo.png';

		$id = 4;

		if(!$internas->edit($id)){
			$path = $request->getUri()->getPath();
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$args['nav']['servicios'] = 'active';

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

		$response = $this->ci->view->render($response, 'frondend/'.$this->config['frondend'].'/servicios.twig', ['args' => $args, 'internas' => $internas, 'blog' => $blog, 'testimonios' => $testimonios, 'servicios' => $servicios,'servicios_categorias' => $servicios_categorias, 'isesion' => $isesion]);
		return $response;
	}

	public function categoria(Request $request, Response $response, $args){
		global $internas, $servicios_categorias, $servicios, $contacto;


		if(!$servicios_categorias->view($args['categoria'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$args['nav']['servicios'] = 'active';

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

		$page = 1;

		if (isset($_GET['page'])) {
			$page = trim($_GET['page']);
		}


		$response = $this->ci->view->render($response, 'frondend/'.$this->config['frondend'].'/servicios/categoria.twig', ['args' => $args, 'internas' => $internas, 'page' => $page, 'servicios_categorias' => $servicios_categorias, 'servicios' => $servicios]);
		return $response;
	}

	public function view(Request $request, Response $response, $args){
		global $internas, $servicios, $contacto, $isesion, $servicios, $servicios_categorias;

		$id = 3;

		if(!$internas->edit($id)){
			$path = $request->getUri()->getPath();
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}


		$args['configuration'] = array();
		$args['configuration']['zoom'] = $internas->extra_internas['zoom'];
		$args['configuration']['lat'] =  $internas->extra_internas['lat'];
		$args['configuration']['lng'] =  $internas->extra_internas['lng'];
		$args['configuration']['icon'] = _HOST_.'/uploads/mapalogo.png';


		if(!$servicios->view($args['name'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$id = 4;

		if(!$internas->edit($id)){
			$path = $request->getUri()->getPath();
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$args['nav']['servicios'] = 'active';

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

		$theme = (isset($servicios->extra_servicios['theme'])) ? $servicios->extra_servicios['theme'] : 'view.twig';

		$response = $this->ci->view->render($response, 'frondend/'.$this->config['frondend'].'/servicios/' .$theme, ['args' => $args, 'internas' => $internas, 'servicios_categorias' => $servicios_categorias, 'isesion' => $isesion, 'servicios' => $servicios]);
		return $response;
	}

	public function gracias(Request $request, Response $response, $args){
		global $internas, $servicios, $contacto;


		if(!$servicios->view($args['name'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}


		$id = 3;

		if(!$internas->edit($id)){
			$path = $request->getUri()->getPath();
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$args['nav']['servicios'] = 'active';
		$args['configuration'] = array();
		$args['configuration']['zoom'] = $internas->extra_internas['zoom'];
		$args['configuration']['lat'] =  $internas->extra_internas['lat'];
		$args['configuration']['lng'] =  $internas->extra_internas['lng'];
		$args['configuration']['icon'] = _HOST_.'/uploads/mapalogo.png';

		$theme = (isset($servicios->extra_servicios['theme'])) ? $servicios->extra_servicios['theme'] : 'view.twig';

		$response = $this->ci->view->render($response, 'frondend/'.$this->config['frondend'].'/servicios/gracias.twig', ['args' => $args, 'blog' => $blog, 'internas' => $internas]);
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