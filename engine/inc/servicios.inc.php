<?php

class servicios {
	private $db;

	public function tabla($requestData, $web){
		global $db, $sesion;
		try{

			$cservicios = file_get_contents(_DATA_ . '/servicios.json');
			$cservicios = json_decode($cservicios, true);

			$sql = " SELECT
			p.*,
			IFNULL(l.name_lineas, 'No disponible') as name_lineas,
			IFNULL(c.name_categorias, 'No disponible') as name_categorias,
			IFNULL(s.name_subcategorias, 'No disponible') as name_subcategorias
			FROM
			servicios p
			LEFT JOIN (
			SELECT id_lineas, name_lineas
			FROM servicios_lineas
			) l ON l.id_lineas = p.id_lineas
			LEFT JOIN (
			SELECT id_categorias, name_categorias
			FROM servicios_categorias
			) c ON c.id_categorias = p.id_categorias
			LEFT JOIN (
			SELECT id_subcategorias, name_subcategorias
			FROM servicios_subcategorias
			) s ON s.id_subcategorias = p.id_subcategorias
			WHERE
			p.eliminado_servicios = 0 ";
			if( !empty($requestData['search']['value']) ) {
				$search = $requestData['search']['value'];
				$sql.=" AND ( ";
				$sql .= " CONCAT(p.name_servicios) LIKE '%".$search."%' ";
				$sql .= " OR l.name_lineas LIKE '%".$search."%' ";
				$sql .= " OR c.name_categorias LIKE '%".$search."%' ";
				$sql .= " OR s.name_subcategorias LIKE '%".$search."%' ";
				$sql .= ") ";
			}
			$q = $db->prepare($sql);
			$q->execute();
			$totalData = $q->rowCount();
			$totalFiltered = $totalData;
			$sql.=" ORDER BY p.name_servicios  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
			$q = $db->prepare($sql);
			$q->execute();
			$data = array();

			while($row = $q->fetchObject()) {
				$nestedData=array();
				$nombre = $row->name_servicios;
				$nestedData[] = $nombre;
				if ($cservicios['view']['lineas'] == 1) {
					$nestedData[] = $row->name_lineas;
				}
				if ($cservicios['view']['categorias'] == 1) {
					$nestedData[] = $row->name_categorias;
				}
				if ($cservicios['view']['subcategorias'] == 1) {
					$nestedData[] = $row->name_subcategorias;
				}
				if($row->active_servicios == 0){  $act = '<span data-activo="activo"><span class="label label-danger">Desactivado</span></span>';}else{ $act = '<span class="label label-primary">Activo</span>';}
				$nestedData[] = $act;
				$option = '<div class="ediccion ">';
				$option .= "<a href='".$web."/editar/".$row->id_servicios."' class='badge badge-info' ><i class='fa fa-edit icon_size tip' title='Editar'></i> Editar</a>";
				if ($cservicios['view']['imagenes'] == 1) {
					$option .= "<a href='".$web."/imagenes/".$row->id_servicios."' class='badge badge-warning' ><i class='fa fa-picture-o icon_size tip' title='Editar'></i> Imagenes</a>";
				}
				$option .= "<a class='mup badge badge-danger' href='' data-target='#myModal' data-toggle='modal' data-id='".$row->id_servicios."' data-name='".$nombre."' ><i class='fa fa-times icon_size tip' title='Eliminar'></i> Eliminar</a>";
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


	public function edit($id_servicios){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM servicios WHERE id_servicios=:id_servicios AND eliminado_servicios = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":id_servicios"=>$id_servicios));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->id_servicios = $row->id_servicios;
					$this->name_servicios = $row->name_servicios;
					$this->seo_servicios = $row->seo_servicios;
					$this->extra_servicios = json_decode($row->extra_servicios, true);
					$this->active_servicios = $row->active_servicios;

					$photo_servicios = json_decode($row->photo_servicios, true);

					$this->photo_servicios = array();

					if (count($photo_servicios) > 0) {
						foreach ($photo_servicios as $key => $value) {

							// Key = "fondo"
							// Value = imagen.jpg

							$this->photo_servicios[$key]['name'] = $value;

							$dir = _HOSTDIR_."/uploads/servicios/$key/big/".$value;
							$dir2 = _HOSTDIR_."/uploads/servicios/$key/small/".$value;

							if (file_exists($dir) && file_exists($dir2) && $value != "") {
								$this->photo_servicios[$key]['file'] =_HOST_."/uploads/servicios/$key/big/".$value;
							}else{
								$this->photo_servicios[$key]['file'] =_HOST_."/uploads/no-disponible.jpg";
							}
						}
					}

					$this->id_lineas = $row->id_lineas;
					$this->id_categorias = $row->id_categorias;
					$this->id_subcategorias = $row->id_subcategorias;

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

	public function view($seo_servicios){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM servicios WHERE seo_servicios=:seo_servicios AND eliminado_servicios = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":seo_servicios"=>$seo_servicios));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->id_servicios = $row->id_servicios;
					$this->name_servicios = $row->name_servicios;
					$this->seo_servicios = $row->seo_servicios;
					$this->extra_servicios = json_decode($row->extra_servicios, true);
					$this->active_servicios = $row->active_servicios;

					$photo_servicios = json_decode($row->photo_servicios, true);

					$this->photo_servicios = array();

					if (count($photo_servicios) > 0) {
						foreach ($photo_servicios as $key => $value) {

							// Key = "fondo"
							// Value = imagen.jpg

							$this->photo_servicios[$key]['name'] = $value;

							$dir = _HOSTDIR_."/uploads/servicios/$key/big/".$value;
							$dir2 = _HOSTDIR_."/uploads/servicios/$key/small/".$value;

							if (file_exists($dir) && file_exists($dir2) && $value != "") {
								$this->photo_servicios[$key]['file'] =_HOST_."/uploads/servicios/$key/big/".$value;
							}else{
								$this->photo_servicios[$key]['file'] = "";
							}
						}
					}


					$this->id_lineas = $row->id_lineas;
					$this->id_categorias = $row->id_categorias;
					$this->id_subcategorias = $row->id_subcategorias;

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

	public function select($id_servicios = null){
		global $db;
		try{
			$data = '';
			$q= "SELECT * FROM servicios WHERE eliminado_servicios = 0 ORDER BY orden_servicios ASC, name_servicios ASC ";
			$q = $db->prepare($q);
			$q->execute();
			if($q->rowCount() > 0){
				$sel = '';
				while($row = $q->fetchObject()) {
					$id = $row->id_servicios;
					if($id_servicios == $id) $sel = "selected='selected' "; else $sel = "";
					$data .='<option '.$sel.' value="'.$row->id_servicios.'">'. $row->name_servicios.'</option>';
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

	public function data($id_categorias = -1, $id_servicios = -1 , $limit = -1 ){
		global $db, $sesion;
		try{
			$data = array();
			$sql= "SELECT * FROM servicios WHERE active_servicios = '1' AND eliminado_servicios = 0  ";
			if ($id_servicios > 0) {
				$sql .= " AND id_servicios != '".$id_servicios."' ";
			}

			if ($id_categorias > 0) {
				$sql .= " AND id_categorias = '".$id_categorias."' ";
			}
			
			if ($limit > 0) {
				$sql .= " ORDER BY RAND() LIMIT $limit ";
			}else{
				$sql .= " ORDER BY orden_servicios ASC, name_servicios ASC ";
			}
			$sql = $db->prepare($sql);
			$sql->execute();
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_servicios;
					$json['name'] = $row->name_servicios;
					$json['seo'] = $row->seo_servicios;
					$json['extra'] = json_decode($row->extra_servicios, true);
					
					$photo_servicios = json_decode($row->photo_servicios, true);

					$json['photo'] = array();

					if (count($photo_servicios) > 0) {
						foreach ($photo_servicios as $key => $value) {

							// Key = "fondo"
							// Value = imagen.jpg

							$json['photo'][$key]['name'] = $value;

							$dir = _HOSTDIR_."/uploads/servicios/$key/big/".$value;
							$dir2 = _HOSTDIR_."/uploads/servicios/$key/small/".$value;

							if (file_exists($dir) && file_exists($dir2) && $value != "") {
								$json['photo'][$key]['file'] =_HOST_."/uploads/servicios/$key/big/".$value;
							}else{
								$json['photo'][$key]['file'] = '';
							}
						}
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

	public function search($name = '', $limit = 10){
		global $db, $sesion;
		try{
			$data = array();
			$sql = " SELECT * FROM servicios WHERE active_servicios = '1' AND eliminado_servicios = 0  AND name_servicios LIKE :name ORDER BY orden_servicios ASC, name_servicios ASC LIMIT $limit ";
			$sql = $db->prepare($sql);
			$sql->execute(array(':name' => '%'.$name.'%'));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_servicios;
					$json['name'] = $row->name_servicios;
					$json['seo'] = $row->seo_servicios;
					$json['extra'] = json_decode($row->extra_servicios, true);
					$photo_servicios = json_decode($row->photo_servicios, true);

					$json['photo'] = array();

					if (count($photo_servicios) > 0) {
						foreach ($photo_servicios as $key => $value) {

							// Key = "fondo"
							// Value = imagen.jpg

							$json['photo'][$key]['name'] = $value;

							$dir = _HOSTDIR_."/uploads/servicios/$key/big/".$value;
							$dir2 = _HOSTDIR_."/uploads/servicios/$key/small/".$value;

							if (file_exists($dir) && file_exists($dir2) && $value != "") {
								$json['photo'][$key]['file'] =_HOST_."/uploads/servicios/$key/big/".$value;
							}else{
								$json['photo'][$key]['file'] = '';
							}
						}
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

	public function update($id_servicios, $name_servicios, $seo_servicios, $active_servicios, $photo_servicios, $id_lineas, $id_categorias, $id_subcategorias, $extra_servicios){
		global $db, $sesion;
		try{
			$sql = "UPDATE servicios SET name_servicios = :name_servicios, seo_servicios = :seo_servicios, active_servicios = :active_servicios, photo_servicios = :photo_servicios, id_lineas = :id_lineas, id_categorias = :id_categorias, id_subcategorias = :id_subcategorias, extra_servicios = :extra_servicios WHERE id_servicios = :id_servicios";
			$stmt = $db->prepare($sql);

			$stmt->bindParam(':id_servicios', $id_servicios, PDO::PARAM_STR);
			$stmt->bindParam(':name_servicios', $name_servicios, PDO::PARAM_STR);
			$stmt->bindParam(':seo_servicios', $seo_servicios, PDO::PARAM_STR);
			$stmt->bindParam(':active_servicios', $active_servicios, PDO::PARAM_STR);
			$stmt->bindParam(':photo_servicios', $photo_servicios, PDO::PARAM_STR);
			$stmt->bindParam(':extra_servicios', $extra_servicios, PDO::PARAM_STR);
			$stmt->bindParam(':id_lineas', $id_lineas, PDO::PARAM_STR);
			$stmt->bindParam(':id_categorias', $id_categorias, PDO::PARAM_STR);
			$stmt->bindParam(':id_subcategorias', $id_subcategorias, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function add($name_servicios, $seo_servicios, $active_servicios, $photo_servicios, $id_lineas, $id_categorias, $id_subcategorias, $extra_servicios){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM servicios WHERE name_servicios=:name_servicios AND eliminado_servicios = 0 ";
			$stmt = $db->prepare($sql);
			$stmt->execute(array(":name_servicios"=>$name_servicios));
			if($stmt->rowCount() > 0){
				return false;
			}else{
				$sql = "INSERT INTO servicios (name_servicios, seo_servicios, active_servicios, photo_servicios, id_lineas, id_categorias, id_subcategorias, extra_servicios) VALUES(:name_servicios, :seo_servicios, :active_servicios, :photo_servicios, :id_lineas, :id_categorias, :id_subcategorias, :extra_servicios)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':name_servicios', $name_servicios, PDO::PARAM_STR);
				$stmt->bindParam(':seo_servicios', $seo_servicios, PDO::PARAM_STR);
				$stmt->bindParam(':active_servicios', $active_servicios, PDO::PARAM_STR);
				$stmt->bindParam(':photo_servicios', $photo_servicios, PDO::PARAM_STR);
				$stmt->bindParam(':extra_servicios', $extra_servicios, PDO::PARAM_STR);
				$stmt->bindParam(':id_lineas', $id_lineas, PDO::PARAM_STR);
				$stmt->bindParam(':id_categorias', $id_categorias, PDO::PARAM_STR);
				$stmt->bindParam(':id_subcategorias', $id_subcategorias, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt;
			}
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function orden($id_servicios, $orden_servicios){
		global $db;
		try{
			$sql = "UPDATE servicios SET orden_servicios = :orden_servicios WHERE id_servicios = :id_servicios";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_servicios', $id_servicios, PDO::PARAM_STR);
			$stmt->bindParam(':orden_servicios', $orden_servicios, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_servicios){
		global $db, $sesion;

		$eliminado_servicios = date("Y-m-d h:i:s");

		$sql = "UPDATE servicios SET eliminado_servicios = :eliminado_servicios  WHERE id_servicios = :id_servicios";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id_servicios', $id_servicios, PDO::PARAM_STR);
		$stmt->bindParam(':eliminado_servicios', $eliminado_servicios, PDO::PARAM_STR);
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

	public function listado($pagination = 0, $limit = 10, $id_lineas = 0, $id_categorias = 0, $id_subcategorias = 0){
		global $db, $sesion;
		try{

			if($pagination == 0){
				$pagination = 1;
			}

			$offset = ($pagination - 1)*$limit . " , ";

			$row_count = $offset . $limit;

			$data = array();
			$sql = " SELECT * FROM servicios WHERE active_servicios = '1' AND eliminado_servicios = 0 ";

			if ($id_lineas > 0) {
				$sql .= " AND id_lineas = '".$id_lineas."' ";
			}

			if ($id_categorias > 0) {
				$sql .= " AND id_categorias = '".$id_categorias."' ";
			}

			if ($id_subcategorias > 0) {
				$sql .= " AND id_subcategorias = '".$id_subcategorias."' ";
			}

			$sql .= " ORDER BY id_servicios ASC, orden_servicios ASC, name_servicios ASC ";

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
					$json['id'] = $row->id_servicios;
					$json['name'] = $row->name_servicios;
					$json['seo'] = $row->seo_servicios;
					$json['extra'] = json_decode($row->extra_servicios, true);
					$photo_servicios = json_decode($row->photo_servicios, true);

					$json['photo'] = array();

					if (count($photo_servicios) > 0) {
						foreach ($photo_servicios as $key => $value) {

							// Key = "fondo"
							// Value = imagen.jpg

							$json['photo'][$key]['name'] = $value;

							$dir = _HOSTDIR_."/uploads/servicios/$key/big/".$value;
							$dir2 = _HOSTDIR_."/uploads/servicios/$key/small/".$value;

							if (file_exists($dir) && file_exists($dir2) && $value != "") {
								$json['photo'][$key]['file'] =_HOST_."/uploads/servicios/$key/big/".$value;
							}else{
								$json['photo'][$key]['file'] = '';
							}
						}
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

}

$servicios = new servicios();