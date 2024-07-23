<?php

class preguntas {
	private $db;


	public function tabla($requestData, $web){

		global $db, $sesion, $datatable, $user;
		$sql= "SELECT * FROM preguntas ";

		if( !empty($requestData['search']['value']) ) {
			$search = $requestData['search']['value'];
			$sql.=" WHERE ( ";
			$sql .= " name_preguntas LIKE '%".$search."%' ";
			$sql .= ") ";
		}

		$q = $db->prepare($sql);
		$q->execute();
		$totalData = $q->rowCount();
		$totalFiltered = $totalData;
		$sql.=" ORDER BY name_preguntas  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		$q = $db->prepare($sql);
		$q->execute();
		$data = array();

		while($row = $q->fetchObject()) {
			$nestedData=array();
			$nombre = $row->name_preguntas;
			$nestedData[] = $nombre;
			if($row->activo_preguntas == 0){  $act = '<span data-activo="activo"><span class="label label-danger">Desactivado</span></span>';}else{ $act = '<span class="label label-primary">Activo</span>';}
			$nestedData[] = $act;
			$option = '<div class="ediccion ">';
			$option .= "<a href='".$web."/editar/".$row->id_preguntas."' class='badge badge-info' ><i class='fa fa-edit icon_size tip' title='Editar'></i> Editar</a>";

			$option .= "<a href='".$web."/".$row->id_preguntas."/respuestas' class='badge badge-warning' ><i class='fa fa-comments icon_size tip' title='Respuestas'></i> Respuestas</a>";

			$option .= "<a class='mup badge badge-danger' href='' data-target='#myModal' data-toggle='modal' data-id='".$row->id_preguntas."' data-name='".$nombre."' ><i class='fa fa-times icon_size tip' title='Eliminar'></i> Eliminar</a>";
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

	public function select($id_preguntas = null){
		global $db;
		try{
			$data = '';
			$q= "SELECT * FROM preguntas ORDER BY orden_preguntas ASC";
			$q = $db->prepare($q);
			$q->execute();
			if($q->rowCount() > 0){
				$sel = '';
				while($row = $q->fetchObject()) {
					$id = $row->id_preguntas;
					if($id_preguntas == $id) $sel = "selected='selected' "; else $sel = "";
					$data .='<option '.$sel.' value="'.$row->id_preguntas.'">'. $row->name_preguntas.'</option>';
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

	public function data(){
		global $db;
		try{
			$data = array();
			$q= "SELECT * FROM preguntas WHERE activo_preguntas = '1' ORDER BY orden_preguntas ASC";
			$q = $db->prepare($q);
			$q->execute();
			if($q->rowCount() > 0){
				$sel = '';
				while($row = $q->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_preguntas;
					$json['name'] = $row->name_preguntas;
					$json['orden'] = $row->orden_preguntas;
					$data[] = $json;
				}
			}
			return $data;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function edit($id_preguntas){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM preguntas WHERE id_preguntas=:id_preguntas";
			$q = $db->prepare($sql);
			$q->execute(array(":id_preguntas"=>$id_preguntas));
			if($q->rowCount() > 0){
				while($row = $q->fetchObject()) {
					$this->name_preguntas = $row->name_preguntas;
					$this->activo_preguntas = $row->activo_preguntas;
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

	public function update($id_preguntas, $name_preguntas, $activo_preguntas){
		global $db, $sesion;
		try{
			$sql = "UPDATE preguntas SET name_preguntas = :name_preguntas, activo_preguntas = :activo_preguntas WHERE id_preguntas = :id_preguntas";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_preguntas', $id_preguntas, PDO::PARAM_STR);
			$stmt->bindParam(':name_preguntas', $name_preguntas, PDO::PARAM_STR);
			$stmt->bindParam(':activo_preguntas', $activo_preguntas, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function orden($id_preguntas, $orden_preguntas){
		global $db, $sesion;
		try{
			$sql = "UPDATE preguntas SET orden_preguntas = :orden_preguntas WHERE id_preguntas = :id_preguntas";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_preguntas', $id_preguntas, PDO::PARAM_STR);
			$stmt->bindParam(':orden_preguntas', $orden_preguntas, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function add($name_preguntas, $activo_preguntas){
		global $db, $sesion;
		try{
			$q= "SELECT * FROM preguntas WHERE name_preguntas=:name_preguntas";
			$q = $db->prepare($q);
			$q->execute(array(":name_preguntas"=>$name_preguntas));
			if($q->rowCount() > 0){
				return false;
			}else{
				$sql = "INSERT INTO preguntas (name_preguntas, activo_preguntas) VALUES(:name_preguntas, :activo_preguntas)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':name_preguntas', $name_preguntas, PDO::PARAM_STR);
				$stmt->bindParam(':activo_preguntas', $activo_preguntas, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt;
			}
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_preguntas){
		global $db, $sesion;


		$q= "SELECT * FROM preguntas_respuestas WHERE id_preguntas=:id_preguntas";
		$q = $db->prepare($q);
		$q->execute(array(":id_preguntas"=>$id_preguntas));

		if($q->rowCount() > 0){
			$return_data['type'] = 'error';
			$return_data['msje'] = 'Error al eliminar. Hay un respuestas relacionadas.';

		}else{
			$sql = "DELETE FROM preguntas WHERE id_preguntas = :id_preguntas";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_preguntas', $id_preguntas, PDO::PARAM_STR);
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

$preguntas = new preguntas();