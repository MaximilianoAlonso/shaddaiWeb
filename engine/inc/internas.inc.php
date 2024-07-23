<?php

class internas {
	private $db;


	public function edit($id_internas = null){
		global $db, $sesion;
		try{
			$sql= "SELECT * FROM internas WHERE id_internas=:id_internas LIMIT 1";
			$q = $db->prepare($sql);
			$q->execute(array(":id_internas"=>$id_internas));
			if($q->rowCount() > 0){
				while($row = $q->fetchObject()) {
					$this->id_internas = $row->id_internas;
					$this->name_internas = $row->name_internas;
					$this->extra_internas = json_decode($row->extra_internas, true);
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

	public function update($id_internas, $extra_internas){
		global $db;
		try{
			$sql = "UPDATE internas SET extra_internas = :extra_internas WHERE id_internas = :id_internas";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_internas', $id_internas, PDO::PARAM_STR);
			$stmt->bindParam(':extra_internas', $extra_internas, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

}

$internas = new internas();