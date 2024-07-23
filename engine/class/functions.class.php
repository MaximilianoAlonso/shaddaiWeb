<?php

class functions {
	private $db;

	public function search_require($carpeta){
		$data = array();
		if(is_dir($carpeta)){
			if($dir = opendir($carpeta)){
				while(($archivo = readdir($dir)) !== false){
					$valid_formats = array("php");
					if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
						$ext = explode(".", $archivo);
						$extension = end($ext);
						if (in_array($extension, $valid_formats)) {
							$data[]  = $carpeta.'/'.$archivo;
						}else{
							$data = array_merge($data, $this->search_require($carpeta.'/'.$archivo));
						}
					}
				}
				closedir($dir);
			}
		}
		return $data;
	}


	function page_title($html) {
		$fp = $html;
		if (!$fp)
			return null;
		$res = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
		if (!$res)
			return null;
		$title = preg_replace('/\s+/', ' ', $title_matches[1]);
		$title = trim($title);
		return $title;
	}
	public function sanear_string($string)
	{
		$string = trim($string);
		$string = str_replace(
			array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
			array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
			$string
		);

		$string = str_replace(
			array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
			array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
			$string
		);

		$string = str_replace(
			array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
			array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
			$string
		);

		$string = str_replace(
			array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
			array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
			$string
		);

		$string = str_replace(
			array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
			array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
			$string
		);

		$string = str_replace(
			array('ñ', 'Ñ', 'ç', 'Ç'),
			array('n', 'N', 'c', 'C',),
			$string
		);
		$string = str_replace(
			array("\\", "¨", "º", "-", "~",
				"#", "@", "|", "!", "\"",
				"·", "$", "%", "&", "/",
				"(", ")", "?", "'", "¡",
				"¿", "[", "^", "`", "]",
				"+", "}", "{", "¨", "´",
				">", "< ", ";", ",", ":",
				".","–","°","`","®","´", '"', "'", "‘", "’", '”', '“'),
			'',
			$string
		);
		return $string;
	}

	public function fecha_hora($fecha = null){
		$date = new DateTime($fecha);
		$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		return $date->format('d')." de ".strtolower($meses[$date->format('n')-1]). " del ".$date->format('Y'). " a las " .$date->format('h:i');
	}

	public function saltos($texto){
		$texto = preg_replace("[\n|\r|\n\r]", "", $texto);
		return $texto;
	}

	public function redirect($url){
		header("Location: $url");
		exit();
	}

	public function r301($url){
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: $url");
		exit();
	}

	public function seo($name=null){
		$string =  $this->sanear_string($name);
		$espacio= array('    ','   ','  ', ' ');
		$seo=strtolower(str_replace($espacio, "-", $string));
		return $seo;
	}

	public function displayOption($actual = null){
		$data = '';
		$s = "selected='selected'";
		$o=$t="";
		if(isset($actual)){
			if($actual==1){$o=$s;}else{$t=$s;}
		}
		$data .= "<option $o value='1'>SI</option>";
		$data .= "<option $t value='0'>NO</option>";
		return $data;
	}

	public function salto($texto){
		$texto = str_replace(array("\r\n", "\r", "\n"), "<br />",trim($texto));
		return $texto;
	}
	public function textarea_encode($texto){
		$texto = str_replace("\n", "<br />",htmlentities(trim($texto)));
		return $texto;
	}
	public function textarea_decode($texto){
		$texto = str_replace("<br />", "\n", html_entity_decode(trim($texto)));
		return $texto;
	}

	function displayNiveles($userlevel = null){
		global $db;
		$q = "SELECT * FROM userlevel WHERE userlevel!=1 ORDER BY userlevel ASC";
		$q = $db->prepare($q);
		$q->execute();
		if($q->rowCount() > 0){
			$sel = '';
			while($row = $q->fetchObject()) {
				$id = $row->userlevel;
				if($userlevel == $id) $sel = "selected='selected' "; else $sel = "";
				echo '<option '.$sel.' value="'.$row->userlevel.'">'. $row->u_nombre.'</option>';
			}
		}else{
			echo '<option>No disponible</option>';
		}

	}


	public function mes($fecha = null){
		$date = new DateTime($fecha);
		$meses = array("ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC");
		return $date->format('d')." ".$meses[$date->format('n')-1];
	}
	public function mes_ano($fecha = null){
		$date = new DateTime($fecha);
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		return $meses[$date->format('n')-1] .' '. $date->format('Y');
	}

	public function mes_data($fecha = null){
		$data = array();
		$date = new DateTime($fecha);
		$meses = array("ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC");
		$data['day'] = $date->format('d');
		$data['month'] = $meses[$date->format('n')-1];
		return $data;
	}

	public function horario($fecha = null){
		$date = new DateTime($fecha);
		$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		return $dias[$date->format('w')].", ".$date->format('d'). " de ".$meses[$date->format('n')-1] ;
	}

	public function horario_corto($fecha = null){
		$date = new DateTime($fecha);
		return $date->format('d') ."/".$date->format('m') . "/" .$date->format('Y') ;
	}

	public function imagen($fotos, $max, $nuevo, $path, $antigua){

		global $ModifiedImage;

		try{
			$valid_formats = array("jpg", "jpeg", "png", "gif", "ico");

			$name = $fotos['name'];
			$size = $fotos['size'];

			if(strlen($name)){
				$name = strtolower($name);
				$ext = explode(".", $name);
				$extension = end($ext);

				//validar formato
				if (in_array($extension, $valid_formats)) {
					//maximo 5MB
					if ($size<((1024*1024)*5)) {
						if($max == null){
							if(!move_uploaded_file($fotos['tmp_name'], $path . $nuevo)) {
								$this->msje = 'No se pudo subir la imagen';
								return false;
							}
						}else{
							if(count($max) > 0){
								foreach ($max as $key => $value) {
									$image = new ModifiedImage($fotos['tmp_name']);
									//convertir tamaño
									if($image->getWidth()){
										$image->resizeToWidth($value['size']);
										$image->save($path .$value['path']. $nuevo);
									}else{
										$this->msje = 'No se pudo subir la imagen y tampoco no se pude convertir el tamaño demasidado';
										return false;
									}
								}
							}else{
								$this->msje = 'Error en array [MAX]';
								return false;
							}
						}
					}else{
						$this->msje = 'La imagen es muy pesada';
						return false;
					}
				}

				//limpiar cache
				clearstatcache();

				$dir = $path . $nuevo;
				//verificar si el nuevo existe
				if (file_exists($dir)) {
					if($nuevo != $antigua &&  $antigua != ""){
						//verificar si la antigua existe
						if (file_exists($path . $antigua)) {
							//eliminar antigua
							unlink($path .$antigua);
						}
					}
				}

			}
			return true;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}


	public function locale($fecha = null){
		$date = new DateTime($fecha);
		$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		return $date->format('d')." de ".$meses[$date->format('n')-1]. " del ".$date->format('Y') ;
	}


	public function clearHtmlCode($data) {
		$data = filter_var($data, FILTER_SANITIZE_STRING);
		$data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
		$data = strip_tags($data);
		try {
			$data = str_replace( array('<','>',"'",'"',')','('), array('&lt;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $data );
			$data = str_ireplace( '%3Cscript', '', $data );
		} catch (Exception $e) {}
		return $data;
	}

	function tiempo_transcurrido($fecha) {
		if(empty($fecha)) {
			return "No hay fecha";
		}

		$intervalos = array("segundo", "minuto", "hora", "día", "semana", "mes", "año");
		$duraciones = array("60","60","24","7","4.35","12");

		$ahora = time();
		$Fecha_Unix = strtotime($fecha);

		if(empty($Fecha_Unix)) {   
			return "Fecha incorracta";
		}
		if($ahora > $Fecha_Unix) {   
			$diferencia     =$ahora - $Fecha_Unix;
			$tiempo         = "Hace";
		} else {
			$diferencia     = $Fecha_Unix -$ahora;
			$tiempo         = "Dentro de";
		}
		for($j = 0; $diferencia >= $duraciones[$j] && $j < count($duraciones)-1; $j++) {
			$diferencia /= $duraciones[$j];
		}

		$diferencia = round($diferencia);

		if($diferencia != 1) {
			$intervalos[5].="e";
			$intervalos[$j].= "s";
		}

		return "$tiempo $diferencia $intervalos[$j]";
	}

	function the_excerpt_max_charlength($excerpt, $charlength) {
		$charlength++;
		$data = '';
		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex = mb_substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				$data .= mb_substr( $subex, 0, $excut );
			} else {
				$data .= $subex;
			}
			$data .= '...';
		} else {
			$data .= $excerpt;
		}
		return $data;
	}

	public function website($website){
		if($website != ""){
			if  ( $ret = parse_url($website) ) {
				if ( !isset($ret["scheme"]) )
				{
					$website = "http://{$website}";
				}
			}
		}
		return $website;
	}

	function hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return $rgb;

	}

	function json($text) {
		$text = json_decode($text, true);
		return $text;

	}

	function base64_url_encode($input) {
		return strtr(base64_encode($input), '+/=', '-_$');
	}

	function base64_url_decode($input) {
		return base64_decode(strtr($input, '-_$', '+/='));
	}

	public function theme($id = '', $carpeta = ''){
		global $config;
		try{
			$data = '';
			$directorio = _VIEWS_.'/frondend/'.$carpeta;
			$direct = opendir($directorio);
			if(isset($direct)){
				$i = 0;
				while ($archivo = readdir($direct)){

					if (!is_file($archivo)){
						$filePath = $archivo;
						if ($filePath!="." && $filePath!=".."){
							if($archivo == $id) $sel = "selected='selected' "; else $sel = "";
							$data .= '<option '.$sel.' value="'.$archivo.'">'. $archivo.'</option>';
						}
					}
				}
			}else{
				$data .= '<option>No disponible</option>';
			}
			return $data;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}

	function sinTildes($cadena) {

		$no_permitidas= array ('á','é','í','ó','ú','Á','É','Í','Ó','Ú','ñ','À','Ã','Ì','Ò','Ù','Ã™','Ã ','Ã¨','Ã¬','Ã²','Ã¹','ç','Ç','Ã¢','ê','Ã®','Ã´','Ã»','Ã‚','ÃŠ','ÃŽ','Ã”','Ã›','ü','Ã¶','Ã–','Ã¯','Ã¤','«','Ò','Ã','Ã„','Ã‹','Ñ','à','è','ì','ò','ù');

		$permitidas= array ('a','e','i','o','u','A','E','I','O','U','n','N','A','E','I','O','U','a','e','i','o','u','c','C','a','e','i','o','u','A','E','I','O','U','u','o','O','i','a','e','U','I','A','E','N','a','e','i','o','u');

		$texto = str_replace($no_permitidas, $permitidas ,$cadena);

		return $texto;

	}

	function valoracion_porcentaje($numero){
		$porcentaje = $numero*100;
		$porcentaje = $porcentaje/5;
		return $porcentaje;
	}


}

$functions = new functions();