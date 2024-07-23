<?php

class servicios_subcategorias {
	private $db;

	public function tabla($requestData, $web){
		global $db, $sesion;
		try{

			$cservicios = file_get_contents(_DATA_ . '/servicios.json');
			$cservicios = json_decode($cservicios, true);

			$sql = " SELECT
			s.*,
			IFNULL(c.name_categorias, 'No disponible') as name_categorias
			FROM
			servicios_subcategorias s
			LEFT JOIN (
			SELECT id_categorias, name_categorias
			FROM servicios_categorias
			) c ON c.id_categorias = c.id_categorias
			WHERE
			s.eliminado_subcategorias = 0 ";
			if( !empty($requestData['search']['value']) ) {
				$search = $requestData['search']['value'];
				$sql.=" AND ( ";
				$sql .= " CONCAT(s.name_subcategorias) LIKE '%".$search."%' ";
				$sql .= " OR c.name_categorias LIKE '%".$search."%' ";
				$sql .= ") ";
			}
			$q = $db->prepare($sql);
			$q->execute();
			$totalData = $q->rowCount();
			$totalFiltered = $totalData;
			$sql.=" ORDER BY s.name_subcategorias  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
			$q = $db->prepare($sql);
			$q->execute();
			$data = array();

			while($row = $q->fetchObject()) {
				$nestedData=array();
				$nombre = $row->name_subcategorias;
				$nestedData[] = $nombre;
				if ($cservicios['view']['categorias'] == 1) {
					$nestedData[] = $row->name_categorias;
				}
				if($row->active_subcategorias == 0){  $act = '<span data-activo="activo"><span class="label label-danger">Desactivado</span></span>';}else{ $act = '<span class="label label-primary">Activo</span>';}
				$nestedData[] = $act;
				$option = '<div class="ediccion ">';
				$option .= "<a href='".$web."/editar/".$row->id_subcategorias."' class='badge badge-info' ><i class='fa fa-edit icon_size tip' title='Editar'></i> Editar</a>";
				$option .= "<a class='mup badge badge-danger' href='' data-target='#myModal' data-toggle='modal' data-id='".$row->id_subcategorias."' data-name='".$nombre."' ><i class='fa fa-times icon_size tip' title='Eliminar'></i> Eliminar</a>";
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


	public function edit($id_subcategorias){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM servicios_subcategorias WHERE id_subcategorias=:id_subcategorias AND eliminado_subcategorias = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":id_subcategorias"=>$id_subcategorias));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->id_subcategorias = $row->id_subcategorias;
					$this->name_subcategorias = $row->name_subcategorias;
					$this->seo_subcategorias = $row->seo_subcategorias;
					$this->extra_subcategorias = json_decode($row->extra_subcategorias, true);
					$this->active_subcategorias = $row->active_subcategorias;

					$this->photo_subcategorias_name = $row->photo_subcategorias;
					$dir = _HOSTDIR_."/uploads/servicios/categorias/big/".$row->photo_subcategorias;
					$dir2 = _HOSTDIR_."/uploads/servicios/categorias/small/".$row->photo_subcategorias;
					if (file_exists($dir) && file_exists($dir2) && $row->photo_subcategorias != "") {
						$this->photo_subcategorias=_HOST_."/uploads/servicios/categorias/small/".$row->photo_subcategorias;
					}else{
						$this->photo_subcategorias=_HOST_."/uploads/no-disponible.jpg";
					}

					$this->id_categorias = $row->id_categorias;

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

	public function view($seo_subcategorias){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM servicios_subcategorias WHERE seo_subcategorias=:seo_subcategorias AND eliminado_subcategorias = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":seo_subcategorias"=>$seo_subcategorias));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->id_subcategorias = $row->id_subcategorias;
					$this->name_subcategorias = $row->name_subcategorias;
					$this->seo_subcategorias = $row->seo_subcategorias;
					$this->extra_subcategorias = json_decode($row->extra_subcategorias, true);
					$this->active_subcategorias = $row->active_subcategorias;

					$this->photo_subcategorias_name = $row->photo_subcategorias;
					$dir = _HOSTDIR_."/uploads/servicios/categorias/big/".$row->photo_subcategorias;
					$dir2 = _HOSTDIR_."/uploads/servicios/categorias/small/".$row->photo_subcategorias;
					if (file_exists($dir) && file_exists($dir2) && $row->photo_subcategorias != "") {
						$this->photo_subcategorias=_HOST_."/uploads/servicios/categorias/big/".$row->photo_subcategorias;
						$this->photo_small_subcategorias=_HOST_."/uploads/servicios/categorias/small/".$row->photo_subcategorias;
					}else{
						$this->photo_small_subcategorias= $this->photo_subcategorias=_HOST_."/uploads/no-disponible.jpg";
					}

					$this->id_categorias = $row->id_categorias;

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

	public function select($id_subcategorias = null, $id_categorias = -1){
		global $db;
		try{
			$data = '';
			$sql = " SELECT * FROM servicios_subcategorias WHERE eliminado_subcategorias = 0 ";
			if ($id_categorias >= 0) {
				$sql .= " AND id_categorias = '".$id_categorias."' ";
			}
			$sql .= " ORDER BY orden_subcategorias ASC, name_subcategorias ASC ";
			$q = $db->prepare($sql);
			$q->execute();
			if($q->rowCount() > 0){
				$data .='<option value="0">No disponible</option>';
				$sel = '';
				while($row = $q->fetchObject()) {
					$id = $row->id_subcategorias;
					if($id_subcategorias == $id) $sel = "selected='selected' "; else $sel = "";
					$data .='<option '.$sel.' value="'.$row->id_subcategorias.'">'. $row->name_subcategorias.'</option>';
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
			$sql= "SELECT * FROM servicios_subcategorias WHERE active_subcategorias = '1' AND eliminado_subcategorias = 0 ORDER BY orden_subcategorias ASC, name_subcategorias ASC ";
			$sql = $db->prepare($sql);
			$sql->execute();
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_subcategorias;
					$json['name'] = $row->name_subcategorias;
					$json['seo'] = $row->seo_subcategorias;
					$json['extra'] = json_decode($row->extra_subcategorias, true);
					$json['photo_name'] = $row->photo_subcategorias;

					$dir = _HOSTDIR_."/uploads/servicios/categorias/big/".$row->photo_subcategorias;
					if (file_exists($dir)  && $row->photo_subcategorias != "") {
						$json['photo'] =_HOST_."/uploads/servicios/categorias/big/".$row->photo_subcategorias;
					}else{
						$json['photo'] =_HOST_."/uploads/no-disponible.jpg";
					}

					$dir2 = _HOSTDIR_."/uploads/servicios/categorias/small/".$row->photo_subcategorias;
					if (file_exists($dir2)  && $row->photo_subcategorias != "") {
						$json['photo_small'] =_HOST_."/uploads/servicios/categorias/small/".$row->photo_subcategorias;
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

	public function update($id_subcategorias, $name_subcategorias, $seo_subcategorias, $active_subcategorias, $photo_subcategorias, $id_categorias, $extra_subcategorias){
		global $db, $sesion;
		try{
			$sql = "UPDATE servicios_subcategorias SET name_subcategorias = :name_subcategorias, seo_subcategorias = :seo_subcategorias, active_subcategorias = :active_subcategorias, photo_subcategorias = :photo_subcategorias, id_categorias = :id_categorias, extra_subcategorias = :extra_subcategorias WHERE id_subcategorias = :id_subcategorias";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_subcategorias', $id_subcategorias, PDO::PARAM_STR);
			$stmt->bindParam(':name_subcategorias', $name_subcategorias, PDO::PARAM_STR);
			$stmt->bindParam(':seo_subcategorias', $seo_subcategorias, PDO::PARAM_STR);
			$stmt->bindParam(':active_subcategorias', $active_subcategorias, PDO::PARAM_STR);
			$stmt->bindParam(':photo_subcategorias', $photo_subcategorias, PDO::PARAM_STR);
			$stmt->bindParam(':extra_subcategorias', $extra_subcategorias, PDO::PARAM_STR);
			$stmt->bindParam(':id_categorias', $id_categorias, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function add($name_subcategorias, $seo_subcategorias, $active_subcategorias, $photo_subcategorias, $id_categorias, $extra_subcategorias){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM servicios_subcategorias WHERE name_subcategorias=:name_subcategorias AND eliminado_subcategorias = 0 ";
			$stmt = $db->prepare($sql);
			$stmt->execute(array(":name_subcategorias"=>$name_subcategorias));
			if($stmt->rowCount() > 0){
				return false;
			}else{
				$sql = "INSERT INTO servicios_subcategorias (name_subcategorias, seo_subcategorias, active_subcategorias, photo_subcategorias, id_categorias, extra_subcategorias) VALUES(:name_subcategorias, :seo_subcategorias, :active_subcategorias, :photo_subcategorias, :id_categorias, :extra_subcategorias)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':name_subcategorias', $name_subcategorias, PDO::PARAM_STR);
				$stmt->bindParam(':seo_subcategorias', $seo_subcategorias, PDO::PARAM_STR);
				$stmt->bindParam(':active_subcategorias', $active_subcategorias, PDO::PARAM_STR);
				$stmt->bindParam(':photo_subcategorias', $photo_subcategorias, PDO::PARAM_STR);
				$stmt->bindParam(':extra_subcategorias', $extra_subcategorias, PDO::PARAM_STR);
				$stmt->bindParam(':id_categorias', $id_categorias, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt;
			}
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function orden($id_subcategorias, $orden_subcategorias){
		global $db;
		try{
			$sql = "UPDATE servicios_subcategorias SET orden_subcategorias = :orden_subcategorias WHERE id_subcategorias = :id_subcategorias";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_subcategorias', $id_subcategorias, PDO::PARAM_STR);
			$stmt->bindParam(':orden_subcategorias', $orden_subcategorias, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_subcategorias){
		global $db, $sesion;

		$eliminado_subcategorias = date("Y-m-d h:i:s");

		$sql = "UPDATE servicios_subcategorias SET eliminado_subcategorias = :eliminado_subcategorias  WHERE id_subcategorias = :id_subcategorias";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id_subcategorias', $id_subcategorias, PDO::PARAM_STR);
		$stmt->bindParam(':eliminado_subcategorias', $eliminado_subcategorias, PDO::PARAM_STR);
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

$servicios_subcategorias = new servicios_subcategorias();