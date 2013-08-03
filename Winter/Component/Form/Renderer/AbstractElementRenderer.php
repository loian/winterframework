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
     * The html between label and element
     * 
     * @var string
     */
    protected $separator;
    
    
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
        $format = "<label for=\"%s\">%s</label>\n";
        
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
    
    /**
     * Set the prefix html code
     * 
     * @param string $html
     */
    public function setPrefix($html) {
        $this->prefix = $html;
    }

    /**
     * Set the suffix html code
     * 
     * @param string $html
     */
    public function setSuffix($html) {
        $this->suffix = $html;
    }
    
    /**
     * Set the html code which separate label and element
     * 
     * @param string $html
     */
    public function setSeparator($html) {
        $this->prefix = $html;
    }
    
    
    /**
     * Render the element as a string like
     * prefix+label+separator+element+suffix
     * 
     * @param \Winter\Component\Form\Element\Interfaces\ElementInterface $element
     * @return string
     */
    public function render(ElementInterface $element) {
        return $this->prefix . 
               $this->getRenderedLabel($element) .
               $this->separator .
               $this->getRenderedElement($element) .
               $this->suffix;
    }
}
