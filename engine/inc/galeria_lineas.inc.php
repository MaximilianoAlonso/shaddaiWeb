<?php

class galeria_lineas {
	private $db;


	public function tabla($requestData, $web){
		global $db, $sesion, $datatable;
		return $datatable->get($requestData, 'galeria_lineas', array('id_lineas', 'name_lineas'), null, array('name_lineas'), 'active_lineas', null, null, null, $web, null, 'eliminado_lineas');
	}

	public function edit($id_lineas){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM galeria_lineas WHERE id_lineas=:id_lineas AND eliminado_lineas = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":id_lineas"=>$id_lineas));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->id_lineas = $row->id_lineas;
					$this->name_lineas = $row->name_lineas;
					$this->seo_lineas = $row->seo_lineas;
					$this->extra_lineas = json_decode($row->extra_lineas, true);
					$this->active_lineas = $row->active_lineas;

					$this->photo_lineas_name = $row->photo_lineas;
					$dir = _HOSTDIR_."/uploads/galeria/lineas/big/".$row->photo_lineas;
					$dir2 = _HOSTDIR_."/uploads/galeria/lineas/small/".$row->photo_lineas;
					if (file_exists($dir) && file_exists($dir2) && $row->photo_lineas != "") {
						$this->photo_lineas=_HOST_."/uploads/galeria/lineas/small/".$row->photo_lineas;
					}else{
						$this->photo_lineas=_HOST_."/uploads/no-disponible.jpg";
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

	public function view($seo_lineas){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM galeria_lineas WHERE seo_lineas=:seo_lineas AND eliminado_lineas = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":seo_lineas"=>$seo_lineas));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->id_lineas = $row->id_lineas;
					$this->name_lineas = $row->name_lineas;
					$this->seo_lineas = $row->seo_lineas;
					$this->extra_lineas = json_decode($row->extra_lineas, true);
					$this->active_lineas = $row->active_lineas;

					$this->photo_lineas_name = $row->photo_lineas;
					$dir = _HOSTDIR_."/uploads/galeria/lineas/big/".$row->photo_lineas;
					$dir2 = _HOSTDIR_."/uploads/galeria/lineas/small/".$row->photo_lineas;
					if (file_exists($dir) && file_exists($dir2) && $row->photo_lineas != "") {
						$this->photo_lineas = _HOST_."/uploads/galeria/lineas/big/".$row->photo_lineas;
						$this->photo_small_lineas = _HOST_."/uploads/galeria/lineas/small/".$row->photo_lineas;
					}else{
						$this->photo_lineas=_HOST_."/uploads/no-disponible.jpg";
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

	public function select($id_lineas = null){
		global $db;
		try{
			$data = '';
			$q= "SELECT * FROM galeria_lineas WHERE eliminado_lineas = 0 ORDER BY orden_lineas ASC, name_lineas ASC ";
			$q = $db->prepare($q);
			$q->execute();
			if($q->rowCount() > 0){
				$data .='<option value="0">No disponible</option>';
				$sel = '';
				while($row = $q->fetchObject()) {
					$id = $row->id_lineas;
					if($id_lineas == $id) $sel = "selected='selected' "; else $sel = "";
					$data .='<option '.$sel.' value="'.$row->id_lineas.'">'. $row->name_lineas.'</option>';
				}
			}else{
				$data .='<option value="0">No disponible</option>';
			}
			return $data;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function data(){
		global $db, $sesion;
		try{
			$data = array();
			$sql= "SELECT * FROM galeria_lineas WHERE active_lineas = '1' AND eliminado_lineas = 0 ORDER BY orden_lineas ASC, name_lineas ASC ";
			$sql = $db->prepare($sql);
			$sql->execute();
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_lineas;
					$json['name'] = $row->name_lineas;
					$json['seo'] = $row->seo_lineas;
					$json['extra'] = json_decode($row->extra_lineas, true);
					$json['photo_name'] = $row->photo_lineas;

					$dir = _HOSTDIR_."/uploads/galeria/lineas/big/".$row->photo_lineas;
					if (file_exists($dir)  && $row->photo_lineas != "") {
						$json['photo'] =_HOST_."/uploads/galeria/lineas/big/".$row->photo_lineas;
					}else{
						$json['photo'] =_HOST_."/uploads/no-disponible.jpg";
					}

					$dir2 = _HOSTDIR_."/uploads/galeria/lineas/small/".$row->photo_lineas;
					if (file_exists($dir2)  && $row->photo_lineas != "") {
						$json['photo_small'] =_HOST_."/uploads/galeria/lineas/small/".$row->photo_lineas;
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

	public function update($id_lineas, $name_lineas, $seo_lineas, $active_lineas, $photo_lineas, $extra_lineas){
		global $db, $sesion;
		try{
			$sql = "UPDATE galeria_lineas SET name_lineas = :name_lineas, seo_lineas = :seo_lineas, active_lineas = :active_lineas, photo_lineas = :photo_lineas, extra_lineas = :extra_lineas WHERE id_lineas = :id_lineas";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_lineas', $id_lineas, PDO::PARAM_STR);
			$stmt->bindParam(':name_lineas', $name_lineas, PDO::PARAM_STR);
			$stmt->bindParam(':seo_lineas', $seo_lineas, PDO::PARAM_STR);
			$stmt->bindParam(':active_lineas', $active_lineas, PDO::PARAM_STR);
			$stmt->bindParam(':photo_lineas', $photo_lineas, PDO::PARAM_STR);
			$stmt->bindParam(':extra_lineas', $extra_lineas, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function add($name_lineas, $seo_lineas, $active_lineas, $photo_lineas, $extra_lineas){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM galeria_lineas WHERE name_lineas=:name_lineas AND eliminado_lineas = 0 ";
			$stmt = $db->prepare($sql);
			$stmt->execute(array(":name_lineas"=>$name_lineas));
			if($stmt->rowCount() > 0){
				return false;
			}else{
				$sql = "INSERT INTO galeria_lineas (name_lineas, seo_lineas, active_lineas, photo_lineas, extra_lineas) VALUES(:name_lineas, :seo_lineas, :active_lineas, :photo_lineas, :extra_lineas)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':name_lineas', $name_lineas, PDO::PARAM_STR);
				$stmt->bindParam(':seo_lineas', $seo_lineas, PDO::PARAM_STR);
				$stmt->bindParam(':active_lineas', $active_lineas, PDO::PARAM_STR);
				$stmt->bindParam(':photo_lineas', $photo_lineas, PDO::PARAM_STR);
				$stmt->bindParam(':extra_lineas', $extra_lineas, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt;
			}
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function orden($id_lineas, $orden_lineas){
		global $db;
		try{
			$sql = "UPDATE galeria_lineas SET orden_lineas = :orden_lineas WHERE id_lineas = :id_lineas";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_lineas', $id_lineas, PDO::PARAM_STR);
			$stmt->bindParam(':orden_lineas', $orden_lineas, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_lineas){
		global $db, $sesion;

		$eliminado_lineas = date("Y-m-d h:i:s");

		$sql = "UPDATE galeria_lineas SET eliminado_lineas = :eliminado_lineas  WHERE id_lineas = :id_lineas";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id_lineas', $id_lineas, PDO::PARAM_STR);
		$stmt->bindParam(':eliminado_lineas', $eliminado_lineas, PDO::PARAM_STR);
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

$galeria_lineas = new galeria_lineas();