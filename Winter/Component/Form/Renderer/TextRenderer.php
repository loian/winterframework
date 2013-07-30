<?php

namespace Winter\Component\Form\Renderer;

use Winter\Component\Form\Renderer\AbstractElementRenderer;
use Winter\Component\Form\Element\Interfaces\ElementInterface;

/**
 * Description of TextRenderer
 *
 * @author lorenzo
 */
class TextRenderer extends AbstractElementRenderer {

    public function render(ElementInterface $text) {
        $format = '<input %s/>';
        $rendered = sprintf($format, $this->buildAttributeString($text->getAttributes()));
        return $rendered;
    }

}
