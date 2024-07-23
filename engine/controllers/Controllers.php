<?php

namespace App;
use Psr\Container\ContainerInterface as ContainerInterface;

Class Controllers{
	protected $ci;
	protected $config;
	protected $sesion;
	protected $functions;
	protected $user;
	protected $ip;
	protected $analytics;

	public function __construct(ContainerInterface $ci) {
		try {
			global $config, $sesion, $functions, $user, $ip, $analytics, $es_movil, $user;
			$this->ci = $ci;
			$this->config = $config;
			$this->ip = $ip;
			$this->analytics = $analytics;
			$this->sesion = $sesion;
			$this->functions = $functions;
			$this->user = $user;

		}
		catch (customException $e) {
			echo $e->errorMessage();
		}
	}

}