<?php

class cursos {
	private $db;

	public function tabla($requestData, $web){
		global $db, $sesion;
		try{

			$ccursos = file_get_contents(_DATA_ . '/cursos.json');
			$ccursos = json_decode($ccursos, true);

			$sql = " SELECT
			p.*,
			IFNULL(l.name_lineas, 'No disponible') as name_lineas,
			IFNULL(c.name_categorias, 'No disponible') as name_categorias,
			IFNULL(s.name_subcategorias, 'No disponible') as name_subcategorias
			FROM
			cursos p
			LEFT JOIN (
			SELECT id_lineas, name_lineas
			FROM cursos_lineas
			) l ON l.id_lineas = p.id_lineas
			LEFT JOIN (
			SELECT id_categorias, name_categorias
			FROM cursos_categorias
			) c ON c.id_categorias = p.id_categorias
			LEFT JOIN (
			SELECT id_subcategorias, name_subcategorias
			FROM cursos_subcategorias
			) s ON s.id_subcategorias = p.id_subcategorias
			WHERE
			p.eliminado_cursos = 0 ";
			if( !empty($requestData['search']['value']) ) {
				$search = $requestData['search']['value'];
				$sql.=" AND ( ";
				$sql .= " CONCAT(p.name_cursos) LIKE '%".$search."%' ";
				$sql .= " OR l.name_lineas LIKE '%".$search."%' ";
				$sql .= " OR c.name_categorias LIKE '%".$search."%' ";
				$sql .= " OR s.name_subcategorias LIKE '%".$search."%' ";
				$sql .= ") ";
			}
			$q = $db->prepare($sql);
			$q->execute();
			$totalData = $q->rowCount();
			$totalFiltered = $totalData;
			$sql.=" ORDER BY p.name_cursos  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
			$q = $db->prepare($sql);
			$q->execute();
			$data = array();

			while($row = $q->fetchObject()) {
				$nestedData=array();
				$nombre = $row->name_cursos;
				$nestedData[] = $nombre;
				if ($ccursos['view']['lineas'] == 1) {
					$nestedData[] = $row->name_lineas;
				}
				if ($ccursos['view']['categorias'] == 1) {
					$nestedData[] = $row->name_categorias;
				}
				if ($ccursos['view']['subcategorias'] == 1) {
					$nestedData[] = $row->name_subcategorias;
				}
				if($row->active_cursos == 0){  $act = '<span data-activo="activo"><span class="label label-danger">Desactivado</span></span>';}else{ $act = '<span class="label label-primary">Activo</span>';}
				$nestedData[] = $act;
				$option = '<div class="ediccion ">';
				$option .= "<a href='".$web."/editar/".$row->id_cursos."' class='badge badge-info' ><i class='fa fa-edit icon_size tip' title='Editar'></i> Editar</a>";
				if ($ccursos['view']['imagenes'] == 1) {
					$option .= "<a href='".$web."/imagenes/".$row->id_cursos."' class='badge badge-warning' ><i class='fa fa-picture-o icon_size tip' title='Editar'></i> Imagenes</a>";
				}
				$option .= "<a class='mup badge badge-danger' href='' data-target='#myModal' data-toggle='modal' data-id='".$row->id_cursos."' data-name='".$nombre."' ><i class='fa fa-times icon_size tip' title='Eliminar'></i> Eliminar</a>";
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


	public function edit($id_cursos){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM cursos WHERE id_cursos=:id_cursos AND eliminado_cursos = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":id_cursos"=>$id_cursos));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->id_cursos = $row->id_cursos;
					$this->name_cursos = $row->name_cursos;
					$this->seo_cursos = $row->seo_cursos;
					$this->extra_cursos = json_decode($row->extra_cursos, true);
					$this->active_cursos = $row->active_cursos;

					$photo_cursos = json_decode($row->photo_cursos, true);

					$this->photo_cursos = array();

					if (count($photo_cursos) > 0) {
						foreach ($photo_cursos as $key => $value) {

							// Key = "fondo"
							// Value = imagen.jpg

							$this->photo_cursos[$key]['name'] = $value;

							$dir = _HOSTDIR_."/uploads/cursos/$key/big/".$value;
							$dir2 = _HOSTDIR_."/uploads/cursos/$key/small/".$value;

							if (file_exists($dir) && file_exists($dir2) && $value != "") {
								$this->photo_cursos[$key]['file'] =_HOST_."/uploads/cursos/$key/big/".$value;
							}else{
								$this->photo_cursos[$key]['file'] =_HOST_."/uploads/no-disponible.jpg";
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

	public function view($seo_cursos){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM cursos WHERE seo_cursos=:seo_cursos AND eliminado_cursos = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":seo_cursos"=>$seo_cursos));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->id_cursos = $row->id_cursos;
					$this->name_cursos = $row->name_cursos;
					$this->seo_cursos = $row->seo_cursos;
					$this->extra_cursos = json_decode($row->extra_cursos, true);
					$this->active_cursos = $row->active_cursos;

					$photo_cursos = json_decode($row->photo_cursos, true);

					$this->photo_cursos = array();

					if (count($photo_cursos) > 0) {
						foreach ($photo_cursos as $key => $value) {

							// Key = "fondo"
							// Value = imagen.jpg

							$this->photo_cursos[$key]['name'] = $value;

							$dir = _HOSTDIR_."/uploads/cursos/$key/big/".$value;
							$dir2 = _HOSTDIR_."/uploads/cursos/$key/small/".$value;

							if (file_exists($dir) && file_exists($dir2) && $value != "") {
								$this->photo_cursos[$key]['file'] =_HOST_."/uploads/cursos/$key/big/".$value;
							}else{
								$this->photo_cursos[$key]['file'] = "";
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

	public function select($id_cursos = null){
		global $db;
		try{
			$data = '';
			$q= "SELECT * FROM cursos WHERE eliminado_cursos = 0 ORDER BY orden_cursos ASC, name_cursos ASC ";
			$q = $db->prepare($q);
			$q->execute();
			if($q->rowCount() > 0){
				$sel = '';
				while($row = $q->fetchObject()) {
					$id = $row->id_cursos;
					if($id_cursos == $id) $sel = "selected='selected' "; else $sel = "";
					$data .='<option '.$sel.' value="'.$row->id_cursos.'">'. $row->name_cursos.'</option>';
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

	public function data($id_categorias = -1, $id_cursos = -1 , $limit = -1 ){
		global $db, $sesion;
		try{
			$data = array();
			$sql= "SELECT * FROM cursos WHERE active_cursos = '1' AND eliminado_cursos = 0  ";
			if ($id_cursos > 0) {
				$sql .= " AND id_cursos != '".$id_cursos."' ";
			}

			if ($id_categorias > 0) {
				$sql .= " AND id_categorias = '".$id_categorias."' ";
			}
			
			if ($limit > 0) {
				$sql .= " ORDER BY RAND() LIMIT $limit ";
			}else{
				$sql .= " ORDER BY orden_cursos ASC, name_cursos ASC ";
			}
			$sql = $db->prepare($sql);
			$sql->execute();
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_cursos;
					$json['name'] = $row->name_cursos;
					$json['seo'] = $row->seo_cursos;
					$json['extra'] = json_decode($row->extra_cursos, true);
					
					$photo_cursos = json_decode($row->photo_cursos, true);

					$json['photo'] = array();

					if (count($photo_cursos) > 0) {
						foreach ($photo_cursos as $key => $value) {

							// Key = "fondo"
							// Value = imagen.jpg

							$json['photo'][$key]['name'] = $value;

							$dir = _HOSTDIR_."/uploads/cursos/$key/big/".$value;
							$dir2 = _HOSTDIR_."/uploads/cursos/$key/small/".$value;

							if (file_exists($dir) && file_exists($dir2) && $value != "") {
								$json['photo'][$key]['file'] =_HOST_."/uploads/cursos/$key/big/".$value;
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
			$sql = " SELECT * FROM cursos WHERE active_cursos = '1' AND eliminado_cursos = 0  AND name_cursos LIKE :name ORDER BY orden_cursos ASC, name_cursos ASC LIMIT $limit ";
			$sql = $db->prepare($sql);
			$sql->execute(array(':name' => '%'.$name.'%'));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_cursos;
					$json['name'] = $row->name_cursos;
					$json['seo'] = $row->seo_cursos;
					$json['extra'] = json_decode($row->extra_cursos, true);
					$photo_cursos = json_decode($row->photo_cursos, true);

					$json['photo'] = array();

					if (count($photo_cursos) > 0) {
						foreach ($photo_cursos as $key => $value) {

							// Key = "fondo"
							// Value = imagen.jpg

							$json['photo'][$key]['name'] = $value;

							$dir = _HOSTDIR_."/uploads/cursos/$key/big/".$value;
							$dir2 = _HOSTDIR_."/uploads/cursos/$key/small/".$value;

							if (file_exists($dir) && file_exists($dir2) && $value != "") {
								$json['photo'][$key]['file'] =_HOST_."/uploads/cursos/$key/big/".$value;
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

	public function update($id_cursos, $name_cursos, $seo_cursos, $active_cursos, $photo_cursos, $id_lineas, $id_categorias, $id_subcategorias, $extra_cursos){
		global $db, $sesion;
		try{
			$sql = "UPDATE cursos SET name_cursos = :name_cursos, seo_cursos = :seo_cursos, active_cursos = :active_cursos, photo_cursos = :photo_cursos, id_lineas = :id_lineas, id_categorias = :id_categorias, id_subcategorias = :id_subcategorias, extra_cursos = :extra_cursos WHERE id_cursos = :id_cursos";
			$stmt = $db->prepare($sql);

			$stmt->bindParam(':id_cursos', $id_cursos, PDO::PARAM_STR);
			$stmt->bindParam(':name_cursos', $name_cursos, PDO::PARAM_STR);
			$stmt->bindParam(':seo_cursos', $seo_cursos, PDO::PARAM_STR);
			$stmt->bindParam(':active_cursos', $active_cursos, PDO::PARAM_STR);
			$stmt->bindParam(':photo_cursos', $photo_cursos, PDO::PARAM_STR);
			$stmt->bindParam(':extra_cursos', $extra_cursos, PDO::PARAM_STR);
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

	public function add($name_cursos, $seo_cursos, $active_cursos, $photo_cursos, $id_lineas, $id_categorias, $id_subcategorias, $extra_cursos){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM cursos WHERE name_cursos=:name_cursos AND eliminado_cursos = 0 ";
			$stmt = $db->prepare($sql);
			$stmt->execute(array(":name_cursos"=>$name_cursos));
			if($stmt->rowCount() > 0){
				return false;
			}else{
				$sql = "INSERT INTO cursos (name_cursos, seo_cursos, active_cursos, photo_cursos, id_lineas, id_categorias, id_subcategorias, extra_cursos) VALUES(:name_cursos, :seo_cursos, :active_cursos, :photo_cursos, :id_lineas, :id_categorias, :id_subcategorias, :extra_cursos)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':name_cursos', $name_cursos, PDO::PARAM_STR);
				$stmt->bindParam(':seo_cursos', $seo_cursos, PDO::PARAM_STR);
				$stmt->bindParam(':active_cursos', $active_cursos, PDO::PARAM_STR);
				$stmt->bindParam(':photo_cursos', $photo_cursos, PDO::PARAM_STR);
				$stmt->bindParam(':extra_cursos', $extra_cursos, PDO::PARAM_STR);
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

	public function orden($id_cursos, $orden_cursos){
		global $db;
		try{
			$sql = "UPDATE cursos SET orden_cursos = :orden_cursos WHERE id_cursos = :id_cursos";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_cursos', $id_cursos, PDO::PARAM_STR);
			$stmt->bindParam(':orden_cursos', $orden_cursos, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_cursos){
		global $db, $sesion;

		$eliminado_cursos = date("Y-m-d h:i:s");

		$sql = "UPDATE cursos SET eliminado_cursos = :eliminado_cursos  WHERE id_cursos = :id_cursos";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id_cursos', $id_cursos, PDO::PARAM_STR);
		$stmt->bindParam(':eliminado_cursos', $eliminado_cursos, PDO::PARAM_STR);
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

$cursos = new cursos();