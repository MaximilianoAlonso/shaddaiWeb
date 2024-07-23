<?php

class personalizados {
	private $db;

	public function tabla($requestData, $web){
		global $db, $sesion, $datatable;

		$sql = "SELECT * FROM personalizados ";
		if( !empty($requestData['search']['value']) ) {
			$search = $requestData['search']['value'];
			$sql.=" WHERE ( ";
			$sql .= " CONCAT(name_personalizados) LIKE '%".$search."%' ";
			$sql .= ") ";
		}
		$q = $db->prepare($sql);
		$q->execute();
		$totalData = $q->rowCount();
		$totalFiltered = $totalData;
		$sql.=" ORDER BY name_personalizados  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		$q = $db->prepare($sql);
		$q->execute();
		$data = array();

		while($row = $q->fetchObject()) {
			$nestedData=array();
			$nombre = $row->name_personalizados;
			$nestedData[] = $nombre;
			if($row->activo_personalizados == 0){  $act = '<span data-activo="activo"><span class="label label-danger">Desactivado</span></span>';}else{ $act = '<span class="label label-primary">Activo</span>';}
			$nestedData[] = $act;
			$option = '<div class="ediccion ">';
			$option .= "<a href='".$web."/editar/".$row->id_personalizados."' class='badge badge-info' ><i class='fa fa-edit icon_size tip' title='Editar'></i> Editar</a>";
			$option .= "<a class='mup badge badge-danger' href='' data-target='#myModal' data-toggle='modal' data-id='".$row->id_personalizados."' data-name='".$nombre."' ><i class='fa fa-times icon_size tip' title='Eliminar'></i> Eliminar</a>";
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


	public function edit($id_personalizados = null, $seo = null){
		global $db, $sesion;
		try{
			if($seo == null){
				$sql= "SELECT * FROM personalizados WHERE id_personalizados=:id_personalizados LIMIT 1";
			}else{
				$sql= "SELECT * FROM personalizados WHERE seo_personalizados=:id_personalizados LIMIT 1";
			}
			$q = $db->prepare($sql);
			$q->execute(array(":id_personalizados"=>$id_personalizados));
			if($q->rowCount() > 0){
				while($row = $q->fetchObject()) {
					$this->id_personalizados = $row->id_personalizados;
					$this->name_personalizados = $row->name_personalizados;
					$this->seo_personalizados = $row->seo_personalizados;
					$this->contenidos_personalizados = $row->contenidos_personalizados;
					$this->titulo_personalizados = $row->titulo_personalizados;
					$this->descripcion_personalizados = $row->descripcion_personalizados;
					$this->keywords_personalizados = $row->keywords_personalizados;
					$this->activo_personalizados = $row->activo_personalizados;
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



	public function update($id_personalizados, $name_personalizados, $seo_personalizados, $contenidos_personalizados, $titulo_personalizados, $descripcion_personalizados, $keywords_personalizados, $activo_personalizados){
		global $db;
		try{
			$sql = "UPDATE personalizados SET name_personalizados = :name_personalizados, seo_personalizados = :seo_personalizados, contenidos_personalizados = :contenidos_personalizados, titulo_personalizados = :titulo_personalizados, descripcion_personalizados = :descripcion_personalizados, keywords_personalizados = :keywords_personalizados, activo_personalizados = :activo_personalizados WHERE id_personalizados = :id_personalizados";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_personalizados', $id_personalizados, PDO::PARAM_STR);
			$stmt->bindParam(':name_personalizados', $name_personalizados, PDO::PARAM_STR);
			$stmt->bindParam(':seo_personalizados', $seo_personalizados, PDO::PARAM_STR);
			$stmt->bindParam(':contenidos_personalizados', $contenidos_personalizados, PDO::PARAM_STR);
			$stmt->bindParam(':titulo_personalizados', $titulo_personalizados, PDO::PARAM_STR);
			$stmt->bindParam(':descripcion_personalizados', $descripcion_personalizados, PDO::PARAM_STR);
			$stmt->bindParam(':keywords_personalizados', $keywords_personalizados, PDO::PARAM_STR);
			$stmt->bindParam(':activo_personalizados', $activo_personalizados, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}


	public function add($name_personalizados, $seo_personalizados, $contenidos_personalizados, $titulo_personalizados, $descripcion_personalizados, $keywords_personalizados, $activo_personalizados){
		global $db;
		try{
			$sql = "INSERT INTO personalizados (name_personalizados, seo_personalizados, contenidos_personalizados, titulo_personalizados, descripcion_personalizados, keywords_personalizados, activo_personalizados) VALUES(:name_personalizados, :seo_personalizados, :contenidos_personalizados, :titulo_personalizados, :descripcion_personalizados, :keywords_personalizados, :activo_personalizados)";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':name_personalizados', $name_personalizados, PDO::PARAM_STR);
			$stmt->bindParam(':seo_personalizados', $seo_personalizados, PDO::PARAM_STR);
			$stmt->bindParam(':contenidos_personalizados', $contenidos_personalizados, PDO::PARAM_STR);
			$stmt->bindParam(':titulo_personalizados', $titulo_personalizados, PDO::PARAM_STR);
			$stmt->bindParam(':descripcion_personalizados', $descripcion_personalizados, PDO::PARAM_STR);
			$stmt->bindParam(':keywords_personalizados', $keywords_personalizados, PDO::PARAM_STR);
			$stmt->bindParam(':activo_personalizados', $activo_personalizados, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function data(){
		global $db, $sesion;
		try{
			$data = array();
			$sql= "SELECT * FROM personalizados ";
			$q = $db->prepare($sql);
			$q->execute();
			if($q->rowCount() > 0){
				$i = 0;
				while($row = $q->fetchObject()) {
					$data[$i]['id'] = $row->id_personalizados;
					$data[$i]['name'] = $row->name_personalizados;
					$data[$i]['url'] = _HOST_ .'/'.$row->seo_personalizados;
					$data[$i]['seo'] = $row->seo_personalizados;
					$data[$i]['contenidos'] = $row->contenidos_personalizados;
					$data[$i]['titulo'] = $row->titulo_personalizados;
					$data[$i]['descripcion'] = $row->descripcion_personalizados;
					$data[$i]['keywords'] = $row->keywords_personalizados;
					$data[$i]['activo'] = $row->activo_personalizados;
					$i++;
				}
			}
			return $data;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function delete($id_personalizados){
		global $db, $sesion, $functions;

		$sql = "DELETE FROM personalizados WHERE id_personalizados = :id_personalizados";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id_personalizados', $id_personalizados, PDO::PARAM_STR);
		$stmt->execute();

		if(!$stmt){
			$return_data['type'] = 'error';
			$return_data['msje'] = 'Error al eliminar. Intente de nuevo.';
		}else{
			$return_data['type'] = 'success';
			$return_data['msje'] = 'Se ha eliminado correctamente.';;
		}

		echo json_encode($return_data);
		exit();

	}


}

$personalizados = new personalizados();