<?php
namespace Application\Test;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestService2
 *
 * @author lorenzo
 */
class TestService2 {
    
    public $x;
    
    public function __construct($test) {
        $this->x = $test;
    }
    
    public function test() {
        echo '<br/>questo e` un pregiato esempio di dependency injection<br/>';
        echo $this->x->testMethod();
    }
}

?>
