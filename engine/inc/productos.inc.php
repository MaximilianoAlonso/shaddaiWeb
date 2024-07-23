<?php

class productos {
	private $db;

	public function tabla($requestData, $web){
		global $db, $sesion;
		try{

			$cproductos = file_get_contents(_DATA_ . '/productos.json');
			$cproductos = json_decode($cproductos, true);

			$sql = " SELECT
			p.*,
			IFNULL(l.name_lineas, 'No disponible') as name_lineas,
			IFNULL(c.name_categorias, 'No disponible') as name_categorias,
			IFNULL(s.name_subcategorias, 'No disponible') as name_subcategorias
			FROM
			productos p
			LEFT JOIN (
			SELECT id_lineas, name_lineas
			FROM productos_lineas
			) l ON l.id_lineas = p.id_lineas
			LEFT JOIN (
			SELECT id_categorias, name_categorias
			FROM productos_categorias
			) c ON c.id_categorias = p.id_categorias
			LEFT JOIN (
			SELECT id_subcategorias, name_subcategorias
			FROM productos_subcategorias
			) s ON s.id_subcategorias = p.id_subcategorias
			WHERE
			p.eliminado_productos = 0 ";
			if( !empty($requestData['search']['value']) ) {
				$search = $requestData['search']['value'];
				$sql.=" AND ( ";
				$sql .= " CONCAT(p.name_productos) LIKE '%".$search."%' ";
				$sql .= " OR l.name_lineas LIKE '%".$search."%' ";
				$sql .= " OR c.name_categorias LIKE '%".$search."%' ";
				$sql .= " OR s.name_subcategorias LIKE '%".$search."%' ";
				$sql .= ") ";
			}
			$q = $db->prepare($sql);
			$q->execute();
			$totalData = $q->rowCount();
			$totalFiltered = $totalData;
			$sql.=" ORDER BY p.name_productos  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
			$q = $db->prepare($sql);
			$q->execute();
			$data = array();

			while($row = $q->fetchObject()) {
				$nestedData=array();
				$nombre = $row->name_productos;
				$nestedData[] = $nombre;
				if ($cproductos['view']['lineas'] == 1) {
					$nestedData[] = $row->name_lineas;
				}
				if ($cproductos['view']['categorias'] == 1) {
					$nestedData[] = $row->name_categorias;
				}
				if ($cproductos['view']['subcategorias'] == 1) {
					$nestedData[] = $row->name_subcategorias;
				}
				if($row->active_productos == 0){  $act = '<span data-activo="activo"><span class="label label-danger">Desactivado</span></span>';}else{ $act = '<span class="label label-primary">Activo</span>';}
				$nestedData[] = $act;
				$option = '<div class="ediccion ">';
				$option .= "<a href='".$web."/editar/".$row->id_productos."' class='badge badge-info' ><i class='fa fa-edit icon_size tip' title='Editar'></i> Editar</a>";
				if ($cproductos['view']['imagenes'] == 1) {
					$option .= "<a href='".$web."/imagenes/".$row->id_productos."' class='badge badge-warning' ><i class='fa fa-picture-o icon_size tip' title='Editar'></i> Imagenes</a>";
				}
				$option .= "<a class='mup badge badge-danger' href='' data-target='#myModal' data-toggle='modal' data-id='".$row->id_productos."' data-name='".$nombre."' ><i class='fa fa-times icon_size tip' title='Eliminar'></i> Eliminar</a>";
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


	public function edit($id_productos){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM productos WHERE id_productos=:id_productos AND eliminado_productos = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":id_productos"=>$id_productos));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->id_productos = $row->id_productos;
					$this->name_productos = $row->name_productos;
					$this->seo_productos = $row->seo_productos;
					$this->extra_productos = json_decode($row->extra_productos, true);
					$this->active_productos = $row->active_productos;

					$this->photo_productos_name = $row->photo_productos;
					$dir = _HOSTDIR_."/uploads/productos/big/".$row->photo_productos;
					$dir2 = _HOSTDIR_."/uploads/productos/small/".$row->photo_productos;
					if (file_exists($dir) && file_exists($dir2) && $row->photo_productos != "") {
						$this->photo_productos=_HOST_."/uploads/productos/small/".$row->photo_productos;
					}else{
						$this->photo_productos=_HOST_."/uploads/no-disponible.jpg";
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

	public function view($seo_productos){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM productos WHERE seo_productos=:seo_productos AND eliminado_productos = 0 ";
			$sql = $db->prepare($sql);
			$sql->execute(array(":seo_productos"=>$seo_productos));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$this->id_productos = $row->id_productos;
					$this->name_productos = $row->name_productos;
					$this->seo_productos = $row->seo_productos;
					$this->extra_productos = json_decode($row->extra_productos, true);
					$this->active_productos = $row->active_productos;

					$this->photo_productos_name = $row->photo_productos;
					$dir = _HOSTDIR_."/uploads/productos/big/".$row->photo_productos;
					$dir2 = _HOSTDIR_."/uploads/productos/small/".$row->photo_productos;
					if (file_exists($dir) && file_exists($dir2) && $row->photo_productos != "") {
						$this->photo_productos=_HOST_."/uploads/productos/big/".$row->photo_productos;
						$this->photo_small_productos=_HOST_."/uploads/productos/small/".$row->photo_productos;
					}else{
						$this->photo_small_productos=$this->photo_productos=_HOST_."/uploads/no-disponible.jpg";
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

	public function select($id_productos = null){
		global $db;
		try{
			$data = '';
			$q= "SELECT * FROM productos WHERE eliminado_productos = 0 ORDER BY orden_productos ASC, name_productos ASC ";
			$q = $db->prepare($q);
			$q->execute();
			if($q->rowCount() > 0){
				$sel = '';
				while($row = $q->fetchObject()) {
					$id = $row->id_productos;
					if($id_productos == $id) $sel = "selected='selected' "; else $sel = "";
					$data .='<option '.$sel.' value="'.$row->id_productos.'">'. $row->name_productos.'</option>';
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
			$sql= "SELECT * FROM productos WHERE active_productos = '1' AND eliminado_productos = 0 ORDER BY orden_productos ASC, name_productos ASC ";
			$sql = $db->prepare($sql);
			$sql->execute();
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_productos;
					$json['name'] = $row->name_productos;
					$json['seo'] = $row->seo_productos;
					$json['extra'] = json_decode($row->extra_productos, true);
					$json['photo_name'] = $row->photo_productos;

					$dir = _HOSTDIR_."/uploads/productos/big/".$row->photo_productos;
					if (file_exists($dir)  && $row->photo_productos != "") {
						$json['photo'] =_HOST_."/uploads/productos/big/".$row->photo_productos;
					}else{
						$json['photo'] =_HOST_."/uploads/no-disponible.jpg";
					}

					$dir2 = _HOSTDIR_."/uploads/productos/small/".$row->photo_productos;
					if (file_exists($dir2)  && $row->photo_productos != "") {
						$json['photo_small'] =_HOST_."/uploads/productos/small/".$row->photo_productos;
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

	public function search($name = '', $limit = 10){
		global $db, $sesion;
		try{
			$data = array();
			$sql = " SELECT * FROM productos WHERE active_productos = '1' AND eliminado_productos = 0  AND name_productos LIKE :name ORDER BY orden_productos ASC, name_productos ASC LIMIT $limit ";
			$sql = $db->prepare($sql);
			$sql->execute(array(':name' => '%'.$name.'%'));
			if($sql->rowCount() > 0){
				while($row = $sql->fetchObject()) {
					$json = array();
					$json['id'] = $row->id_productos;
					$json['name'] = $row->name_productos;
					$json['seo'] = $row->seo_productos;
					$json['extra'] = json_decode($row->extra_productos, true);
					$json['photo_name'] = $row->photo_productos;

					$dir = _HOSTDIR_."/uploads/productos/big/".$row->photo_productos;
					if (file_exists($dir)  && $row->photo_productos != "") {
						$json['photo'] =_HOST_."/uploads/productos/big/".$row->photo_productos;
					}else{
						$json['photo'] =_HOST_."/uploads/no-disponible.jpg";
					}

					$dir2 = _HOSTDIR_."/uploads/productos/small/".$row->photo_productos;
					if (file_exists($dir2)  && $row->photo_productos != "") {
						$json['photo_small'] =_HOST_."/uploads/productos/small/".$row->photo_productos;
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

	public function update($id_productos, $name_productos, $seo_productos, $active_productos, $photo_productos, $id_lineas, $id_categorias, $id_subcategorias, $extra_productos){
		global $db, $sesion;
		try{
			$sql = "UPDATE productos SET name_productos = :name_productos, seo_productos = :seo_productos, active_productos = :active_productos, photo_productos = :photo_productos, id_lineas = :id_lineas, id_categorias = :id_categorias, id_subcategorias = :id_subcategorias, extra_productos = :extra_productos WHERE id_productos = :id_productos";
			$stmt = $db->prepare($sql);

			$stmt->bindParam(':id_productos', $id_productos, PDO::PARAM_STR);
			$stmt->bindParam(':name_productos', $name_productos, PDO::PARAM_STR);
			$stmt->bindParam(':seo_productos', $seo_productos, PDO::PARAM_STR);
			$stmt->bindParam(':active_productos', $active_productos, PDO::PARAM_STR);
			$stmt->bindParam(':photo_productos', $photo_productos, PDO::PARAM_STR);
			$stmt->bindParam(':extra_productos', $extra_productos, PDO::PARAM_STR);
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

	public function add($name_productos, $seo_productos, $active_productos, $photo_productos, $id_lineas, $id_categorias, $id_subcategorias, $extra_productos){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM productos WHERE name_productos=:name_productos AND eliminado_productos = 0 ";
			$stmt = $db->prepare($sql);
			$stmt->execute(array(":name_productos"=>$name_productos));
			if($stmt->rowCount() > 0){
				return false;
			}else{
				$sql = "INSERT INTO productos (name_productos, seo_productos, active_productos, photo_productos, id_lineas, id_categorias, id_subcategorias, extra_productos) VALUES(:name_productos, :seo_productos, :active_productos, :photo_productos, :id_lineas, :id_categorias, :id_subcategorias, :extra_productos)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':name_productos', $name_productos, PDO::PARAM_STR);
				$stmt->bindParam(':seo_productos', $seo_productos, PDO::PARAM_STR);
				$stmt->bindParam(':active_productos', $active_productos, PDO::PARAM_STR);
				$stmt->bindParam(':photo_productos', $photo_productos, PDO::PARAM_STR);
				$stmt->bindParam(':extra_productos', $extra_productos, PDO::PARAM_STR);
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

	public function orden($id_productos, $orden_productos){
		global $db;
		try{
			$sql = "UPDATE productos SET orden_productos = :orden_productos WHERE id_productos = :id_productos";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_productos', $id_productos, PDO::PARAM_STR);
			$stmt->bindParam(':orden_productos', $orden_productos, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_productos){
		global $db, $sesion;

		$eliminado_productos = date("Y-m-d h:i:s");

		$sql = "UPDATE productos SET eliminado_productos = :eliminado_productos  WHERE id_productos = :id_productos";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id_productos', $id_productos, PDO::PARAM_STR);
		$stmt->bindParam(':eliminado_productos', $eliminado_productos, PDO::PARAM_STR);
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

$productos = new productos();