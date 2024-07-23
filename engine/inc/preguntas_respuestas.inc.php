<?php

class preguntas_respuestas {
	private $db;


	public function tabla($id_preguntas, $requestData, $web){

		global $db, $sesion, $datatable, $user;
		$sql= "SELECT * FROM preguntas_respuestas WHERE id_preguntas = '".$id_preguntas."' ";

		if( !empty($requestData['search']['value']) ) {
			$search = $requestData['search']['value'];
			$sql.=" AND ( ";
			$sql .= " name_respuestas LIKE '%".$search."%' ";
			$sql .= ") ";
		}

		$q = $db->prepare($sql);
		$q->execute();
		$totalData = $q->rowCount();
		$totalFiltered = $totalData;
		$sql.=" ORDER BY name_respuestas  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		$q = $db->prepare($sql);
		$q->execute();
		$data = array();

		while($row = $q->fetchObject()) {
			$nestedData=array();
			$nombre = $row->name_respuestas;
			$nestedData[] = $nombre;
			if($row->activo_respuestas == 0){  $act = '<span data-activo="activo"><span class="label label-danger">Desactivado</span></span>';}else{ $act = '<span class="label label-primary">Activo</span>';}
			$nestedData[] = $act;
			$option = '<div class="ediccion ">';
			$option .= "<a href='".$web."/editar/".$row->id_respuestas."' class='badge badge-info' ><i class='fa fa-edit icon_size tip' title='Editar'></i> Editar</a>";

			$option .= "<a class='mup badge badge-danger' href='' data-target='#myModal' data-toggle='modal' data-id='".$row->id_respuestas."' data-name='".$nombre."' ><i class='fa fa-times icon_size tip' title='Eliminar'></i> Eliminar</a>";
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

	public function select($id_preguntas = null, $id_respuestas = null){
		global $db;
		try{
			$data = '';
			$q= "SELECT * FROM preguntas_respuestas WHERE id_preguntas = :id_preguntas ORDER BY orden_respuestas ASC";
			$q = $db->prepare($q);
			$q->execute(array(':id_preguntas' => $id_preguntas ));
			if($q->rowCount() > 0){
				$sel = '';
				while($row = $q->fetchObject()) {
					$id = $row->id_respuestas;
					if($id_respuestas == $id) $sel = "selected='selected' "; else $sel = "";
					$data .='<option '.$sel.' value="'.$row->id_respuestas.'">'. $row->name_respuestas.'</option>';
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

	public function data($id_preguntas = null){
		global $db;
		try{
			$data = array();
			$q= "SELECT * FROM preguntas_respuestas WHERE id_preguntas = :id_preguntas AND activo_respuestas = '1' ORDER BY orden_respuestas ASC";
			$q = $db->prepare($q);
			$q->execute(array(':id_preguntas' => $id_preguntas ));
			if($q->rowCount() > 0){
				$sel = '';
				while($row = $q->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_respuestas;
					$json['name'] = $row->name_respuestas;
					$json['orden'] = $row->orden_respuestas;
					$json['extra'] = json_decode($row->extra_respuestas, true);
					$data[] = $json;
				}
			}
			return $data;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function edit($id_respuestas){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM preguntas_respuestas WHERE id_respuestas=:id_respuestas";
			$q = $db->prepare($sql);
			$q->execute(array(":id_respuestas"=>$id_respuestas));
			if($q->rowCount() > 0){
				while($row = $q->fetchObject()) {
					$this->name_respuestas = $row->name_respuestas;
					$this->activo_respuestas = $row->activo_respuestas;
					$this->extra_respuestas = json_decode($row->extra_respuestas, true);
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

	public function update($id_respuestas, $name_respuestas, $activo_respuestas, $extra_respuestas){
		global $db, $sesion;
		try{
			$sql = "UPDATE preguntas_respuestas SET name_respuestas = :name_respuestas, activo_respuestas = :activo_respuestas, extra_respuestas = :extra_respuestas WHERE id_respuestas = :id_respuestas";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_respuestas', $id_respuestas, PDO::PARAM_STR);
			$stmt->bindParam(':name_respuestas', $name_respuestas, PDO::PARAM_STR);
			$stmt->bindParam(':activo_respuestas', $activo_respuestas, PDO::PARAM_STR);
			$stmt->bindParam(':extra_respuestas', $extra_respuestas, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function orden($id_respuestas, $orden_respuestas){
		global $db, $sesion;
		try{
			$sql = "UPDATE preguntas_respuestas SET orden_respuestas = :orden_respuestas WHERE id_respuestas = :id_respuestas";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_respuestas', $id_respuestas, PDO::PARAM_STR);
			$stmt->bindParam(':orden_respuestas', $orden_respuestas, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function add($id_preguntas, $name_respuestas, $activo_respuestas, $extra_respuestas){
		global $db, $sesion;
		try{
			$q= "SELECT * FROM preguntas_respuestas WHERE name_respuestas=:name_respuestas AND id_preguntas = :id_preguntas ";
			$q = $db->prepare($q);
			$q->execute(array(":id_preguntas"=>$id_preguntas, ":name_respuestas"=>$name_respuestas));
			if($q->rowCount() > 0){
				return false;
			}else{
				$sql = "INSERT INTO preguntas_respuestas (name_respuestas, activo_respuestas, id_preguntas, extra_respuestas) VALUES(:name_respuestas, :activo_respuestas, :id_preguntas, :extra_respuestas)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':name_respuestas', $name_respuestas, PDO::PARAM_STR);
				$stmt->bindParam(':activo_respuestas', $activo_respuestas, PDO::PARAM_STR);
				$stmt->bindParam(':id_preguntas', $id_preguntas, PDO::PARAM_STR);
				$stmt->bindParam(':extra_respuestas', $extra_respuestas, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt;
			}
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_respuestas){
		global $db, $sesion;

		$sql = "DELETE FROM preguntas_respuestas WHERE id_respuestas = :id_respuestas";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id_respuestas', $id_respuestas, PDO::PARAM_STR);
		$stmt->execute();

		if(!$stmt){
			$return_data['type'] = 'error';
			$return_data['msje'] = 'Error al eliminar. Intente de nuevo.';

		}else{
			$return_data['type'] = 'success';
			$return_data['msje'] = 'El area se ha eliminado.';
		}

		echo json_encode($return_data);
		exit();

	}

}

$preguntas_respuestas = new preguntas_respuestas();