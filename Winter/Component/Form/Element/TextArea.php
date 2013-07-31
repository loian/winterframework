<?php

namespace Winter\Component\Form\Element;

use Winter\Component\Form\Renderer\AbstractElementRenderer;
use Winter\Component\Form\Element\Interfaces\ElementInterface;
use Winter\Component\Form\Renderer\TextAreaRenderer;

/**
 * TextArea
 *
 * @author Lorenzo Iannone
 */
class TextArea extends Text{
    
    protected $value;
    
    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        $this->setRenderer(new TextAreaRenderer());
    }
    
    public function setValue($value) {
        $this->value = $value;
    }
    
    public function getValue() {
        return $value;
    }
}
