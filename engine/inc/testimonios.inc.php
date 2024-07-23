<?php

class testimonios {
	private $db;


	public function tabla($requestData, $web){
		global $db, $sesion, $datatable;
		return $datatable->get($requestData, 'testimonios', array('id_testimonios', 'name_testimonios'), null, array('name_testimonios'), 'active_testimonios', null, null, null, $web, null, 'eliminado_testimonios');
	}

	public function edit($id_testimonios){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM testimonios WHERE id_testimonios=:id_testimonios AND eliminado_testimonios = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":id_testimonios"=>$id_testimonios));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->name_testimonios = $row->name_testimonios;
					$this->extra_testimonios = json_decode($row->extra_testimonios, true);
					$this->active_testimonios = $row->active_testimonios;

					$photo_testimonios = json_decode($row->photo_testimonios, true);

					$this->photo_testimonios = array();

					if (count($photo_testimonios) > 0) {
						foreach ($photo_testimonios as $key => $value) {

							// Key = "fondo"
							// Value = imagen.jpg

							$this->photo_testimonios[$key]['name'] = $value;

							$dir = _HOSTDIR_."/uploads/testimonios/$key/big/".$value;
							$dir2 = _HOSTDIR_."/uploads/testimonios/$key/small/".$value;

							if (file_exists($dir) && file_exists($dir2) && $value != "") {
								$this->photo_testimonios[$key]['file'] =_HOST_."/uploads/testimonios/$key/big/".$value;
							}else{
								$this->photo_testimonios[$key]['file'] =_HOST_."/uploads/no-disponible.jpg";
							}
						}
					}
					$this->fecha_testimonios = $row->fecha_testimonios;

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
			$sql= "SELECT * FROM testimonios WHERE active_testimonios = '1' AND eliminado_testimonios = 0 ORDER BY orden_testimonios ASC, name_testimonios ASC ";
			$sql = $db->prepare($sql);
			$sql->execute();
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_testimonios;
					$json['name'] = $row->name_testimonios;
					$json['extra'] = json_decode($row->extra_testimonios, true);
					$photo_testimonios = json_decode($row->photo_testimonios, true);

					$json['photo'] = array();

					if (count($photo_testimonios) > 0) {
						foreach ($photo_testimonios as $key => $value) {

							// Key = "fondo"
							// Value = imagen.jpg

							$json['photo'][$key]['name'] = $value;

							$dir = _HOSTDIR_."/uploads/testimonios/$key/big/".$value;
							$dir2 = _HOSTDIR_."/uploads/testimonios/$key/small/".$value;

							if (file_exists($dir) && file_exists($dir2) && $value != "") {
								$json['photo'][$key]['file'] =_HOST_."/uploads/testimonios/$key/big/".$value;
							}else{
								$json['photo'][$key]['file'] = '';
							}
						}
					}

					$json['fecha'] = $row->fecha_testimonios;

					$data[] = $json;
				}
			}
			return $data;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function update($id_testimonios, $name_testimonios, $active_testimonios, $photo_testimonios, $extra_testimonios){
		global $db, $sesion;
		try{
			$sql = "UPDATE testimonios SET name_testimonios = :name_testimonios, active_testimonios = :active_testimonios, photo_testimonios = :photo_testimonios, extra_testimonios = :extra_testimonios WHERE id_testimonios = :id_testimonios";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_testimonios', $id_testimonios, PDO::PARAM_STR);
			$stmt->bindParam(':name_testimonios', $name_testimonios, PDO::PARAM_STR);
			$stmt->bindParam(':active_testimonios', $active_testimonios, PDO::PARAM_STR);
			$stmt->bindParam(':photo_testimonios', $photo_testimonios, PDO::PARAM_STR);
			$stmt->bindParam(':extra_testimonios', $extra_testimonios, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function add($name_testimonios, $active_testimonios, $photo_testimonios, $extra_testimonios){
		global $db, $sesion;
		try{
			$fecha_testimonios = date("Y-m-d H:i:s");
			$sql = "INSERT INTO testimonios (name_testimonios, active_testimonios, photo_testimonios, extra_testimonios, fecha_testimonios) VALUES(:name_testimonios, :active_testimonios, :photo_testimonios, :extra_testimonios, :fecha_testimonios)";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':name_testimonios', $name_testimonios, PDO::PARAM_STR);
			$stmt->bindParam(':active_testimonios', $active_testimonios, PDO::PARAM_STR);
			$stmt->bindParam(':photo_testimonios', $photo_testimonios, PDO::PARAM_STR);
			$stmt->bindParam(':extra_testimonios', $extra_testimonios, PDO::PARAM_STR);
			$stmt->bindParam(':fecha_testimonios', $fecha_testimonios, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function orden($id_testimonios, $orden_testimonios){
		global $db;
		try{
			$sql = "UPDATE testimonios SET orden_testimonios = :orden_testimonios WHERE id_testimonios = :id_testimonios";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_testimonios', $id_testimonios, PDO::PARAM_STR);
			$stmt->bindParam(':orden_testimonios', $orden_testimonios, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_testimonios){
		global $db, $sesion;

		$eliminado_testimonios = date("Y-m-d h:i:s");

		$sql = "UPDATE testimonios SET eliminado_testimonios = :eliminado_testimonios  WHERE id_testimonios = :id_testimonios";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id_testimonios', $id_testimonios, PDO::PARAM_STR);
		$stmt->bindParam(':eliminado_testimonios', $eliminado_testimonios, PDO::PARAM_STR);
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

$testimonios = new testimonios();