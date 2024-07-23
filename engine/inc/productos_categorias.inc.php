<?php

class productos_categorias {
	private $db;

	public function tabla($requestData, $web){
		global $db, $sesion;
		try{

			$cproductos = file_get_contents(_DATA_ . '/productos.json');
			$cproductos = json_decode($cproductos, true);

			$sql = " SELECT
			c.*,
			IFNULL(l.name_lineas, 'No disponible') as name_lineas
			FROM
			productos_categorias c
			LEFT JOIN (
			SELECT id_lineas, name_lineas
			FROM productos_lineas
			) l ON l.id_lineas = c.id_lineas
			WHERE
			c.eliminado_categorias = 0 ";
			if( !empty($requestData['search']['value']) ) {
				$search = $requestData['search']['value'];
				$sql.=" AND ( ";
				$sql .= " CONCAT(c.name_categorias) LIKE '%".$search."%' ";
				$sql .= " OR l.name_lineas LIKE '%".$search."%' ";
				$sql .= ") ";
			}
			$q = $db->prepare($sql);
			$q->execute();
			$totalData = $q->rowCount();
			$totalFiltered = $totalData;
			$sql.=" ORDER BY c.name_categorias  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
			$q = $db->prepare($sql);
			$q->execute();
			$data = array();

			while($row = $q->fetchObject()) {
				$nestedData=array();
				$nombre = $row->name_categorias;
				$nestedData[] = $nombre;
				if ($cproductos['view']['lineas'] == 1) {
					$nestedData[] = $row->name_lineas;
				}
				if($row->active_categorias == 0){  $act = '<span data-activo="activo"><span class="label label-danger">Desactivado</span></span>';}else{ $act = '<span class="label label-primary">Activo</span>';}
				$nestedData[] = $act;
				$option = '<div class="ediccion ">';
				$option .= "<a href='".$web."/editar/".$row->id_categorias."' class='badge badge-info' ><i class='fa fa-edit icon_size tip' title='Editar'></i> Editar</a>";
				$option .= "<a class='mup badge badge-danger' href='' data-target='#myModal' data-toggle='modal' data-id='".$row->id_categorias."' data-name='".$nombre."' ><i class='fa fa-times icon_size tip' title='Eliminar'></i> Eliminar</a>";
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


	public function edit($id_categorias){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM productos_categorias WHERE id_categorias=:id_categorias AND eliminado_categorias = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":id_categorias"=>$id_categorias));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->id_categorias = $row->id_categorias;
					$this->name_categorias = $row->name_categorias;
					$this->seo_categorias = $row->seo_categorias;
					$this->extra_categorias = json_decode($row->extra_categorias, true);
					$this->active_categorias = $row->active_categorias;

					$this->photo_categorias_name = $row->photo_categorias;
					$dir = _HOSTDIR_."/uploads/productos/categorias/big/".$row->photo_categorias;
					$dir2 = _HOSTDIR_."/uploads/productos/categorias/small/".$row->photo_categorias;
					if (file_exists($dir) && file_exists($dir2) && $row->photo_categorias != "") {
						$this->photo_categorias=_HOST_."/uploads/productos/categorias/small/".$row->photo_categorias;
					}else{
						$this->photo_categorias=_HOST_."/uploads/no-disponible.jpg";
					}

					$this->id_lineas = $row->id_lineas;

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

	public function view($seo_categorias){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM productos_categorias WHERE seo_categorias=:seo_categorias AND eliminado_categorias = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":seo_categorias"=>$seo_categorias));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->id_categorias = $row->id_categorias;
					$this->name_categorias = $row->name_categorias;
					$this->seo_categorias = $row->seo_categorias;
					$this->extra_categorias = json_decode($row->extra_categorias, true);
					$this->active_categorias = $row->active_categorias;

					$this->photo_categorias_name = $row->photo_categorias;
					$dir = _HOSTDIR_."/uploads/productos/categorias/big/".$row->photo_categorias;
					$dir2 = _HOSTDIR_."/uploads/productos/categorias/small/".$row->photo_categorias;
					if (file_exists($dir) && file_exists($dir2) && $row->photo_categorias != "") {
						$this->photo_categorias=_HOST_."/uploads/productos/categorias/big/".$row->photo_categorias;
						$this->photo_small_categorias=_HOST_."/uploads/productos/categorias/small/".$row->photo_categorias;
					}else{
						$this->photo_small_categorias=$this->photo_categorias=_HOST_."/uploads/no-disponible.jpg";
					}

					$this->id_lineas = $row->id_lineas;

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

	public function select($id_categorias = null, $id_lineas = -1){
		global $db;
		try{
			$data = '';
			$sql = " SELECT * FROM productos_categorias WHERE eliminado_categorias = 0 ";
			if ($id_lineas >= 0) {
				$sql .= " AND id_lineas = '".$id_lineas."' ";
			}
			$sql .= " ORDER BY orden_categorias ASC, name_categorias ASC ";
			$q = $db->prepare($sql);
			$q->execute();
			if($q->rowCount() > 0){
				$data .='<option value="0">No disponible</option>';
				$sel = '';
				while($row = $q->fetchObject()) {
					$id = $row->id_categorias;
					if($id_categorias == $id) $sel = "selected='selected' "; else $sel = "";
					$data .='<option '.$sel.' value="'.$row->id_categorias.'">'. $row->name_categorias.'</option>';
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
			$sql= "SELECT * FROM productos_categorias WHERE active_categorias = '1' AND eliminado_categorias = 0 ORDER BY orden_categorias ASC, name_categorias ASC ";
			$sql = $db->prepare($sql);
			$sql->execute();
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_categorias;
					$json['name'] = $row->name_categorias;
					$json['seo'] = $row->seo_categorias;
					$json['extra'] = json_decode($row->extra_categorias, true);
					$json['photo_name'] = $row->photo_categorias;

					$dir = _HOSTDIR_."/uploads/productos/categorias/big/".$row->photo_categorias;
					if (file_exists($dir)  && $row->photo_categorias != "") {
						$json['photo'] =_HOST_."/uploads/productos/categorias/big/".$row->photo_categorias;
					}else{
						$json['photo'] =_HOST_."/uploads/no-disponible.jpg";
					}

					$dir2 = _HOSTDIR_."/uploads/productos/categorias/small/".$row->photo_categorias;
					if (file_exists($dir2)  && $row->photo_categorias != "") {
						$json['photo_small'] =_HOST_."/uploads/productos/categorias/small/".$row->photo_categorias;
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

	public function update($id_categorias, $name_categorias, $seo_categorias, $active_categorias, $photo_categorias, $id_lineas, $extra_categorias){
		global $db, $sesion;
		try{
			$sql = "UPDATE productos_categorias SET name_categorias = :name_categorias, seo_categorias = :seo_categorias, active_categorias = :active_categorias, photo_categorias = :photo_categorias, id_lineas = :id_lineas, extra_categorias = :extra_categorias WHERE id_categorias = :id_categorias";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_categorias', $id_categorias, PDO::PARAM_STR);
			$stmt->bindParam(':name_categorias', $name_categorias, PDO::PARAM_STR);
			$stmt->bindParam(':seo_categorias', $seo_categorias, PDO::PARAM_STR);
			$stmt->bindParam(':active_categorias', $active_categorias, PDO::PARAM_STR);
			$stmt->bindParam(':photo_categorias', $photo_categorias, PDO::PARAM_STR);
			$stmt->bindParam(':extra_categorias', $extra_categorias, PDO::PARAM_STR);
			$stmt->bindParam(':id_lineas', $id_lineas, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function add($name_categorias, $seo_categorias, $active_categorias, $photo_categorias, $id_lineas, $extra_categorias){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM productos_categorias WHERE name_categorias=:name_categorias AND eliminado_categorias = 0 ";
			$stmt = $db->prepare($sql);
			$stmt->execute(array(":name_categorias"=>$name_categorias));
			if($stmt->rowCount() > 0){
				return false;
			}else{
				$sql = "INSERT INTO productos_categorias (name_categorias, seo_categorias, active_categorias, photo_categorias, id_lineas, extra_categorias) VALUES(:name_categorias, :seo_categorias, :active_categorias, :photo_categorias, :id_lineas, :extra_categorias)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':name_categorias', $name_categorias, PDO::PARAM_STR);
				$stmt->bindParam(':seo_categorias', $seo_categorias, PDO::PARAM_STR);
				$stmt->bindParam(':active_categorias', $active_categorias, PDO::PARAM_STR);
				$stmt->bindParam(':photo_categorias', $photo_categorias, PDO::PARAM_STR);
				$stmt->bindParam(':extra_categorias', $extra_categorias, PDO::PARAM_STR);
				$stmt->bindParam(':id_lineas', $id_lineas, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt;
			}
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function orden($id_categorias, $orden_categorias){
		global $db;
		try{
			$sql = "UPDATE productos_categorias SET orden_categorias = :orden_categorias WHERE id_categorias = :id_categorias";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_categorias', $id_categorias, PDO::PARAM_STR);
			$stmt->bindParam(':orden_categorias', $orden_categorias, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_categorias){
		global $db, $sesion;

		$eliminado_categorias = date("Y-m-d h:i:s");

		$sql = "UPDATE productos_categorias SET eliminado_categorias = :eliminado_categorias  WHERE id_categorias = :id_categorias";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id_categorias', $id_categorias, PDO::PARAM_STR);
		$stmt->bindParam(':eliminado_categorias', $eliminado_categorias, PDO::PARAM_STR);
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

$productos_categorias = new productos_categorias();