<?php
namespace App\Backend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use user;
class Index extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){
		$white = "white-bg";
		$content['v_x'] = 'active';
		$response = $this->ci->view->render($response, 'backend/index.twig', ['white' => $white, 'content' => $content]);
		return $response;
	}

	public function login(Request $request, Response $response, $args){
		$error = null;
		if(isset($_POST['username'])){
			$uname = trim($_POST['username']);
			$umail = trim($_POST['username']);
			$upass = trim($_POST['password']);
			if($this->sesion->login($uname,$umail,$upass)){
				$this->functions->redirect(_HOST_."/admin/index");
			}else{
				$error = true;
			}
		}
		$response = $this->ci->view->render($response, 'backend/login.twig', ['error' => $error]);
		return $response;
	}

	public function perfil(Request $request, Response $response, $args){

		global $user, $functions;

		$content['modulo'] = "Perfil";
		$content['sector'] = "Perfil";
		$content['back'] = _HOST_.'/admin/perfil';
		$content['title'] = "Perfil";
		$content['cabezado'] = "Perfil";

		$return_data = null;

		if(isset($_POST['btn-save'])){


			$functions->msje = '';

			if($_FILES['fotos']['name'] != ""){
				$max[0]['size'] = 90;
				$max[0]['path'] = '';
				$worker_dni = trim($_POST['worker_dni']);
				$path = _HOSTDIR_."/uploads/workers/";
				$fotos = $_FILES['fotos'];
				$ext = explode(".", $fotos['name']);
				$extension = end($ext);
				$foto = $worker_dni .".".$extension;
				$functions->imagen($fotos, $max, $foto, $path, $foto);
			}


			$name = trim($_POST['name']);
			$lastname = trim($_POST['lastname']);
			$worker_dni = trim($_POST['worker_dni']);
			$email = trim($_POST['email']);
			$cellphone = trim($_POST['cellphone']);
			$password = trim($_POST['password']);
			$vehiculo = trim($_POST['vehiculo']);
			$licencia = trim($_POST['licencia']);
			$address = trim($_POST['address']);

			if($user->update($user->worker_dni, $user->username, $name, $lastname , $user->id_area, $email, $cellphone, $vehiculo, $licencia, $address, $password)){
				$user = new user($user->username);
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente. '.$functions->msje;
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente. '.$functions->msje;
			}

		}

		$response = $this->ci->view->render($response, 'backend/perfil.twig', ['content' => $content, 'return_data' => $return_data, 'user' => $user]);
		return $response;
	}

	public function salir(Request $request, Response $response, $args){
		$this->sesion->logout();
		$this->functions->redirect(_HOST_.'/admin/login');
		return $response;
	}

}