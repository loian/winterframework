<?php

namespace Winter\Component\Form\Element;

use Winter\Component\Form\Element\Interfaces\ElementInterface;
use Winter\Component\Form\Element\Exception\AttrbuteNotFound;
use Winter\Component\Form\Element\Exception\TypeOverride;

/**
 * Element
 *
 * @author Lorenzo Iannone
 */
class Element implements ElementInterface {

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $attributes;
    

    /**
     * Default constructor
     */
    public function __construct() {
        $this->attributes = array();
    }

    /**
     * 
     * @param string $name
     * @return \Winter\Component\Form\Element\Element
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the name of the element
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set one attribute
     * 
     * @param string $key
     * @param mixed $value
     * @return \Winter\Component\Form\Element\Element
     * @throws TypeOverride
     */
    public function setAttribute($key, $value) {
         if(strtolower($key) == 'type') {
             throw new TypeOverride();
         }
        $this->attributes[$key] = $value;
        return $this;
    }

    /**
     * Set one or more attributes
     * @param array $attributes
     * @return \Winter\Component\Form\Element\Element
     * @throws TypeOverride
     */
    public function setAttributes($attributes) {
        if($this->chechTypeOverride()) {
            throw new TypeOverride();
        }
        
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * Get one attrbute by key
     * 
     * @param string $key
     * @return \Winter\Component\Form\Element\Element
     * @throws AttrbuteNotFound
     */
    public function getAttribute($key) {
        if (!key_exists($key, $this->attributes)) {
            throw new AttrbuteNotFound();
        }

        return $this->attributes[$key];
    }

    /**
     * Get all attributes
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**
     * Remove an attribute
     * @param string $key
     * @return \Winter\Component\Form\Element\Element
     * @throws AttrbuteNotFound
     */
    public function removeAttribute($key) {
        if (!key_exists($key, $this->attributes)) {
            throw new AttrbuteNotFound();
        }

        unset($this->attributes[$key]);
        return $this;
    }

    /**
     * Clear all attributes;
     * @return \Winter\Component\Form\Element\Element
     */
    public function clearAttributes() {
        $this->attributes = array();
        return $this;
    }

    /**
     * Set the label of the element
     * 
     * @param string $label
     * @return \Winter\Component\Form\Element\Element
     */
    public function setLabel($label) {
        $this->label = $label;
        return $this;
    }

    /**
     * Get the label
     */
    public function getLabel() {
        return $this->label;
    }
    
    public function chechTypeOverride() {
        foreach($this->attributes as $k=>$v) {
            if(strtolower($k) == 'type') {
                return true;
            }
        }
        return false;
    }
    

}
