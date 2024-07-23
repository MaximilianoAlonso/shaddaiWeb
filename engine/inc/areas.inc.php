<?php

class areas {
	private $db;


	public function tabla($requestData, $web){
		global $db, $sesion, $datatable;
		return $datatable->get($requestData, 'areas', array('id_area', 'name_area'), array('name_area', 'Developer'), array('name_area'), null, null, null, null, $web);
	}

	public function select($id_area = null){
		global $db;
		try{
			$data = '';
			$q= "SELECT * FROM areas WHERE id_area!=1";
			$q = $db->prepare($q);
			$q->execute();
			if($q->rowCount() > 0){
				$sel = '';
				while($row = $q->fetchObject()) {
					$id = $row->id_area;
					if($id_area == $id) $sel = "selected='selected' "; else $sel = "";
					$data .='<option '.$sel.' value="'.$row->id_area.'">'. $row->name_area.'</option>';
				}
			}else{
				$data .='<option>No disponible</option>';
			}
			return $data;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function edit($id_area){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM areas WHERE id_area!=1 AND id_area=:id_area";
			$q = $db->prepare($sql);
			$q->execute(array(":id_area"=>$id_area));
			if($q->rowCount() > 0){
				while($row = $q->fetchObject()) {
					$this->name_area = $row->name_area;
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

	public function update($id_area, $name_area){
		global $db, $sesion;
		try{
			$sql = "UPDATE areas SET name_area = :name_area WHERE id_area = :id_area";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_area', $id_area, PDO::PARAM_STR);
			$stmt->bindParam(':name_area', $name_area, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function add($name_area){
		global $db, $sesion;
		try{
			$q= "SELECT * FROM areas WHERE name_area=:name_area";
			$q = $db->prepare($q);
			$q->execute(array(":name_area"=>$name_area));
			if($q->rowCount() > 0){
				return false;
			}else{
				$sql = "INSERT INTO areas (name_area) VALUES(:name_area)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':name_area', $name_area, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt;
			}
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_area){
		global $db, $sesion;
		$q= "SELECT * FROM workers WHERE id_area=:id_area";
		$q = $db->prepare($q);
		$q->execute(array(":id_area"=>$id_area));

		if($q->rowCount() > 0){

			$return_data['type'] = 'error';
			$return_data['msje'] = 'Error al eliminar. Hay trabajadores relacionados.';

		}else{
			$sql = "DELETE FROM areas WHERE id_area = :id_area";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_area', $id_area, PDO::PARAM_STR);
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

$areas = new areas();