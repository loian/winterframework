<?php

/* This code is released under the terms of MIT license */

namespace Winter\Component\Form\Renderer;

use Winter\Component\Form\Renderer\AbstractElementRenderer;
use Winter\Component\Form\Element\Interfaces\ElementInterface;

/**
 * SelectRenderer
 *
 * @author Lorenzo Iannone
 */
class SelectRenderer extends AbstractElementRenderer {

    protected function getRenderedElement(ElementInterface $element) {
        
        $options = array();
        
        //select as some method not listed in interface, we have to 
        //check if element is a select
        if (get_class($element) == \Winter\Component\Form\Element\Select::class) {
            $options = $element->getOptions();
        }
        
        $renderedOptions = "";
        foreach ($options as $option) {
            
            $selectedText = ($option->isSelected()) ? ' selected' : '';
            $disabledText = ($option->isDisabled()) ? ' disabled' : '';
            $labelText = ($option->getLabel() != null) ? ' label'.$option->getLabel() : '';
            
            $format = "\t<option%s%s%s>%s</option>\n";
            $renderedOptions .= sprintf($format, $selectedText, $disabledText, $labelText, $option->getText());
        }
        
        $format = "<select %s>\n%s</select>\n";
        $renderedElement = sprintf($format, $this->buildAttributeString($element->getAttributes()), $renderedOptions);
        return $renderedElement;
        
    }
}

