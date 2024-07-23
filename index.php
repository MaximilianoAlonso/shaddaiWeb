<?php

/*
=====================================================
 Slim Base
-----------------------------------------------------
 http://slim.base/
-----------------------------------------------------
 Archivo: index.php
-----------------------------------------------------
 Desarrollado: Paul Zuñiga
-----------------------------------------------------
 Copyright (c) 2018
=====================================================
*/

/* Composer */
require __DIR__.'/engine/data/define.php';


require __DIR__.'/vendor/autoload.php';


date_default_timezone_set(TIMEZONE);
setlocale(LC_ALL,LOCALE);
ini_set('max_execution_time', 200);
ini_set('session.gc_maxlifetime', 14400);
@session_set_cookie_params(14400);
session_start();
require_once(_ENGINE_."/init.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
