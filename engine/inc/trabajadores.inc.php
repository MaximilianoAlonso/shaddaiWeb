<?php

class trabajadores {
	private $db;


	public function select($worker_dni = null){
		global $db;
		try{
			$data = '';
			if($worker_dni == true){
				$q = "SELECT worker_dni, name, lastname FROM workers WHERE worker_dni =:worker_dni ";
				$q = $db->prepare($q);
				$q->execute(array(":worker_dni"=>$worker_dni));
			}else{
				$q = "SELECT worker_dni, name, lastname FROM workers WHERE worker_dni NOT IN ";
				$q.= "(SELECT worker_dni FROM users )";
				$q = $db->prepare($q);
				$q->execute();
			}
			if($q->rowCount() > 0){
				if($worker_dni == null){
					$data .= '<option value="" selected disabled>Seleccione un Trabajador</option>';
				}
				while($row = $q->fetchObject()) {
					$id = $row->worker_dni;
					$data .= '<option value="'.$row->worker_dni.'">'. $row->name.' '.$row->lastname.'</option>';
				}
			}else{
				$data .= '<option value="">No disponible</option>';
			}
			return $data;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function tabla($requestData, $web){
		global $db, $sesion, $datatable;

		$sql = "SELECT w.*, a.* ";
		$sql.=" FROM workers w, areas a";
		$sql.=" WHERE w.worker_dni!=99999999 AND  w.id_area=a.id_area ";
		if( !empty($requestData['search']['value']) ) {
			$search = $requestData['search']['value'];
			$sql.=" AND ( ";
			$sql .= " CONCAT(w.name, ' ', w.lastname) LIKE '%".$search."%' ";
			$sql .= "OR w.worker_dni LIKE '%".$search."%' ";
			$sql .= "OR w.email LIKE '%".$search."%' ";
			$sql .= "OR w.cellphone LIKE '%".$search."%' ";
			$sql .= "OR a.name_area LIKE '%".$search."%' ";
			$sql .= ") ";
		}
		$q = $db->prepare($sql);
		$q->execute();
		$totalData = $q->rowCount();
		$totalFiltered = $totalData;
		$sql.=" ORDER BY worker_dni  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		$q = $db->prepare($sql);
		$q->execute();
		$data = array();

		while($row = $q->fetchObject()) {
			$nestedData=array();
			$nombre = $row->name .' '.$row->lastname;
			$nestedData[] = $row->worker_dni;
			$nestedData[] = $nombre;
			$nestedData[] = $row->email;
			$nestedData[] = $row->cellphone;
			$nestedData[] = $row->name_area;
			$option = '<div class="ediccion ">';
			$option .= "<a href='".$web."/editar/".$row->worker_dni."' class='badge badge-info' ><i class='fa fa-edit icon_size tip' title='Editar'></i> Editar</a>";
			$option .= "<a class='mup badge badge-danger' href='' data-target='#myModal' data-toggle='modal' data-id='".$row->worker_dni."' data-name='".$nombre."' ><i class='fa fa-times icon_size tip' title='Eliminar'></i> Eliminar</a>";
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


	public function edit($worker_dni){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM workers WHERE worker_dni!=99999999 AND worker_dni=:worker_dni";
			$q = $db->prepare($sql);
			$q->execute(array(":worker_dni"=>$worker_dni));
			if($q->rowCount() > 0){
				while($row = $q->fetchObject()) {
					$this->nombre = $row->name;
					$this->apellidos = $row->lastname;
					$this->worker_dni = $row->worker_dni;
					$this->email = $row->email;
					$this->cellphone = $row->cellphone;
					$this->vehiculo = $row->vehiculo;
					$this->licencia = $row->licencia;
					$this->address = $row->address;
					$this->id_area = $row->id_area;
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


	public function update($worker_dni, $name, $lastname, $id_area, $email, $cellphone, $vehiculo, $licencia, $address){
		global $db, $sesion;
		try{
			$sql = "UPDATE workers SET name = :name, lastname = :lastname, id_area = :id_area, email = :email, cellphone = :cellphone, vehiculo = :vehiculo, licencia = :licencia, address = :address WHERE worker_dni = :worker_dni";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':worker_dni', $worker_dni, PDO::PARAM_STR);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
			$stmt->bindParam(':id_area', $id_area, PDO::PARAM_STR);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':cellphone', $cellphone, PDO::PARAM_STR);
			$stmt->bindParam(':vehiculo', $vehiculo, PDO::PARAM_STR);
			$stmt->bindParam(':licencia', $licencia, PDO::PARAM_STR);
			$stmt->bindParam(':address', $address, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function add($worker_dni, $name, $lastname, $id_area, $email, $cellphone, $vehiculo, $licencia, $address){
		global $db, $sesion;
		try{
			$q= "SELECT * FROM workers WHERE name=:name";
			$q = $db->prepare($q);
			$q->execute(array(":name"=>$name));
			if($q->rowCount() > 0){
				return false;
			}else{
				$sql = "INSERT INTO workers (worker_dni, name, lastname, id_area, email, cellphone, vehiculo, licencia, address) VALUES(:worker_dni, :name, :lastname, :id_area, :email, :cellphone, :vehiculo, :licencia, :address)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':worker_dni', $worker_dni, PDO::PARAM_STR);
				$stmt->bindParam(':name', $name, PDO::PARAM_STR);
				$stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
				$stmt->bindParam(':id_area', $id_area, PDO::PARAM_STR);
				$stmt->bindParam(':email', $email, PDO::PARAM_STR);
				$stmt->bindParam(':cellphone', $cellphone, PDO::PARAM_STR);
				$stmt->bindParam(':vehiculo', $vehiculo, PDO::PARAM_STR);
				$stmt->bindParam(':licencia', $licencia, PDO::PARAM_STR);
				$stmt->bindParam(':address', $address, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt;
			}
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function data($worker_dni){
		global $db, $sesion, $functions;
		try{
			$return_data = array();
			$q = "SELECT w.worker_dni, w.name, w.lastname, w.email, a.name_area FROM workers w, areas a ";
			$q.= "WHERE w.id_area = a.id_area AND w.worker_dni=:worker_dni";
			$q = $db->prepare($q);
			$q->execute(array(":worker_dni"=>$worker_dni));
			if($q->rowCount() == 0){
				$return_data['type'] = 'error';
				$return_data['msje'] = 'No se pudo encontrar el trabajador';
			}else{
				while($row = $q->fetchObject()) {
					$worker_dni = str_pad($row->worker_dni, 8, 0, STR_PAD_LEFT);
					$name = $row->name;
					$lastname = $row->lastname;
					$email = $row->email;
					$name_area = $row->name_area;
					/*******/
					$name_= substr($name,0,1);
					$lastname_ =explode(" ",$lastname);
					$lastname__=$lastname_[0];
					if(strlen($lastname__) <=2) $lastname__ = $lastname__.$lastname_[1];
					$username= strtolower($functions->sinTildes($name_.$lastname__));

					$dir = _HOSTDIR_."/uploads/workers/".$row->worker_dni . ".jpg";
					if (file_exists($dir) && $row->worker_dni . ".jpg" != "") {
						$image=_HOST_."/uploads/workers/".$row->worker_dni . ".jpg";
					}else{
						$image=_HOST_."/uploads/no-disponible.jpg";
					}
					/*******/
					$return_data['type'] = 'success';
					$return_data['username'] = $username;
					$return_data['fullname'] = $name." ".$lastname;
					$return_data['email'] = $email;
					$return_data['area'] = $name_area;
					$return_data['image'] = $image;
				}
			}
			return $return_data;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($worker_dni){
		global $db, $sesion;
		$q= "SELECT * FROM users WHERE worker_dni=:worker_dni";
		$q = $db->prepare($q);
		$q->execute(array(":worker_dni"=>$worker_dni));

		if($q->rowCount() > 0){

			$return_data['type'] = 'error';

			$return_data['msje'] = 'Error al eliminar. Hay un usuario relacionados.';

		}else{
			$sql = "DELETE FROM workers WHERE worker_dni = :worker_dni";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':worker_dni', $worker_dni, PDO::PARAM_STR);
			$stmt->execute();

			if(!$stmt){

				$return_data['type'] = 'error';

				$return_data['msje'] = 'Error al eliminar. Intente de nuevo.';

			}else{

				$return_data['type'] = 'success';

				$return_data['msje'] = 'El area se ha eliminado.';
			}

		}

		echo json_encode($return_data);

		exit();

	}

}

$trabajadores = new trabajadores();