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
     * @conditionstrategy match
     * @param \Winter\Foundation\Event\Interfaces\EventInterface $event
     */
    public function execute(\Winter\Foundation\Event\Interfaces\EventInterface $event) {
        
        $session = new Session(new \Winter\Component\Http\Session\SessionHandler\PhpSessionHandler());
        $session->start();
        $cookie = new \Winter\Component\Http\Cookie\Cookie;
        //$session->set('bac','che');
        //echo $session->get('bac');
        
        //$x = \Winter\Foundation\Container\Container::getInstance()->getService("testservice");
        //$x->testMethod();
//        $config = new \Winter\Foundation\Config\Config();
//        $config->setConfigHandler(new \Winter\Foundation\Config\Handler\YamlConfigHandler());
//        $x = new \stdClass();
//        $x->y = array(1,3,4);
//        $config->writeConfig($x, "/home/lorenzo/test/x.yml");
        $t = new \Winter\Component\Form\Element\Select();
        $t->setOption(new \Winter\Component\Form\Element\SelectOption(33, "test"));
        
        $t->setAttribute('name', 'testo')
                ->setAttribute("id", "a34443")
                ->setLabel('elemento:');
                
        echo $t->render();
    }  
    
    public function testEx() {
        if (rand(1,2) == 1)
        return false;
        else
        return true;
                
    }
}

