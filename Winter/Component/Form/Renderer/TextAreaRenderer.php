<?php

namespace Winter\Component\Form\Renderer;

use Winter\Component\Form\Renderer\AbstractElementRenderer;
use Winter\Component\Form\Element\Interfaces\ElementInterface;
use Winter\Component\Form\Renderer\Interfaces\RendererInterface;
/**
 * Description of TextAreaRenderer
 *
 * @author Lorenzo Iannone
 */
class TextAreaRenderer extends AbstractElementRenderer implements RendererInterface {

    /**
     * Get a html representation of the element
     * 
     * @param \Winter\Component\Form\Element\Interfaces\ElementInterface $text
     * @return string
     */    
    protected function getRenderedElement(ElementInterface $textarea) {
        $format = "<textarea %s>%s</textarea>\n";
        $rendered = sprintf($format, $this->buildAttributeString($textarea->getAttributes()),$textarea->getValue());
        return $rendered;
    }
}

?>
