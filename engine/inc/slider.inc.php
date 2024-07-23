<?php

class slider {
	private $db;


	public function tabla($requestData, $web){
		global $db, $sesion, $datatable;
		return $datatable->get($requestData, 'slider', array('id_slider', 'name_slider'), null, array('name_slider', 'photo_slider'), 'active_slider', array('/uploads/slider', 'photo_slider' ), null, null, $web, null, 'eliminado_slider');
	}

	public function edit($id_slider){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM slider WHERE id_slider=:id_slider AND eliminado_slider = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":id_slider"=>$id_slider));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->name_slider = $row->name_slider;
					$this->extra_slider = json_decode($row->extra_slider, true);
					$this->active_slider = $row->active_slider;

					$this->photo_slider_name = $row->photo_slider;
					$dir = _HOSTDIR_."/uploads/slider/big/".$row->photo_slider;
					$dir2 = _HOSTDIR_."/uploads/slider/small/".$row->photo_slider;
					if (file_exists($dir) && file_exists($dir2) && $row->photo_slider != "") {
						$this->photo_slider=_HOST_."/uploads/slider/small/".$row->photo_slider;
					}else{
						$this->photo_slider=_HOST_."/uploads/no-disponible.jpg";
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
			$sql= "SELECT * FROM slider WHERE active_slider = '1' AND eliminado_slider = 0 ORDER BY orden_slider ASC, name_slider ASC ";
			$sql = $db->prepare($sql);
			$sql->execute();
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_slider;
					$json['name'] = $row->name_slider;
					$json['extra'] = json_decode($row->extra_slider, true);
					$json['photo_name'] = $row->photo_slider;

					$dir = _HOSTDIR_."/uploads/slider/big/".$row->photo_slider;
					if (file_exists($dir)  && $row->photo_slider != "") {
						$json['photo'] =_HOST_."/uploads/slider/big/".$row->photo_slider;
					}else{
						$json['photo'] =_HOST_."/uploads/no-disponible.jpg";
					}

					$dir2 = _HOSTDIR_."/uploads/slider/small/".$row->photo_slider;
					if (file_exists($dir2)  && $row->photo_slider != "") {
						$json['photo_small'] =_HOST_."/uploads/slider/small/".$row->photo_slider;
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

	public function update($id_slider, $name_slider, $active_slider, $photo_slider, $extra_slider){
		global $db, $sesion;
		try{
			$sql = "UPDATE slider SET name_slider = :name_slider, active_slider = :active_slider, photo_slider = :photo_slider, extra_slider = :extra_slider WHERE id_slider = :id_slider";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_slider', $id_slider, PDO::PARAM_STR);
			$stmt->bindParam(':name_slider', $name_slider, PDO::PARAM_STR);
			$stmt->bindParam(':active_slider', $active_slider, PDO::PARAM_STR);
			$stmt->bindParam(':photo_slider', $photo_slider, PDO::PARAM_STR);
			$stmt->bindParam(':extra_slider', $extra_slider, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function add($name_slider, $active_slider, $photo_slider, $extra_slider){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM slider WHERE name_slider=:name_slider AND eliminado_slider = 0 ";
			$stmt = $db->prepare($sql);
			$stmt->execute(array(":name_slider"=>$name_slider));
			if($stmt->rowCount() > 0){
				return false;
			}else{
				$sql = "INSERT INTO slider (name_slider, active_slider, photo_slider, extra_slider) VALUES(:name_slider, :active_slider, :photo_slider, :extra_slider)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':name_slider', $name_slider, PDO::PARAM_STR);
				$stmt->bindParam(':active_slider', $active_slider, PDO::PARAM_STR);
				$stmt->bindParam(':photo_slider', $photo_slider, PDO::PARAM_STR);
				$stmt->bindParam(':extra_slider', $extra_slider, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt;
			}
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function orden($id_slider, $orden_slider){
		global $db;
		try{
			$sql = "UPDATE slider SET orden_slider = :orden_slider WHERE id_slider = :id_slider";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_slider', $id_slider, PDO::PARAM_STR);
			$stmt->bindParam(':orden_slider', $orden_slider, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_slider){
		global $db, $sesion;

		$eliminado_slider = date("Y-m-d h:i:s");

		$sql = "UPDATE slider SET eliminado_slider = :eliminado_slider  WHERE id_slider = :id_slider";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id_slider', $id_slider, PDO::PARAM_STR);
		$stmt->bindParam(':eliminado_slider', $eliminado_slider, PDO::PARAM_STR);
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

$slider = new slider();