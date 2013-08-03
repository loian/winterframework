<?php

namespace Winter\Component\Form\Renderer;

use Winter\Component\Form\Renderer\AbstractElementRenderer;
use Winter\Component\Form\Element\Interfaces\ElementInterface;
use Winter\Component\Form\Renderer\Interfaces\RendererInterface;
/**
 * PasswordRenderer
 *
 * @author Lorenzo Iannone
 */
class PasswordRenderer extends AbstractElementRenderer implements RendererInterface {

    /**
     * Get a html representation of the element
     * 
     * @param \Winter\Component\Form\Element\Interfaces\ElementInterface $text
     * @return string
     */
    protected function getRenderedElement(ElementInterface $text) {
        $format = "<input type=\"password\" %s/>\n";
        $rendered = sprintf($format, $this->buildAttributeString($text->getAttributes()));
        return $rendered;
    }

}
