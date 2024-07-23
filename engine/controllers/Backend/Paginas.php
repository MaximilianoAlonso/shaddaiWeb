<?php
namespace App\Backend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Paginas extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){
		return $response;

	}

	public function home(Request $request, Response $response, $args){

		global $internas;
		$id = 1;
		$return_data = null;

		if(isset($_POST['btn-save'])){
			$extra_internas = json_encode($_POST['extra_internas']);
			if($internas->update($id, $extra_internas)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		if(!$internas->edit($id)){
			$path = $request->getUri()->getPath();
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_pa']  = $content['v_pa_1'] = 'active';

		$content['modulo'] = "Páginas";
		$content['sector'] = "Páginas";
		$content['back'] = _HOST_.'/admin/paginas/home';
		$content['title'] = "Home";
		$content['cabezado'] = "Home";

		$response = $this->ci->view->render($response, 'backend/paginas/home.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'internas' => $internas]);
		return $response;

	}

	public function nosotros(Request $request, Response $response, $args){

		global $internas;
		$id = 2;
		$return_data = null;

		if(isset($_POST['btn-save'])){
			$extra_internas = json_encode($_POST['extra_internas']);
			if($internas->update($id, $extra_internas)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		if(!$internas->edit($id)){
			$path = $request->getUri()->getPath();
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_pa']  = $content['v_pa_2'] = 'active';

		$content['modulo'] = "Páginas";
		$content['sector'] = "Páginas";
		$content['back'] = _HOST_.'/admin/paginas/nosotros';
		$content['title'] = "Nosotros";
		$content['cabezado'] = "Nosotros";

		$response = $this->ci->view->render($response, 'backend/paginas/nosotros.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'internas' => $internas]);
		return $response;

	}

	public function contactanos(Request $request, Response $response, $args){

		global $internas;
		$id = 3;
		$return_data = null;

		if(isset($_POST['btn-save'])){
			$extra_internas = json_encode($_POST['extra_internas']);
			if($internas->update($id, $extra_internas)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		if(!$internas->edit($id)){
			$path = $request->getUri()->getPath();
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_pa']  = $content['v_pa_3'] = 'active';

		$content['modulo'] = "Páginas";
		$content['sector'] = "Páginas";
		$content['back'] = _HOST_.'/admin/paginas/contactanos';
		$content['title'] = "Contáctanos";
		$content['cabezado'] = "Contáctanos";

		$response = $this->ci->view->render($response, 'backend/paginas/contactanos.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'internas' => $internas]);
		return $response;

	}


	public function servicios(Request $request, Response $response, $args){

		global $internas;
		$id = 4;
		$return_data = null;

		if(isset($_POST['btn-save'])){
			$extra_internas = json_encode($_POST['extra_internas']);
			if($internas->update($id, $extra_internas)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		if(!$internas->edit($id)){
			$path = $request->getUri()->getPath();
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_pa']  = $content['v_pa_5'] = 'active';

		$content['modulo'] = "Páginas";
		$content['sector'] = "Páginas";
		$content['back'] = _HOST_.'/admin/paginas/servicios';
		$content['title'] = "Servicios";
		$content['cabezado'] = "Servicios";

		$response = $this->ci->view->render($response, 'backend/paginas/servicios.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'internas' => $internas]);
		return $response;

	}


	public function testimonios(Request $request, Response $response, $args){

		global $internas;
		$id = 5;
		$return_data = null;

		if(isset($_POST['btn-save'])){
			$extra_internas = json_encode($_POST['extra_internas']);
			if($internas->update($id, $extra_internas)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		if(!$internas->edit($id)){
			$path = $request->getUri()->getPath();
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_pa']  = $content['v_pa_6'] = 'active';

		$content['modulo'] = "Páginas";
		$content['sector'] = "Páginas";
		$content['back'] = _HOST_.'/admin/paginas/testimonios';
		$content['title'] = "Testimonios";
		$content['cabezado'] = "Testimonios";

		$response = $this->ci->view->render($response, 'backend/paginas/testimonios.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'internas' => $internas]);
		return $response;

	}


	public function galeria(Request $request, Response $response, $args){

		global $internas;
		$id = 6;
		$return_data = null;

		if(isset($_POST['btn-save'])){
			$extra_internas = json_encode($_POST['extra_internas']);
			if($internas->update($id, $extra_internas)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		if(!$internas->edit($id)){
			$path = $request->getUri()->getPath();
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_pa']  = $content['v_pa_7'] = 'active';

		$content['modulo'] = "Páginas";
		$content['sector'] = "Páginas";
		$content['back'] = _HOST_.'/admin/paginas/galeria';
		$content['title'] = "Galeria";
		$content['cabezado'] = "Galeria";

		$response = $this->ci->view->render($response, 'backend/paginas/galeria.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'internas' => $internas]);
		return $response;

	}

	public function cursos(Request $request, Response $response, $args){

		global $internas;
		$id = 7;
		$return_data = null;

		if(isset($_POST['btn-save'])){
			$extra_internas = json_encode($_POST['extra_internas']);
			if($internas->update($id, $extra_internas)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}
		}

		if(!$internas->edit($id)){
			$path = $request->getUri()->getPath();
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}

		$content['v_pa']  = $content['v_pa_8'] = 'active';

		$content['modulo'] = "Páginas";
		$content['sector'] = "Páginas";
		$content['back'] = _HOST_.'/admin/paginas/cursos';
		$content['title'] = "Cursos";
		$content['cabezado'] = "Cursos";

		$response = $this->ci->view->render($response, 'backend/paginas/cursos.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'internas' => $internas]);
		return $response;

	}

}