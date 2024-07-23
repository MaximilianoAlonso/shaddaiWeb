<?php

try {
	$db = new PDO('mysql:host='.DBHOST.';port='.DBPORT.';dbname='.DBNAME,DBUSER, DBPASS, array( PDO::ATTR_PERSISTENT => false));
	$db->exec("set names latin1");
} catch (PDOException $e) {
	print "Fall&oacute; la conexi&oacute;n: " . $e->getMessage() . "<br/>";
	die();
}