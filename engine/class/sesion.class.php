<?php

class sesion {

	private $db, $config;

	function __construct()
	{
		global $db, $config;
		$this->db = $db;
		$this->config = $config;
	}


	public function login($uname,$uemail,$upass)
	{
		try
		{
			$stmt = $this->db->prepare("SELECT u.*, w.* FROM users u, workers w WHERE u.worker_dni = w.worker_dni AND u.username=:uname OR w.email=:uemail  LIMIT 1");
			$stmt->execute(array(':uname'=>$uname, ':uemail'=>$uemail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

			if($stmt->rowCount() > 0)
			{

				if(password_verify($upass, $userRow['password']))
				{
					$_SESSION['user_session'] = $userRow['username'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function logout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}

}

$sesion = new sesion();

$user_id = null;

if(isset($_SESSION['user_session'])){
	$user_id  = $_SESSION['user_session'];
}