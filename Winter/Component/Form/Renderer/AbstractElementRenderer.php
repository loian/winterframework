<?php

namespace Winter\Component\Form\Renderer;

use Winter\Component\Form\Renderer\Interfaces\RendererInterface;
use Winter\Component\Form\Element\Interfaces\ElementInterface;

/**
 * AbstractElementRenderer
 *
 * @author Lorenzo Iannone
 */
abstract class AbstractElementRenderer implements RendererInterface {

    /**
     * Render the element
     */
    abstract public function render(ElementInterface $element);

    /**
     * Build a string from attributes in attr="val" format
     * 
     * @return string
     */
    protected function buildAttributeString($attributes) {
        
        $tmp = array();
        foreach ($attributes as $attr => $value) {
            $tmp[] = sprintf('%s="%s"', $attr, $value);
        }
        return implode(' ', $tmp);
    }

}
