<?php

class eventos {
	private $db;

	public function tabla($requestData, $web){
		global $db, $sesion;
		try{

			$ceventos = file_get_contents(_DATA_ . '/eventos.json');
			$ceventos = json_decode($ceventos, true);

			$sql = " SELECT
			p.*,
			IFNULL(l.name_lineas, 'No disponible') as name_lineas,
			IFNULL(c.name_categorias, 'No disponible') as name_categorias,
			IFNULL(s.name_subcategorias, 'No disponible') as name_subcategorias
			FROM
			eventos p
			LEFT JOIN (
			SELECT id_lineas, name_lineas
			FROM eventos_lineas
			) l ON l.id_lineas = p.id_lineas
			LEFT JOIN (
			SELECT id_categorias, name_categorias
			FROM eventos_categorias
			) c ON c.id_categorias = p.id_categorias
			LEFT JOIN (
			SELECT id_subcategorias, name_subcategorias
			FROM eventos_subcategorias
			) s ON s.id_subcategorias = p.id_subcategorias
			WHERE
			p.eliminado_eventos = 0 ";
			if( !empty($requestData['search']['value']) ) {
				$search = $requestData['search']['value'];
				$sql.=" AND ( ";
				$sql .= " CONCAT(p.name_eventos) LIKE '%".$search."%' ";
				$sql .= " OR l.name_lineas LIKE '%".$search."%' ";
				$sql .= " OR c.name_categorias LIKE '%".$search."%' ";
				$sql .= " OR s.name_subcategorias LIKE '%".$search."%' ";
				$sql .= ") ";
			}
			$q = $db->prepare($sql);
			$q->execute();
			$totalData = $q->rowCount();
			$totalFiltered = $totalData;
			$sql.=" ORDER BY p.name_eventos  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
			$q = $db->prepare($sql);
			$q->execute();
			$data = array();

			while($row = $q->fetchObject()) {
				$nestedData=array();
				$nombre = $row->name_eventos;
				$nestedData[] = $nombre;
				if ($ceventos['view']['lineas'] == 1) {
					$nestedData[] = $row->name_lineas;
				}
				if ($ceventos['view']['categorias'] == 1) {
					$nestedData[] = $row->name_categorias;
				}
				if ($ceventos['view']['subcategorias'] == 1) {
					$nestedData[] = $row->name_subcategorias;
				}
				if($row->active_eventos == 0){  $act = '<span data-activo="activo"><span class="label label-danger">Desactivado</span></span>';}else{ $act = '<span class="label label-primary">Activo</span>';}
				$nestedData[] = $act;
				$option = '<div class="ediccion ">';
				$option .= "<a href='".$web."/editar/".$row->id_eventos."' class='badge badge-info' ><i class='fa fa-edit icon_size tip' title='Editar'></i> Editar</a>";
				if ($ceventos['view']['imagenes'] == 1) {
					$option .= "<a href='".$web."/imagenes/".$row->id_eventos."' class='badge badge-warning' ><i class='fa fa-picture-o icon_size tip' title='Editar'></i> Imagenes</a>";
				}
				$option .= "<a class='mup badge badge-danger' href='' data-target='#myModal' data-toggle='modal' data-id='".$row->id_eventos."' data-name='".$nombre."' ><i class='fa fa-times icon_size tip' title='Eliminar'></i> Eliminar</a>";
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


	public function edit($id_eventos){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM eventos WHERE id_eventos=:id_eventos AND eliminado_eventos = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":id_eventos"=>$id_eventos));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->id_eventos = $row->id_eventos;
					$this->name_eventos = $row->name_eventos;
					$this->seo_eventos = $row->seo_eventos;
					$this->extra_eventos = json_decode($row->extra_eventos, true);
					$this->active_eventos = $row->active_eventos;

					$this->photo_eventos_name = $row->photo_eventos;
					$dir = _HOSTDIR_."/uploads/eventos/big/".$row->photo_eventos;
					$dir2 = _HOSTDIR_."/uploads/eventos/small/".$row->photo_eventos;
					if (file_exists($dir) && file_exists($dir2) && $row->photo_eventos != "") {
						$this->photo_eventos=_HOST_."/uploads/eventos/small/".$row->photo_eventos;
					}else{
						$this->photo_eventos=_HOST_."/uploads/no-disponible.jpg";
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


	public function view($seo_eventos){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM eventos WHERE seo_eventos=:seo_eventos AND eliminado_eventos = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":seo_eventos"=>$seo_eventos));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->id_eventos = $row->id_eventos;
					$this->name_eventos = $row->name_eventos;
					$this->seo_eventos = $row->seo_eventos;
					$this->extra_eventos = json_decode($row->extra_eventos, true);
					$this->active_eventos = $row->active_eventos;

					$this->photo_eventos_name = $row->photo_eventos;
					$dir = _HOSTDIR_."/uploads/eventos/big/".$row->photo_eventos;
					$dir2 = _HOSTDIR_."/uploads/eventos/small/".$row->photo_eventos;
					if (file_exists($dir) && file_exists($dir2) && $row->photo_eventos != "") {
						$this->photo_eventos=_HOST_."/uploads/eventos/big/".$row->photo_eventos;
						$this->photo_small_eventos=_HOST_."/uploads/eventos/small/".$row->photo_eventos;
					}else{
						$this->photo_small_eventos = $this->photo_eventos=_HOST_."/uploads/no-disponible.jpg";
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

	public function select($id_eventos = null){
		global $db;
		try{
			$data = '';
			$q= "SELECT * FROM eventos WHERE eliminado_eventos = 0 ORDER BY orden_eventos ASC, name_eventos ASC";
			$q = $db->prepare($q);
			$q->execute();
			if($q->rowCount() > 0){
				$sel = '';
				while($row = $q->fetchObject()) {
					$id = $row->id_eventos;
					if($id_eventos == $id) $sel = "selected='selected' "; else $sel = "";
					$data .='<option '.$sel.' value="'.$row->id_eventos.'">'. $row->name_eventos.'</option>';
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
			$sql= "SELECT * FROM eventos WHERE active_eventos = '1' AND eliminado_eventos = 0 ORDER BY orden_eventos ASC, name_eventos ASC ";
			$sql = $db->prepare($sql);
			$sql->execute();
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_eventos;
					$json['name'] = $row->name_eventos;
					$json['seo'] = $row->seo_eventos;
					$json['extra'] = json_decode($row->extra_eventos, true);
					$json['photo_name'] = $row->photo_eventos;

					$dir = _HOSTDIR_."/uploads/eventos/big/".$row->photo_eventos;
					if (file_exists($dir)  && $row->photo_eventos != "") {
						$json['photo'] =_HOST_."/uploads/eventos/big/".$row->photo_eventos;
					}else{
						$json['photo'] =_HOST_."/uploads/no-disponible.jpg";
					}

					$dir2 = _HOSTDIR_."/uploads/eventos/small/".$row->photo_eventos;
					if (file_exists($dir2)  && $row->photo_eventos != "") {
						$json['photo_small'] =_HOST_."/uploads/eventos/small/".$row->photo_eventos;
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

	public function update($id_eventos, $name_eventos, $seo_eventos, $active_eventos, $photo_eventos, $id_lineas, $id_categorias, $id_subcategorias, $extra_eventos){
		global $db, $sesion;
		try{
			$sql = "UPDATE eventos SET name_eventos = :name_eventos, seo_eventos = :seo_eventos, active_eventos = :active_eventos, photo_eventos = :photo_eventos, id_lineas = :id_lineas, id_categorias = :id_categorias, id_subcategorias = :id_subcategorias, extra_eventos = :extra_eventos WHERE id_eventos = :id_eventos";
			$stmt = $db->prepare($sql);

			$stmt->bindParam(':id_eventos', $id_eventos, PDO::PARAM_STR);
			$stmt->bindParam(':name_eventos', $name_eventos, PDO::PARAM_STR);
			$stmt->bindParam(':seo_eventos', $seo_eventos, PDO::PARAM_STR);
			$stmt->bindParam(':active_eventos', $active_eventos, PDO::PARAM_STR);
			$stmt->bindParam(':photo_eventos', $photo_eventos, PDO::PARAM_STR);
			$stmt->bindParam(':extra_eventos', $extra_eventos, PDO::PARAM_STR);
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

	public function add($name_eventos, $active_eventos, $photo_eventos, $id_lineas, $id_categorias, $id_subcategorias, $extra_eventos){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM eventos WHERE name_eventos=:name_eventos AND eliminado_eventos = 0 ";
			$stmt = $db->prepare($sql);
			$stmt->execute(array(":name_eventos"=>$name_eventos));
			if($stmt->rowCount() > 0){
				return false;
			}else{
				$sql = "INSERT INTO eventos (name_eventos, seo_eventos, active_eventos, photo_eventos, id_lineas, id_categorias, id_subcategorias, extra_eventos) VALUES(:name_eventos, :seo_eventos, :active_eventos, :photo_eventos, :id_lineas, :id_categorias, :id_subcategorias, :extra_eventos)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':name_eventos', $name_eventos, PDO::PARAM_STR);
				$stmt->bindParam(':seo_eventos', $seo_eventos, PDO::PARAM_STR);
				$stmt->bindParam(':active_eventos', $active_eventos, PDO::PARAM_STR);
				$stmt->bindParam(':photo_eventos', $photo_eventos, PDO::PARAM_STR);
				$stmt->bindParam(':extra_eventos', $extra_eventos, PDO::PARAM_STR);
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

	public function orden($id_eventos, $orden_eventos){
		global $db;
		try{
			$sql = "UPDATE eventos SET orden_eventos = :orden_eventos WHERE id_eventos = :id_eventos";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_eventos', $id_eventos, PDO::PARAM_STR);
			$stmt->bindParam(':orden_eventos', $orden_eventos, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_eventos){
		global $db, $sesion;

		$eliminado_eventos = date("Y-m-d h:i:s");

		$sql = "UPDATE eventos SET eliminado_eventos = :eliminado_eventos  WHERE id_eventos = :id_eventos";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id_eventos', $id_eventos, PDO::PARAM_STR);
		$stmt->bindParam(':eliminado_eventos', $eliminado_eventos, PDO::PARAM_STR);
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

$eventos = new eventos();