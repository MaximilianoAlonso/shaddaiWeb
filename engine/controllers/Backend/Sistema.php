<?php
namespace App\Backend;
use App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Sistema extends App\Controllers{

	public function __invoke(Request $request, Response $response, $args){
		return $response;

	}

}