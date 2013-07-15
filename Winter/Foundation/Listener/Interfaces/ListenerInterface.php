<?php
namespace Winter\Foundation\Listener\Interfaces;
use Winter\Foundation\Event\Interfaces\EventInterface;

/**
 * The interface that all Listeners registered to dispatcher should implement.
 * @author Lorenzo Iannone
 */
interface ListenerInterface {
    
    /**
     * Get an array representing the code docblock
     * 
     * @return array
     */
    public function getDescriptor();
    
    /**
     * Execute some action when waked up
     * 
     * @param \Winter\Foundation\Event\Interfaces\EventInterface $event
     */
    public function execute (EventInterface $event);
    
    
}
