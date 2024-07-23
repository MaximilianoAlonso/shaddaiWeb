<?php

class galeria {
	private $db;

	public function tabla($requestData, $web){
		global $db, $sesion;
		try{

			$cgaleria = file_get_contents(_DATA_ . '/galeria.json');
			$cgaleria = json_decode($cgaleria, true);

			$sql = " SELECT
			p.*,
			IFNULL(l.name_lineas, 'No disponible') as name_lineas,
			IFNULL(c.name_categorias, 'No disponible') as name_categorias,
			IFNULL(s.name_subcategorias, 'No disponible') as name_subcategorias
			FROM
			galeria p
			LEFT JOIN (
			SELECT id_lineas, name_lineas
			FROM galeria_lineas
			) l ON l.id_lineas = p.id_lineas
			LEFT JOIN (
			SELECT id_categorias, name_categorias
			FROM galeria_categorias
			) c ON c.id_categorias = p.id_categorias
			LEFT JOIN (
			SELECT id_subcategorias, name_subcategorias
			FROM galeria_subcategorias
			) s ON s.id_subcategorias = p.id_subcategorias
			WHERE
			p.eliminado_galeria = 0 ";
			if( !empty($requestData['search']['value']) ) {
				$search = $requestData['search']['value'];
				$sql.=" AND ( ";
				$sql .= " CONCAT(p.name_galeria) LIKE '%".$search."%' ";
				$sql .= " OR l.name_lineas LIKE '%".$search."%' ";
				$sql .= " OR c.name_categorias LIKE '%".$search."%' ";
				$sql .= " OR s.name_subcategorias LIKE '%".$search."%' ";
				$sql .= ") ";
			}
			$q = $db->prepare($sql);
			$q->execute();
			$totalData = $q->rowCount();
			$totalFiltered = $totalData;
			$sql.=" ORDER BY p.name_galeria  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
			$q = $db->prepare($sql);
			$q->execute();
			$data = array();

			while($row = $q->fetchObject()) {
				$nestedData=array();
				$nombre = $row->name_galeria;
				$nestedData[] = $nombre;
				if ($cgaleria['view']['lineas'] == 1) {
					$nestedData[] = $row->name_lineas;
				}
				if ($cgaleria['view']['categorias'] == 1) {
					$nestedData[] = $row->name_categorias;
				}
				if ($cgaleria['view']['subcategorias'] == 1) {
					$nestedData[] = $row->name_subcategorias;
				}
				if($row->active_galeria == 0){  $act = '<span data-activo="activo"><span class="label label-danger">Desactivado</span></span>';}else{ $act = '<span class="label label-primary">Activo</span>';}
				$nestedData[] = $act;
				$option = '<div class="ediccion ">';
				$option .= "<a href='".$web."/editar/".$row->id_galeria."' class='badge badge-info' ><i class='fa fa-edit icon_size tip' title='Editar'></i> Editar</a>";
				if ($cgaleria['view']['imagenes'] == 1) {
					$option .= "<a href='".$web."/imagenes/".$row->id_galeria."' class='badge badge-warning' ><i class='fa fa-picture-o icon_size tip' title='Editar'></i> Imagenes</a>";
				}
				$option .= "<a class='mup badge badge-danger' href='' data-target='#myModal' data-toggle='modal' data-id='".$row->id_galeria."' data-name='".$nombre."' ><i class='fa fa-times icon_size tip' title='Eliminar'></i> Eliminar</a>";
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


	public function edit($id_galeria){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM galeria WHERE id_galeria=:id_galeria AND eliminado_galeria = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":id_galeria"=>$id_galeria));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->id_galeria = $row->id_galeria;
					$this->name_galeria = $row->name_galeria;
					$this->seo_galeria = $row->seo_galeria;
					$this->extra_galeria = json_decode($row->extra_galeria, true);
					$this->active_galeria = $row->active_galeria;

					$this->photo_galeria_name = $row->photo_galeria;
					$dir = _HOSTDIR_."/uploads/galeria/big/".$row->photo_galeria;
					$dir2 = _HOSTDIR_."/uploads/galeria/small/".$row->photo_galeria;
					if (file_exists($dir) && file_exists($dir2) && $row->photo_galeria != "") {
						$this->photo_galeria=_HOST_."/uploads/galeria/small/".$row->photo_galeria;
					}else{
						$this->photo_galeria=_HOST_."/uploads/no-disponible.jpg";
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

	public function view($seo_galeria){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM galeria WHERE seo_galeria=:seo_galeria AND eliminado_galeria = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":seo_galeria"=>$seo_galeria));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->id_galeria = $row->id_galeria;
					$this->name_galeria = $row->name_galeria;
					$this->seo_galeria = $row->seo_galeria;
					$this->extra_galeria = json_decode($row->extra_galeria, true);
					$this->active_galeria = $row->active_galeria;

					$this->photo_galeria_name = $row->photo_galeria;
					$dir = _HOSTDIR_."/uploads/galeria/big/".$row->photo_galeria;
					$dir2 = _HOSTDIR_."/uploads/galeria/small/".$row->photo_galeria;
					if (file_exists($dir) && file_exists($dir2) && $row->photo_galeria != "") {
						$this->photo_galeria=_HOST_."/uploads/galeria/big/".$row->photo_galeria;
						$this->photo_small_galeria=_HOST_."/uploads/galeria/small/".$row->photo_galeria;
					}else{
						$this->photo_small_galeria=$this->photo_galeria=_HOST_."/uploads/no-disponible.jpg";
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

	public function select($id_galeria = null){
		global $db;
		try{
			$data = '';
			$q= "SELECT * FROM galeria WHERE eliminado_galeria = 0 ORDER BY orden_galeria ASC, name_galeria ASC ";
			$q = $db->prepare($q);
			$q->execute();
			if($q->rowCount() > 0){
				$sel = '';
				while($row = $q->fetchObject()) {
					$id = $row->id_galeria;
					if($id_galeria == $id) $sel = "selected='selected' "; else $sel = "";
					$data .='<option '.$sel.' value="'.$row->id_galeria.'">'. $row->name_galeria.'</option>';
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
		global $db, $sesion;
		try{
			$data = array();
			$sql= "SELECT * FROM galeria WHERE active_galeria = '1' AND eliminado_galeria = 0 ORDER BY orden_galeria ASC, name_galeria ASC ";
			$sql = $db->prepare($sql);
			$sql->execute();
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_galeria;
					$json['name'] = $row->name_galeria;
					$json['seo'] = $row->seo_galeria;
					$json['extra'] = json_decode($row->extra_galeria, true);
					$json['photo_name'] = $row->photo_galeria;

					$dir = _HOSTDIR_."/uploads/galeria/big/".$row->photo_galeria;
					if (file_exists($dir)  && $row->photo_galeria != "") {
						$json['photo'] =_HOST_."/uploads/galeria/big/".$row->photo_galeria;
					}else{
						$json['photo'] =_HOST_."/uploads/no-disponible.jpg";
					}

					$dir2 = _HOSTDIR_."/uploads/galeria/small/".$row->photo_galeria;
					if (file_exists($dir2)  && $row->photo_galeria != "") {
						$json['photo_small'] =_HOST_."/uploads/galeria/small/".$row->photo_galeria;
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

	public function listado($pagination = 0, $limit = 10){
		global $db, $sesion;
		try{

			if($pagination == 0){
				$pagination = 1;
			}

			$offset = ($pagination - 1)*$limit . " , ";

			$row_count = $offset . $limit;

			$data = array();
			$sql= "SELECT * FROM galeria WHERE active_galeria = '1' AND eliminado_galeria = 0 ORDER BY orden_galeria ASC, name_galeria ASC ";

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
					$json['id'] = $row->id_galeria;
					$json['name'] = $row->name_galeria;
					$json['seo'] = $row->seo_galeria;
					$json['extra'] = json_decode($row->extra_galeria, true);
					$json['photo_name'] = $row->photo_galeria;

					$dir = _HOSTDIR_."/uploads/galeria/big/".$row->photo_galeria;
					if (file_exists($dir)  && $row->photo_galeria != "") {
						$json['photo'] =_HOST_."/uploads/galeria/big/".$row->photo_galeria;
					}else{
						$json['photo'] =_HOST_."/uploads/no-disponible.jpg";
					}

					$dir2 = _HOSTDIR_."/uploads/galeria/small/".$row->photo_galeria;
					if (file_exists($dir2)  && $row->photo_galeria != "") {
						$json['photo_small'] =_HOST_."/uploads/galeria/small/".$row->photo_galeria;
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

	public function update($id_galeria, $name_galeria, $seo_galeria, $active_galeria, $photo_galeria, $id_lineas, $id_categorias, $id_subcategorias, $extra_galeria){
		global $db, $sesion;
		try{
			$sql = "UPDATE galeria SET name_galeria = :name_galeria, seo_galeria = :seo_galeria, active_galeria = :active_galeria, photo_galeria = :photo_galeria, id_lineas = :id_lineas, id_categorias = :id_categorias, id_subcategorias = :id_subcategorias, extra_galeria = :extra_galeria WHERE id_galeria = :id_galeria";
			$stmt = $db->prepare($sql);

			$stmt->bindParam(':id_galeria', $id_galeria, PDO::PARAM_STR);
			$stmt->bindParam(':name_galeria', $name_galeria, PDO::PARAM_STR);
			$stmt->bindParam(':seo_galeria', $seo_galeria, PDO::PARAM_STR);
			$stmt->bindParam(':active_galeria', $active_galeria, PDO::PARAM_STR);
			$stmt->bindParam(':photo_galeria', $photo_galeria, PDO::PARAM_STR);
			$stmt->bindParam(':extra_galeria', $extra_galeria, PDO::PARAM_STR);
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

	public function add($name_galeria, $seo_galeria, $active_galeria, $photo_galeria, $id_lineas, $id_categorias, $id_subcategorias, $extra_galeria){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM galeria WHERE name_galeria=:name_galeria AND eliminado_galeria = 0 ";
			$stmt = $db->prepare($sql);
			$stmt->execute(array(":name_galeria"=>$name_galeria));
			if($stmt->rowCount() > 0){
				return false;
			}else{
				$sql = "INSERT INTO galeria (name_galeria, seo_galeria, active_galeria, photo_galeria, id_lineas, id_categorias, id_subcategorias, extra_galeria) VALUES(:name_galeria, :seo_galeria, :active_galeria, :photo_galeria, :id_lineas, :id_categorias, :id_subcategorias, :extra_galeria)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':name_galeria', $name_galeria, PDO::PARAM_STR);
				$stmt->bindParam(':seo_galeria', $seo_galeria, PDO::PARAM_STR);
				$stmt->bindParam(':active_galeria', $active_galeria, PDO::PARAM_STR);
				$stmt->bindParam(':photo_galeria', $photo_galeria, PDO::PARAM_STR);
				$stmt->bindParam(':extra_galeria', $extra_galeria, PDO::PARAM_STR);
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

	public function orden($id_galeria, $orden_galeria){
		global $db;
		try{
			$sql = "UPDATE galeria SET orden_galeria = :orden_galeria WHERE id_galeria = :id_galeria";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_galeria', $id_galeria, PDO::PARAM_STR);
			$stmt->bindParam(':orden_galeria', $orden_galeria, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_galeria){
		global $db, $sesion;

		$eliminado_galeria = date("Y-m-d h:i:s");

		$sql = "UPDATE galeria SET eliminado_galeria = :eliminado_galeria  WHERE id_galeria = :id_galeria";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id_galeria', $id_galeria, PDO::PARAM_STR);
		$stmt->bindParam(':eliminado_galeria', $eliminado_galeria, PDO::PARAM_STR);
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

$galeria = new galeria();