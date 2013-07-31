<?php

namespace Winter\Component\Form\Renderer;

use Winter\Component\Form\Renderer\AbstractElementRenderer;
use Winter\Component\Form\Element\Interfaces\ElementInterface;
use Winter\Component\Form\Renderer\Interfaces\RendererInterface;
/**
 * Description of TextAreaRenderer
 *
 * @author lorenzo
 */
class TextAreaRenderer extends AbstractElementRenderer implements RendererInterface {
    
    public function render(ElementInterface $textarea) {
        $format = '<textarea %s>%s</textarea>';
        $rendered = sprintf($format, $this->buildAttributeString($textarea->getAttributes()),$textarea->getValue());
        return $rendered;
    }
}

?>
