<?php
namespace Winter\Foundation\Listener;

use Winter\Foundation\Listener\Interfaces\ListenerInterface;
use Winter\Foundation\BlockParser\BlockParser;
use Winter\Foundation\Listener\Exceptions\ConditionNotFound;
use Winter\Foundation\Listener\Exceptions\ConditionMethodNotFound;
use Winter\Foundation\Listener\Exceptions\ConditionMethodInvalid;
use Winter\Foundation\Dispatcher\Dispatcher;


/**
 * Base class for all listeners
 *
 * @author Lorenzo Iannone
 */
abstract class AbstractListener implements ListenerInterface {
    /**
     * Handle an event occurenct
     * 
     * @param \Winter\Foundation\Event\Interfaces\EventInterface $event
     */
    abstract public function execute(\Winter\Foundation\Event\Interfaces\EventInterface $event);

    /**
     * Get a data structure representing all annotation of a class
     * 
     * @return array
     */
    final public function getDescriptor() {
        return BlockParser::ofAllClass(get_called_class());
    }
    
    /**
     * Wrapper for dispatcher::notify
     * 
     * @param \Winter\Foundation\Event\Interfaces\EventInterface $event
     */
    final public function dispatcherNotify (\Winter\Foundation\Event\Interfaces\EventInterface $event) {
        Dispatcher::getInstance()->notify($event);
    }

}
