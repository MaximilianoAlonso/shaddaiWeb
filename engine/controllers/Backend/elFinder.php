<?php
namespace App\Backend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class elFinder extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){
		require_once _ENGINE_ . '/class/elfinder/connector.minimal.php';
		return $response;
	}

}