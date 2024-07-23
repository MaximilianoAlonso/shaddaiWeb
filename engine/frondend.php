<?php

$app->map(['GET', 'POST'], '/', '\App\Frondend\Index');

$app->get('/gracias', '\App\Frondend\Index:gracias');

$app->get('/nuestra-firma', '\App\Frondend\Nosotros');
$app->get('/sitemap.xml', '\App\Frondend\Index:sitemap');

$app->group('/servicios', function () use ($app) {
	$app->map(['GET', 'POST'],'', '\App\Frondend\Servicios');
	$app->map(['GET', 'POST'],'/categoria/{categoria}', '\App\Frondend\Servicios:categoria');
	$app->map(['GET', 'POST'],'/{name}', '\App\Frondend\Servicios:view');
	$app->map(['GET', 'POST'],'/{name}/thanks', '\App\Frondend\Servicios:gracias');
});

$app->get('/testimonios', '\App\Frondend\Reviews');

$app->group('/trabajos', function () use ($app) {
	$app->get('', '\App\Frondend\Gallery');
	$app->get('/{id:[0-9]+}', '\App\Frondend\Gallery:view');
});

$app->map(['GET', 'POST'], '/contacto', '\App\Frondend\Contacto');
$app->get('/contacto/thanks', '\App\Frondend\Contacto:gracias');


$app->group('/api', function () use ($app) {
	$app->post('/formulario', '\App\Frondend\Api\Formulario');
});

$app->get('/{name}', '\App\Frondend\Index:Personalizacion');
