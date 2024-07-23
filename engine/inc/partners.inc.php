<?php

class partners {
	private $db;


	public function tabla($requestData, $web){
		global $db, $sesion, $datatable;
		return $datatable->get($requestData, 'partners', array('id_partners', 'name_partners'), null, array('name_partners'), 'active_partners', null, null, null, $web, null, 'eliminado_partners');
	}

	public function edit($id_partners){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM partners WHERE id_partners=:id_partners AND eliminado_partners = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":id_partners"=>$id_partners));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->name_partners = $row->name_partners;
					$this->extra_partners = json_decode($row->extra_partners, true);
					$this->active_partners = $row->active_partners;

					$this->photo_partners_name = $row->photo_partners;
					$dir = _HOSTDIR_."/uploads/partners/big/".$row->photo_partners;
					$dir2 = _HOSTDIR_."/uploads/partners/small/".$row->photo_partners;
					if (file_exists($dir) && file_exists($dir2) && $row->photo_partners != "") {
						$this->photo_partners=_HOST_."/uploads/partners/small/".$row->photo_partners;
					}else{
						$this->photo_partners=_HOST_."/uploads/no-disponible.jpg";
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
			$sql= "SELECT * FROM partners WHERE active_partners = '1' AND eliminado_partners = 0 ORDER BY orden_partners ASC, name_partners ASC ";
			$sql = $db->prepare($sql);
			$sql->execute();
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_partners;
					$json['name'] = $row->name_partners;
					$json['extra'] = json_decode($row->extra_partners, true);
					$json['photo_name'] = $row->photo_partners;

					$dir = _HOSTDIR_."/uploads/partners/big/".$row->photo_partners;
					if (file_exists($dir)  && $row->photo_partners != "") {
						$json['photo'] =_HOST_."/uploads/partners/big/".$row->photo_partners;
					}else{
						$json['photo'] =_HOST_."/uploads/no-disponible.jpg";
					}

					$dir2 = _HOSTDIR_."/uploads/partners/small/".$row->photo_partners;
					if (file_exists($dir2)  && $row->photo_partners != "") {
						$json['photo_small'] =_HOST_."/uploads/partners/small/".$row->photo_partners;
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

	public function update($id_partners, $name_partners, $active_partners, $photo_partners, $extra_partners){
		global $db, $sesion;
		try{
			$sql = "UPDATE partners SET name_partners = :name_partners, active_partners = :active_partners, photo_partners = :photo_partners, extra_partners = :extra_partners WHERE id_partners = :id_partners";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_partners', $id_partners, PDO::PARAM_STR);
			$stmt->bindParam(':name_partners', $name_partners, PDO::PARAM_STR);
			$stmt->bindParam(':active_partners', $active_partners, PDO::PARAM_STR);
			$stmt->bindParam(':photo_partners', $photo_partners, PDO::PARAM_STR);
			$stmt->bindParam(':extra_partners', $extra_partners, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function add($name_partners, $active_partners, $photo_partners, $extra_partners){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM partners WHERE name_partners=:name_partners AND eliminado_partners = 0 ";
			$stmt = $db->prepare($sql);
			$stmt->execute(array(":name_partners"=>$name_partners));
			if($stmt->rowCount() > 0){
				return false;
			}else{
				$sql = "INSERT INTO partners (name_partners, active_partners, photo_partners, extra_partners) VALUES(:name_partners, :active_partners, :photo_partners, :extra_partners)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':name_partners', $name_partners, PDO::PARAM_STR);
				$stmt->bindParam(':active_partners', $active_partners, PDO::PARAM_STR);
				$stmt->bindParam(':photo_partners', $photo_partners, PDO::PARAM_STR);
				$stmt->bindParam(':extra_partners', $extra_partners, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt;
			}
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function orden($id_partners, $orden_partners){
		global $db;
		try{
			$sql = "UPDATE partners SET orden_partners = :orden_partners WHERE id_partners = :id_partners";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_partners', $id_partners, PDO::PARAM_STR);
			$stmt->bindParam(':orden_partners', $orden_partners, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_partners){
		global $db, $sesion;

		$eliminado_partners = date("Y-m-d h:i:s");

		$sql = "UPDATE partners SET eliminado_partners = :eliminado_partners  WHERE id_partners = :id_partners";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id_partners', $id_partners, PDO::PARAM_STR);
		$stmt->bindParam(':eliminado_partners', $eliminado_partners, PDO::PARAM_STR);
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

$partners = new partners();