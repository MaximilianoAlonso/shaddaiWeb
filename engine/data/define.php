<?php


define ("VERSION", '2.0');
define ("APP_DEBUG", true);
define ("IPTEST", '192.168.1.37');
define ("PORTTEST", 12);
define ("LOCALE", 'es_PE');
define ("TIMEZONE", 'America/Lima');

//secure
define ("DBKEY", "xcentrobolsa2015");
define ("DBIV", "CMSmottPERU1.000");

define ("EMAILNAME", "Estudio Shaddai Web");
define ("EMAIL", "informes@estudioshaddai.com");
define ("EMAILPASS", "contable2020");

define ("EMAILRECEPTOR", array('informes@estudioshaddai.com'));

if($_SERVER['SERVER_NAME'] == IPTEST){
	$port = ":".PORTTEST;
}else{
	$port = "";
}

if (isset($_SERVER['HTTPS'])) {
	$http = "https";
}else{
	$http = "http";
}
//Rutas
define ( '_HOST_', $http ."://".$_SERVER['SERVER_NAME'].$port);
define ( '_HOSTDIR_', $_SERVER['DOCUMENT_ROOT']);
define ( '_ASSETS_', _HOST_."/assets");
define ( '_CACHE_', _HOSTDIR_."/cache");
define ( '_LOG_', _HOSTDIR_."/log/".date("Y")."/".date("m")."/".date("d-m-Y").".log");
define ( '_ENGINE_', _HOSTDIR_."/engine");
define ( '_CLASS_', _ENGINE_."/class");
define ( '_DATA_', _ENGINE_."/data");
define ( '_INC_', _ENGINE_."/inc");
define ( '_MODULES_', _ENGINE_."/modules");
define ( '_CONTROLLERS_', _ENGINE_."/controllers");
define ( '_VIEWS_', _ENGINE_."/views");