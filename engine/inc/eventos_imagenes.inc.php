<?php

class eventos_imagenes {
	private $db;

	public function tabla($id_eventos = 0, $requestData, $web){
		global $db, $sesion;
		try{

			$sql = " SELECT
			c.*
			FROM
			eventos_imagenes c
			WHERE
			c.id_eventos = '".$id_eventos."' 
			AND
			c.eliminado_imagenes = 0 ";
			if( !empty($requestData['search']['value']) ) {
				$search = $requestData['search']['value'];
				$sql.=" AND ( ";
				$sql .= " CONCAT(c.name_imagenes) LIKE '%".$search."%' ";
				$sql .= ") ";
			}
			$q = $db->prepare($sql);
			$q->execute();
			$totalData = $q->rowCount();
			$totalFiltered = $totalData;
			$sql.=" ORDER BY c.name_imagenes  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
			$q = $db->prepare($sql);
			$q->execute();
			$data = array();

			while($row = $q->fetchObject()) {
				$nestedData=array();
				$nombre = $row->name_imagenes;
				$nestedData[] = $nombre;

				$dir = _HOSTDIR_."/uploads/eventos/imagenes/big/".$row->photo_imagenes;
				$dir2 = _HOSTDIR_."/uploads/eventos/imagenes/small/".$row->photo_imagenes;
				if (file_exists($dir) && file_exists($dir2) && $row->photo_imagenes != "") {
					$nestedData[] = '<img src="'._HOST_.'/uploads/eventos/imagenes/small/'.$row->photo_imagenes.'" alt="'.$row->photo_imagenes.'" style="max-width: 150px;" >';
				}else{
					$nestedData[] = '<img src="'._HOST_.'/uploads/no-disponible.jpg" alt="No disponible" style="max-width: 150px;" >';
				}


				if($row->active_imagenes == 0){  $act = '<span data-activo="activo"><span class="label label-danger">Desactivado</span></span>';}else{ $act = '<span class="label label-primary">Activo</span>';}
				$nestedData[] = $act;
				$option = '<div class="ediccion ">';
				$option .= "<a href='".$web."/editar/".$row->id_imagenes."' class='badge badge-info' ><i class='fa fa-edit icon_size tip' title='Editar'></i> Editar</a>";
				$option .= "<a class='mup badge badge-danger' href='' data-target='#myModal' data-toggle='modal' data-id='".$row->id_imagenes."' data-name='".$nombre."' ><i class='fa fa-times icon_size tip' title='Eliminar'></i> Eliminar</a>";
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
			return json_encode($json_data);

		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}


	public function edit($id_imagenes){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM eventos_imagenes WHERE id_imagenes=:id_imagenes AND eliminado_imagenes = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":id_imagenes"=>$id_imagenes));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->name_imagenes = $row->name_imagenes;
					$this->extra_imagenes = json_decode($row->extra_imagenes, true);
					$this->active_imagenes = $row->active_imagenes;

					$this->photo_imagenes_name = $row->photo_imagenes;
					$dir = _HOSTDIR_."/uploads/eventos/imagenes/big/".$row->photo_imagenes;
					$dir2 = _HOSTDIR_."/uploads/eventos/imagenes/small/".$row->photo_imagenes;
					if (file_exists($dir) && file_exists($dir2) && $row->photo_imagenes != "") {
						$this->photo_imagenes=_HOST_."/uploads/eventos/imagenes/small/".$row->photo_imagenes;
					}else{
						$this->photo_imagenes=_HOST_."/uploads/no-disponible.jpg";
					}

					$this->id_eventos = $row->id_eventos;

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

	public function select($id_imagenes = null, $id_eventos = -1){
		global $db;
		try{
			$data = '';
			$sql = " SELECT * FROM eventos_imagenes WHERE eliminado_imagenes = 0 ";
			if ($id_eventos >= 0) {
				$sql .= " AND id_eventos = '".$id_eventos."' ";
			}
			$sql .= " ORDER BY orden_imagenes ASC ";
			$q = $db->prepare($sql);
			$q->execute();
			if($q->rowCount() > 0){
				$data .='<option value="0">No disponible</option>';
				$sel = '';
				while($row = $q->fetchObject()) {
					$id = $row->id_imagenes;
					if($id_imagenes == $id) $sel = "selected='selected' "; else $sel = "";
					$data .='<option '.$sel.' value="'.$row->id_imagenes.'">'. $row->name_imagenes.'</option>';
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

	public function data($id_eventos = 0, $random = null, $limit = 0){
		global $db, $sesion;
		try{
			$data = array();
			$sql = "SELECT * FROM eventos_imagenes WHERE active_imagenes = '1' AND eliminado_imagenes = 0 ";
			if ($id_eventos > 0) {
				$sql .= " AND id_eventos = '".$id_eventos."' ";
			}
			if ($random == true) {
				$sql .= " ORDER BY RAND() ";
			}else{
				$sql .= " ORDER BY orden_imagenes ASC, name_imagenes ASC  ";
			}
			if ($limit > 0) {
				$sql .= " LIMIT $limit ";
			}
			$sql = $db->prepare($sql);
			$sql->execute();
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_imagenes;
					$json['name'] = $row->name_imagenes;
					$json['extra'] = json_decode($row->extra_imagenes, true);
					$json['photo_name'] = $row->photo_imagenes;

					$dir = _HOSTDIR_."/uploads/eventos/imagenes/big/".$row->photo_imagenes;
					if (file_exists($dir)  && $row->photo_imagenes != "") {
						$json['photo'] =_HOST_."/uploads/eventos/imagenes/big/".$row->photo_imagenes;
					}else{
						$json['photo'] =_HOST_."/uploads/no-disponible.jpg";
					}

					$dir2 = _HOSTDIR_."/uploads/eventos/imagenes/small/".$row->photo_imagenes;
					if (file_exists($dir2)  && $row->photo_imagenes != "") {
						$json['photo_small'] =_HOST_."/uploads/eventos/imagenes/small/".$row->photo_imagenes;
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


	public function listado($id_eventos = 0, $pagination = 0, $limit = 10){
		global $db, $sesion;
		try{

			if($pagination == 0){
				$pagination = 1;
			}

			$offset = ($pagination - 1)*$limit . " , ";

			$row_count = $offset . $limit;


			$data = array();
			$sql = "SELECT * FROM eventos_imagenes WHERE active_imagenes = '1' AND eliminado_imagenes = 0 ";
			if ($id_eventos > 0) {
				$sql .= " AND id_eventos = '".$id_eventos."' ";
			}
			$sql .= " ORDER BY orden_imagenes ASC, name_imagenes ASC  ";


			//Contar todos las imagenes
			$q2 = $db->prepare($sql);
			$q2->execute();

			//Agregar limite con paginación
			$sql .= " LIMIT ".$row_count;
			$q = $db->prepare($sql);
			$q->execute();


			if($q->rowCount() > 0){
				while($row = $q->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_imagenes;
					$json['name'] = $row->name_imagenes;
					$json['extra'] = json_decode($row->extra_imagenes, true);
					$json['photo_name'] = $row->photo_imagenes;

					$dir = _HOSTDIR_."/uploads/eventos/imagenes/big/".$row->photo_imagenes;
					if (file_exists($dir)  && $row->photo_imagenes != "") {
						$json['photo'] =_HOST_."/uploads/eventos/imagenes/big/".$row->photo_imagenes;
					}else{
						$json['photo'] =_HOST_."/uploads/no-disponible.jpg";
					}

					$dir2 = _HOSTDIR_."/uploads/eventos/imagenes/small/".$row->photo_imagenes;
					if (file_exists($dir2)  && $row->photo_imagenes != "") {
						$json['photo_small'] =_HOST_."/uploads/eventos/imagenes/small/".$row->photo_imagenes;
					}else{
						$json['photo_small'] =_HOST_."/uploads/no-disponible.jpg";
					}

					$data['listado'][] = $json;
				}
			}

			$data['pagination']['limit'] =  $limit;
			$data['pagination']['total_pages'] =  ceil($q2->rowCount() / $limit);
			$data['pagination']['total_items'] = $q2->rowCount();

			$total_pages = ceil($q2->rowCount() / $limit);
			
			return $data;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function update($id_imagenes, $name_imagenes, $active_imagenes, $photo_imagenes, $id_eventos, $extra_imagenes){
		global $db, $sesion;
		try{
			$sql = "UPDATE eventos_imagenes SET name_imagenes = :name_imagenes, active_imagenes = :active_imagenes, photo_imagenes = :photo_imagenes, id_eventos = :id_eventos, extra_imagenes = :extra_imagenes WHERE id_imagenes = :id_imagenes";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_imagenes', $id_imagenes, PDO::PARAM_STR);
			$stmt->bindParam(':name_imagenes', $name_imagenes, PDO::PARAM_STR);
			$stmt->bindParam(':active_imagenes', $active_imagenes, PDO::PARAM_STR);
			$stmt->bindParam(':photo_imagenes', $photo_imagenes, PDO::PARAM_STR);
			$stmt->bindParam(':extra_imagenes', $extra_imagenes, PDO::PARAM_STR);
			$stmt->bindParam(':id_eventos', $id_eventos, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function add($name_imagenes, $active_imagenes, $photo_imagenes, $id_eventos, $extra_imagenes){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM eventos_imagenes WHERE name_imagenes=:name_imagenes AND id_eventos = :id_eventos AND eliminado_imagenes = 0 ";
			$stmt = $db->prepare($sql);
			$stmt->execute(array(":name_imagenes"=>$name_imagenes, ":id_eventos" => $id_eventos));
			if($stmt->rowCount() > 0){
				return false;
			}else{
				$sql = "INSERT INTO eventos_imagenes (name_imagenes, active_imagenes, photo_imagenes, id_eventos, extra_imagenes) VALUES(:name_imagenes, :active_imagenes, :photo_imagenes, :id_eventos, :extra_imagenes)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':name_imagenes', $name_imagenes, PDO::PARAM_STR);
				$stmt->bindParam(':active_imagenes', $active_imagenes, PDO::PARAM_STR);
				$stmt->bindParam(':photo_imagenes', $photo_imagenes, PDO::PARAM_STR);
				$stmt->bindParam(':extra_imagenes', $extra_imagenes, PDO::PARAM_STR);
				$stmt->bindParam(':id_eventos', $id_eventos, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt;
			}
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function orden($id_imagenes, $orden_imagenes){
		global $db;
		try{
			$sql = "UPDATE eventos_imagenes SET orden_imagenes = :orden_imagenes WHERE id_imagenes = :id_imagenes";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_imagenes', $id_imagenes, PDO::PARAM_STR);
			$stmt->bindParam(':orden_imagenes', $orden_imagenes, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_imagenes){
		global $db, $sesion;

		$eliminado_imagenes = date("Y-m-d h:i:s");

		$sql = "UPDATE eventos_imagenes SET eliminado_imagenes = :eliminado_imagenes  WHERE id_imagenes = :id_imagenes";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id_imagenes', $id_imagenes, PDO::PARAM_STR);
		$stmt->bindParam(':eliminado_imagenes', $eliminado_imagenes, PDO::PARAM_STR);
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

$eventos_imagenes = new eventos_imagenes();