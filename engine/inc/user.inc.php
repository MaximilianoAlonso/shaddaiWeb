<?php

class user {
	private $db;


	public function __construct($user_id){
		global $db, $sesion;
		try
		{
			$sql= "SELECT u.*, w.*, a.* FROM users u, workers w, areas a WHERE u.worker_dni = w.worker_dni AND w.id_area = a.id_area AND u.username=:user_id";
			$q = $db->prepare($sql);
			$q->execute(array(":user_id"=>$user_id));
			if($q->rowCount() > 0){
				while($row = $q->fetchObject()) {
					$this -> username = $row->username;
					$imag=$row->worker_dni.".jpg";
					$dir = _HOSTDIR_."/uploads/workers/".$row->worker_dni . ".jpg";
					if (file_exists($dir) && $row->worker_dni . ".jpg" != "") {
						$this->file=_HOST_."/uploads/workers/".$row->worker_dni . ".jpg";
					}else{
						$this->file=_HOST_."/uploads/workers/no-disponible.jpg";
					}
					$this -> userlevel = $row->userlevel;
					$this -> worker_dni = $row->worker_dni;
					$name= explode(" ",trim($row->name));
					$this -> name_ = $name[0];
					$this -> name= $row->name;
					$apel=explode(" ",trim($row->lastname));
					$this -> lastname_= $apel[0];
					$this -> lastname= $row->lastname;
					$this -> email = $row->email;
					$this -> id_area = $row->id_area;
					$this -> active = $row->active;
					$this -> cellphone = $row->cellphone;
					$this -> licencia = $row->licencia;
					$this -> vehiculo = $row->vehiculo;
					$this -> address = $row->address;
					$this -> name_area = $row->name_area;
					$this ->pass = json_decode($row->pass);
					if($this -> active == 0){
						$sesion->redirect(_HOST_."/admin/salir");
					}

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

	public function update($worker_dni, $username, $name, $lastname , $id_area, $email, $cellphone, $vehiculo, $licencia, $address, $password){
		global $db , $trabajadores;

		try{
			if($password != ""){
				$hash = password_hash($password, PASSWORD_DEFAULT);
				$sql = "UPDATE users SET password = :hash WHERE username = :username";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':username', $username, PDO::PARAM_STR);
				$stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
				$stmt->execute();
			}

			if($trabajadores->update($worker_dni, $name, $lastname, $id_area, $email, $cellphone, $vehiculo, $licencia, $address)){
				return true;
			}else{
				return false;
			}

		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}

}

$user = new user($user_id);

?>