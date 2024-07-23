<?php


$SesionAdmin = function ($request, $response, $next) use ($app) {
	global $sesion;
	$uri = $request->getUri();
	$url_path = $uri->getPath();

	if($sesion->is_loggedin()){
		if ($url_path == '/admin/login') {
			return $response->withRedirect('/admin');
		}
	}else{
		if ($url_path != '/admin/login') {
			return $response->withRedirect('/admin/login');
		}
	}
	$app->cache = true;
	return $next($request, $response);
};