<?php

//Configuraciones

$config = file_get_contents(_DATA_ . '/config.json');

$config = json_decode($config, true);



require_once _DATA_ . '/dbconfig.php';

//Clases

require_once  _CLASS_ .'/database.class.php';

require_once _CLASS_ . '/functions.class.php';

require_once  _CLASS_ .'/sesion.class.php';

require_once _CLASS_ . '/ModifiedImage.php';

require_once  _CLASS_ . '/CircleCrop.class.php';

require_once  _CLASS_ . '/crypto.class.php';

require_once  _CLASS_ . '/mailing.class.php';

//Includes

$inc = $functions->search_require(_INC_);

if(count($inc) > 0){

	foreach ($inc as $key => $value) {

		require_once $value;

	}

}

$es_movil = 0;

if(preg_match('/(android|wap|phone|ipad)/i',strtolower(@$_SERVER['HTTP_USER_AGENT']))){

	$es_movil++;

}

$ip = $_SERVER["REMOTE_ADDR"];

if(isset($_SERVER["HTTP_REFERER"])  && !isset($_COOKIE['in'])){

	setcookie("in", $_SERVER["HTTP_REFERER"],  time()+86400);

}

if(!isset($_COOKIE['analytics'])){

	$analytics =  uniqid();

	setcookie("analytics", $analytics,  time()+604800);

}else{

	$analytics = $_COOKIE['analytics'];

}

//Route
require_once _ENGINE_ . '/app.php';

