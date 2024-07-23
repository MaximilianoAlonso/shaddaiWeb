<?php
namespace App\Frondend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Index extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){
		global $internas, $slider, $servicios, $servicios_categorias, $isesion, $contacto;
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

		$id = 1;

		if(!$internas->edit($id)){
			$path = $request->getUri()->getPath();
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}


		$args['nav']['inicio'] = 'active';

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

		$response = $this->ci->view->render($response, 'frondend/'.$this->config['frondend'].'/index.twig', ['args' => $args, 'internas' => $internas, 'slider' => $slider, 'servicios' => $servicios, 'servicios_categorias' => $servicios_categorias, 'isesion' => $isesion]);
		return $response;
	}


	public function sitemap(Request $request, Response $response, $args){

		$response = $this->ci->view->render($response, 'frondend/'.$this->config['frondend'].'/sitemap.twig', ['args' => $args]);
		return $response->withHeader('Content-Type','text/xml');
	}

	public function blog(){
		require(_HOSTDIR_.'/blog/wp-blog-header.php');
		$defaults = array(
			'numberposts' => 5, 'offset' => 0,
			'category' => 0, 'orderby' => 'post_date',
			'order' => 'DESC', 'include' => '',
			'exclude' => '', 'meta_key' => '',
			'meta_value' =>'', 'post_type' => 'post',
			'suppress_filters' => true
		);
		$args = array(
			'numberposts' => 6
		);
		$post_array = get_posts($args  );
		$data =array();
		for($i=0; $i<count($post_array); $i++){
			$json = array();
			if(has_post_thumbnail()){
				$thumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post_array[$i]->ID), 'medium');
				$json['photo'] =  $thumb_src['0'];
			}
			$excerpt = get_the_excerpt();
			$charlength = 180;
			$contenido = '';
			if ( mb_strlen( $excerpt ) > $charlength ) {
				$subex = mb_substr( $excerpt, 0, $charlength - 5 );
				$exwords = explode( ' ', $subex );
				$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
				if ( $excut < 0 ) {
					$contenido .= mb_substr( $subex, 0, $excut );
				} else {
					$contenido .= $subex;
				}
				$contenido .= '[...]';
			} else {
				$contenido .= $excerpt;
			}
			$json['id'] = $post_array[$i]->ID;
			$json['name'] = $post_array[$i]->post_title;
			$json['seo'] = get_permalink();
			$json['contenido'] = $contenido;
			$data[] = $json;

		}
		return $data;
	}

	public function Personalizacion(Request $request, Response $response, $args){
		global $internas, $personalizados, $contacto;


		if(!$personalizados->edit( $args['name'], true)){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}


		$response = $this->ci->view->render($response, 'frondend/'.$this->config['frondend'].'/base.twig', ['args' => $args, 'personalizados' => $personalizados]);
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

		$args['nav']['contact'] = 'active';

		$args['configuration'] = array();
		$args['configuration']['zoom'] = $internas->extra_internas['zoom'];
		$args['configuration']['lat'] =  $internas->extra_internas['lat'];
		$args['configuration']['lng'] =  $internas->extra_internas['lng'];
		$args['configuration']['icon'] = _HOST_.'/uploads/mapalogo.png';

		$response = $this->ci->view->render($response, 'frondend/'.$this->config['frondend'].'/gracias.twig', ['args' => $args, 'internas' => $internas]);
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