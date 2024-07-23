<?php
namespace App\Frondend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Nosotros extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){
		global $internas, $equipo, $servicios_categorias;

		$id = 1;

		if(!$internas->edit($id)){
			$path = $request->getUri()->getPath();
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$id = 2;

		if(!$internas->edit($id)){
			$path = $request->getUri()->getPath();
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$args['nav']['nuestra-firma'] = 'active';

		$response = $this->ci->view->render($response, 'frondend/'.$this->config['frondend'].'/nosotros.twig', ['args' => $args, 'internas' => $internas, 'equipo' => $equipo, 'servicios_categorias' => $servicios_categorias]);
		return $response;
	}



}