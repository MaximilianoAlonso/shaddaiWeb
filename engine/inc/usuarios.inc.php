<?php

class usuarios {
	private $db;


	public function tabla($requestData, $web){

		global $db, $sesion, $datatable, $user;
		$sql= "SELECT u.*, w.*, a.*, l.* FROM users u, workers w, areas a, userlevel l WHERE u.worker_dni = w.worker_dni AND u.userlevel = l.userlevel AND w.id_area = a.id_area AND u.username!='admin' AND u.username!='".$user->username."' ";

		if( !empty($requestData['search']['value']) ) {
			$search = $requestData['search']['value'];
			$sql.=" AND ( ";
			$sql .= " CONCAT(w.name, ' ', w.lastname) LIKE '%".$search."%' ";
			$sql .= "OR u.username LIKE '%".$search."%' ";
			$sql .= "OR l.u_nombre LIKE '%".$search."%' ";
			$sql .= ") ";
		}

		$q = $db->prepare($sql);
		$q->execute();
		$totalData = $q->rowCount();
		$totalFiltered = $totalData;
		$sql.=" ORDER BY l.u_nombre  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		$q = $db->prepare($sql);
		$q->execute();
		$data = array();

		while($row = $q->fetchObject()) {
			$nestedData=array();
			$nombre = $row->name .' '.$row->lastname;
			$nestedData[] = $row->u_nombre;
			$nestedData[] = $row->username;
			$nestedData[] = $nombre;
			if($row->active == 0){  $act = '<span data-activo="activo"><span class="label label-danger">Desactivado</span></span>';}else{ $act = '<span class="label label-primary">Activo</span>';}
			$nestedData[] = $act;
			$option = '<div class="ediccion ">';
			$option .= "<a href='".$web."/editar/".$row->username."' class='badge badge-info' ><i class='fa fa-edit icon_size tip' title='Editar'></i> Editar</a>";
			//$option .= "<a href='".$web."/permisos/".$row->username."' class='badge badge-warning' ><i class='fa fa-eye icon_size tip' title='Editar'></i> Permisos</a>";
			$option .= "<a class='mup badge badge-danger' href='' data-target='#myModal' data-toggle='modal' data-id='".$row->username."' data-name='".$nombre."' ><i class='fa fa-times icon_size tip' title='Eliminar'></i> Eliminar</a>";
			$option .= '</div>';
			$nestedData[] = $option;
			$data[] = $nestedData;
		}

		$json_data = array(
			"draw"            => intval( $requestData['draw'] ),
			"recordsTotal"    => intval( $totalData ),
			"recordsFiltered" => intval( $totalFiltered ),
			"data"            => $data
			);
		echo json_encode($json_data);
		exit();

	}

	public function edit($username){
		global $db, $sesion, $user;
		try{
			$sql= "SELECT u.*, w.*, a.* FROM users u, workers w, areas a WHERE u.worker_dni=w.worker_dni && w.id_area=a.id_area AND u.username!='admin' AND u.username=:username AND u.username!='".$user->username."' ";
			$q = $db->prepare($sql);
			$q->execute(array(":username"=>$username));
			if($q->rowCount() > 0){
				while($row = $q->fetchObject()) {
					$this->username = $row->username;
					$this->name = $row->name;
					$this->lastname = $row->lastname;
					$this->userlevel = $row->userlevel;
					$this->active = $row->active;
					$this ->email = $row->email;
					$this ->name_area = $row->name_area;
					$this ->worker_dni = $row->worker_dni;
					$this ->pass = json_decode($row->pass);
					$dir = _HOSTDIR_."/uploads/workers/".$row->worker_dni . ".jpg";
					if (file_exists($dir) && $row->worker_dni . ".jpg" != "") {
						$this->thumbs=_HOST_."/uploads/workers/".$row->worker_dni . ".jpg";
					}else{
						$this->thumbs=_HOST_."/uploads/no-disponible.jpg";
					}
				}
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function update($username, $active, $userlevel, $password){
		global $db, $sesion;
		try{
			$sql = "UPDATE users SET active = :active, userlevel = :userlevel ";
			if($password!=""){
				$hash = password_hash($password, PASSWORD_DEFAULT);
				$sql .=", password = :hash ";
			}
			$sql .="WHERE username = :username";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':username', $username, PDO::PARAM_STR);
			$stmt->bindParam(':active', $active, PDO::PARAM_STR);
			$stmt->bindParam(':userlevel', $userlevel, PDO::PARAM_STR);
			if($password!=""){
				$stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
			}
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function add($worker_dni, $username, $active, $userlevel, $password){
		global $db, $sesion, $user;
		try{
			$q= "SELECT * FROM users WHERE username=:username";
			$q = $db->prepare($q);
			$q->execute(array(":username"=>$username));
			if($q->rowCount() > 0){
				return false;
			}else{

				if($password != ""){
					$hash = password_hash($password, PASSWORD_DEFAULT);
					$sql = "INSERT INTO users (worker_dni, username, active, userlevel, password, createdby) VALUES(:worker_dni, :username, :active, :userlevel, :hash, :createdby)";
				}else{
					$sql = "INSERT INTO users (worker_dni, username, active, userlevel, createdby) VALUES(:worker_dni, :username, :active, :userlevel, :createdby)";
				}
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':worker_dni', $worker_dni, PDO::PARAM_STR);
				$stmt->bindParam(':username', $username, PDO::PARAM_STR);
				$stmt->bindParam(':active', $active, PDO::PARAM_STR);
				$stmt->bindParam(':userlevel', $userlevel, PDO::PARAM_STR);
				$stmt->bindParam(':createdby', $user->username, PDO::PARAM_STR);
				if($password != ""){
					$stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
				}
				$stmt->execute();
				return $stmt;
			}
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($username){
		global $db, $sesion;
		$sql = "DELETE FROM users WHERE username = :username";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->execute();

		if(!$stmt){

			$return_data['status'] = 'error';

			$return_data['type'] = 'danger';

			$return_data['msje'] = 'Error al eliminar. Intente de nuevo.';

		}else{
			$return_data['status'] = 'ok';

			$return_data['type'] = 'success';

			$return_data['msje'] = 'El usuario '.$username.' se ha eliminado.';
		}

		echo json_encode($return_data);

		exit();

	}

}

$usuarios = new usuarios();

?>