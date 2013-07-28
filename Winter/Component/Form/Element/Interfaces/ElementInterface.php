<?php

namespace Winter\Component\Form\Element\Interfaces;

/**
 * ElementInterface
 *
 * @author Lorenzo Iannone
 */
interface ElementInterface {
    /**
     * Set the name of the element
     * 
     * @param string $name
     */
    public function setName($name);
    
    
    /**
     * Get the name of the element
     */
    public function getName();
    
    /**
     * Set one attribute
     * 
     * @param string $key
     * @param mixed $value
     */
    public function setAttribute($key,$value);
    
    
    /**
     * Set one or more attributes
     * @param array $attributes
     */
    public function setAttributes($attributes);
    
    /**
     * Get one attrbute by key
     * 
     * @param string $key
     */
    public function getAttribute($key);
    
    /**
     * Get all attributes
     */
    public function getAttributes();
    
    /**
     * Remove an attribute
     * @param string $key
     */
    public function removeAttribute($key); 
    
    /**
     * Clear all attributes;
     */
    public function clearAttributes();
    
    /**
     * Set the label of the element
     * 
     * @param string $label
     */
    public function setLabel($label);
    
    /**
     * Get the label
     */
    public function getLabel();

}
