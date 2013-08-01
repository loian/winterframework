<?php

namespace Application\Listener;


use Winter\Component\Http\Listener\AbstractHttpListener;
use Winter\Component\Http\Session\Session;
/**
 * Description of TestListener
 *
 * @author lorenzo
 */
class TestListener2 extends AbstractHttpListener {

    /**
     * @condition test
     * @conditionmethod match
     * @param \Winter\Foundation\Event\Interfaces\EventInterface $event
     */
    public function execute(\Winter\Foundation\Event\Interfaces\EventInterface $event) {
        echo 'bacche2';
       
    }  
    
    public function testEx() {
        if (rand(1,2) == 1)
        return false;
        else
        return true;
                
    }
}

