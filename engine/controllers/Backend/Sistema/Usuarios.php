<?php
namespace App\Backend\Sistema;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Usuarios extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){

		global $usuarios;

		$content['v_s']  = $content['v_s_4']  = 'active';

		$content['modulo'] = "Usuarios";
		$content['sector'] = "Usuarios";
		$content['back'] = _HOST_.'/admin/sistema/usuarios';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/sistema';

		$content['title'] = "Usuarios";
		$content['cabezado'] = "Listado";

		$return_data = null;

		if(isset($_GET['tabla'])){
			if(isset($_POST['order'])){
				$requestData = $_POST;
				$usuarios->tabla($requestData, $content['back']);
			}
		}
		if(isset($_GET['del'])){
			if(isset($_POST['del_id'])){
				$usuarios->delete($_POST['del_id']);
			}
		}

		if(isset($_GET['n'])){
			if(preg_match('/sistema\/usuarios\/agregar/', @$_SERVER["HTTP_REFERER"])){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se guardado correctamente';
			}
		}

		$response = $this->ci->view->render($response, 'backend/sistema/usuarios.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data]);
		return $response;

	}

	public function add(Request $request, Response $response, $args){

		global $usuarios, $functions, $trabajadores;

		$content['v_s']  = $content['v_s_4']  = 'active';

		$content['modulo'] = "Usuarios";
		$content['sector'] = "Usuarios";
		$content['back'] = _HOST_.'/admin/sistema/usuarios';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/sistema';

		$content['title'] = "Usuarios";
		$content['cabezado'] = "Agregar";

		$args['type'] = 'agregar';

		$return_data = null;

		if(isset($_GET["json"])){
			if(isset($_POST['form'])){
				$form = $_POST['form'];
				if($form == 'trabajadores'){
					$id = $_POST["id"];
					$return_data = $trabajadores->data($id);
				}else{
					$return_data['type'] = 'error';
					$return_data['msje'] = 'Error no se pudo consultar en la base de datos. Intente de nuevo.';
				}
				echo json_encode($return_data);
				exit();
			}

		}

		if(isset($_POST['btn-save'])){

			$worker_dni = trim($_POST['worker_dni']);
			$username = trim($_POST['username']);
			$active = trim($_POST['active']);
			$userlevel = trim($_POST['userlevel']);
			$password = trim($_POST['password']);

			if($usuarios->add($worker_dni, $username, $active, $userlevel, $password)){
				$this->functions->redirect(_HOST_."/admin/sistema/usuarios?n");
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se guardado correctamente. ';
			}

		}

		$req = "required";
		$response = $this->ci->view->render($response, 'backend/sistema/usuarios.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'usuarios' => $usuarios, 'trabajadores' => $trabajadores, 'req' => $req]);
		return $response;

	}

	public function edit(Request $request, Response $response, $args){
		global $usuarios, $functions, $trabajadores;

		$content['v_s']  = $content['v_s_4']  = 'active';

		$content['modulo'] = "Usuarios";
		$content['sector'] = "Usuarios";
		$content['back'] = _HOST_.'/admin/sistema/usuarios';
		$content['sector2'] = "Sistema";
		$content['back2'] = _HOST_.'/admin/sistema';

		$content['title'] = "Usuarios";
		$content['cabezado'] = "Editar";

		$args['type'] = 'editar';

		$return_data = null;

		if(isset($_POST['btn-save'])){

			$active = trim($_POST['active']);
			$userlevel = trim($_POST['userlevel']);
			$password = trim($_POST['password']);

			if($usuarios->update($args['id'], $active, $userlevel, $password)){
				$return_data['type'] = 'success';
				$return_data['msje'] = 'Se ha actualizado correctamente.';
			}else{
				$return_data['type'] = 'error';
				$return_data['msje'] = 'Error no se actualizado correctamente.';
			}

		}

		if(!$usuarios->edit($args['id'])){
			$path = $request->getUri()->getPath();
			$this->ci->logger->info("Not Found (404): {$request->getMethod()} {$path}");
			$response = $this->ci->view->render($response->withStatus(404), 'errors/404.twig', ['path' => $path]);
			return $response;
		}


		$dis = "readonly";
		$response = $this->ci->view->render($response, 'backend/sistema/usuarios.twig', ['content' => $content, 'args' => $args, 'return_data' => $return_data, 'usuarios' => $usuarios, 'trabajadores' => $trabajadores, 'dis' => $dis]);
		return $response;
	}

}