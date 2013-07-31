<?php

namespace Winter\Component\Form\Renderer;

use Winter\Component\Form\Renderer\AbstractElementRenderer;
use Winter\Component\Form\Element\Interfaces\ElementInterface;
use Winter\Component\Form\Renderer\Interfaces\RendererInterface;
/**
 * Description of TextRenderer
 *
 * @author lorenzo
 */
class TextRenderer extends AbstractElementRenderer implements RendererInterface {

    public function render(ElementInterface $text) {
        $format = '<input type="text" %s/>';
        $rendered = sprintf($format, $this->buildAttributeString($text->getAttributes()));
        return $rendered;
    }

}
