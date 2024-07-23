<?php

class cursos_subimagenes {
	private $db;

	public function tabla($id_cursos = 0, $id_imagenes = 0, $requestData, $web){
		global $db, $sesion;
		try{
			$sql = " SELECT
			c.*
			FROM
			cursos_subimagenes c
			WHERE
			c.id_cursos = '".$id_cursos."' 
			AND
			c.id_imagenes = '".$id_imagenes."' 
			AND
			c.eliminado_subimagenes = 0 ";
			if( !empty($requestData['search']['value']) ) {
				$search = $requestData['search']['value'];
				$sql.=" AND ( ";
				$sql .= " CONCAT(c.name_subimagenes) LIKE '%".$search."%' ";
				$sql .= ") ";
			}
			$q = $db->prepare($sql);
			$q->execute();
			$totalData = $q->rowCount();
			$totalFiltered = $totalData;
			$sql.=" ORDER BY c.name_subimagenes  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
			$q = $db->prepare($sql);
			$q->execute();
			$data = array();

			while($row = $q->fetchObject()) {
				$nestedData=array();
				$nombre = $row->name_subimagenes;
				$nestedData[] = $nombre;

				$dir = _HOSTDIR_."/uploads/cursos/imagenes/adicionales/big/".$row->photo_subimagenes;
				$dir2 = _HOSTDIR_."/uploads/cursos/imagenes/adicionales/small/".$row->photo_subimagenes;
				if (file_exists($dir) && file_exists($dir2) && $row->photo_subimagenes != "") {
					$nestedData[] = '<img src="'._HOST_.'/uploads/cursos/imagenes/adicionales/small/'.$row->photo_subimagenes.'" alt="'.$row->photo_subimagenes.'" style="max-width: 150px;" >';
				}else{
					$nestedData[] = '<img src="'._HOST_.'/uploads/no-disponible.jpg" alt="No disponible" style="max-width: 150px;" >';
				}


				if($row->active_subimagenes == 0){  $act = '<span data-activo="activo"><span class="label label-danger">Desactivado</span></span>';}else{ $act = '<span class="label label-primary">Activo</span>';}
				$nestedData[] = $act;
				$option = '<div class="ediccion ">';
				$option .= "<a href='".$web."/editar/".$row->id_subimagenes."' class='badge badge-info' ><i class='fa fa-edit icon_size tip' title='Editar'></i> Editar</a>";
				$option .= "<a class='mup badge badge-danger' href='' data-target='#myModal' data-toggle='modal' data-id='".$row->id_subimagenes."' data-name='".$nombre."' ><i class='fa fa-times icon_size tip' title='Eliminar'></i> Eliminar</a>";
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


	public function edit($id_subimagenes){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM cursos_subimagenes WHERE id_subimagenes=:id_subimagenes AND eliminado_subimagenes = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":id_subimagenes"=>$id_subimagenes));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->name_subimagenes = $row->name_subimagenes;
					$this->extra_subimagenes = json_decode($row->extra_subimagenes, true);
					$this->active_subimagenes = $row->active_subimagenes;

					$this->photo_subimagenes_name = $row->photo_subimagenes;
					$dir = _HOSTDIR_."/uploads/cursos/imagenes/adicionales/big/".$row->photo_subimagenes;
					$dir2 = _HOSTDIR_."/uploads/cursos/imagenes/adicionales/small/".$row->photo_subimagenes;
					if (file_exists($dir) && file_exists($dir2) && $row->photo_subimagenes != "") {
						$this->photo_subimagenes=_HOST_."/uploads/cursos/imagenes/adicionales/small/".$row->photo_subimagenes;
					}else{
						$this->photo_subimagenes=_HOST_."/uploads/no-disponible.jpg";
					}

					$this->id_cursos = $row->id_cursos;

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

	public function data($id_cursos = 0, $id_imagenes = 0, $random = null, $limit = 0){
		global $db, $sesion;
		try{
			$data = array();
			$sql = "SELECT * FROM cursos_subimagenes WHERE active_subimagenes = '1' AND eliminado_subimagenes = 0 ";
			if ($id_cursos > 0) {
				$sql .= " AND id_cursos = '".$id_cursos."' ";
			}
			if ($id_imagenes > 0) {
				$sql .= " AND id_imagenes = '".$id_imagenes."' ";
			}
			if ($random == true) {
				$sql .= " ORDER BY RAND() ";
			}else{
				$sql .= " ORDER BY orden_subimagenes ASC, name_subimagenes ASC  ";
			}
			if ($limit > 0) {
				$sql .= " LIMIT $limit ";
			}
			$sql = $db->prepare($sql);
			$sql->execute();
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_subimagenes;
					$json['name'] = $row->name_subimagenes;
					$json['photo_name'] = $row->photo_subimagenes;

					$dir = _HOSTDIR_."/uploads/cursos/imagenes/adicionales/big/".$row->photo_subimagenes;
					if (file_exists($dir)  && $row->photo_subimagenes != "") {
						$json['photo'] =_HOST_."/uploads/cursos/imagenes/adicionales/big/".$row->photo_subimagenes;
					}else{
						$json['photo'] =_HOST_."/uploads/no-disponible.jpg";
					}

					$dir2 = _HOSTDIR_."/uploads/cursos/imagenes/adicionales/small/".$row->photo_subimagenes;
					if (file_exists($dir2)  && $row->photo_subimagenes != "") {
						$json['photo_small'] =_HOST_."/uploads/cursos/imagenes/adicionales/small/".$row->photo_subimagenes;
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


	public function listado($id_cursos = 0, $id_imagenes = 0, $pagination = 0, $limit = 10){
		global $db, $sesion;
		try{

			if($pagination == 0){
				$pagination = 1;
			}

			$offset = ($pagination - 1)*$limit . " , ";

			$row_count = $offset . $limit;


			$data = array();
			$sql = "SELECT * FROM cursos_subimagenes WHERE active_subimagenes = '1' AND eliminado_subimagenes = 0 ";
			if ($id_cursos > 0) {
				$sql .= " AND id_cursos = '".$id_cursos."' ";
			}
			if ($id_imagenes > 0) {
				$sql .= " AND id_imagenes = '".$id_imagenes."' ";
			}
			$sql .= " ORDER BY orden_subimagenes ASC, name_subimagenes ASC  ";


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
					$json['id'] = $row->id_subimagenes;
					$json['name'] = $row->name_subimagenes;
					$json['extra'] = json_decode($row->extra_subimagenes, true);
					$json['photo_name'] = $row->photo_subimagenes;

					$dir = _HOSTDIR_."/uploads/cursos/imagenes/adicionales/big/".$row->photo_subimagenes;
					if (file_exists($dir)  && $row->photo_subimagenes != "") {
						$json['photo'] =_HOST_."/uploads/cursos/imagenes/adicionales/big/".$row->photo_subimagenes;
					}else{
						$json['photo'] =_HOST_."/uploads/no-disponible.jpg";
					}

					$dir2 = _HOSTDIR_."/uploads/cursos/imagenes/adicionales/small/".$row->photo_subimagenes;
					if (file_exists($dir2)  && $row->photo_subimagenes != "") {
						$json['photo_small'] =_HOST_."/uploads/cursos/imagenes/adicionales/small/".$row->photo_subimagenes;
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

	public function update($id_subimagenes, $name_subimagenes, $active_subimagenes, $photo_subimagenes, $id_cursos, $id_imagenes, $extra_subimagenes){
		global $db, $sesion;
		try{
			$sql = "UPDATE cursos_subimagenes SET name_subimagenes = :name_subimagenes, active_subimagenes = :active_subimagenes, photo_subimagenes = :photo_subimagenes, id_cursos = :id_cursos, id_imagenes = :id_imagenes, extra_subimagenes = :extra_subimagenes WHERE id_subimagenes = :id_subimagenes";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_subimagenes', $id_subimagenes, PDO::PARAM_STR);
			$stmt->bindParam(':name_subimagenes', $name_subimagenes, PDO::PARAM_STR);
			$stmt->bindParam(':active_subimagenes', $active_subimagenes, PDO::PARAM_STR);
			$stmt->bindParam(':photo_subimagenes', $photo_subimagenes, PDO::PARAM_STR);
			$stmt->bindParam(':extra_subimagenes', $extra_subimagenes, PDO::PARAM_STR);
			$stmt->bindParam(':id_cursos', $id_cursos, PDO::PARAM_STR);
			$stmt->bindParam(':id_imagenes', $id_imagenes, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function add($name_subimagenes, $active_subimagenes, $photo_subimagenes, $id_cursos, $id_imagenes, $extra_subimagenes){
		global $db, $sesion;
		try{

			$sql = "INSERT INTO cursos_subimagenes (name_subimagenes, active_subimagenes, photo_subimagenes, id_cursos, id_imagenes, extra_subimagenes) VALUES(:name_subimagenes, :active_subimagenes, :photo_subimagenes, :id_cursos, :id_imagenes, :extra_subimagenes)";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':name_subimagenes', $name_subimagenes, PDO::PARAM_STR);
			$stmt->bindParam(':active_subimagenes', $active_subimagenes, PDO::PARAM_STR);
			$stmt->bindParam(':photo_subimagenes', $photo_subimagenes, PDO::PARAM_STR);
			$stmt->bindParam(':extra_subimagenes', $extra_subimagenes, PDO::PARAM_STR);
			$stmt->bindParam(':id_cursos', $id_cursos, PDO::PARAM_STR);
			$stmt->bindParam(':id_imagenes', $id_imagenes, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function orden($id_subimagenes, $orden_subimagenes){
		global $db;
		try{
			$sql = "UPDATE cursos_subimagenes SET orden_subimagenes = :orden_subimagenes WHERE id_subimagenes = :id_subimagenes";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_subimagenes', $id_subimagenes, PDO::PARAM_STR);
			$stmt->bindParam(':orden_subimagenes', $orden_subimagenes, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_subimagenes){
		global $db, $sesion;

		$eliminado_subimagenes = date("Y-m-d h:i:s");

		$sql = "UPDATE cursos_subimagenes SET eliminado_subimagenes = :eliminado_subimagenes  WHERE id_subimagenes = :id_subimagenes";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id_subimagenes', $id_subimagenes, PDO::PARAM_STR);
		$stmt->bindParam(':eliminado_subimagenes', $eliminado_subimagenes, PDO::PARAM_STR);
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

$cursos_subimagenes = new cursos_subimagenes();