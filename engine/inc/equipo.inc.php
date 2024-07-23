<?php

class equipo {
	private $db;


	public function tabla($requestData, $web){
		global $db, $sesion, $datatable;
		return $datatable->get($requestData, 'equipo', array('id_equipo', 'name_equipo'), null, array('name_equipo', 'photo_equipo'), 'active_equipo', array('/uploads/equipo', 'photo_equipo' ), null, null, $web, null, 'eliminado_equipo');
	}

	public function edit($id_equipo){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM equipo WHERE id_equipo=:id_equipo AND eliminado_equipo = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":id_equipo"=>$id_equipo));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->name_equipo = $row->name_equipo;
					$this->extra_equipo = json_decode($row->extra_equipo, true);
					$this->active_equipo = $row->active_equipo;

					$this->photo_equipo_name = $row->photo_equipo;
					$dir = _HOSTDIR_."/uploads/equipo/big/".$row->photo_equipo;
					$dir2 = _HOSTDIR_."/uploads/equipo/small/".$row->photo_equipo;
					if (file_exists($dir) && file_exists($dir2) && $row->photo_equipo != "") {
						$this->photo_equipo=_HOST_."/uploads/equipo/small/".$row->photo_equipo;
					}else{
						$this->photo_equipo=_HOST_."/uploads/no-disponible.jpg";
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
			$sql= "SELECT * FROM equipo WHERE active_equipo = '1' AND eliminado_equipo = 0 ORDER BY orden_equipo ASC, name_equipo ASC ";
			$sql = $db->prepare($sql);
			$sql->execute();
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_equipo;
					$json['name'] = $row->name_equipo;
					$json['extra'] = json_decode($row->extra_equipo, true);
					$json['photo_name'] = $row->photo_equipo;

					$dir = _HOSTDIR_."/uploads/equipo/big/".$row->photo_equipo;
					if (file_exists($dir)  && $row->photo_equipo != "") {
						$json['photo'] =_HOST_."/uploads/equipo/big/".$row->photo_equipo;
					}else{
						$json['photo'] =_HOST_."/uploads/no-disponible.jpg";
					}

					$dir2 = _HOSTDIR_."/uploads/equipo/small/".$row->photo_equipo;
					if (file_exists($dir2)  && $row->photo_equipo != "") {
						$json['photo_small'] =_HOST_."/uploads/equipo/small/".$row->photo_equipo;
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

	public function update($id_equipo, $name_equipo, $active_equipo, $photo_equipo, $extra_equipo){
		global $db, $sesion;
		try{
			$sql = "UPDATE equipo SET name_equipo = :name_equipo, active_equipo = :active_equipo, photo_equipo = :photo_equipo, extra_equipo = :extra_equipo WHERE id_equipo = :id_equipo";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_equipo', $id_equipo, PDO::PARAM_STR);
			$stmt->bindParam(':name_equipo', $name_equipo, PDO::PARAM_STR);
			$stmt->bindParam(':active_equipo', $active_equipo, PDO::PARAM_STR);
			$stmt->bindParam(':photo_equipo', $photo_equipo, PDO::PARAM_STR);
			$stmt->bindParam(':extra_equipo', $extra_equipo, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function add($name_equipo, $active_equipo, $photo_equipo, $extra_equipo){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM equipo WHERE name_equipo=:name_equipo AND eliminado_equipo = 0 ";
			$stmt = $db->prepare($sql);
			$stmt->execute(array(":name_equipo"=>$name_equipo));
			if($stmt->rowCount() > 0){
				return false;
			}else{
				$sql = "INSERT INTO equipo (name_equipo, active_equipo, photo_equipo, extra_equipo) VALUES(:name_equipo, :active_equipo, :photo_equipo, :extra_equipo)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':name_equipo', $name_equipo, PDO::PARAM_STR);
				$stmt->bindParam(':active_equipo', $active_equipo, PDO::PARAM_STR);
				$stmt->bindParam(':photo_equipo', $photo_equipo, PDO::PARAM_STR);
				$stmt->bindParam(':extra_equipo', $extra_equipo, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt;
			}
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function orden($id_equipo, $orden_equipo){
		global $db;
		try{
			$sql = "UPDATE equipo SET orden_equipo = :orden_equipo WHERE id_equipo = :id_equipo";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_equipo', $id_equipo, PDO::PARAM_STR);
			$stmt->bindParam(':orden_equipo', $orden_equipo, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_equipo){
		global $db, $sesion;

		$eliminado_equipo = date("Y-m-d h:i:s");

		$sql = "UPDATE equipo SET eliminado_equipo = :eliminado_equipo  WHERE id_equipo = :id_equipo";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id_equipo', $id_equipo, PDO::PARAM_STR);
		$stmt->bindParam(':eliminado_equipo', $eliminado_equipo, PDO::PARAM_STR);
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

$equipo = new equipo();