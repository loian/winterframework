<?php
require_once __DIR__.'/../../Winter/Foundation/Autoloader/Autoloader.php';
use Winter\Foundation\Config\Config;
use Winter\Foundation\Dispatcher\Dispatcher;
use Winter\Component\Http\Event\HttpRequestEvent;
error_reporting (E_ALL);

/* get http request event */
$requestEvent = new HttpRequestEvent();

/* set the preferred config format */
Config::setConfigFormat(Config::YAML_CONFIG);

/* dispatch the request event */
Dispatcher::getInstance()->notify($requestEvent);



//$s = new \Winter\Component\Http\Session\Session(new Winter\Component\Http\Session\SessionHandler\PhpSessionHandler());
//$s->set('pippeox', 33333);
//var_dump($_SESSION);