<?php

namespace Winter\Component\Form\Renderer\Interfaces;

use Winter\Component\Form\Element\Interfaces\ElementInterface;
/**
 * Render Interface
 * 
 * @author Lorenzo Iannone
 */
interface RendererInterface {
    
    /**
     * Render an element
     * @return string
     */
    public function render(ElementInterface $element);

    /**
     * Build a string from attributes
     * @return string
     */    
    public function buildAttributeString($attributes);
}
