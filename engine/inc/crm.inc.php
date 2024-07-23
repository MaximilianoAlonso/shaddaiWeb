<?php


class crm{

	public function datos($data){
		global $analytics, $es_movil, $functions, $mailing;

		$array = array();
		$array['intereses'] = (isset($data['intereses'])) ? trim($data['intereses']) : '';
		$array['name'] = (isset($data['name'])) ? trim($data['name']) : '';
		$array['lastname'] = (isset($data['lastname'])) ? trim($data['lastname']) : '';
		$array['email'] = (isset($data['email'])) ? trim($data['email']) : '';
		$array['estatus'] = 1;

		$array['website'] = 'IBO';
		$array['url'] = (isset($data['url'])) ? trim($data['url']) : '';
		$array['phone'] = (isset($data['phone'])) ? trim($data['phone']) : '';


		$array['medios'] = 1; //website

		if ($es_movil > 0) {
			$array['medios'] = 2; //movil
		}

		$array['fuentes'] = 1;

		$array['analytics'] = (isset($analytics)) ? trim($analytics) : '';
		$array['message'] = (isset($data['message'])) ? htmlspecialchars($data['message'], ENT_QUOTES) : '';
		$array['reserva_text'] = (isset($data['reserva_text'])) ? trim($data['reserva_text']) : '';
		$array['reserva'] = (isset($data['reserva'])) ? trim($data['reserva']) : '0000-00-00';
		$array['date'] = date("Y-m-d H:i:s");
		$array['ip'] = (isset($_SERVER["REMOTE_ADDR"])) ? $_SERVER["REMOTE_ADDR"] : '127.0.0.1';

		$array['agente'] = (isset($_SERVER["HTTP_USER_AGENT"])) ? $_SERVER["HTTP_USER_AGENT"] : '';


		$array['token'] = bin2hex(random_bytes(64));
		$array['tracker'] = 0;
		$array['lang'] = $array['lang'] =  (isset($data['lang'])) ? trim($data['lang']) : 'es';
		$array['referencia'] = (isset($data['referencia'])) ? trim($data['referencia']) : '';

		if(preg_match('/google/', $array['url'])  || isset($_COOKIE['fuente'])  || isset($_SESSION['fuente']) ){
			$array['fuentes'] = 2;
		}

		if(preg_match('/facebook/', $array['url']) || preg_match('/facebook/', $array['referencia'])){
			$array['fuentes'] = 3;
		}

		require_once _ENGINE_ . '/class/dbip-client.class.php';
		$array['country'] = countryCode($array['ip']);
		if ($array['country'] == "ZZ") $array['country'] = "PE";

		$array['horario'] = (isset($data['horario'])) ? trim($data['horario']) : '';

		$array['detalles'] = $mailing->contactenos($data);

		return $array;
	}



	public function FiltroSpam($mensaje) {

		$filtro_mensaje = $mensaje;
		$patron = array(
			0 => "href",
			1 => "http",
			2 => "html"
		);
		$detectado = 0;

		for ($i = 0; $i < count($patron); $i++) {
			if (strpos($filtro_mensaje, $patron[$i]) !== false) {
				$detectado++;
			}
		}

		if ($detectado > 0) {
			return true;
		}

		return false;
	}

	public function FiltroCountry($country) {
		$blacklist = array("RU", "AL");
		if (in_array($country, $blacklist)) {
			return true;
		}
		return false;
	}


	public function add($data){

		try{

			$array = $this->datos($data);

			if ($this->FiltroSpam($array['message'])) {
				return false;
			}

			if ($this->FiltroCountry($array['country'])) {
				return false;
			}

			$ch = curl_init();
	        // definimos la URL a la que hacemos la petición
			curl_setopt($ch, CURLOPT_URL,"");
	        // indicamos el tipo de petición: POST
			curl_setopt($ch, CURLOPT_POST, TRUE);
	        // definimos cada uno de los parámetros

			curl_setopt($ch, CURLOPT_POSTFIELDS, $array);

	        // recibimos la respuesta y la guardamos en una variable
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$remote_server_output = curl_exec ($ch);
	        // cerramos la sesión cURL
			curl_close ($ch);

			return true;

		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}

$crm = new crm();