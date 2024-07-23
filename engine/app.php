<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App(["settings" => $config]);

require_once _ENGINE_ . '/middleware.php';

$container = $app->getContainer();

$container['view'] = function ($container) use ($app) {

	global $ip, $config, $sesion, $functions, $user, $es_movil, $analytics, $servicios, $servicios_imagenes, $testimonios, $personalizados, $servicios_subimagenes;

	$twig['cache'] = _CACHE_;
	$twig['auto_reload'] = true;

	if (isset($app->cache)) {
		$twig['cache'] = false;
	}

	$view = new \Slim\Views\Twig(_VIEWS_, $twig);
	$basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
	$view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));


	$agente = @$_SERVER['HTTP_USER_AGENT'];
	$google_page_speed = false;
	if (preg_match("/Google Page Speed Insights/i", $agente)) {
		$google_page_speed = true;
	}

	if (preg_match("/Chrome-Lighthouse/i", $agente)) {
		$google_page_speed = true;
	}

	$view->offsetSet('es_movil', $es_movil);
	$view->offsetSet('config', $config);
	$view->offsetSet('functions', $functions);
	$view->offsetSet('user', $user);
	$view->offsetSet('ip', $ip);
	$view->offsetSet('url', _HOST_);
	$view->offsetSet('request', _HOST_.$_SERVER["REQUEST_URI"]);
	$view->offsetSet('assets', _ASSETS_);
	$view->offsetSet('frondend', _ASSETS_.'/frondend');
	$view->offsetSet('backend', _ASSETS_.'/backend');
	$view->offsetSet('recursos', '/frondend/'.$config['frondend']);
	$view->offsetSet('admin', '/backend');
	$view->offsetSet('theme', _ASSETS_.'/frondend/'.$config['frondend']);
	$view->offsetSet('errors', _ASSETS_.'/errors');
	$view->offsetSet('analytics', $analytics);
	$view->offsetSet('gobot', $google_page_speed);
	$view->offsetSet('servicios', $servicios);
	$view->offsetSet('testimonios', $testimonios);
	$view->offsetSet('servicios_imagenes', $servicios_imagenes);
	$view->offsetSet('servicios_subimagenes', $servicios_subimagenes);
	$view->offsetSet('personalizados', $personalizados);

	return $view;
};

$container['notFoundHandler'] = function ($c) {
	return new App\Extensions\NotFound($c->get('view'), $c->get('logger'));
};

$container['notAllowedHandler'] = function ($c) {
	return new App\Extensions\notAllowed($c->get('view'), $c->get('logger'));
};

$container['logger'] = function($c) {
	$path = $_SERVER["REQUEST_URI"];
	$logger = new \Monolog\Logger('my_logger');
	if (!preg_match('/^.*\.(jpg|jpeg|png|gif|ico)$/i', $path)) {
		$file_handler = new \Monolog\Handler\StreamHandler(_LOG_);
		$logger->pushHandler($file_handler);
	}
	return $logger;
};


require_once _ENGINE_ . '/backend.php';
require_once _ENGINE_ . '/frondend.php';

$app->run();