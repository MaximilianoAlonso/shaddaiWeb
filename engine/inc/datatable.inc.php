<?php

class datatable {
	private $db;

	public function get($requestData=null, $table=null, $tablaid = null, $notable=null, $columns=null, $activo=null, $foto =null, $select = null, $form=null, $web = null, $limit = null,  $eliminado=null) {
		global $db, $sesion;
		try{
			$sql = "SELECT * ";
			$sql.=" FROM $table ";
			if($notable == true){
				$sql.=" WHERE $notable[0] != '".$notable[1]."' ";
			}
			if($select == true){
				$sql.=" WHERE $select[0] = '".$select[1]."' ";
			}
			if( !empty($requestData['search']['value']) ) {
				$search = $requestData['search']['value'];
				if($notable == true || $select == true){
					$sql.=" AND ( ";
				}else{
					$sql.=" WHERE ( ";
				}
				for ( $i=0 ; $i<count($columns) ; $i++ ) {
					if($i > 0) $sql .= " OR ";
					$col = (explode(",",$columns[$i]));
					if(@$col[1] == true){
						$sql .= "$col[0] LIKE '%".$search."%' ";
						$sql .= "OR $col[1] LIKE '%".$search."%' ";
					}else{
						$sql .= "$columns[$i] LIKE '%".$search."%' ";
					}

				}
				$sql .= ")";

			}
			if($limit == true){
				if(!empty($requestData['search']['value'])){
					$sql.=" AND ";
				}else{
					$sql.=" WHERE ";
				}
				$sql .= " $limit[0]  >= '".$limit[1]."' ";
			}
			if($eliminado == true){
				if(!empty($requestData['search']['value'])){
					$sql.=" AND ";
				}else{
					$sql.=" WHERE ";
				}
				$sql .= " $eliminado = 0 ";
			}
			$q = $db->prepare($sql);
			$q->execute();
			$totalData = $q->rowCount();
			$totalFiltered = $totalData;
			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
			$q = $db->prepare($sql);
			$q->execute();
			$data = array();

			while($row = $q->fetchObject()) {
				$nestedData=array();

				for ( $i=0 ; $i<count($columns) ; $i++ ) {
					$col = (explode(",",$columns[$i]));
					if(@$col[1] == true){
						$nestedData[] = $row->{$col[0]} . " " .$row->{$col[1]};
					}else{
						if(@$foto[1] == $columns[$i]){
							$dir = _HOSTDIR_.$foto[0].'/big/'.$row->{$columns[$i]};
							$dir2 = _HOSTDIR_.$foto[0].'/small/'.$row->{$columns[$i]};
							if (file_exists($dir) && file_exists($dir2)){
								$nestedData[] = '<img src="'._HOST_.$foto[0].'/small/'.$row->{$columns[$i]}.'" alt="'.$row->{$columns[$i]}.'" style="max-width: 150px;">';
							}else{
								$nestedData[] = '<img src="'._HOST_.'/uploads/no-disponible.jpg" alt="'.$row->{$columns[$i]}.'" style="max-width: 150px;" >';
							}
						}else{
							$nestedData[] = $row->{$columns[$i]};
						}

					}
				}
				if($activo == true){
					if($row->{$activo} == 0){ $act = '<span data-activo="activo"><span class="label label-danger">Desactivado</span></span>';}else{ $act = '<span class="label label-primary">Activo</span>';}
					$nestedData[] = $act;
				}

				$option = '<div class="ediccion ">';
				$option .= "<a href='".$web."/editar/".$row->{$tablaid[0]}."' class='badge badge-info' ><i class='fa fa-edit icon_size tip' title='Editar'></i> Editar</a>";
				$option .= "<a class='mup badge badge-danger' href='' data-target='#myModal' data-toggle='modal' data-id='".$row->{$tablaid[0]}."' data-name='".$row->{$tablaid[1]}."' ><i class='fa fa-times icon_size tip' title='Eliminar'></i> Eliminar</a>";
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


}

$datatable = new datatable();