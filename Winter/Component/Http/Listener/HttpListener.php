<?php

namespace Winter\Component\Http\Listener;

use Winter\Foundation\Listener\AbstractListener;
use Winter\Component\Http\Event\RequestGatewayEvent;
use Winter\Foundation\Event\Interfaces\EventInterface;
use Winter\Foundation\Container\Container;

/**
 * Handler for http requests
 *
 * @author Lorenzo Iannone
 */
class HttpListener extends AbstractListener {
    
    /**
     * Handle an http event
     * 
     * @param \Winter\Foundation\Event\Interfaces\EventInterface $event
     * @condition test
     * @conditionmethod execute
     */
    public function execute(EventInterface $event) {
        $gatewayRequest = new RequestGatewayEvent();
        $this->dispatcherNotify($gatewayRequest);
        
//        $test = Container::getInstance()->getService('testservice');
//        $test->testMethod();
//        
//        
//        $test2 = Container::getInstance()->getService('testservice2');
//        $test2->test();
        
    }
    
    
    public function test(EventInterface $event){
        if ($event->getIdentifier() == '/bacche') return true;
        return false;
        
    }

}
