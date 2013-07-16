<?php

namespace Application\Listener;


use Winter\Component\Http\Listener\AbstractHttpListener;
use Winter\Component\Http\Session\Session;
/**
 * Description of TestListener
 *
 * @author lorenzo
 */
class TestListener extends AbstractHttpListener {

    /**
     * @condition test
     * @conditionmethod match  
     * @param \Winter\Foundation\Event\Interfaces\EventInterface $event
     */
    public function execute(\Winter\Foundation\Event\Interfaces\EventInterface $event) {
        echo 'bacche';
        
        $session = new Session(new \Winter\Component\Http\Session\Handler\PhpSessionHandler());
        $session->start();
        //$session->set('bac','che');
        echo $session->get('bac');
    }  
}

