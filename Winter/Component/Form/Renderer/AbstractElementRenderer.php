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
     * The html before the element
     * @var string
     */
    protected $prefix;

    /**
     * The html after the element
     * @var string
     */
    protected $suffix;
    
    
    /**
     * Get a html representation of the element
     * 
     * @param \Winter\Component\Form\Element\Interfaces\ElementInterface $text
     * @return string
     */
    abstract protected function getRenderedElement(ElementInterface $element);

    /**
     * Build a string from attributes in attr="val" format
     * 
     * @return string
     */
    public function buildAttributeString($attributes) {
        
        $tmp = array();
        foreach ($attributes as $attr => $value) {
            $tmp[] = sprintf('%s="%s"', $attr, $value);
        }
        return implode(' ', $tmp);
    }
    
    /**
     * Return an html representation for the element label
     * 
     * @param \Winter\Component\Form\Element\Interfaces\ElementInterface $element
     * @return string
     */
    protected function getRenderedLabel(ElementInterface $element) {
        $format = '<label for="%s">%s</label>';
        
        try {
           $id = $element->getAttribute('id');
        } catch (Exception $e) {
            return '';
        }
        if($element->getLabel()) {
            return sprintf ($format, $id, $element->getLabel());
        }
        
        return '';
    }
    
    public function setPrefix($html) {
        
    }

    public function render(ElementInterface $element) {
        return $this->prefix . 
               $this->getRenderedLabel($element) .
               $this->getRenderedElement($element) .
               $this->suffix;
    }
}
