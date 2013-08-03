<?php

namespace Winter\Component\Form\Element;
use Winter\Component\Form\Element\Text;
use Winter\Component\Form\Renderer\PasswordRenderer;

/**
 * Password
 *
 * @author Lorenzo Iannone
 */
class Password extends Text  {
    
    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        $this->validators = array();
        //set the default renderer
        $this->renderer = new PasswordRenderer();
    }

}
