<?php
namespace App\Frondend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Gallery extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){
		global $internas, $slider;

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

		$id = 6;

		if(!$internas->edit($id)){
			$path = $request->getUri()->getPath();
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$args['nav']['trabajos'] = 'active';

		$response = $this->ci->view->render($response, 'frondend/'.$this->config['frondend'].'/gallery.twig', ['args' => $args, 'internas' => $internas, 'slider' => $slider]);
		return $response;
	}



}