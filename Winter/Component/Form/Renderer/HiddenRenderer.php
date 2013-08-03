<?php

namespace Winter\Component\Form\Renderer;

use Winter\Component\Form\Renderer\AbstractElementRenderer;
use Winter\Component\Form\Element\Interfaces\ElementInterface;
use Winter\Component\Form\Renderer\Interfaces\RendererInterface;
/**
 * Description of HiddenRenderer
 *
 * @author Lorenzo Iannone
 */
class HiddenRendererRenderer extends AbstractElementRenderer implements RendererInterface {

    /**
     * Get a html representation of the element
     * 
     * @param \Winter\Component\Form\Element\Interfaces\ElementInterface $text
     * @return string
     */
    protected function getRenderedElement(ElementInterface $text) {
        $format = "<input type=\"hidden\" %s/>\n";
        $rendered = sprintf($format, $this->buildAttributeString($text->getAttributes()));
        return $rendered;
    }
    
    /**
     * Override the standard render method to prevent rendering
     * of prefix, label and suffix
     * 
     * @param \Winter\Component\Form\Element\Interfaces\ElementInterface $element
     * @return type
     */
    public function render(ElementInterface $element) {
        return $this->getRenderedElement($element);
    }

}
