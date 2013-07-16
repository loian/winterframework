<?php

namespace Application\Listener;


use Winter\Component\Http\Listener\AbstractHttpListener;
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
    }  
}

?>
