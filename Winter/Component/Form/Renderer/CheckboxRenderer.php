<?php

namespace Winter\Component\Form\Renderer;

use Winter\Component\Form\Renderer\AbstractElementRenderer;
use Winter\Component\Form\Element\Interfaces\ElementInterface;
use Winter\Component\Form\Renderer\Interfaces\RendererInterface;
/**
 * CheckboxRenderer
 *
 * @author Lorenzo Iannone
 */
class CheckboxRenderer extends AbstractElementRenderer implements RendererInterface {

    /**
     * Get a html representation of the element
     * 
     * @param \Winter\Component\Form\Element\Interfaces\ElementInterface $text
     * @return string
     */
    protected function getRenderedElement(ElementInterface $checkbox) {
        
        $checkedString = '';
        if($checkbox->getValue()) {
            $checkedString = sprintf('checked="%s"',$checkbox->getValue());
        }
        
        $format = '<input type="checkbox" %s %s/>';
        $rendered = sprintf($format, $this->buildAttributeString($checkbox->getAttributes()), $checkedString);
        return $rendered;
    }

}
