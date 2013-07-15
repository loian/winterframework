<?php
require_once __DIR__.'/Winter/Init/init.php';

$event = new \Winter\Component\Http\Event\RequestEvent();
Winter\Foundation\Dispatcher\Dispatcher::getInstance()->fireEvent($event);

