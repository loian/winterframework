<?php

namespace Winter\Component\Form\Renderer;

use Winter\Component\Form\Renderer\AbstractElementRenderer;

/**
 * Description of TextRenderer
 *
 * @author lorenzo
 */
class TextRenderer extends AbstractElementRenderer {

    public function render($text) {
        $format = '<input type="%s" %s/>';
        $rendered = sprintf($format, $text->getAttribute('type'), $this->buildAttributeString($text->getAttributes()));
        return $rendered;
    }

}
