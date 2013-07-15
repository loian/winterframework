<?php
require_once __DIR__.'/../Foundation/Autoloader/Autoloader.php';

use Winter\Foundation\Dispatcher\Dispatcher;
use Winter\Component\Http\Event\RequestEvent;
error_reporting (E_ALL);

/* get http request event */
$requestEvent = new RequestEvent();

/* dispatch the request event */
Dispatcher::getInstance()->notify($requestEvent);

