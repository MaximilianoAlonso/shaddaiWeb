<?php

class contacto {
	private $db;

	public function send($args){
		try{
			global $mailing, $functions;

			$htmlMensaje =  $mailing->contactenos($args);
			$title = $functions->page_title($htmlMensaje);
			return $mailing->SwiftSend_STMP_SEND(trim($args['name']), $title, EMAILRECEPTOR, $htmlMensaje, trim($args['email']) );
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

}

$contacto = new contacto();