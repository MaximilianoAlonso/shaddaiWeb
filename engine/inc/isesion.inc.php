<?php

class isesion {
	private $db;


	public function tabla($requestData, $web){
		global $db, $sesion, $datatable;
		return $datatable->get($requestData, 'isesion', array('id_isesion', 'name_isesion'), null, array('name_isesion', 'photo_isesion'), 'active_isesion', array('/uploads/isesion', 'photo_isesion' ), null, null, $web, null, 'eliminado_isesion');
	}

	public function edit($id_isesion){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM isesion WHERE id_isesion=:id_isesion AND eliminado_isesion = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":id_isesion"=>$id_isesion));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->name_isesion = $row->name_isesion;
					$this->extra_isesion = json_decode($row->extra_isesion, true);
					$this->active_isesion = $row->active_isesion;

					$this->photo_isesion_name = $row->photo_isesion;
					$dir = _HOSTDIR_."/uploads/isesion/big/".$row->photo_isesion;
					$dir2 = _HOSTDIR_."/uploads/isesion/small/".$row->photo_isesion;
					if (file_exists($dir) && file_exists($dir2) && $row->photo_isesion != "") {
						$this->photo_isesion=_HOST_."/uploads/isesion/small/".$row->photo_isesion;
					}else{
						$this->photo_isesion=_HOST_."/uploads/no-disponible.jpg";
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

	public function data(){
		global $db, $sesion;
		try{
			$data = array();
			$sql= "SELECT * FROM isesion WHERE active_isesion = '1' AND eliminado_isesion = 0 ORDER BY orden_isesion ASC, name_isesion ASC ";
			$sql = $db->prepare($sql);
			$sql->execute();
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_isesion;
					$json['name'] = $row->name_isesion;
					$json['extra'] = json_decode($row->extra_isesion, true);
					$json['photo_name'] = $row->photo_isesion;

					$dir = _HOSTDIR_."/uploads/isesion/big/".$row->photo_isesion;
					if (file_exists($dir)  && $row->photo_isesion != "") {
						$json['photo'] =_HOST_."/uploads/isesion/big/".$row->photo_isesion;
					}else{
						$json['photo'] =_HOST_."/uploads/no-disponible.jpg";
					}

					$dir2 = _HOSTDIR_."/uploads/isesion/small/".$row->photo_isesion;
					if (file_exists($dir2)  && $row->photo_isesion != "") {
						$json['photo_small'] =_HOST_."/uploads/isesion/small/".$row->photo_isesion;
					}else{
						$json['photo_small'] =_HOST_."/uploads/no-disponible.jpg";
					}

					$data[] = $json;
				}
			}
			return $data;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function update($id_isesion, $name_isesion, $active_isesion, $photo_isesion, $extra_isesion){
		global $db, $sesion;
		try{
			$sql = "UPDATE isesion SET name_isesion = :name_isesion, active_isesion = :active_isesion, photo_isesion = :photo_isesion, extra_isesion = :extra_isesion WHERE id_isesion = :id_isesion";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_isesion', $id_isesion, PDO::PARAM_STR);
			$stmt->bindParam(':name_isesion', $name_isesion, PDO::PARAM_STR);
			$stmt->bindParam(':active_isesion', $active_isesion, PDO::PARAM_STR);
			$stmt->bindParam(':photo_isesion', $photo_isesion, PDO::PARAM_STR);
			$stmt->bindParam(':extra_isesion', $extra_isesion, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function add($name_isesion, $active_isesion, $photo_isesion, $extra_isesion){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM isesion WHERE name_isesion=:name_isesion AND eliminado_isesion = 0 ";
			$stmt = $db->prepare($sql);
			$stmt->execute(array(":name_isesion"=>$name_isesion));
			if($stmt->rowCount() > 0){
				return false;
			}else{
				$sql = "INSERT INTO isesion (name_isesion, active_isesion, photo_isesion, extra_isesion) VALUES(:name_isesion, :active_isesion, :photo_isesion, :extra_isesion)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':name_isesion', $name_isesion, PDO::PARAM_STR);
				$stmt->bindParam(':active_isesion', $active_isesion, PDO::PARAM_STR);
				$stmt->bindParam(':photo_isesion', $photo_isesion, PDO::PARAM_STR);
				$stmt->bindParam(':extra_isesion', $extra_isesion, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt;
			}
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function orden($id_isesion, $orden_isesion){
		global $db;
		try{
			$sql = "UPDATE isesion SET orden_isesion = :orden_isesion WHERE id_isesion = :id_isesion";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_isesion', $id_isesion, PDO::PARAM_STR);
			$stmt->bindParam(':orden_isesion', $orden_isesion, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_isesion){
		global $db, $sesion;

		$eliminado_isesion = date("Y-m-d h:i:s");

		$sql = "UPDATE isesion SET eliminado_isesion = :eliminado_isesion  WHERE id_isesion = :id_isesion";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id_isesion', $id_isesion, PDO::PARAM_STR);
		$stmt->bindParam(':eliminado_isesion', $eliminado_isesion, PDO::PARAM_STR);
		$stmt->execute();

		if(!$stmt){
			$return_data['type'] = 'error';
			$return_data['msje'] = 'Error al eliminar. Intente de nuevo.';
		}else{
			$return_data['type'] = 'success';
			$return_data['msje'] = 'El area se ha eliminado.';
		}

		return json_encode($return_data);

	}

}

$isesion = new isesion();